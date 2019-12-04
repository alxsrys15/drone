<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use Ahc\Jwt\JWT;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function beforeFilter (Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow('logout');
    }


    public function index()
    {
        $this->paginate = [
            'contain' => ['Googles']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Googles', 'Customers']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $googles = $this->Users->Googles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'googles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $googles = $this->Users->Googles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'googles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login () {
        if ($this->request->is('post')) {
            // pr($this->request->data);die();
            $q = $this->Users->findByEmail($this->request->data['email'])->first();
            if ($q->is_active) {
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    return $this->redirect(['controller' => $user['lib_user_role']['name'] === "Admin" ? 'Admin' : 'Home']);
                }
                $this->Flash->error(__('Invalid username or password, try again'));
            } else {
                $this->Flash->error(__('Please verify your account.'));
            }
        }

        if ($this->request->is('get')) {
            if (!empty($this->request->query['user'])) {
                $jwt = new JWT('secret', 'HS256', 3600, 10);
                $token = $this->request->query['user'];
                $payload = $jwt->decode($token);
                $user = $this->Users->get($payload['id']);
                $user->is_active = 1;
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Account verified. You can now log in.'));
                }
            }
        }
    }

    public function register () {
        $errors = [];
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $newUser = $this->Users->newEntity($data);
            $newUser->verification_token = '';
            $errors = $newUser->getErrors();
            if ($this->Users->save($newUser)) {
                $this->Flash->success(__('Registration successful. Please verify your email first to login.'));
                $this->redirect(['action' => 'login']);
            }
        }
        $this->set(compact('errors'));
    }

    public function logout () {
        return $this->redirect($this->Auth->logout());
    }
}

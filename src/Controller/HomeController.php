<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomeController extends AppController
{
    public function beforeFilter ($event) {
        parent::beforeFilter($event);
        $this->Auth->allow('index');
    }

    public function initialize () {
    	parent::initialize();
    	$this->loadModel('Products');
    }

    public function index () {
    	$products = $this->Products->find('all');

    	$this->set(compact('products'));
    }
    
}

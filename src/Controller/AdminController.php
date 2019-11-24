<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdminController extends AppController
{
    public function beforeFilter (Event $event) {
        parent::beforeFilter($event);
        
    }

    public function initialize () {
    	parent::initialize();
    	$this->loadModel('Products');
        $this->loadModel('Orders');
        $this->loadModel('Users');
        $this->viewBuilder()->setLayout('admin');
    }

    public function index () {
    	$orders = $this->Orders->find('all', ['contain' => 'OrderDetails'])->toArray();
        $monthly_sales = $this->Orders->find();

        $total_sales = 0;
        $pending_orders = 0;
        foreach ($orders as $order) {
            $total_sales += $order->total;
            if ($order->lib_status_code_id === 2) {
                $pending_orders++;
            }
        }

        $response = @file_get_contents( "https://www.instagram.com/droneclothingco/?__a=1" );
        $response = json_decode($response, true);
        $followers = $response['graphql']['user']['edge_followed_by']['count'];
        $this->set(compact('total_sales', 'followers', 'pending_orders'));
    }

    public function products () {
    	$categories = $this->Products->Categories->find('list', [
            'conditions' => [
                'is_active' => 1
            ]
        ]);
    	$sizes = $this->Products->ProductVariants->Sizes->find('list', ['fields' => ['id', 'name']])->toArray();
    	$products = $this->Products->find('all', [
    		'contain' => [
    			'ProductVariants',
    			'ProductVariants.Sizes',
    			'Categories'
    		]
    	]);
    	$this->set(compact('categories', 'sizes', 'products'));
    }

    public function productAdd () {
    	$arr_ext = ['jpg', 'jpeg', 'png'];
    	if ($this->request->is('post')) {
    		// pr($this->request->data);die();
    		$images = [$this->request->data['img1'], $this->request->data['img2'], $this->request->data['img3']];
    		$new_product = $this->Products->newEntity($this->request->getData(), ['associated' => ['ProductVariants']]);
    		
    		foreach ($images as $key => $image) {
    			if (in_array(pathinfo($image['name'], PATHINFO_EXTENSION), $arr_ext)) {
    				$uploaded = false;
    				$ctr = $key + 1;
    				if (move_uploaded_file($image['tmp_name'], WWW_ROOT . '/img/product_images/' . $image['name'])) {
    					$new_product['img'.$ctr] = $image['name'];
    					$uploaded = true;
    				} else {
    					$new_product['img'.$ctr] = '';
    				}
    			}
    		}
    		
    		if ($uploaded) {
    			if ($this->Products->save($new_product, ['associated' => ['ProductVariants']])) {
    				$this->Flash->success(__('Product succesfully added'));
    				return $this->redirect(['action' => 'products']);
    			}
    		}
    	}
    }

    public function users () {
        $users = $this->Users->find('all', [
            'conditions' => [
                'lib_user_roles_id' => 1
            ]
        ]);
        $this->set(compact('users'));
    }

    public function usersDelete ($id, $active) {
        if ($id) {
            $user = $this->Users->get($id);
            $user->is_active = $active;
            if ($this->Users->save($user)) {
                $this->Flash->success(__($active ? 'User activated' : 'User deactivated'));
                return $this->redirect(['action' => 'users']);
            }
        }
    }

    public function userAdd () {
        if ($this->request->is('post')) {
            if ($this->Users->save($this->request->getData())) {
                $this->Flash->success(__('User created'));
            } else {
                $this->Flash->error(__('Registration unsuccesful'));
            }
        }
        return $this->redirect(['action' => 'users']);
    }

    public function updateOrderStatus ($id, $status) {
        if ($id) {
            $order = $this->Orders->get($id);
            $order->lib_status_code_id = $status;
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('Purchase order updated.'));
            } else {
                $this->Flash->error('Something went wrong');
            }
        }
        return $this->redirect(['action' => 'orders']);
    }

    public function orders () {
        $orders = $this->Orders->find('all', [
            'contain' => [
                'Users',
                'LibStatusCodes'
            ],
            'order' => [
                'Orders.created' => 'DESC'
            ]
        ]);
        $this->set(compact('orders'));
    }
    
    public function categories () {
    	$categories = $this->Products->Categories->find('all');
    	
    	$this->set(compact('categories'));
    }

    public function categoriesAdd () {
    	if ($this->request->is('post')) {
    		if ($this->Products->Categories->save($this->Products->Categories->newEntity($this->request->data))) {
    			$this->Flash->success(__('Category succesfully added'));
    			return $this->redirect(['action' => 'categories']);
    		}
    	}
    }

    public function categoriesDelete ($id, $active) {
    	if ($id) {
    		$category = $this->Products->Categories->get($id);
    		$category->is_active = $active;
    		if ($this->Products->Categories->save($category)) {
    			$this->Flash->success(__($active ? 'Category activated' : 'Category deactivated'));
    			return $this->redirect(['action' => 'categories']);
    		}
    	}
    }

    public function getSalesData () {
        $this->autoRender = false;
        $returnData = [];
        if ($this->request->is('post')) {
            $sales = $this->Orders->find();
            $sort = $this->request->getData('sort');
            $query = [];
            if ($sort === "month") {
                $query = [
                    'month' => $sales->func()->monthname(['created' => 'identifier'])
                ];
            } else {
                $query = [
                    'year' => $sales->func()->year(['created' => 'identifier'])
                ];
            }
            $sales->select($query)
            ->select(['total' => $sales->func()->sum('total')])
            ->group([$sort]);
            foreach ($sales as $s) {
                $returnData[] = [
                    'label' => $s[$sort],
                    'total' => $s['total']
                ];
            }
        }
        echo json_encode($returnData);
    }

    public function download () {
        $this->response->download('report.csv');
        $data = $this->Orders->find('all', [
            'contain' => [
                'Users',
                'LibStatusCodes'
            ],
            'order' => [
                'Orders.created' => 'DESC'
            ]
        ]);

        $export_data = [];
        foreach ($data as $d) {
            $export_data[] = [
                'customer' => $d->user->first_name . ' ' . $d->user->last_name,
                'total' => $d->total,
                'shipping_address' => $d->shipping_address,
                'payment_type' => $d->payment_type,
                'date' => $d->created->setTimezone('Asia/Manila'),
                'status' => $d->lib_status_code->name
            ];
        }
        $_serialize = 'export_data';
        $_header = count($export_data) > 0 ? array_keys($export_data[0]) : [];
        $this->set(compact('export_data', '_serialize', '_header'));
        $this->viewBuilder()->className('CsvView.Csv');
        return;
    }
}

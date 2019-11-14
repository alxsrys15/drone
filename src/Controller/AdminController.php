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
    }

    public function index () {
    	
    }

    public function products () {
    	$categories = $this->Products->Categories->find('list');
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
}

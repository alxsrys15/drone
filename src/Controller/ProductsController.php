<?php
namespace App\Controller;

use App\Controller\AppController;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Exception\PayPalConnectionException;
use Ahc\Jwt\JWT;
use Cake\Routing\Router;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function beforeFilter ($event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['view', 'index', 'cart']);
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories']
        ];
        $query = $this->Products->find('all');

        if (!empty($this->request->query)) {
            if (!empty($this->request->query['category'])) {
                $query->where(['category_id' => $this->request->query['category']]);
            }
        }

        $products = $this->paginate($query);

        $categories = $this->Products->Categories->find('all');

        $this->set(compact('products', 'categories'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Categories', 'ProductVariants', 'ProductVariants.Sizes']
        ]);

        $sizes = [];
        $sku = [];

        foreach ($product->product_variants as $key => $v) {
            $sizes[$v->size->id] = $v->size->name;
            if (!empty($sku[$v->size->name])) {
                $sku[$v->size->id] += $v->sku;
            } else {
                $sku[$v->size->id] = $v->sku;
            } 
        }

        $this->set(compact('product', 'sizes', 'sku'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function cart () {
        if ($this->request->is('post')) {
            if ($this->Auth->User('id')) {
                $payment_type = $this->request->getData()['payment_type'];
                $items = json_decode($this->request->getData()['items'], true);
                $shipping_address = $this->request->getData()['shipping_address'];
                if ($payment_type === "paypal") {
                    $this->processPaypal($items, $shipping_address);
                }
            } else {
                $this->Flash->error(__('Please login to continue'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            }
        }
    }

    public function populateCartTable () {
        if ($this->request->is('post')) {
            $cart = json_decode($this->request->data['data'], true);
            $this->set(compact('cart'));
            $this->render('cart_table');
        }
    }

    private function processPaypal ($items, $shipping_address) {
        $jwt = new JWT('secret', 'HS256', 3600, 10);

        if (!empty($items)) {
            $paypalItemList = new ItemList();
            $total_amount = 0;
            foreach ($items as $i) {
                $total_amount += $i['total'];
                $paypalItem = new Item([
                    'name' => $i['name'],
                    'quantity' => $i['count'],
                    'price' => $i['price'],
                    'currency' => 'PHP'
                ]);
                $paypalItemList->addItem($paypalItem);
            }
            // pr($paypalItemList);die();
            $payment = new Payment([
                'intent' => 'sale',
                'redirect_urls' => [
                    'return_url' => Router::url(['controller' => 'products', 'action' => 'completeOrder', '?' => ['order_details' => $jwt->encode(['items' => $items, 'shipping_address' => $shipping_address]), 'success' => true]], true),
                    'cancel_url' => Router::url(['controller' => 'products', 'action' => 'cart'], true)
                ],
                'payer' => ['payment_method' => 'paypal'],
                'transactions' => [
                    [
                        'amount' => [
                            'total' => $total_amount + 100,
                            'currency' => 'PHP',
                            'details' => [
                                'shipping' => 100,
                                'sub_total' => $total_amount
                            ]
                        ],
                        'item_list' => $paypalItemList,
                        'description' => 'Payment',
                        'invoice_number' => uniqid()
                    ]
                ]
            ]);
            try {
                $payment->create($this->apiContext);
            } catch (PayPalConnectionException $ex) {
                pr($ex->getData());die();
            }
            $approvalUrl = $payment->getApprovalLink();
            return $this->redirect($approvalUrl);
        }
    }

    public function completeOrder () {
        $this->loadModel('Orders');
        $jwt = new JWT('secret', 'HS256', 3600, 10);
        if ($this->request->is('get')) {
            $is_success = $this->request->getQuery()['success'];
            $saved = false;
            if ($is_success) {
                $order_details = $jwt->decode($this->request->getQuery()['order_details']);
                $items = json_decode(json_encode($order_details['items']), true);
                $token_check = $this->Orders->exists(['payment_token' => $this->request->getQuery()['token']]);
                if (!$token_check) {
                    $total = 0;
                    $newOrderDetails = [];
                    $shipping_address = $order_details['shipping_address'];
                    foreach ($items as $i) {
                        $total += $i['total'];
                        $newOrderDetails[] = [
                            'product_id' => $i['id'],
                            'quantity' => $i['count']
                        ];
                    }
                    $newOrder = [
                        'user_id' => $this->Auth->User('id'),
                        'total' => (int) $total,
                        'shipping_address' => $shipping_address,
                        'payment_type' => 'PAYPAL',
                        'lib_status_code_id' => 2,
                        'payment_token' => $this->request->getQuery()['token'],
                        'order_details' => $newOrderDetails
                    ];
                    $newOrder = $this->Orders->newEntity($newOrder, ['associated' => 'OrderDetails']);
                    
                    if ($this->Orders->save($newOrder, ['associated' => 'OrderDetails'])) {
                        $this->adjustStock($items);
                    }
                }
                $this->set(compact('items'));
            }
        }
    }

    private function adjustStock($items = []) {
        if (!empty($items)) {
            foreach ($items as $i) {
                $pv = $this->Products->ProductVariants->find('all', [
                    'conditions' => [
                        'product_id' => $i['id'],
                        'size_id' => $i['size_id']
                    ]
                ])->first();
                $pv->sku = $pv->sku - $i['count'];
                $this->Products->ProductVariants->save($pv);
            }
        }
    }
}

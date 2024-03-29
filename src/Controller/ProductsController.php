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
use PayMaya\API\Checkout;
use PayMaya\PayMayaSDK;
use PayMaya\API\Customization;


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

    public function initialize () {
        parent::initialize();
        PayMayaSDK::getInstance()->initCheckout('pk-lNAUk1jk7VPnf7koOT1uoGJoZJjmAxrbjpj6urB8EIA', 'sk-fzukI3GXrzNIUyvXY3n16cji8VTJITfzylz5o5QzZMC');
        // $shopCustomization = new Customization();
        // $shopCustomization->customTitle = "Drone Clothing Co.";
        // $shopCustomization->logoUrl = ROUTER::url('/webroot/img/assets/drone_logo.jpeg', true);
        // $shopCustomization->iconUrl = ROUTER::url('/webroot/img/assets/drone_logo.jpeg', true);
        // $shopCustomization->appleTouchIconUrl = ROUTER::url('/img/assets/drone_logo.jpeg', true);
        // $shopCustomization->colorScheme = '#368d5c';
        // $shopCustomization->set();
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories']
        ];
        $query = $this->Products->find('all');

        if (!empty($this->request->query)) {
            if (!empty($this->request->query['category']) && isset($this->request->query['category'])) {
                $query->where(['category_id' => $this->request->query['category']]);
            }
            if (!empty($this->request->query['gender']) && isset($this->request->query['category'])) {
                $query->where(['gender_id' => $this->request->query['gender']]);
            }
        }

        $products = $this->paginate($query);

        $categories = $this->Products->Categories->find('all');
        $genders = $this->Products->Genders->find('all');

        $this->set(compact('products', 'categories', 'genders'));
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
        $this->loadModel('Payments');
        $this->loadModel('ShippingFee');
        $payment_types = $this->Payments->find('list', [
            'fields' => [
                'name'
            ],
            'conditions' => [
                'is_active' => 1
            ]
        ]);
        $shipping = $this->ShippingFee->find('all')->first();
        if ($this->request->is('post')) {
            if ($this->Auth->User('id')) {
                $payment_type = $this->request->getData()['payment_type'];
                $items = json_decode($this->request->getData()['items'], true);
                $shipping_address = [
                    'street_address' => $this->request->getData('street_address'),
                    'barangay' => $this->request->getData('barangay'),
                    'city' => $this->request->getData('city'),
                    'province' => $this->request->getData('province')
                ];
                if ($payment_type === "PAYPAL") {
                    $this->processPaypal($items, $shipping_address);
                } elseif ($payment_type === "PAYMAYA") {
                    $this->processPaymaya($items, $shipping_address);
                }
            } else {
                $this->Flash->error(__('Please login to continue'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            }
        }
        $this->set(compact('payment_types', 'shipping'));
    }

    public function populateCartTable () {
        if ($this->request->is('post')) {
            $cart = json_decode($this->request->data['data'], true);
            $this->set(compact('cart'));
            $this->render('cart_table');
        }
    }

    private function processPaymaya ($items, $shipping_address) {
        $this->loadModel('ShippingFee');
        $jwt = new JWT('secret', 'HS256', 3600, 10);
        $shipping_fee = $this->ShippingFee->find('all')->first();
        if (!empty($items)) {
            $total_amount = 0;
            $paymaya_items = [];
            $itemCheckout = new Checkout();
            $itemCheckout->buyer = [
                'firstName' => $this->Auth->User('first_name'),
                'lastName' => $this->Auth->User('last_name'),
            ];
            $itemCheckout->redirectUrl = [
                'success' => Router::url(['controller' => 'products', 'action' => 'completeOrder', '?' => ['order_details' => $jwt->encode(['items' => $items, 'shipping_address' => $shipping_address]), 'success' => true, 'payment_type' => 'PAYMAYA', 'token' => uniqid()]], true),
                'cancel' => Router::url(['controller' => 'products', 'action' => 'cart'], true)
            ];
            $itemCheckout->requestReferenceNumber = uniqid();
            foreach ($items as $i) {
                $total_amount += $i['total'];
                $paymaya_items[] = [
                    'name' => $i['name'],
                    'amount' => [
                        'value' => $i['price']
                    ],
                    'totalAmount' => [
                        'value' => $i['total']
                    ]
                ];
            }
            $itemCheckout->totalAmount = [
                'value' => $total_amount + $shipping_fee->shipping_fee,
                'currency' => 'PHP',
                'details' => [
                    'shippingFee' => $shipping_fee->shipping_fee
                ]
            ];
            $itemCheckout->items = $paymaya_items;
            try {
                $itemCheckout->execute();
            } catch (Exception $e) {
                
            }
            
            // pr($itemCheckout);die();
            return $this->redirect($itemCheckout->url);
        }
    }

    private function processPaypal ($items, $shipping_address) {
        $jwt = new JWT('secret', 'HS256', 3600, 10);
        $this->loadModel('ShippingFee');
        $shipping_fee = $this->ShippingFee->find('all')->first();
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
                    'return_url' => Router::url(['controller' => 'products', 'action' => 'completeOrder', '?' => ['order_details' => $jwt->encode(['items' => $items, 'shipping_address' => $shipping_address]), 'success' => true, 'payment_type' => 'PAYPAL']], true),
                    'cancel_url' => Router::url(['controller' => 'products', 'action' => 'cart'], true)
                ],
                'payer' => ['payment_method' => 'paypal'],
                'transactions' => [
                    [
                        'amount' => [
                            'total' => $total_amount + $shipping_fee->shipping_fee,
                            'currency' => 'PHP',
                            'details' => [
                                'shipping' => $shipping_fee->shipping_fee,
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
        $this->loadModel('ShippingFee');
        $jwt = new JWT('secret', 'HS256', 3600, 10);
        $shipping_fee = $this->ShippingFee->find('all')->first();
        if ($this->request->is('get')) {
            $is_success = $this->request->getQuery()['success'];
            $saved = false;
            if ($is_success) {
                $order_details = $jwt->decode($this->request->getQuery()['order_details']);
                $items = json_decode(json_encode($order_details['items']), true);
                $shipping_address = json_decode(json_encode($order_details['shipping_address']), true);
                $token_check = $this->Orders->exists(['payment_token' => $this->request->getQuery()['token']]);
                if (!$token_check) {
                    $total = 0;
                    $newOrderDetails = [];
                    foreach ($items as $i) {
                        $total += $i['total'];
                        $newOrderDetails[] = [
                            'product_id' => $i['id'],
                            'size' => $i['size_name'],
                            'quantity' => $i['count']
                        ];
                    }

                    $newOrder = [
                        'user_id' => $this->Auth->User('id'),
                        'total' => (int) $total,
                        'payment_type' => $this->request->getQuery()['payment_type'],
                        'lib_status_code_id' => 2,
                        'payment_token' => $this->request->getQuery()['token'],
                        'order_details' => $newOrderDetails
                    ];
                    $newOrder = array_merge($newOrder, $shipping_address);
                    
                    $newOrder = $this->Orders->newEntity($newOrder, ['associated' => 'OrderDetails']);
                    
                    if ($this->Orders->save($newOrder, ['associated' => 'OrderDetails'])) {
                        $this->adjustStock($items);
                    }
                }
                $this->set(compact('items', 'shipping_fee'));
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

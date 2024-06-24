<?php

namespace Payment\Controller;

use Application\Mvc\Controller;
use Phalcon\Mvc\Dispatcher\Exception;
use Cms\Model\Settings;
use Menu\Model\Menus;
use Payment\Model\Order;
use Payment\Model\Membership;
use Payment\Form\MembershipForm;
use Payment\Model\Transaction;
use Payment\Model\ThematicAreas;
use Payment\Model\Howtoknow;
use Payment\Model\Subscriber;
use Phalcon\Http\Client\Request;


class IndexController extends Controller
{

    public function indexAction()
    {
        if($this->request->isPost()){
            $form = new MembershipForm();
            $model = new Membership();
            $invoise = new Order();
            $price = Settings::findFirst(1);

            // $thematic_areas = $this->request->getPost('thematic_areas');
            // $howtoknow = $this->request->getPost('howtoknow');

            $post = $this->request->getPost();
            $form->bind($post,$model);

            if($form->isValid()){
                if($model->create()){
                    $form->bind($post,$model);
                    if($model->save()){
                        // //Thematic Areas
                        // foreach ($thematic_areas as $key => $thematic_area) {
                        //     $thematic = new ThematicAreas();
                        //     $thematic->member_id = $model->id;
                        //     $thematic->value = $thematic_area;
                        //     $thematic->save();
                        // }
                        
                        // //How to Know
                        // foreach ($howtoknow as $key => $howvalue) {
                        //     $how = new Howtoknow();
                        //     $how->member_id = $model->id;
                        //     $how->value = $howvalue;
                        //     $how->save();
                        // }
                        //Invoice
                        $invoise->amount = $price->membership_price;
                        $invoise->state = 1;
                        $invoise->member_id = $model->id;
                        $invoise->status = "notpaid";
                        $invoise->save();
                        $this->view->setVar('order', $model);
                        $this->view->setVar('invoise', $invoise);
                    }elseif($model->save() === false){
                        $messages = $model->getMessages();
                        foreach ($messages as $message) {
                            echo $message . "<br>";
                        }die();
                    }
                }else{
                    $messages = $model->getMessages();

                    foreach ($messages as $message) {
                        echo $message, "<br>";
                    }
                    die();
                }
            }else{
                die('NOT VALID');
            }
        }
    }

    public function subscribeAction()
    {
        $price = Settings::findFirst(1);
        $priceformonth = $price->magazine_price / 12;
        $this->view->setVar('priceformonth', $priceformonth);
    }

    public function magorderAction()
    {
        if($this->request->isPost()){
            
            $fio = $this->request->getPost('fio');
            $subtime = (int)$this->request->getPost('subtime');
            $address = $this->request->getPost('address');
            $phone = $this->request->getPost('phone');
            $summa = $this->request->getPost('summa');

            if($fio == null || $subtime == null || $address == null || $phone == null){
                die('Something went wrong!');
            }else{
                $model = new Subscriber();
                $invoise = new Order();
                $model->fio = $fio;
                $model->subtime = $subtime;
                $model->address = $address;
                $model->phone = $phone;
                $model->summa = $summa;
                if($model->save()){
                    //Invoice
                    $invoise->amount = $model->summa;
                    $invoise->state = 1;
                    $invoise->subscriber_id = $model->id;
                    $invoise->status = "notpaid";
                    if($invoise->save()){
                        echo "Order has been created!";
                        $this->view->setVar('invoise', $invoise);
                    }else{
                        $messages = $invoise->getMessages();
                        foreach ($messages as $message) {
                            echo $message . "<br>";
                        }
                    }
                    $this->view->setVar('subscriber', $model);
                }else{
                    $messages = $model->getMessages();
                    foreach ($messages as $message) {
                        echo $message . "<br>";
                    }
                }
            }
        }
    }


    public static function datetime2timestamp($datetime)
    {
        if ($datetime) {
            return strtotime($datetime);
        }

        return $datetime;
    }

    /*************************
     *  Payme Callback function
     */
    public function paycomAction()
    {
        if($this->request->isGet()){
            die('API version: 1.0.0');
        }
        

        if($this->request->isPost()){
               // Storage::disk('local')->put('file-payme-'.date('Y-m-d H-i-s').'.txt', json_encode($request->all()));

                $this->response->setContentType('application/json', 'UTF-8');

                //Paycom Authorization
                //$test_key = "mIw31Vx1cy@Ho8sTpfXoHgwEAB?3gKr8u1Pu";
                $test_key = "@kbHU64TngdzRgRyrHpZ&3UdaY1kfgq1H9pn";
                $headers = getallheaders();
                //$base = base64_decode($matches[1]);
                file_put_contents(ROOT ."/uploads/payme/".date('Y-m-d H-i-s')."headers.txt", $headers['Authorization']);
                if (!$headers || !isset($headers['Authorization']) ||
                    !preg_match('/^\s*Basic\s+(\S+)\s*$/i', $headers['Authorization'], $matches) ||
                    base64_decode($matches[1]) != "Paycom:" . $test_key
                ) {
                    file_put_contents(ROOT ."/uploads/payme/".date('Y-m-d H-i-s')."base.txt", $matches[1]);
                    $response_data = array(
                        'error' => 
                            [
                                'code'=>-32504,
                                'message'=>
                                    [
                                        'ru'=>'Неверная авторизация',
                                        'uz'=>'Login noto`g`ri',
                                        'en'=>'Wrong authorization'
                                        //'data'=> $matches[1]
                                    ]
                            ]
                    );
                    $this->returnJSON($response_data);
                    exit();
                  }

                //All Paycom methods
                $rawBody = $this->request->getJsonRawBody(true);
                $method = $rawBody['method'];
                $params = $rawBody['params'];

                //$params = ['id'=>'5acb206174b776c233128549', 'reason' => 'some reasen', 'account'=>['order_id' => 2], 'amount' => 1000,'time'=> 1523261537859];
                //$method = 'CheckTransaction';
                $amount = isset($params['amount']) ? $params['amount'] : '';
                $amount = substr($amount, 0, -2);

                if ($method === 'CheckPerformTransaction') {
                    $invoice = Order::findFirst($params['account']['order_id']);

                    if($invoice !== null) {
                        $invoice_amount = $invoice->amount;
                        if($invoice->state == 1) {
                            if($invoice_amount == $amount) {
                                $response_data = ['result' => ['allow'=>true]];
                                $this->returnJSON($response_data);
                                exit();
                            }
                            else{
                                $response_data = array(
                                    'error' => 
                                        [
                                            'code'=>-31001,
                                            'message'=>
                                                [
                                                    'ru'=>'Неверная сумма',
                                                    'uz'=>'Pul miqdori noto`g`ri',
                                                    'en'=>'Wrong total amount'
                                                ]
                                ]);
                                $this->returnJSON($response_data);
                                exit();
                            }
                        }
                        else
                            $response_data = [
                                'error' => 
                                    [
                                        'code'=>-31051,
                                        'message'=>
                                            [
                                                'ru'=>'Заказ не доступен для оплаты',
                                                'uz'=>'Bu buyurtma bo`yicha to`lov yo`q',
                                                'en'=>'Order is not available for purchase'
                                            ]
                                    ]
                            ];
                            $this->returnJSON($response_data);
                            exit();
                    }
                    else
                        $response_data = [
                            'error' => 
                                [
                                    'code'=>-31050,
                                    'message'=>
                                        [
                                            'ru'=>'Заказ не найден',
                                            'uz'=>'Buyurtma topilmadi',
                                            'en'=>'Order not found'
                                        ]
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                }

                elseif ($method === 'CreateTransaction') {
                    $invoice = Order::findFirst( $params['account']['order_id'] );

                    if($invoice) {
                        if($invoice->amount == $amount) {
                            $transaction_id = $params['id'];
                            $transaction = Transaction::findFirst([
                                "order_id = $invoice->id AND status = 'prepared'",
                            ]);

                            if(!$transaction) {
                                $transaction = new Transaction();
                                //$transaction->user_id = $invoice->user_id;
                                $transaction->order_id = $invoice->id;
                                //$transaction->merchant_trans_id = $invoice->id;
                                $transaction->amount = $invoice->amount;
                                $transaction->paycom_transaction_id = $transaction_id;
                                $transaction->paycom_time = $params['time'];
                                $transaction->paycom_time_datetime = $params['time'];
                                $transaction->create_time = date('Y-m-d H:i:s');
                                $transaction->payment_code = 'payme';
                                $transaction->status = 'prepared';
                                $transaction->state = 1;
                                
                                $transaction->save();

                                $response_data = [
                                    //'data1' => $transaction_id .' = '.$transaction->paycom_transaction_id,
                                    'result' => 
                                        [
                                            'create_time'=>strtotime($transaction->create_time)*1000,
                                            'transaction'=>(string)$transaction->id,
                                            'state'=>$transaction->state
                                        ]
                                ];
                                $this->returnJSON($response_data);
                                exit();
                            }
                            elseif($transaction_id == $transaction->paycom_transaction_id){
                                $response_data = [
                                    //'data2' => $transaction_id .' = '.$transaction->paycom_transaction_id,
                                    'result' => 
                                        [
                                            'create_time'=>strtotime($transaction->create_time)*1000,
                                            'transaction'=>"$transaction->id",
                                            'state'=>$transaction->state
                                        ]
                                ];
                                $this->returnJSON($response_data);
                                exit();
                            }
                            else{
                                $response_data = [
                                    //'data3' => $transaction_id .' = '.$transaction->paycom_transaction_id,
                                    'error' => 
                                        [
                                            'code'=>-31051,
                                            'message'=>
                                                [
                                                    'ru'=>'Счет в ожидании оплаты',
                                                    'uz'=>'Buyurtma to`lovi kutilmoqda',
                                                    'en'=>'Waiting order payment'
                                                ]
                                        ]
                                ];
                                $this->returnJSON($response_data);
                                exit();
                            }
                        }
                        else{
                            $response_data = [
                                'error' => 
                                    [
                                        'code'=>-31001,
                                        'message'=>
                                            [
                                                'ru'=>'Неверная сумма',
                                                'uz'=>'Pul miqdori noto`g`ri',
                                                'en'=>'Wrong total amount'
                                            ]
                                    ]
                            ];
                            $this->returnJSON($response_data);
                            exit();
                        }
                    }
                    else{
                        $response_data = [
                            'error' =>
                                [
                                    'code'=>-31050,
                                    'message'=>
                                        [
                                            'ru'=>'Заказ не найден',
                                            'uz'=>'Buyurtma topilmadi',
                                            'en'=>'Order not found'
                                        ]
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                    }
                }

                elseif ($method === 'PerformTransaction') {

                    $transaction = Transaction::findFirst([
                        'conditions' => 'payment_code = ?1 AND paycom_transaction_id = ?2',
                        'bind'       =>[
                            1 => 'payme',
                            2 => $params['id']
                            //3 => 'prepared',
                        ]
                    ]);

                    if($transaction) {
                        $transaction->status = 'completed';
                        $transaction->perform_time = date('Y-m-d H:i:s');
                        $transaction->state = 2;
                        $transaction->save();

                        // Update Invoice status
                        $invoice = Order::findFirst($transaction->order_id);
                        $invoice->status = 'prepaid';
                        $invoice->save();
                        
                        $response_data = [
                            'result' => 
                                [
                                    'create_time'  => $this->datetime2timestamp($transaction->create_time),
                                    'perform_time' => (int)$this->datetime2timestamp($transaction->perform_time)*1000,
                                    'cancel_time'  => $this->datetime2timestamp($transaction->cancel_time),
                                    'transaction'=>$transaction->id,
                                    'state'=>$transaction->state,
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                    }
                    else
                        $response_data = [
                            'error' => 
                                [
                                    'code'=>-31003,
                                    'message'=>
                                        [
                                            'ru'=>'Транзакция не найдена',
                                            'uz'=>'Bitim topilmadi',
                                            'en'=>'Transaction not found'
                                        ]
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                }

                elseif ($method === 'CancelTransaction') {
                    $transaction = Transaction::findFirst([
                        'conditions' => 'payment_code = ?1 AND paycom_transaction_id = ?2',
                        'bind'       =>[
                            1 => 'payme',
                            2 => $params['id']
                        ]
                    ]);

                    if($transaction) {
                        $cancel_time = ($transaction->cancel_time != null) ? $transaction->cancel_time : date('Y-m-d H:i:s');
                        $transaction->status = 'canceled';
                        $transaction->reason = $params['reason'];
                        $transaction->cancel_time = $cancel_time;
                        $transaction->state = ($transaction->state == 1 || $transaction->state == -1) ? -1 : -2;
                        $transaction->save();

                        $response_data = [
                            'result' => 
                                [
                                    'transaction'=>''.$transaction->id,
                                    'cancel_time'=>strtotime($cancel_time)*1000,
                                    'state'=>$transaction->state
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                    }
                    else
                        $response_data = [
                            'error' => 
                                [
                                    'code'=>-31003,
                                    'message'=>
                                    [
                                        'ru'=>'Транзакция не найдена',
                                        'uz'=>'Bitim topilmadi',
                                        'en'=>'Transaction not found'
                                    ]
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                }

                elseif ($method === 'CheckTransaction') {
                    $transaction = Transaction::findFirst([
                        'conditions' => 'paycom_transaction_id = ?1',
                        'bind'       =>[
                            1 => $params['id']
                        ]
                    ]);

                    if($transaction) {
                        $create_time = ($transaction->create_time) ? strtotime($transaction->create_time) : 0;
                        $perform_time = ($transaction->perform_time) ? strtotime($transaction->perform_time) : 0;
                        $cancel_time = ($transaction->cancel_time) ? strtotime($transaction->cancel_time) : 0;
                        $myreason = ($transaction->reason > 0) ? (int)$transaction->reason : null;

                        $response_data = [
                            'result' => 
                                [
                                    'create_time'=>$create_time*1000,
                                    'perform_time'=>$perform_time*1000,
                                    'cancel_time'=>$cancel_time*1000,
                                    'transaction'=>$transaction->id,
                                    'state'=>(int)$transaction->state,
                                    'reason'=>$myreason
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                    }
                    else
                        $response_data = [
                            'error' => 
                                [
                                    'code'=>-31003,
                                    'message'=>
                                        [
                                            'ru'=>'Транзакция не найдена',
                                            'uz'=>'Bitim topilmadi',
                                            'en'=>'Transaction not found'
                                        ]
                                ]
                        ];
                    $this->returnJSON($response_data);
                    exit();
                }

                // return response()->json(['result' => ['allow'=>true]]);

        }
        
    }






    public function paycomlocaAction()
    {
        if($this->request->isGet()){
            //new \DateTime();
            $d = new \DateTime('2016-03-11 11:00:00', new \DateTimeZone('Asia/Tashkent'));
            //echo $d->format('U')."<br>";
            var_dump($d->format('U')); // 1457690400

            die('API version: 1.0.0');
        }
        

        if($this->request->isPost()){
                $this->response->setContentType('application/json', 'UTF-8');

                //Paycom Authorization
                $test_key = "mIw31Vx1cy@Ho8sTpfXoHgwEAB?3gKr8u1Pu";
                $headers = getallheaders();
                if (!$headers || !isset($headers['Authorization']) ||
                    !preg_match('/^\s*Basic\s+(\S+)\s*$/i', $headers['Authorization'], $matches) ||
                    base64_decode($matches[1]) != "Paycom:" . $test_key
                ) {
                    $response_data = array(
                        'error' => 
                            [
                                'code'=>-32504,
                                'message'=>
                                    [
                                        'ru'=>'Неверная авторизация',
                                        'uz'=>'Login noto`g`ri',
                                        'en'=>'Wrong authorization'
                                    ]
                            ]
                    );
                    $this->returnJSON($response_data);
                    exit();
                  }

                //All Paycom methods
                $rawBody = $this->request->getJsonRawBody(true);
                $method = $rawBody['method'];
                $params = $rawBody['params'];

                //$params = ['id'=>'5acb206174b776c233128549', 'reason' => 'some reasen', 'account'=>['order_id' => 2], 'amount' => 1000,'time'=> 1523261537859];
                //$method = 'CheckTransaction';
                $amount = isset($params['amount']) ? $params['amount'] : '';

                if ($method === 'CheckPerformTransaction') {
                    $invoice = Order::findFirst($params['account']['order_id']);

                    if($invoice !== null) {
                        $invoice_amount = substr($invoice->amount, 0, -2);
                        if($invoice->state == 1) {
                            if($invoice_amount == $amount) {
                                $response_data = ['result' => ['allow'=>true]];
                                $this->returnJSON($response_data);
                                exit();
                            }
                            else{
                                $response_data = array(
                                    'error' => 
                                        [
                                            'code'=>-31001,
                                            'message'=>
                                                [
                                                    'ru'=>'Неверная сумма',
                                                    'uz'=>'Pul miqdori noto`g`ri',
                                                    'en'=>'Wrong total amount'
                                                ]
                                ]);
                                $this->returnJSON($response_data);
                                exit();
                            }
                        }
                        else
                            $response_data = [
                                'error' => 
                                    [
                                        'code'=>-31051,
                                        'message'=>
                                            [
                                                'ru'=>'Заказ не доступен для оплаты',
                                                'uz'=>'Bu buyurtma bo`yicha to`lov yo`q',
                                                'en'=>'Order is not available for purchase'
                                            ]
                                    ]
                            ];
                            $this->returnJSON($response_data);
                            exit();
                    }
                    else
                        $response_data = [
                            'error' => 
                                [
                                    'code'=>-31050,
                                    'message'=>
                                        [
                                            'ru'=>'Заказ не найден',
                                            'uz'=>'Buyurtma topilmadi',
                                            'en'=>'Order not found'
                                        ]
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                }

                elseif ($method === 'CreateTransaction') {
                    $invoice = Order::findFirst( $params['account']['order_id'] );

                    if($invoice) {
                        if($invoice->amount == $amount) {
                            $transaction_id = $params['id'];
                            $transaction = Transaction::findFirst([
                                "order_id = $invoice->id AND status = 'prepared'",
                            ]);

                            if($transaction == null) {
                                $transaction = new Transaction();
                                //$transaction->user_id = $invoice->user_id;
                                $transaction->order_id = $invoice->id;
                                //$transaction->merchant_trans_id = $invoice->id;
                                $transaction->amount = $invoice->amount;
                                $transaction->paycom_transaction_id = $transaction_id;
                                $transaction->paycom_time = $params['time'];
                                $transaction->paycom_time_datetime = $params['time'];
                                $transaction->create_time = date('Y-m-d H:i:s');
                                $transaction->payment_code = 'payme';
                                $transaction->status = 'prepared';
                                $transaction->state = 1;
                                
                                $transaction->save();

                                $response_data = [
                                    'data1' => $transaction_id .' = '.$transaction->paycom_transaction_id,
                                    'result' => 
                                        [
                                            'create_time'=>strtotime($transaction->create_time)*1000,
                                            'transaction'=>(string)$transaction->id,
                                            'state'=>$transaction->state
                                        ]
                                ];
                                $this->returnJSON($response_data);
                                exit();
                            }
                            elseif($transaction_id == $transaction->paycom_transaction_id){
                                $response_data = [
                                    'data2' => $transaction_id .' = '.$transaction->paycom_transaction_id,
                                    'result' => 
                                        [
                                            'create_time'=>strtotime($transaction->create_time)*1000,
                                            'transaction'=>"$transaction->id",
                                            'state'=>$transaction->state
                                        ]
                                ];
                                $this->returnJSON($response_data);
                                exit();
                            }
                            else{
                                $response_data = [
                                    'data3' => $transaction_id .' = '.$transaction->paycom_transaction_id,
                                    'error' => 
                                        [
                                            'code'=>-31051,
                                            'message'=>
                                                [
                                                    'ru'=>'Счет в ожидании оплаты',
                                                    'uz'=>'Buyurtma to`lovi kutilmoqda',
                                                    'en'=>'Waiting order payment'
                                                ]
                                        ]
                                ];
                                $this->returnJSON($response_data);
                                exit();
                            }
                        }
                        else{
                            $response_data = [
                                'error' => 
                                    [
                                        'code'=>-31001,
                                        'message'=>
                                            [
                                                'ru'=>'Неверная сумма',
                                                'uz'=>'Pul miqdori noto`g`ri',
                                                'en'=>'Wrong total amount'
                                            ]
                                    ]
                            ];
                            $this->returnJSON($response_data);
                            exit();
                        }
                    }
                    else{
                        $response_data = [
                            'error' =>
                                [
                                    'code'=>-31050,
                                    'message'=>
                                        [
                                            'ru'=>'Заказ не найден',
                                            'uz'=>'Buyurtma topilmadi',
                                            'en'=>'Order not found'
                                        ]
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                    }
                }

                elseif ($method === 'PerformTransaction') {

                    $transaction = Transaction::findFirst([
                        'conditions' => 'payment_code = ?1 AND status = ?2 AND paycom_transaction_id = ?3',
                        'bind'       =>[
                            1 => 'payme',
                            2 => 'prepared',
                            3 => $params['id']
                        ]
                    ]);

                    if($transaction !== NULL) {
                        $transaction->status = 'completed';
                        $transaction->perform_time = date('Y-m-d H:i:s');
                        $transaction->state = 2;
                        $transaction->save();

                        // Update Invoice status
                        $invoice = Order::findFirst($transaction->order_id);
                        $invoice->status = 'prepaid';
                        $invoice->save();

                        $response_data = [
                            'result' => 
                                [
                                    'perform_time'=>strtotime($transaction->perform_time),
                                    'transaction'=>$transaction->id,
                                    'state'=>$transaction->state
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                    }
                    else
                        $response_data = [
                            'error' => 
                                [
                                    'code'=>-31003,
                                    'message'=>
                                        [
                                            'ru'=>'Транзакция не найдена',
                                            'uz'=>'Bitim topilmadi',
                                            'en'=>'Transaction not found'
                                        ]
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                }

                elseif ($method === 'CancelTransaction') {
                    $transaction = Transaction::findFirst([
                        'conditions' => 'payment_code = ?1 AND paycom_transaction_id = ?2',
                        'bind'       =>[
                            1 => 'payme',
                            2 => $params['id']
                        ]
                    ]);

                    if($transaction !== null) {
                        $transaction->status = 'canceled';
                        $transaction->reason = $params['reason'];
                        $transaction->cancel_time = date('Y-m-d H:i:s');
                        $transaction->state = ($transaction->state == 1 || $transaction->state == -1) ? -1 : -2;
                        $transaction->save();

                        $response_data = [
                            'result' => 
                                [
                                    'transaction'=>''.$transaction->id,
                                    'cancel_time'=>strtotime($transaction->cancel_time),
                                    'state'=>$transaction->state
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                    }
                    else
                        $response_data = [
                            'error' => 
                                [
                                    'code'=>-31003,
                                    'message'=>
                                    [
                                        'ru'=>'Транзакция не найдена',
                                        'uz'=>'Bitim topilmadi',
                                        'en'=>'Transaction not found'
                                    ]
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                }

                elseif ($method === 'CheckTransaction') {
                    $transaction = Transaction::findFirst([
                        'conditions' => 'paycom_transaction_id = ?1',
                        'bind'       =>[
                            1 => $params['id']
                        ]
                    ]);

                    if($transaction !== null) {
                        $create_time = ($transaction->create_time) ? strtotime($transaction->create_time) : 0;
                        $perform_time = ($transaction->perform_time) ? strtotime($transaction->perform_time) : 0;
                        $cancel_time = ($transaction->cancel_time) ? strtotime($transaction->cancel_time) : 0;

                        $response_data = [
                            'result' => 
                                [
                                    'create_time'=>$create_time,
                                    'perform_time'=>$perform_time,
                                    'cancel_time'=>$cancel_time,
                                    'transaction'=>$transaction->id,
                                    'state'=>(int)$transaction->state,
                                    'reason'=>$transaction->reason
                                ]
                        ];
                        $this->returnJSON($response_data);
                        exit();
                    }
                    else
                        $response_data = [
                            'error' => 
                                [
                                    'code'=>-31003,
                                    'message'=>
                                        [
                                            'ru'=>'Транзакция не найдена',
                                            'uz'=>'Bitim topilmadi',
                                            'en'=>'Transaction not found'
                                        ]
                                ]
                        ];
                    $this->returnJSON($response_data);
                    exit();
                }

                // return response()->json(['result' => ['allow'=>true]]);

        }
        
    }


}

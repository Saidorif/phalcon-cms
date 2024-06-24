<?php

/**
 * AdminUserController
 */

namespace Admin\Controller;

use Application\Mvc\Controller;
use Admin\Model\AdminUser;
use Admin\Form\LoginForm;
use Michelf\Markdown;
use Phalcon\Mvc\View;

class IndexController extends Controller
{

    public function indexAction()
    {
        $this->setAdminEnvironment();
        $this->view->languages_disabled = true;

        $auth = $this->session->get('auth');
        if (!$auth || !isset($auth->admin_session) || !$auth->admin_session) {
            $this->flash->notice($this->helper->at('Log in please'));
            $this->redirect($this->url->get() . 'admin/index/login');
        }                  

        $this->helper->title($this->helper->at('Welcome to Eskiz CMS'), true);

        $this->helper->activeMenu()->setActive('admin-home');

    }

    public function loginAction()
    {
        $client_ip = $this->getIPAddress();
         //print_r($this->getIPAddress());die;
        $ips = [
            '127.0.0.2',
            '127.0.0.1',
        ];
        if(!in_array($client_ip,$ips)){
            print_r($this->getIPAddress());die;
            return $this->redirect($this->url->get() . '404');
        }
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $guessing = $this->session->get('guessing');
        if(!$guessing){
            $this->session->set('guessing',[
                'count' => 0,
                'time' => time(),
            ]);
        }
        if((int)$guessing['count'] >= 3 && ($guessing['time'] + 15) > time()){
            $this->view->setVar('blocked',true);
        }
        if((int)$guessing['count'] >= 3 && ($guessing['time'] + 15) < time()){
            $this->session->set('guessing',[
                'count' => 0,
                'time' => time(),
            ]);
        }

        $form = new LoginForm();

        if ($this->request->isPost()) {
            if((int)$guessing['count'] >= 3 && ($guessing['time'] + 15) > time()){
                return $this->redirect($this->url->get() . 'admin/index/login');
            }
            if ($this->security->checkToken()) {
                if ($form->isValid($this->request->getPost())) {
                    $login = $this->request->getPost('login', 'string');
                    $password = $this->request->getPost('password', 'string');
                    $user = AdminUser::findFirst("login='$login'");
                    if ($user) {
                        if ($user->checkPassword($password)) {
                            if ($user->isActive()) {
                                $this->session->set('auth', $user->getAuthData());
                                $this->flash->success($this->helper->translate("Welcome to the administrative control panel!"));
                                return $this->redirect($this->url->get() . 'admin/index');
                            } else {
                                $this->flash->error($this->helper->translate("User is not activated yet"));
                            }
                        } else {
                            $this->session->set('guessing',[
                                'count' => (int)$guessing['count'] + 1,
                                'time' => time(),
                            ]);
                            if((int)$guessing['count'] >= 3){
                                $this->flash->error($this->helper->translate("You are blocked for 5 minutes. Please try again later..."));
                            }else{
                                $this->flash->error($this->helper->translate("Incorrect login or password"));
                            }
                        }
                    } else {
                        $this->session->set('guessing',[
                            'count' => (int)$guessing['count'] + 1,
                            'time' => time(),
                        ]);
                        $this->flash->error($this->helper->translate("Incorrect login or password"));
                    }
                } else {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                }
            } else {
                $this->session->set('guessing',[
                    'count' => (int)$guessing['count'] + 1,
                    'time' => time(),
                ]);
                $this->flash->error($this->helper->translate("Security errors"));
            }
        }

        $this->view->form = $form;

    }

    public function logoutAction()
    {
        if ($this->request->isPost()) {
            if ($this->security->checkToken()) {
                $this->session->remove('auth');
            } else {
                $this->flash->error("Security errors");
            }
        } else {
            $this->flash->error("Security errors");
        }
        $this->redirect($this->url->get());
    }

    private function getIPAddress() {
        //whether ip is from the share internet
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from the proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from the remote address
        else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}

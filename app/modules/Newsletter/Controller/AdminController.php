<?php

namespace Newsletter\Controller;

use Application\Mvc\Controller;
use Newsletter\Model\Newsletter;
use Newsletter\Model\Settings;
use Newsletter\Model\Newslist;
use Newsletter\Form\NewsletterForm;
use Publication\Model\Type;
use Publication\Model\Publication;
use Webform\Model\Webform;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-newsletter');
    }

    public function indexAction()
    {
        $page = $this->request->getQuery('page', 'int', 1);
        $newsList = Newslist::find();
        $settings = Settings::findFirst(1);
        $publications = Publication::find([
            "conditions" => "type_id = ".$settings->getCategory(),
            "order"      => "date DESC, id DESC"
        ]);
        $data = array();
        foreach ($publications as $item) {
          $news = array();
          $news['id'] = $item->getId();  
          $news['title'] = $item->getTitle();  
          $news['url'] = $item->getSlug();
          $news['type_slug'] = $item->getTypeSlug();
          $news['type_title'] = $item->getTypeTitle();
          $news['date'] = $item->getDate();
          $news['status'] = 'not-sent';
          foreach ($newsList as $value) {
            if($item->getId() == $value->getNewsId() && $value->getLanguage() == LANG){
              $news['id'] = $item->getId();  
              $news['title'] = $item->getTitle();  
              $news['url'] = $item->getSlug();  
              $news['type_slug'] = $item->getTypeSlug();  
              $news['type_title'] = $item->getTypeTitle();  
              $news['date'] = $item->getDate();  
              $news['status'] = 'sent';  
            }
          }
          $data[] = $news;
        }
        
        $paginator = new PaginatorArray([
            "data"  => $data,
            "limit" => 20,
            "page"  => $page
        ]);
        $this->view->categories = Type::find();
        $this->view->settings = $settings;
        $this->view->entries = Newsletter::find();
        $this->view->publications = $paginator->getPaginate();
        $this->helper->title($this->helper->at('Newsletter'), true);        
    }

    public function addAction()
    {
        if (!$this->request->getPost() || !$this->request->isAjax()) {
            return $this->flash->error('post ajax required');
        }

        $email = $this->request->getPost('email');
        // $phone = $this->request->getPost('phone');
        
        $model = new Newsletter();
        $model->setEmail($email);
        // $model->setPhone($phone);
        if ($model->create()) {            
            $this->returnJSON([
                'success' => true,
                'id' => $model->getId(),
                'email' => $model->getEmail(),
            ]);            
        } else {
            $this->returnJSON(['error' => implode(' | ', $model->getMessages())]);
        }
    }

    public function deleteAction()
    {
        if (!$this->request->getPost() || !$this->request->isAjax()) {
            return $this->flash->error('post ajax required');
        }

        $id = $this->request->getPost('id');

        $model = Newsletter::findFirst($id);
        if ($model) {
            if ($model->delete()) {
                $this->returnJSON([
                    'success' => true
                ]);
            }
        }

    }

    public function settingsAction($id)
    {
        $model = Settings::findFirst($id);
        if ($this->request->isPost()) {
            $model->setCategory($this->request->getPost('category'));
            $model->setEmail($this->request->getPost('email'));
            $model->setFromName($this->request->getPost('from_name'));
            if ($model->update()) {
                $this->flash->success('Settings updated');
                return $this->redirect($this->url->get() . 'newsletter/admin');
            } else {
                $this->flashErrors($model);
            }
        }    
    }

    public function newsAction()
    {
        if ($this->request->isPost()) {
            if(isset($_SERVER['HTTPS'])){
                $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
            }
            else{
                $protocol = 'http';
            }

            $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
            $logo = $base_url.'/assets/images/logo.png';

            $mail = new Webform();
            $settings = Settings::findFirst(1);
            $from_name = $settings->getFromName();
            $from_email = $settings->getEmail();           
            $mailer = $mail->mailconfig($from_email, $from_name);

            $subscribed = Newsletter::find();
            $news_ids = $this->request->getPost('news_id'); 
            $news_title = $this->request->getPost('news_title'); 
            $news_date = $this->request->getPost('news_date'); 
            $news_url = $this->request->getPost('news_url');
            
            $data = array();
            $emails = array();
            foreach ($news_ids as $key => $id) {
                $model = new Newslist();
                $model->setNewsId($id);
                $model->setLanguage(LANG);
                $model->setDate(date('Y-m-d H:i:s'));
                $model->save();                
                $data[$key]['title'] = $news_title[$key];
                $data[$key]['date'] = $news_date[$key];
                $data[$key]['url'] = $base_url.$news_url[$key];
            }
            foreach ($subscribed as $key => $email) {
                $emails[$key] = $email->getEmail();
            }              
                       
            $params = [
                'data' => $data,
                'logo' => $logo,
                'theme' => $settings->getFromName(),
            ];
            
            $viewPath = 'emails/newsletter';
            $message = $mailer->createMessageFromView($viewPath, $params)
                ->bcc($emails,$settings->getFromName())
                ->subject($settings->getFromName());
            if ($message->send()) {
                $this->flash->success('Settings updated');
                return $this->redirect($this->url->get() . 'newsletter/admin');
            } else {
                $this->flashErrors($model);
            }             
        }   
    }

}
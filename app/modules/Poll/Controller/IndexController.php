<?php

namespace Poll\Controller;

use Application\Mvc\Controller;
use Poll\Model\Poll;
use Poll\Model\Votes;
use Poll\Model\Options;
use Cms\Model\Settings;

class IndexController extends Controller
{

    public function indexAction()
    {
        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.$slug;        
        $meta_image = $this->helper->base_url().'/'.$settings->getLogo();
        $this->view->entries = Poll::find();        
        $this->view->title = $this->helper->translate('Poll');    
        $this->helper->title()->append($this->helper->translate('Poll'));    
        $this->helper->meta()->set('title', $this->helper->translate('Poll'));
        $this->helper->meta()->set('description', $this->helper->translate('Poll'));
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);
    }

    public function voteAction()
    {
        if ($this->request->isPost()) {
          $poll_id = $this->request->getPost('poll_id');
      		$vote = $this->request->getPost('vote');

          $model = new Votes();
          $model->setPollId($poll_id);
          $model->setVote($vote);
          $model->setLanguage(LANG);
          if ($model->create()) {             
            $this->returnJSON([
              'success' => true,
              'id' => $model->getPollId(),
            ]);
          } else {
            $this->returnJSON(['error' => implode(' | ', $model->getMessages())]);
          }            
        }    
    }

    public function resultAction($id) {
      if ($id) {         
        $poll_title = Poll::findFirst($id);
        $polls_count = Votes::count([
          "poll_id = :poll_id: AND language = :language:",
          "bind" => [
              "poll_id" => $id,
              "language" => LANG
          ],
          "group" => "vote",
        ]);
        $polls = Options::find([
          "poll_id = :poll_id: AND language = :language:",
          "bind" => [
              "poll_id" => $id,
              "language" => LANG
          ]
        ]);
        $rows = array();        
        foreach ($polls as $poll) {          
          $total = 0;
          $row = array();                
          $row['vote'] = 0;
          if(count($polls_count) > 0){
            foreach ($polls_count as $item) {
              if($item->vote){
                $total += (int)$item->rowcount;
                if($item->vote == $poll->vote){
                  $row['vote'] = (int)$item->rowcount;
                } 
              } 
              $row['title'] = $poll->title;
            }             
          } else {
            $row['vote'] = 0;
            $row['title'] = $poll->title;
          }
          $rows[] = $row;                  
        }
       
        $this->returnJSON([
          'success' => true,
          'title' => $poll_title->getTitle(),
          'data' => $rows,
          'total' => $total,
        ]);                    
      }    
    }

    public function pollAction()
    {
       $poll = Poll::query()
        ->where("status = '0'")
        ->orderBy('created_at DESC')
        ->limit(3)
        ->execute();     
        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.'poll';        
        $meta_image = $this->helper->base_url().'/'.$settings->getLogo();
        $this->view->polls = $poll;  
        $this->view->title = $this->helper->translate('Poll');   
        $this->helper->title()->append($this->helper->translate('Poll'));      
        $this->helper->meta()->set('title', $this->helper->translate('Poll'));
        $this->helper->meta()->set('description', $this->helper->translate('Poll'));
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);
    }

}

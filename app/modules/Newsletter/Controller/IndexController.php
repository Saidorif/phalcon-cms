<?php
namespace Newsletter\Controller;

use Application\Mvc\Controller;
use Newsletter\Model\Newsletter;
use Phalcon\Mvc\Dispatcher\Exception;
use Phalcon\Http\Response;

class IndexController extends Controller
{

    public function subscribeAction()
    {
        if (!$this->request->getPost() || !$this->request->isAjax()) {
            return $this->flash->error('post ajax required');
        }

        $email = $this->request->getPost('email');
        
        $model = new Newsletter();
        $model->setEmail($email);
        if ($model->create()) {            
            $this->returnJSON([
                'success' => true,
                'email' => $model->getEmail(),
            ]);            
        } else {
            $this->returnJSON(['error' => implode(' | ', $model->getMessages())]);
        }
    }

}

<?php

namespace Webform\Controller;

use Application\Mvc\Controller;
use Cms\Model\Settings;
use Webform\Model\Webform;
use Phalcon\Mvc\Dispatcher\Exception;
use Phalcon\Http\Response;

class IndexController extends Controller
{

    public function feedbackAction()
    {
       $model = new Webform();
        if ($this->request->isPost()) {

            if(isset($_SERVER['HTTPS'])){
                $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
            }
            else{
                $protocol = 'http';
            }

            $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];

            $settings = Settings::findFirst(1);

            $from = $this->request->getPost('email');
            $name = $settings->getSiteName();

            $mailer = $model->mailconfig($from, $name);

            $params = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'subject' => $this->request->getPost('subject'),
                'message' => $this->request->getPost('message'),
            ];

            $viewPath = 'emails/feedback';
            
            if ($this->request->hasFiles() == true) {
                foreach ($this->request->getUploadedFiles() as $file) {
                    if (!$file->getTempName()) {
                        return;
                    }
                    if (!in_array($file->getType(), [
                        'image/jpg',
                        'image/jpeg',
                        'image/png',
                        'image/bmp',
                        'application/pdf',
                    ])
                    ) {
                        $this->response->setStatusCode(401, 'Only allow formats .jpg, .jpeg, .png, .pdf');
                    }

                    $hash = md5(microtime()).'.'.$file->getExtension();
                    $currentPath = ROOT.'/uploads/support/'.$hash;
                    $img = substr($currentPath, strpos($currentPath, 'uploads'));
                    $file->moveTo($currentPath);

                    $atachFile = $base_url.'/'.$img;

                    $message = $mailer->createMessageFromView($viewPath, $params)
                        ->to($settings->getEmail(), 'Обратная связь')
                        ->attachment($atachFile)
                        ->subject('Обратная связь');
                    $message->send();
                }
            }

            if ($this->request->hasFiles() == 0) {
                $message = $mailer->createMessageFromView($viewPath, $params)
                    ->to($settings->getEmail(), 'Обратная связь')
                    ->subject('Обратная связь');
                $message->send();
            }

            $this->response->setStatusCode(200, 'OK');

        }
    }

}

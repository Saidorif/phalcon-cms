<?php

namespace Documentation\Controller;

use Application\Mvc\Controller;
use Documentation\Model\Documentation;
use Documentation\Model\Category;
use Cms\Model\Settings;
use Page\Model\Page;

class IndexController extends Controller
{

  public function indexAction()
  {
    $page = Page::findFirst([
      'conditions' => 'slug = ?1',
      'bind' => [1 => "siyosatchi-kutubxonasi"]
    ]);
    if($page){
      $this->view->setVar('page', $page);
    }
    $this->view->entries3 = true;//Documentation::find();
    $this->view->categories = Category::find();
    $this->view->title = $this->helper->translate('Politician library');
    $settings = Settings::findFirst(1);
    $curLang = $this->helper->currentUrl(LANG);
    $meta_url = $this->helper->base_url().$curLang.'documentation';
    $meta_image = $this->helper->base_url().'/'.$settings->getLogo();

    $this->helper->title()->append($this->helper->translate('Politician library'));
    $this->helper->meta()->set('title', $this->helper->translate('Politician library'));
    $this->helper->meta()->set('description', $this->helper->translate('Politician library'));
    $this->helper->meta()->set('type', 'article');
    $this->helper->meta()->set('site_name', $settings->getSiteName());
    $this->helper->meta()->set('url', $meta_url);
    $this->helper->meta()->set('image', $meta_image);

  }

  public function auditAction()
  {
    $this->view->audits = Documentation::find('type = "audit"');
    $this->view->finance = Documentation::find('type = "finance"');
    $this->view->title = $this->helper->translate('Audit opinions and financial statements');
    $settings = Settings::findFirst(1);
    $curLang = $this->helper->currentUrl(LANG);
    $meta_url = $this->helper->base_url().$curLang.'audit-financial';
    $meta_image = $this->helper->base_url().'/'.$settings->getLogo();

    $this->helper->title()->append($this->helper->translate('Audit opinions and financial statements'));
    $this->helper->meta()->set('title', $this->helper->translate('Audit opinions and financial statements'));
    $this->helper->meta()->set('description', $this->helper->translate('Audit opinions and financial statements'));
    $this->helper->meta()->set('type', 'article');
    $this->helper->meta()->set('site_name', $settings->getSiteName());
    $this->helper->meta()->set('url', $meta_url);
    $this->helper->meta()->set('image', $meta_image);

  }

  public function ukazyiAction()
  {
    $this->view->entries = Documentation::find('type = "ukazyi"');
    $this->view->title = $this->helper->translate('Decree');
    $settings = Settings::findFirst(1);
    $curLang = $this->helper->currentUrl(LANG);
    $meta_url = $this->helper->base_url().$curLang.'ukazyi';
    $meta_image = $this->helper->base_url().'/'.$settings->getLogo();

    $this->helper->title()->append($this->helper->translate('Decree'));
    $this->helper->meta()->set('title', $this->helper->translate('Decree'));
    $this->helper->meta()->set('description', $this->helper->translate('Decree'));
    $this->helper->meta()->set('type', 'article');
    $this->helper->meta()->set('site_name', $settings->getSiteName());
    $this->helper->meta()->set('url', $meta_url);
    $this->helper->meta()->set('image', $meta_image);

  }

  public function uploadAction()
  {
    if ($this->request->hasFiles()) {
      $files = $this->request->getUploadedFiles();

      foreach ($files as $file) {
        echo $file->getName(), ' ', $file->getSize(), '\n';

        $file->moveTo(
          'files/' . $file->getName()
        );
      }
    }
  }

}

<?php

namespace Faq\Widget;

use Application\Widget\AbstractWidget;
use Faq\Model\Helper\FaqHelper;

class FaqWidget extends AbstractWidget
{

    public function faqBlock($limit = 5)
    {
        // $faq = Faq::query()  
        // ->limit($limit)
        // ->execute(); 

        $helper = new FaqHelper();
        $fields = $helper->translateFieldsSubQuery();

        $columns = ['p.*'];
        $columns = array_merge($columns, $fields);

        $qb = $this->modelsManager->createBuilder()
            ->columns($columns)
            ->addFrom('Faq\Model\Faq', 'p')
            ->orderBy('p.id DESC')
            ->limit($limit);

        $entries = $qb->getQuery()->execute();

        $this->widgetPartial('widget/faq-block', ['entries' => $entries]);
    }

} 
<?php

namespace Partner\Widget;

use Application\Widget\AbstractWidget;
use Partner\Model\Partner;

class PartnerWidget extends AbstractWidget
{

    public function partnerBlock($limit = 10)
    {
         $partner = Partner::query()  
        ->limit($limit)
        ->execute();   

        $this->widgetPartial('widget/partner-block', ['entries' => $partner]);
    }

} 
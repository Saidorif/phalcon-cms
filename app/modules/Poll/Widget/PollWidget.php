<?php

namespace Poll\Widget;

use Application\Widget\AbstractWidget;
use Poll\Model\Poll;

class PollWidget extends AbstractWidget
{
    public function poll()
    {
        $polls = Poll::query()
        ->where("status = '0'")
        ->orderBy('created_at DESC')
        ->limit(1)
        ->execute(); 

        $this->widgetPartial('widget/poll', ['polls' => $polls]);
    }
} 
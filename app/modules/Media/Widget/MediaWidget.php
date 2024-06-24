<?php

namespace Media\Widget;

use Application\Widget\AbstractWidget;
use Media\Model\Media;
use Media\Model\Category;


class MediaWidget extends AbstractWidget
{

    public function media($limit = 3)
    {
    	$media = Media::query()
        ->where("category_id = '1'")
        ->orderBy('id DESC')
        ->limit($limit)
        ->execute();    	       
        $this->widgetPartial('index/block', ['media' => $media]);
    } 

    public function videoGallery($limit = 20)
    {
    	$media = Media::query()
        ->where("category_id = '2'")
        ->orderBy('id DESC')
        ->limit($limit)
        ->execute();    	       
        $this->widgetPartial('index/video-gallery', ['media' => $media]);
    } 

} 
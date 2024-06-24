<?php

namespace Cms\Model;

use Phalcon\Mvc\Model\Message;

class Settings extends \Phalcon\Mvc\Model
{

    public function getSource()
    {
        return 'cms_settings';
    }

    
    public $site_name;
    public $email;
    public $logo;
    public $favicon;
    
    /**
     * @param mixed $key
     */
    public function setSiteName($site_name)
    {
        $this->site_name = $site_name;
    }

    /**
     * @return mixed
     */
    public function getSiteName()
    {
        return $this->site_name;
    }

    /**
     * @param mixed $value
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }


    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    public function setFavicon($favicon)
    {
        $this->favicon = $favicon;
    }

    /**
     * @return mixed
     */
    public function getFavicon()
    {
        return $this->favicon;
    }


}
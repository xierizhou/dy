<?php
namespace Sunday\SwooleCrontab;

use Illuminate\Session\SessionManager;
use Illuminate\Config\Repository;

class Crontab
{
    /**
     * @var SessionManager
     */
    protected $session;

    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var array
     */
    protected $notifications = [];

    /**
     * Toastr constructor.
     * @param SessionManager $session
     * @param Repository $config
     */
    public function __construct(SessionManager $session, Repository $config)
    {
        $this->session = $session;
        $this->config = $config;
    }

    public function config($key=null){
        if(!is_null($key)){
            return $this->config->get('swoole_crontab.'.$key);
        }else{
            return $this->config->get('swoole_crontab');
        }

    }
}
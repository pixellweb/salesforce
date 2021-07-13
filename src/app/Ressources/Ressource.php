<?php

namespace Citadelle\Salesforce\app\Ressources;


use Citadelle\Salesforce\app\Api;

class Ressource
{
    /**
     * @var Api
     */
    public $api;


    /**
     * Ressource constructor.
     */
    public function __construct()
    {
        $this->api = new Api();
    }

}

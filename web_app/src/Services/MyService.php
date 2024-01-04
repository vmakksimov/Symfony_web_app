<?php 

declare(strict_types=1);

namespace App\Services;

use App\Services\MySecondService;

use Symfony\Contracts\Service\Attribute\Required;

class MyService {

    public $secService;
    // use OptionalServiceTrait;
    public function __construct($service){
       dump($service);

       $this->secService = $service;
    }   


}
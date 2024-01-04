<?php 

declare(strict_types=1);

namespace App\Services;
use App\Services\MySecondService;
use Symfony\Contracts\Service\Attribute\Required;

trait OptionalServiceTrait {

    private $service;

    #[Required]
    public function setSecondService(MySecondService $second_service){
        dump($second_service);

        // $this->service = $second_service;
    }
}
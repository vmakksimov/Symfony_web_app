<?php

declare(strict_types=1);
namespace App\Services;
use Psr\Log\LoggerInterface;

class GiftService {

    public $gifts = ['ball', 'feather', 'egg', 'tomato', 'rosmarin'];
    public function __construct(LoggerInterface $logger){
        $logger->info('Succesfully presented gifts!');
        $this->gifts;
    }
}


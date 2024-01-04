<?php 

declare(strict_types=1);


namespace App\Services;

class MySecondService {
    public function __construct(){
        dump('from second service');
    }

    public function someMethod(){
        dump('some method here');
    }
}
<?php 

namespace App\Events;

use Psr\EventDispatcher\EventDispatcherInterface;
use stdClass;
use Symfony\Component\EventDispatcher\EventDispatcher;


class VideoCreatedEvent extends EventDispatcher {

    public $video;
    public function __construct(EventDispatcherInterface $video){
        $this->video = $video;
    }
}
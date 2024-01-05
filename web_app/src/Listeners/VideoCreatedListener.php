<?php 

namespace App\Listeners;

class VideoCreatedListener {
    // public function __invoke(){

    // }

    public function onVideoCreatedEvent($event){
        dump($event->video->title);
    }
}
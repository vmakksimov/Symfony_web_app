<?php 


declare(strict_types=1);

namespace App\Services;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpFoundation\Response;
class KernelResponseListener
{
    public function OnKernelResponse(ResponseEvent $event) {
        $response = new Response('dupa');
        $event->setResponse($response);
    }
}
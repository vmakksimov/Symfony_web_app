<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\GiftService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\{User, Video, Address};
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;



class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default', requirements: ['page' => '\d+'])]


    public function index(
        EntityManagerInterface $entityManager, 
        PersistenceManagerRegistry $doctrine,
        GiftService $gifts,
        Request $request,
        SessionInterface $session
    ): Response {

        // $user = new User();
        // $user->setName('Rodrigo');

        // $entityManager->persist($user);
        // $entityManager->flush();

        $user = new User();
        $user->setName('Viktor');
        $entityManager->persist($user);
        $entityManager->flush();

        $as = $entityManager->getRepository(User::class)->find(1);
        $users = $doctrine->getManager()->getRepository(User::class)->findAll();
        // $user = $doctrine->getManager()->getRepository(User::class)->find(1);
        dump($as);

        $video = new Video();

        for ($i=0; $i <= 5 ; $i++) { 
            $video->setTitle('Video number -' . $i);
            $user->addVideo($video);
            $entityManager->persist($video);
        }

       $address = new Address();
       $address->setStreet('501');
       $address->setNumber(1);
       $user->setAddress($address);
       $entityManager->flush();
        
        // $session->set('name', 'session value');
        // $session->clear();
        // if ($session->has('name')) {
        //     exit($session->get('name'));
        // }
        // exit($request->cookies->get('PHPSESSID'));
        // $cookie = new Cookie(
        //     'bounty',
        //     'bounty_value',
        //     time() + (2 * 365 * 24 * 60 * 60)
        // );

        // $res = new Response();
        // $res->headers->setCookie($cookie);
        // $res->send();


        $usera = ['Adam', 'Philly', 'Asen'];

        if (!$users) {
            throw $this->createNotFoundException('The user does not exists');
        }
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'gifts' => $gifts->gifts
        ]);
        // return $this->redirectToRoute('app_default2');
    }

    #[Route('/default2/{page}/{number}/{slug}/{category}', name: 'app_default2', defaults: ['category' => 'computers'],  requirements: ['category' => 'computers|rtv'])]
    public function index2(): Response
    {
        return $this->json(['Message' => 'This is defalt user 2']);
    }

    #[Route("/download", name: "download")]

    public function download()
    {
        $path = $this->getParameter('download_directory');
        return $this->file($path . 'file1.png');
    }
}

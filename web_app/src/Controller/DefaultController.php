<?php

namespace App\Controller;

use App\Services\GiftService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default')]    
    public function index(EntityManagerInterface $entityManager,PersistenceManagerRegistry $doctrine, GiftService $gifts) : Response
    {

        $user = new User();
        $user->setName('Rodrigo');
       
        $entityManager->persist($user);
        $entityManager->flush();
        

        $users = $doctrine->getManager()->getRepository(User::class)->findAll();
        
      
        $usera = ['Adam', 'Philly', 'Asen'];
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'gifts' => $gifts->gifts
        ]);
        // return $this->redirectToRoute('app_default2');
    }
    
    #[Route('/default2', name: 'app_default2')]
    public function index2(): Response
    {
        return $this->json(['Message' => 'This is defalt user 2']);
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\GiftService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\{User, Video, Address, Author, File, Pdf, SecurityUser};
use App\Events\VideoCreatedEvent;
use App\Form\RegisterUserType;
use App\Services\MyService;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
Use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Form\VideoFormType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;




class DefaultController extends AbstractController
{
    

    public $dispatcher;
    public function __construct(EventDispatcherInterface $dispatcher){
        $this->dispatcher = $dispatcher;
    
    }
    #[Route('/default', name: 'app_default', requirements: ['page' => '\d+'])]
    public function index(
        EntityManagerInterface $entityManager, 
        PersistenceManagerRegistry $doctrine,
        GiftService $gifts,
        Request $request,
        SessionInterface $session,
        MyService $myService,
        UserPasswordHasherInterface $userPasswordHasherInterface
    ): Response {

        // $user = new User();
        // $user->setName('Rodrigo');

        // $entityManager->persist($user);
        // $entityManager->flush();
        // $video = new \stdClass();
        // $video->title = 'Funny Movie';
        // $event = new VideoCreatedEvent($video);
        // $this->dispatcher->dispatch($event, 'video.created.event');
        // dump($myService->secService->someMethod());
        // $author = $entityManager->getRepository(Author::class)->findByIdWithPdf(1);
        // dump($author);
        // foreach($author->getFiles() as $file){
        //     dump($file->getFilename());
        // }

        // $user = new User();
        // $user->setName('Viktor');
        // $entityManager->persist($user);
        // $entityManager->flush();

        // $as = $entityManager->getRepository(User::class)->find(1);
        
        // $user = $doctrine->getManager()->getRepository(User::class)->find(1);
      

        

    //     for ($i=0; $i <= 5 ; $i++) { 
    //         $video->setTitle('Video number -' . $i);
    //         $user->addVideo($video);
    //         $entityManager->persist($video);
    //     }

    //    $address = new Address();
    //    $address->setStreet('501');
    //    $address->setNumber(1);
    //    $user->setAddress($address);
    //    $entityManager->flush();
        
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
        // $video = new Video();
        // $video->setTitle('Create a blog post');
        // $video->setCreatedAt(new \DateTime('tomorrow'));
        // $form = $this->createForm(VideoFormType::class, $video);
        // $form->handleRequest($request);
        // if($form->isSubmitted() && $form->isValid()){
        //     $entityManager->persist($video);
        //     $entityManager->flush();
        //     return $this->redirectToRoute('app_default');
        // }

        $users = $doctrine->getManager()->getRepository(SecurityUser::class)->findAll();
        dump($users);
        $usera = ['Adam', 'Philly', 'Asen'];

        $user = new SecurityUser();
        $form = $this->createForm(RegisterUserType::class, $user);
        $form->handleRequest($request);
        $passwordFile = $form->get('password')->getData();
        dump($passwordFile);
        if($form->isSubmitted() && $form->isValid()){
            $user->setPassword($userPasswordHasherInterface->hashPassword($user, $passwordFile));
            $user->setEmail($form->get('email')->getData());
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_default');
        }

        // if (!$users) {
        //     throw $this->createNotFoundException('The user does not exists');
        // }
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'gifts' => $gifts->gifts,
            'form' => $form->createView(),
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
    #[Route("/login", name: "login")]
    public function login(AuthenticationUtils $authenticationUtils){
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUserName,
            'error' => $error,
       
        ));
    }
}

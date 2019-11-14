<?php

namespace App\Controller;



use App\Document\Playlist;
use App\Document\Video;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Document\User;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class  ApplicationController extends AbstractController
{

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("/", name="acceuil")
     */
    public function acceuil( ){
        return $this->render('/video/index.html.twig');
    }


    /**
     * @Route("/AddPlayList/{id}", name="AddPlaylist")
     */

    public function createPlayList(DocumentManager $documentManager,Request $request,$id){

        $playList = new Playlist();

        $form=$this->createFormBuilder($playList)
            ->add('titre')
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()) {
            $this->addFlash('PlaylistUser',$playList->getUser());
            $playList->setIdUSer($id);
            $documentManager->persist($playList);
            $documentManager->flush();
        }
        return $this->render('application/AddPlayLIst.html.twig',[
            'formPlayList'=>$form->createView()
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */

    public function ShowPlayList(DocumentManager $documentManager,Request $request,$id){

        $repository=$documentManager->getRepository(Playlist::class);
        $EnsemblePlayList = $repository->findBy(['userid'=>$id]);
        return $this->render('application/Show.html.twig',[
            'EnsemblePLayList'=>$EnsemblePlayList
        ]);
    }



    /**
     * @Route("/userlogin", name="userlogin")
     */
    public function userLogin(AuthenticationUtils $authenticationUtils){
        $errors = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUsername();
        return $this->render('application/login.html.twig', [
            'error' => $errors,
            'lastUserName' => $lastUserName
        ]);

    }




    /**
     * @Route("/intermediaire/{id} ",name="intermediaire")
     */
       public function inter( ){
           return $this->render('/application/Intermediaire.hmtl.twig',[
               'session'=>$this->session
           ]);
       }



    /**
     * @Route("/inscription", name="inscription")
     */
    public function SignUp(DocumentManager $dm,Request $request,UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form=$this->createFormBuilder($user)
                    ->add('Firstname' )
                    ->add('Lastname')
                    ->add('email')
                    ->add('password',PasswordType::class)
                    ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $hash =$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $dm->persist($user);
            $dm->flush();
            $this->session->set('idUser', $user->getId());
            $this->addFlash('idUser',$user->getId());
            return  $this->redirectToRoute('userlogin');

        }
        return $this->render('/application/inscription.html.twig',[
            'formUser'=>$form->createView()

        ]);

    }


    /**
     * @Route("/deconnexion", name="deconnexion")
     */

     public function Deconnexion(){

         $this->session=$this->session->invalidate();
         return $this->render('/application/deconnexion.html.twig',[
             'session'=>$this->session

         ]);
     }
}

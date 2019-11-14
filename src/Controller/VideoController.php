<?php

namespace App\Controller;
use App\Document\Video;

use Symfony\Component\HttpFoundation\Request;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{

    /**
     * @Route("/Addvideo/{id}", name="addvideo")
     */
    public function createVideo(DocumentManager $dm,Request $request,$id)
    {
        $video=new Video();
        $form=$this->createFormBuilder($video)
            ->add('titre')
            ->add('chemin')
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $video->setPlayListid($id);
            $dm->persist($video);
            $dm->flush();
            return  $this->redirectToRoute('afficher',['id'=>$id]);
        }
        return $this->render('video/Addvideo.html.twig', [
            'controller_name' => 'VideoController',
            'formVideo'=>$form->createView()
        ]);
    }
    /**
     * @Route("/afficher/{id}", name="afficher")
     */

    public function ShowVideo(DocumentManager $documentManager,Request $request,$id){

        $repository=$documentManager->getRepository(Video::class);
        $EnsembleVideo = $repository->findBy(['playlistid'=>$id]);
        return $this->render('video/affichagevideo.html.twig',[
            'EnsembleVideo'=>$EnsembleVideo
        ]);
    }

}

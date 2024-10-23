<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;


class MedalijanController extends AbstractController
{
    #[Route('/showclient', name: 'app_showclient')]
    public function showclient(ManagerRegistry $m,ClientRepository $rep): Response
    {

        $clientdata = $rep->findAll();

        return $this->render('medalijan/showclient.html.twig', [
            'tabclient' =>  $clientdata,
        ]);
    }


    #[Route('/deleteclient/{id}', name: 'app_deleteclient')]
    public function deleteclient(ManagerRegistry $m,Request $req,$id,ClientRepository $rep): Response
            {
                $em=$m->getManager();
                $client=$rep->find($id);
                $em->remove($client);
                $em->flush();   
            return $this->redirectToRoute('app_showclient') ;   
            }

    #[Route('/addclient', name: 'app_addclient')]
    public function addclient(ManagerRegistry $m,Request $req): Response
    {
        $em=$m->getManager();
        $client=new Client();
        $client->setValidation(true);
       $form=$this->createForm(ClientType::class,$client);
        $form->handleRequest($req);
        if($form->isSubmitted()&&$form->isValid()){
            $client->setValidation(true);
        $em->persist($client);
        $em->flush();   
    return $this->redirectToRoute('app_showclient') ;   }
         return $this->render('medalijan/addclient.html.twig',['addform'=>$form]);
        }
  

}

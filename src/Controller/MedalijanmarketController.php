<?php

namespace App\Controller;

use App\Form\MarketType;
use App\Form\RechercheType;
use App\Repository\MarketRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class MedalijanmarketController extends AbstractController
{
    #[Route('/showmarket', name: 'app_showmarket')]
    public function Showmarket(MarketRepository $rep ,Request $request, ManagerRegistry $m): Response
    {
        $form = $this->createForm(RechercheType::class);

        $form->handleRequest($request);

        $Marketdata = $rep->findAll();

        if ($form->isSubmitted()) {
            $Marketdata = $rep->getMarketDate($form->get('min')->getData(), $form->get('max')->getData());
        }

        return $this->render('medalijanmarket/showmarket.html.twig', [
            'tabmarket' => $Marketdata, 'rechercheForm' => $form
        ]);
    }

    #[Route('/modifymarket/{id}', name: 'app_modifymarket')]
    public function modifymarket(ManagerRegistry $m, Request $req, MarketRepository $rep, $id): Response
    {
        $em = $m->getManager();
        $market = $rep->find($id);
        $form = $this->createForm(MarketType::class, $market);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($market);
            $em->flush();

            return $this->redirectToRoute('app_showmarket');
        }

        return $this->render('medalijanmarket/modifymarket.html.twig', [
            'form' => $form
        ]);
    }
}

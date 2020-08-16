<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\Routing\Annotation\Route;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo): HttpFoundationResponse
    {
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }

    /**
     * @Route("/ads/new", name="ads_create")
     *
     * @return Response
     */
    public function create(Request $request, ObjectManager $objectManager): HttpFoundationResponse
    {
        $ad = new Ad();
        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($ad);
            $objectManager->flush();

            $this->addFlash("success", "L'annonce {{$ad->getTitle()}} a bien été ajouté");

            return $this->redirectToRoute("ads_show", [
                "slug" => $ad->getSlug()
            ]);
        }

        return $this->render("ad/new.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route("/ads/{slug}", name="ads_show")
     * 
     * @return Response
     */
    public function show(Ad $ad): HttpFoundationResponse
    {
        return $this->render("ad/show.html.twig", [
            "ad" => $ad
        ]);
    }
}

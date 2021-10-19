<?php

namespace App\Controller;

use App\Entity\UploadableDemo;
use App\Form\UploadableDemoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route(path: "/new", name: "new")]
    public function new(Request $request): Response
    {
        $uploadableDemo = new UploadableDemo();

        $form = $this->createForm(UploadableDemoType::class, $uploadableDemo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $liste = $form->getData();
            $this->getDoctrine()->getManager()->persist($liste);
            $this->getDoctrine()->getManager()->flush();

            return $this->render('success.html.twig');
        }

        return $this->renderForm('uploadable_demo_form.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * Route("/{id}", name="index")
     *
     * The "id" of the UploadableDemo is passed in and then turned into a UploadableDemo object
     * automatically by the ParamConverter.
     */
    ##[Route(path: "/{id}", name: "index", defaults: ['id' => 1])]
    #[Route(path: "/{id}", name: "index", requirements: ['id' => "\d+"], defaults: ['id' => 1])]
    ##[Route(path: "/{id}", name: "index")]
    public function index(UploadableDemo $uploadableDemo): Response
    {
        $form = $this->createForm(UploadableDemoType::class, $uploadableDemo);

        return $this->renderForm('uploadable_demo_form.html.twig', [
            #'uploadableDemo' => $uploadableDemo,
            'form' => $form,
        ]);
    }
}

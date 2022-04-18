<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Forms\WoofType;
use function file_put_contents;

class WoofController extends AbstractController
{
    #[Route('/', methods: ['GET'])]
    public function homepage(Request $request): Response
    {
        $form = $this->createForm(WoofType::class);

        return $this->render('woof.html.twig', ['form_definition' => $form->createView()]);
    }

    #[Route('/', methods: ['POST'])]
    public function homepagePOST(Request $request): Response
    {
        $form = $this->createForm(WoofType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            file_put_contents('test.txt', var_export($form->getData(), true));
        }

        return $this->render('woof.html.twig', ['form_definition' => $form->createView()]);
    }
}

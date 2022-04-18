<?php

namespace App\Controller;

use App\Entity\Woof;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Forms\WoofType;
use function file_put_contents;

class WoofController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/', methods: ['GET'])]
    public function homepage(Request $request): Response
    {
        $form = $this->createForm(WoofType::class);

        return $this->renderTempalte($form);
    }

    #[Route('/', methods: ['POST'])]
    public function homepagePOST(Request $request): Response
    {
        $form = $this->createForm(WoofType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($form->getData());
            $this->entityManager->flush();
        }

        return $this->renderTempalte($form);
    }

    private function renderTempalte(FormInterface $form): Response
    {
        $woofs = $this->entityManager->getRepository(Woof::class)->findAll();
        return $this->render('woof.html.twig', ['form_definition' => $form->createView(), 'woofs' => $woofs]);
    }
}

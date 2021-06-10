<?php


namespace App\Controller;


use App\Entity\Tricks;
use App\Form\TrickFormType;
use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TricksController extends AbstractController
{
    private TricksRepository $trickRepository;

    public function __construct(TricksRepository $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    /**
     * @Route("/tricks/{id}", name="trick_show", requirements={"id"="\d+"})
     */
    public function showTrick(Tricks $tricks)
    {
        $trick = $this->trickRepository->findOneByIdJoinedToGroup($tricks->getId());
        /*$groupName= $trick->getGroup()->getName();*/

        return $this->render('tricks/show.html.twig', [
            'trick' => $trick,
        ]);

    }

    /**
     * @Route("/tricks/{id}/edit", name="trick_edit", requirements={"id"="\d+"})
     */
    public function editTrick(Tricks $tricks, Request $request): Response
    {
        $trick = $this->trickRepository->findOneByIdJoinedToGroup($tricks->getId());
        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        return $this->render('tricks/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
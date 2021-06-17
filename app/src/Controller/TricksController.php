<?php


namespace App\Controller;


use App\Entity\Tricks;
use App\Form\TrickFormType;
use App\Repository\TricksRepository;
use Doctrine\ORM\NonUniqueResultException;
use phpDocumentor\Reflection\Types\This;
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
     * @Route("/tricks/add", name="trick_add")
     */
    public function addTrick(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $trick = new Tricks();

        $form = $this->createForm(TrickFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $trick = $form->getData();
            $trick->setCreatedAt();
            $trick->setUpdatedAt();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trick);
            $entityManager->flush();

            $this->addFlash('success', '<p class="text-center m-0">'.$trick->getName().' was created !</p>');

            return $this->redirectToRoute('trick_show', ['id' => $trick->getId()]);

        }

        return $this->render('tricks/add.html.twig', [
            'createForm' => $form->createView(),
        ]);

    }

    /**
     * @Route("/tricks/delete/{id}", name="trick_delete", requirements={"id"="\d+"})
     */
    public function deleteTrick(Tricks $tricks)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $trick = $this->trickRepository->find($tricks->getId());

        $this->addFlash('warning', '<p class="text-center m-0">'.$trick->getName().' was deleted ! </p>');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($trick);
        $entityManager->flush();


        return $this->redirectToRoute('app_home');

    }

    /**
     * @Route("/tricks/{id}/edit", name="trick_edit", requirements={"id"="\d+"})
     * @throws NonUniqueResultException
     */
    public function editTrick(Tricks $tricks, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $trick = $this->trickRepository->findOneByIdJoinedToGroup($tricks->getId());


        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick = $form->getData();
            $trick->setUpdatedAt();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trick);
            $entityManager->flush();

            $this->addFlash('success', '<p class="text-center m-0">'.$trick->getName().' was updated !</p>');

            return $this->redirectToRoute('trick_show', ['id' => $tricks->getId()]);

        }

        return $this->render('tricks/edit.html.twig', [
            'editForm' => $form->createView(),
        ]);

    }
}
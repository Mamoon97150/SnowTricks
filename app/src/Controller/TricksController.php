<?php


namespace App\Controller;


use App\Entity\Message;
use App\Entity\Tricks;
use App\Entity\User;
use App\Form\MessageFormType;
use App\Form\TrickFormType;
use App\Repository\TricksRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class TricksController extends AbstractController
{
    private TricksRepository $trickRepository;
    private Security $security;

    public function __construct(TricksRepository $trickRepository, Security $security)
    {
        $this->trickRepository = $trickRepository;
        $this->security = $security;
    }

    /**
     * @Route("/tricks/{id}", name="trick_show", requirements={"id"="\d+"})
     * @throws NonUniqueResultException
     */
    public function showTrick(Tricks $tricks, Request $request)
    {
        $trick = $this->trickRepository->findOneByIdJoinedToGroup($tricks->getId());
        $messages = $trick->getMessages();
        $username = $this->getUser()->getUsername();
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username' => $username]);


        $form = $this->createForm(MessageFormType::class);
        $form->handleRequest($request);

        if ($this->security->isGranted('ROLE_USER')) {
            if ($form->isSubmitted() && $form->isValid()) {
                (new MessageController())->addMessage($form, $trick, $user, $this);
            }

        }


        return $this->render('tricks/show.html.twig', [
            'trick' => $trick,
            'messages' => $messages,
            'user' => $user,
            'messageForm' => $form->createView()
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
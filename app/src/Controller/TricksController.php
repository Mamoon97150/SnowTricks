<?php


namespace App\Controller;


use App\Entity\Medias;
use App\Entity\Message;
use App\Entity\Tricks;
use App\Entity\User;
use App\Form\MediaFormType;
use App\Form\MessageFormType;
use App\Form\TrickFormType;
use App\Repository\MessageRepository;
use App\Repository\TricksRepository;
use App\Service\MediaUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
     */
    public function showTrick(Tricks $trick, Request $request, MediaUploader $uploader, MessageRepository $messageRepository): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageFormType::class, $message);
        $form->handleRequest($request);

        if ($this->security->isGranted('ROLE_USER') && $form->isSubmitted() && $form->isValid()) {
            (new MessageController())->addMessage($form, $trick, $this);
        }

        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $messageRepository->getMessagePaginator($trick, $offset);

        $media = new Medias();
        $mediaForm = $this->createForm(MediaFormType::class, $media);
        $mediaForm->handleRequest($request);

        if ($this->security->isGranted('ROLE_USER') && $mediaForm->isSubmitted() && $mediaForm->isValid()) {
            (new MediaController($this->security))->addMedia($uploader, $trick, $mediaForm, $media, $this);
        }

        $featured = (new MediaController($this->security))->getFeatured($trick, $this);

        return $this->render('tricks/show.html.twig', [
            'trick' => $trick,
            'messageForm' => $form->createView(),
            'messages' => $paginator,
            'previous' => $offset - MessageRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + MessageRepository::PAGINATOR_PER_PAGE),
            'mediaForm'=> $mediaForm->createView(),
            'featured' => $featured
        ]);

    }

    /**
     * @Route("/tricks/add", name="trick_add")
     */
    public function addTrick(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $trick = new Tricks();

        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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
    public function deleteTrick(Tricks $trick)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $this->addFlash('warning', '<p class="text-center m-0">'.$trick->getName().' was deleted ! </p>');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($trick);
        $entityManager->flush();


        return $this->redirectToRoute('app_home');

    }

    /**
     * @Route("/tricks/{id}/edit", name="trick_edit", requirements={"id"="\d+"})
     */
    public function editTrick(Tricks $trick, Request $request, MediaUploader $uploader): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setUpdatedAt();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trick);
            $entityManager->flush();

            $this->addFlash('success', '<p class="text-center m-0">'.$trick->getName().' was updated !</p>');

            return $this->redirectToRoute('trick_show', ['id' => $trick->getId()]);

        }

        $media = new Medias();
        $mediaForm = $this->createForm(MediaFormType::class, $media);
        $mediaForm->handleRequest($request);

        if ($this->security->isGranted('ROLE_USER') && $mediaForm->isSubmitted() && $mediaForm->isValid()) {
            (new MediaController($this->security))->addMedia($uploader, $trick, $mediaForm, $media, $this);
        }

        $featured = (new MediaController($this->security))->getFeatured($trick, $this);

        return $this->render('tricks/edit.html.twig', [
            'editForm' => $form->createView(),
            'featured' => $featured,
            'mediaForm' => $mediaForm->createView(),
            'trick' => $trick
        ]);

    }
}
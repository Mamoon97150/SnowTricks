<?php


namespace App\Controller;


use App\Entity\Medias;
use App\Entity\Message;
use App\Entity\Tricks;
use App\Form\ImgFormType;
use App\Form\MessageFormType;
use App\Form\TrickFormType;
use App\Form\VideoFormType;
use App\Repository\MessageRepository;
use App\Repository\TricksRepository;
use App\Service\MediaUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/tricks/{slug}", name="trick_show")
     */
    public function showTrick(Tricks $trick, Request $request, MediaUploader $uploader, MessageRepository $messageRepository): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageFormType::class, $message);
        $form->handleRequest($request);

        if ($this->security->isGranted('ROLE_USER') && $form->isSubmitted() && $form->isValid()) {
            (new MessageController())->addMessage($form, $trick, $this);
        }

        $page = (int)$request->query->get('page', 1);
        $limit = 10;

        $count = $messageRepository->getMessageCount($trick);
        $maxPage = ceil($count/$limit);

        $paginator = $messageRepository->getMessagePaginator($trick, $limit, $page);

        if ($request->get('load')){
            return new JsonResponse([
                'content' => $this->renderView('messages/_show.html.twig', ['messages' => $paginator,]),
                'maxPage' => $maxPage
            ]);
        }

        $media = new Medias();
        $mediaForm = $this->createForm(ImgFormType::class, $media);
        $mediaForm->handleRequest($request);

        if ($this->security->isGranted('ROLE_USER') && $mediaForm->isSubmitted() && $mediaForm->isValid()) {
            (new MediaController($this->security))->addMedia($uploader, $trick, $mediaForm, $media, $this);
        }

        $embed = new Medias();
        $embedForm = $this->createForm(VideoFormType::class, $embed);
        $embedForm->handleRequest($request);


        if ($this->security->isGranted('ROLE_USER') && $embedForm->isSubmitted() && $embedForm->isValid()) {

            $embed = $embedForm->getData();

            $embed->setExtension('link');
            $embed->setTrick($trick);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($embed);
            $entityManager->flush();

            $this->addFlash('success', '<p class="text-center m-0">Your video was embedded to the trick !</p>');
        }


        $featured = (new MediaController($this->security))->getFeatured($trick, $this);

        return $this->render('tricks/show.html.twig', [
            'trick' => $trick,
            'messageForm' => $form->createView(),
            'messages' => $paginator,
            'mediaForm' => $mediaForm->createView(),
            'embedForm' => $embedForm->createView(),
            'featured' => $featured,
            'page' => $page,
            'maxPage' => $maxPage
        ]);

    }

    /**
     * @Route("/trick/add", name="trick_add")
     */
    public function addTrick(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $trick = new Tricks();

        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trick);
            $entityManager->flush();

            $this->addFlash('success', '<p class="text-center m-0">'.$trick->getName().' was created !</p>');

            return $this->redirectToRoute('trick_show', ['slug' => $trick->getSlug()]);

        }

        return $this->render('tricks/add.html.twig', [
            'createForm' => $form->createView(),
        ]);

    }

    /**
     * @Route("/tricks/delete/{slug}", name="trick_delete")
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
     * @Route("/tricks/{slug}/edit", name="trick_edit")
     */
    public function editTrick(Tricks $trick, Request $request, MediaUploader $uploader): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trick);
            $entityManager->flush();

            $this->addFlash('success', '<p class="text-center m-0">'.$trick->getName().' was updated !</p>');

            return $this->redirectToRoute('trick_show', ['slug' => $trick->getSlug()]);

        }

        $media = new Medias();
        $mediaForm = $this->createForm(ImgFormType::class, $media);
        $mediaForm->handleRequest($request);

        if ($this->security->isGranted('ROLE_USER') && $mediaForm->isSubmitted() && $mediaForm->isValid()) {
            (new MediaController($this->security))->addMedia($uploader, $trick, $mediaForm, $media, $this);
        }

        $embed = new Medias();
        $embedForm = $this->createForm(VideoFormType::class, $embed);
        $embedForm->handleRequest($request);


        if ($this->security->isGranted('ROLE_USER') && $embedForm->isSubmitted() && $embedForm->isValid()) {

            $embed = $embedForm->getData();

            $embed->setExtension('link');
            $embed->setTrick($trick);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($embed);
            $entityManager->flush();

            $this->addFlash('success', '<p class="text-center m-0">Your video was embedded to the trick !</p>');
        }

        $featured = (new MediaController($this->security))->getFeatured($trick, $this);

        return $this->render('tricks/edit.html.twig', [
            'editForm' => $form->createView(),
            'featured' => $featured,
            'mediaForm' => $mediaForm->createView(),
            'embedForm' => $embedForm->createView(),
            'trick' => $trick
        ]);

    }
}
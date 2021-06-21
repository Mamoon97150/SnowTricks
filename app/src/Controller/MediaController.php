<?php

namespace App\Controller;

use App\Entity\Medias;
use App\Entity\Tricks;
use App\Form\MediaFormType;
use App\Repository\MediasRepository;
use App\Service\MediaUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class MediaController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    /**
     * @Route("/media/add/{id}", name="media_add", requirements={"id"="\d+"})
     */
    public function addMedia(MediaUploader $mediaUploader, Tricks $trick, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $media = new Medias();
        $mediaForm = $this->createForm(MediaFormType::class, $media);
        $mediaForm->handleRequest($request);


        if ($mediaForm->isSubmitted() && $mediaForm->isValid()) {
            /** @var UploadedFile $file */
            $file = $mediaForm->get('name')->getData();

            if ($file) {
                $media->setExtension($file->guessExtension());

                $mediaName = $mediaUploader->upload($file);
                $media->setName($mediaName);
                $media->setTrick($trick);


                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($media);
                $entityManager->flush();


                $this->addFlash('success', '<p class="text-center m-0">Your media was added to the trick !</p>');
            }

        }

        return $this->render('media/_addMedia.html.twig', [
            'mediaForm' => $mediaForm->createView()
        ]);
    }

    public function getFeatured(Tricks $trick, TricksController $param): ?object
    {
        return $param->getDoctrine()
            ->getRepository(Medias::class)
            ->findOneBy([
                'featured' => true,
                'trick' => $trick
            ]);
    }

    /**
     * @Route("/media/delete/{id}", name="media_delete", requirements={"id"="\d+"})
     */
    public function deleteMedia(Medias $media): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $this->addFlash('warning', '<p class="text-center m-0">The media was deleted ! </p>');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($media);
        $entityManager->flush();


        return $this->redirectToRoute('trick_show', [
            'id' => $media->getTrick()->getId()
        ]);

    }

    /**
     * @Route("/media/{id}/edit", name="media_edit", requirements={"id"="\d+"})
     */
    public function editMedia(Medias $media, Request $request, MediaUploader $mediaUploader): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $mediaForm = $this->createForm(MediaFormType::class, $media);
        $mediaForm->handleRequest($request);

        if ($this->security->isGranted('ROLE_USER') && $mediaForm->isSubmitted() && $mediaForm->isValid()) {
            /** @var UploadedFile $file */
            $file = $mediaForm->get('name')->getData();

            if ($file) {
                $media->setExtension($file->guessExtension());

                $mediaName = $mediaUploader->upload($file);
                $media->setName($mediaName);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($media);
                $entityManager->flush();

                $this->addFlash('success', '<p class="text-center m-0">This media was updated !</p>');
            }
            return $this->redirectToRoute('trick_edit', ['id' => $media->getTrick()->getId()]);

        }

        return $this->render('media/_editMedia.html.twig', [
            'mediaForm' => $mediaForm->createView(),
            'media' => $media
        ]);

    }

}

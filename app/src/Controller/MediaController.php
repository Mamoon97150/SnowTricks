<?php

namespace App\Controller;

use App\Entity\Medias;
use App\Entity\Tricks;
use App\Form\ImgFormType;
use App\Service\MediaUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class MediaController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function addMedia(MediaUploader $mediaUploader, Tricks $trick, FormInterface $mediaForm, Medias $media, TricksController $controller): Response
    {
        $controller->denyAccessUnlessGranted('ROLE_USER');

        /** @var UploadedFile $file */
        $file = $mediaForm->get('name')->getData();

        if ($file) {
            $media->setExtension($file->guessExtension());

            $mediaName = $mediaUploader->upload($file);
            $media->setName($mediaName);
            $media->setTrick($trick);

            $entityManager = $controller->getDoctrine()->getManager();

            $featured = (new MediaController($this->security))->getFeatured($trick, $controller);
            if ($media->getFeatured() and $featured) {
                $featured->setFeatured(false);
                $entityManager->persist($featured);
            }

            $entityManager->persist($media);
            $entityManager->flush();


            $controller->addFlash('success', '<p class="text-center m-0">Your media was added to the trick !</p>');
        }
        return $controller->redirectToRoute('trick_show', ['id' => $trick->getId()]);
    }

    public function getFeatured(Tricks $trick, AbstractController $param): ?object
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

        $mediaForm = $this->createForm(ImgFormType::class, $media);
        $mediaForm->handleRequest($request);

        if ($this->security->isGranted('ROLE_USER') && $mediaForm->isSubmitted() && $mediaForm->isValid()) {
            /** @var UploadedFile $file */
            $file = $mediaForm->get('name')->getData();

            if ($file) {
                $media->setExtension($file->guessExtension());

                $mediaName = $mediaUploader->upload($file);
                $media->setName($mediaName);

                $entityManager = $this->getDoctrine()->getManager();

                if ($media->getFeatured()) {
                    $featured = $this->getFeatured($media->getTrick(), $this);
                    $featured->setFeatured(false);
                    $entityManager->persist($featured);
                }

                $entityManager->persist($media);
                $entityManager->flush();

                $this->addFlash('success', '<p class="text-center m-0">This media was updated !</p>');
            }
            return $this->redirectToRoute('trick_edit', ['id' => $media->getTrick()->getId()]);

        }

        return $this->render('media/editMedia.html.twig', [
            'imgForm' => $mediaForm->createView(),
            'media' => $media
        ]);

    }

}

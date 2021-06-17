<?php

namespace App\Controller;

use App\Entity\Medias;
use App\Repository\MediasRepository;
use App\Service\MediaUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class MediaController extends AbstractController
{
    public function addMedia(UploadedFile $file, MediaUploader $mediaUploader, Medias $media, AbstractController $controller, $trick): Response
    {
        $controller->denyAccessUnlessGranted('ROLE_USER');

        if ($file) {
            $media->setExtension($file->guessExtension());

            $mediaName = $mediaUploader->upload($file);
            $media->setName($mediaName);
            $media->setTrick($trick);

            $entityManager = $controller->getDoctrine()->getManager();
            $entityManager->persist($media);
            $entityManager->flush();

            $controller->addFlash('success', '<p class="text-center m-0">Your media was added to the trick !</p>');

        }

        return $controller->redirectToRoute('trick_show', ['id' => $trick->getId()]);
    }

    public function getFeatured(\App\Entity\Tricks $trick, TricksController $param)
    {
        return $param->getDoctrine()
            ->getRepository(Medias::class)
            ->findOneBy([
                'featured' => true,
                'trick' => $trick
            ]);
    }

    /**
     * @Route("/media/delete/{id}", name="message_delete", requirements={"id"="\d+"})
     */
    public function deleteMedia(Medias $media): RedirectResponse
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

}

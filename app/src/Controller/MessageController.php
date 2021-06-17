<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/message/delete/{id}", name="message_delete", requirements={"id"="\d+"})
     */
    public function deleteMessage(Message $message): RedirectResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $this->addFlash('warning', '<p class="text-center m-0">The message was deleted ! </p>');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($message);
        $entityManager->flush();


        return $this->redirectToRoute('trick_show', [
            'id' => $message->getTrick()->getId()
        ]);

    }

    public function addMessage($form, $trick, AbstractController $controller): RedirectResponse
    {
        $message = $form->getData();
        $message->setCreatedAt();
        $message->setTrick($trick);
        $message->setUser($controller->getUser());


        $entityManager = $controller->getDoctrine()->getManager();
        $entityManager->persist($message);
        $entityManager->flush();

        $controller->addFlash('success', '<p class="text-center m-0">Your message was added to the discussion board, ' . $user->getUsername() . '!</p>');

        return $controller->redirectToRoute('trick_show', ['id' => $trick->getId()]);

    }
}

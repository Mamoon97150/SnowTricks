<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\User;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/message/delete/{id}", name="message_delete", requirements={"id"="\d+"})
     */
    public function deleteMessage(Message $messages, MessageRepository $messageRepository)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $message = $messageRepository->find($messages->getId());

        $this->addFlash('warning', '<p class="text-center m-0">The message was deleted ! </p>');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($message);
        $entityManager->flush();


        return $this->redirectToRoute('trick_show', [
            'id' => $message->getTrick()->getId()
        ]);

    }

    public function addMessage($form, $trick, $user, $controller)
    {
        $message = $form->getData();
        $message->setCreatedAt();
        $message->setTrick($trick);
        $message->setUser($user);


        $entityManager = $controller->getDoctrine()->getManager();
        $entityManager->persist($message);
        $entityManager->flush();

        $controller->addFlash('success', '<p class="text-center m-0">Your message was added to de discussion board, ' . $user->getUsername() . '!</p>');

        return $controller->redirectToRoute('trick_show', ['id' => $trick->getId()]);

    }
}

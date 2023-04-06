<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $contact->setCreatedAt(new \DateTimeImmutable());


            $entityManager->persist($contact);
            $entityManager->flush();

            $email = (new Email())
                ->from($contact->getEmail())
                ->to('laxar@laxar.com')
                ->subject($contact->getSubject())
                ->html($contact->getMessage());

            $mailer->send($email);

            $this->addFlash('success', 'Le message a bien été envoyé ');



            return $this->redirectToRoute('app_contact');
        };


        return $this->render('contact/index.html.twig', [
            'form' => $form,
        ]);
    }
}

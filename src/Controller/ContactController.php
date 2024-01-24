<?php

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
{
    /**
     * List items
     */
    public function showForm(): string
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(
                empty($_POST['firstName']) ||
                empty($_POST['lastName']) ||
                empty($_POST['emailAddress']) ||
                empty($_POST['topic']) ||
                empty($_POST['messageContent'])
            ){
                return $this->twig->render('Contact/contact.html.twig', [
                    'error' => 'Veuillez remplir tous les champs',
                    'post' => $_POST,
                ]);
            }

            $contactManager = new ContactManager();
            $contact = $contactManager->insert($_POST);
            header('Location: /contact_us_sent');
            exit();

        }
        return $this->twig->render('Contact/contact.html.twig');
    }

    public function confirmationSending(): string
    {
        return $this->twig->render('Contact/contact.html.twig', [
            'success' => 'Votre message a bien été envoyé',
        ]);
    }
}

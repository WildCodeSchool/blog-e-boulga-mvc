<?php

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
{
    public function showForm(): string|false
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->twig->render('Contact/contact.html.twig');
        }

        $_POST = array_map('trim', $_POST);
        foreach ($_POST as $key => $value) {
            $_POST[$key] = htmlentities($value);
        }

        $errors = $this->validateForm();

        if (empty($errors)) {
            (new ContactManager())->insert($_POST);
            header('Location: /contact_sent');
            exit();
        }

        return $this->twig->render('Contact/contact.html.twig', [
            'errors' => $errors,
            'post' => $_POST,
        ]);
    }

    private function validateForm(): array
    {
        $errors = [];

        $this->validateRequiredFields(['firstName', 'lastName', 'emailAddress', 'topic', 'messageContent'], $errors);
        $this->validateEmailAddress('emailAddress', 'L\'adresse email n\'est pas valide', $errors);
        $this->validateStringLength(
            'messageContent',
            10,
            PHP_INT_MAX,
            'Le message doit contenir au moins 10 caractères',
            $errors
        );
        $this->validateStringLength(
            'firstName',
            2,
            PHP_INT_MAX,
            'Le prénom doit contenir au moins 2 caractères',
            $errors
        );
        $this->validateStringLength('lastName', 2, PHP_INT_MAX, 'Le nom doit contenir au moins 2 caractères', $errors);
        $this->validateStringLength('topic', 4, 80, 'Le sujet doit contenir entre 4 et 80 caractères', $errors);
        $this->validateCheckbox('validation', 'Vous devez accepter les conditions d\'utilisation', $errors);

        return $errors;
    }

    private function validateRequiredFields(array $fields, array &$errors): void
    {
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                match ($field) {
                    'firstName' => $field = 'prénom',
                    'lastName' => $field = 'nom',
                    'emailAddress' => $field = 'adresse email',
                    'topic' => $field = 'sujet',
                    'messageContent' => $field = 'message',
                    default => $field = 'champ',
                };

                $errors[] = "Le champ {$field} est obligatoire";
            }
        }
    }

    private function validateEmailAddress(string $field, string $errorMessage, array &$errors): void
    {
        if (!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
            $errors[] = $errorMessage;
        }
    }

    private function validateStringLength(
        string $field,
        int $minLength,
        int $maxLength,
        string $errorMessage,
        array &$errors
    ): void {
        $value = $_POST[$field] ?? '';
        $length = mb_strlen($value, 'UTF-8');

        if (!empty($value) && ($length < $minLength || $length > $maxLength)) {
            $errors[] = $errorMessage;
        }
    }

    private function validateCheckbox(string $field, string $errorMessage, array &$errors): void
    {
        if (!isset($_POST[$field])) {
            $errors[] = $errorMessage;
        }
    }

    public function confirmationSending(): string
    {
        return $this->twig->render('Contact/contact.html.twig', [
            'success' => 'Votre message a bien été envoyé',
        ]);
    }
}

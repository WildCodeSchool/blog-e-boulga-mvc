<?php

namespace App\Controller;

class ContactController extends AbstractController
{
    /**
     * List items
     */
    public function showForm(): string
    {
        return $this->twig->render('Contact/contact.html.twig');
    }
}

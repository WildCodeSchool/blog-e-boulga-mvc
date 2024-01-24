<?php

namespace App\Model;

use PDO;

class ContactManager extends AbstractManager
{
    public const TABLE = 'form';
    public const CLASSNAME = "App\Model\FormModel";

    /**
     * Insert new form data in database
     */
    public function insert(array $form): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`firstName`, `lastName`, `emailAddress`, `topic`, `messageContent`, `sendingStatus`) VALUES (:firstName, :lastName, :emailAddress, :topic, :messageContent, 1)");
        $statement->bindValue('firstName', $form['firstName'], PDO::PARAM_STR);
        $statement->bindValue('lastName', $form['lastName'], PDO::PARAM_STR);
        $statement->bindValue('emailAddress', $form['emailAddress'], PDO::PARAM_STR);
        $statement->bindValue('topic', $form['topic'], PDO::PARAM_STR);
        $statement->bindValue('messageContent', $form['messageContent'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

}

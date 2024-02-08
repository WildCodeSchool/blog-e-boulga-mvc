<?php

namespace App\Model;

class AdminUserModel
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $emailAddress;
    private string $login;
    private string $password;
    private string $accountStatus;
    private string $roles;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFirstname(): string
    {
        return $this->firstName;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstName = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastName;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastName = $lastname;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): void
    {
        $this->emailAddress = $emailAddress;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getAccountStatus(): string
    {
        return $this->accountStatus;
    }

    public function setAccountStatus(string $accountStatus): void
    {
        $this->accountStatus = $accountStatus;
    }

    public function getRoles(): string
    {
        return $this->roles;
    }

    public function setRoles(string $roles): void
    {
        $this->roles = $roles;
    }
}

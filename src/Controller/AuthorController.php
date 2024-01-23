<?php

namespace App\Controller;

class AuthorController
{
    private int $id = 0;
    private string $firstName = "";
    private string $lastName = "";
    private string $shortDescription = "";
    private string $fullDescription = "";
    private string $linkedinURL = "";
    private string $githubURL = "";
    private string $webSite = "";
    private string $image = "";

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $shortDescription
     * @param string $fullDescription
     * @param string $linkedinURL
     * @param string $githubURL
     * @param string $webSite
     * @param string $image
     */
    public function __construct(
        string $firstName,
        string $lastName,
        string $shortDescription,
        string $fullDescription,
        string $linkedinURL,
        string $githubURL,
        string $webSite,
        string $image
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->shortDescription = $shortDescription;
        $this->fullDescription = $fullDescription;
        $this->linkedinURL = $linkedinURL;
        $this->githubURL = $githubURL;
        $this->webSite = $webSite;
        $this->image = $image;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    public function getFullDescription(): string
    {
        return $this->fullDescription;
    }

    public function setFullDescription(string $fullDescription): void
    {
        $this->fullDescription = $fullDescription;
    }

    public function getLinkedinURL(): string
    {
        return $this->linkedinURL;
    }

    public function setLinkedinURL(string $linkedinURL): void
    {
        $this->linkedinURL = $linkedinURL;
    }

    public function getGithubURL(): string
    {
        return $this->githubURL;
    }

    public function setGithubURL(string $githubURL): void
    {
        $this->githubURL = $githubURL;
    }

    public function getWebSite(): string
    {
        return $this->webSite;
    }

    public function setWebSite(string $webSite): void
    {
        $this->webSite = $webSite;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }
}

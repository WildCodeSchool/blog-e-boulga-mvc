<?php

namespace App\Model;

/**

This will suppress all the PMD warnings in
this class.
 *
 * @SuppressWarnings(PHPMD)
 */
class ArticleModel
{
    private int $id;
    private ?int $authorId;
    private ?int $categoryId;
    private ?string $articleTitle;
    private ?string $homeTitle;
    private ?string $imgSrc;
    private ?string $altImg;
    private ?string $homePreview;
    private ?string $introduction;
    private ?string $detail;
    private ?string $description;
    private ?string $shadowColor;
    private ?string $releaseDate;
    private int $status;
    private ?string $updatedAt;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $articleCategory;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getArticleTitle(): string
    {
        return $this->articleTitle;
    }

    public function setArticleTitle(string $articleTitle): void
    {
        $this->articleTitle = $articleTitle;
    }

    public function getHomeTitle(): string
    {
        return $this->homeTitle;
    }

    public function setHomeTitle(string $homeTitle): void
    {
        $this->homeTitle = $homeTitle;
    }

    public function getImgSrc(): string
    {
        return $this->imgSrc;
    }

    public function setImgSrc(string $imgSrc): void
    {
        $this->imgSrc = $imgSrc;
    }

    public function getAltImg(): string
    {
        return $this->altImg;
    }

    public function setAltImg(string $altImg): void
    {
        $this->altImg = $altImg;
    }

    public function getHomePreview(): string
    {
        return $this->homePreview;
    }

    public function setHomePreview(string $homePreview): void
    {
        $this->homePreview = $homePreview;
    }

    public function getIntroduction(): string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): void
    {
        $this->introduction = $introduction;
    }

    public function getDetail(): string
    {
        return htmlspecialchars_decode($this->detail);
    }

    public function setDetail(string $detail): void
    {
        $this->detail = $detail;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getShadowColor(): string
    {
        return $this->shadowColor;
    }

    public function setShadowColor(string $shadowColor): void
    {
        $this->shadowColor = $shadowColor;
    }

    public function getReleaseDate(): string | null
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getArticleCategory(): ?string
    {
        return $this->articleCategory;
    }

    public function setArticleCategory(?string $articleCategory): void
    {
        $this->articleCategory = $articleCategory;
    }
}

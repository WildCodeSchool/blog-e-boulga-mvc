<?php

namespace App\Controller;

use App\Model\ArticleManager;
use App\Model\AuthorManager;
use App\Model\CategoryManager;
use App\Interface\UploadFile;

class ArticleController extends AbstractController implements UploadFile
{
    /**
     * Display article informations specified by $id.
     */
    public function show(int $id): string
    {
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticle($id);
        $authorId = $article->getAuthorId();

        $authorManager = new AuthorManager();
        $author = $authorManager->getById($authorId);

        return $this->twig->render('Article/article.html.twig', [
            'article' => $article,
            'author' => $author,
            'authorId' => $authorId,
        ]);
    }

    public function add(): string
    {
        $author = new AuthorManager();
        $authors = $author->getAll();

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->getAllCategory();

        return $this->twig->render('Admin/Article/add.html.twig', [
            'authors' => $authors,
            'categories' => $categories
        ]);
    }

    public function uploadFile(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $image = $_FILES['avatar'];

            $fileTmp = $image['tmp_name'];
            $fileName = $image['name'];

            $uploadDir = 'assets/images/articles/';
            $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $typeOfFile = ['jpg', 'png', 'webp'];
            $maxFileSize = 2000000;

            if ((!in_array($extension, $typeOfFile))) {
                $errors[] = 'Veuillez sélectionner une image de type jpg, png ou webp !';
            }
            if (file_exists($fileTmp) && filesize($fileTmp) > $maxFileSize) {
                $errors[] = 'Votre fichier doit faire moins de 2Mo !';
            }
            $uploaded = [];
            $failed = [];

            $fileExt = explode('.', $fileName);
            $fileExt = strtolower(end($fileExt));

            if (empty($errors)) {
                $fileNameNew = uniqid('', true) . '.' . $fileExt;
                $fileDestination = $uploadDir . $fileNameNew;

                if (move_uploaded_file($fileTmp, $fileDestination)) {
                    $uploaded[$fileName] = $fileDestination;
                } else {
                    $failed[$fileName] = "[{$fileName}] failed to upload.";
                }
            }
        }
    }
}

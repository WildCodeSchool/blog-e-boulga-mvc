<?php

namespace App\Controller;

use App\Model\ArticleManager;
use App\Model\AuthorManager;
use App\Model\CategoryManager;
use App\Interface\UploadFile;

class ArticleController extends AbstractController implements UploadFile
{
    public function index(): string
    {
        if (!$this->user) {
            header('Location: /admin/login');
            exit();
        }

        $articleManager = new ArticleManager();
        $mainArticleId = $articleManager->getMainArticleId();

        if (isset($_GET['status'])) {
            $list = $_GET['status'];
            if ($list === 'archived') {
                $articles = $articleManager->selectByConditions('status', '3');
            } elseif ($list === 'published') {
                $articles = $articleManager->selectByConditions('status', '2');
            } elseif ($list === 'draft') {
                $articles = $articleManager->selectByConditions('status', '1');
            } else {
                $articles = ['error' => 'Aucun article ne correspond à votre recherche'];
            }
        } else {
            $articles = $articleManager->selectAll();
        }


        return $this->twig->render('Admin/Article/index.html.twig', [
            'articles' => $articles,
            'mainArticleId' => $mainArticleId->getIdArticle(),
        ]);
    }
    /**
     * Display article informations specified by $id.
     */
    public function show(int $id): string
    {
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticle($id);

        if (!$article) {
            header("HTTP/1.0 404 Not Found");
            echo '404 - Page not found';
            exit();
        }

        $authorId = $article->getAuthorId();

        $authorManager = new AuthorManager();
        $author = $authorManager->getById($authorId);

        return $this->twig->render('Article/article.html.twig', [
            'article' => $article,
            'author' => $author,
            'authorId' => $authorId,
        ]);
    }

add_article_form
    public function add(): string
    {
        $author = new AuthorManager();
        $authors = $author->getAll();

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->getAllCategory();

        $this->uploadFile();

        return $this->twig->render('Admin/Article/add.html.twig', [
            'authors' => $authors,
            'categories' => $categories
        ]);
    }

    public function uploadFile(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $image = $_FILES['imageUpload'];

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

            if (empty($errors)) {
                $fileNameNew = uniqid('', true) . '.' . $extension;
                $fileDestination = $uploadDir . $fileNameNew;

                if (move_uploaded_file($fileTmp, $fileDestination)) {
                    $uploaded[$fileName] = $fileDestination;
                } else {
                    $failed[$fileName] = "[{$fileName}] failed to upload.";
                }
            }
        }

    public function setMain(int $id): void
    {
        $articleManager = new ArticleManager();
        $articleManager->setMainArticle($id);

        header('Location: /admin/articles');
        exit();
    }
}

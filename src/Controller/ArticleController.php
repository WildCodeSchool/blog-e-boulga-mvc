<?php

namespace App\Controller;

use App\Model\ArticleManager;
use App\Model\AuthorManager;
use App\Model\CategoryManager;
use App\Interface\UploadFile;
use Exception;

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
            $articleStatus = $this->checkStatus($_GET['status']);
            $errorMsg = 'Aucun article ne correspond à votre recherche';
            $articles =
                $articleStatus != 'error' ?
                    $articleManager->selectByConditions('status', $articleStatus) :
                    ['error' => $errorMsg];
        } else {
            $articles = $articleManager->selectAll();
        }

        return $this->twig->render('Admin/Article/index.html.twig', [
            'articles' => $articles,
            'mainArticleId' => $mainArticleId->getIdArticle(),
            'status' => $_GET['status'] ?? null,
            'page' => 'articles',
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

        if ($article->getStatus() != '2' && !$this->user) {
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

    public function add(): string
    {
        $author = new AuthorManager();
        $authors = $author->getAll();

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->getAllCategory();

        if ($_POST) {
            $errors = [];
            $this->checkArticleForm($_POST, $errors);
            $this->checkUploadFile($_FILES, $errors);

            if (empty($errors)) {
                $newArticle = $_POST;
                $imageArticle = $this->uploadFile($errors);
                if (empty($errors)) {
                    $newArticle['imgSrc'] = $imageArticle;
                    (new ArticleManager())->createArticle($newArticle);
                    header('Location: /admin/articles');
                    exit();
                }
            }
        }
        return $this->twig->render('Admin/Article/add.html.twig', [
            'errors' => $errors ?? null,
            'authors' => $authors,
            'categories' => $categories,
        ]);
    }

    private function checkArticleForm(array $form, array &$errors): void
    {
        foreach ($form as $key => $item) {
            if (empty($item)) {
                $errors[] = "Le champ " . $key . " n'est pas rensigné";
            }
        }
    }

    private function checkUploadFile(array $file, array &$errors): void
    {
        if (empty($file['imageUpload']['name'])) {
            $errors[] = 'No file found';
        }
    }

    public function uploadFile(array &$errors): string
    {

        $image = $_FILES['imageUpload'];

        $fileTmp = $image['tmp_name'];
        $fileName = $image['name'];

        $uploadDir = 'assets/images/articles/';
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        var_dump($extension);
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
                return $uploaded[$fileName] = $fileDestination;
            } else {
                return $failed[$fileName] = "[{$fileName}] failed to upload.";
            }
        }
        return 'an error occured';
    }

    public function setMain(int $id, string $filter = null): void
    {
        $articleManager = new ArticleManager();
        $articleManager->setMainArticle($id);

        if ($filter === null) {
            header('Location: /admin/articles');
            exit();
        }

        $filter = match ($filter) {
            '3' => 'archived',
            '2' => 'published',
            '1' => 'draft',
            default => null,
        };

        header('Location: /admin/articles?status=' . $filter);
        exit();
    }

    private function checkStatus(string $get)
    {
        return match ($get) {
            'archived' => '3',
            'published' => '2',
            'draft' => '1',
            default => 'error',
        };
    }

    public function edit(int $id): ?string
    {
        $articleManager = new ArticleManager();
        $articleUpdate = $articleManager->getArticle($id);

        $author = new AuthorManager();
        $authors = $author->getAll();

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->getAllCategory();
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $articleUpdate = array_map('trim', $_POST);
            $this->checkArticleForm($articleUpdate, $errors);

            if (empty($errors) && $_FILES['imageUpload']['error'] === 0) {
                //$this->checkUploadFile($_FILES, $errors);
                $newImageArticle = $this->uploadFile($errors);
                if (empty($errors)) {
                    $articleUpdate['imgSrc'] = $newImageArticle;
                }
            }
            //Update the article
            if (empty($errors)) {
                $articleManager->update($articleUpdate, $id);

                header('Location: edit?id=' . $id);
                exit();
            }
        }

        // Generate the web page
        return $this->twig->render('Admin/Article/edit.html.twig', [
            'errors' => $errors,
            'articleUpdate' => $articleUpdate,
            'authors' => $authors,
            'categories' => $categories,
        ]);
    }
}

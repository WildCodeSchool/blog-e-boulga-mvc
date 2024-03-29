<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'items' => ['ItemController', 'index',],
    'contact_us' => ['ContactController', 'showForm'],
    'contact_sent' => ['ContactController', 'confirmationSending'],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'article' => ['ArticleController', 'show', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'about_us' => ['AuthorController','index'],
    'admin/article/add' => ['ArticleController', 'add'],
    'admin/login' => ['AdminUserController', 'login'],
    'admin/logout' => ['AdminUserController', 'logout'],
    'admin/articles' => ['ArticleController', 'index'],
    'admin/categories' => ['CategoriesController', 'index'],
    'admin/categories/delete' => ['CategoriesController', 'delete'],
    'admin/article/main' => ['ArticleController', 'setMain', ['id', 'filter']],
    'admin/article/edit' => ['ArticleController', 'edit', ['id']],
];

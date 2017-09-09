<?php

$app->get('/articles/create', function () use ($app) {
    $app->render('articles/create.html.twig');
})->name('articles.create');
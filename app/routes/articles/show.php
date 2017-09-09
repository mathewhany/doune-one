<?php

$app->get('/articles/:id', function ($id) use ($app) {

    $query = $app->db->prepare('SELECT * FROM articles WHERE id = ?');

    $query->execute([$id]);

    if (!$article = $query->fetch()) {
        $app->notFound();
    }

    $app->render('articles/show.html.twig', compact('article'));

})->name('articles.show');
<?php

$app->get('/articles/:id/edit', function ($id) use ($app) {

    $query = $app->db->prepare('SELECT * FROM articles WHERE id = ?');

    $query->execute([$id]);

    if (!$article = $query->fetch()) {
        $app->notFound();
    }

    $app->render('articles/edit.html.twig', compact('article'));
    
})->name('articles.edit');

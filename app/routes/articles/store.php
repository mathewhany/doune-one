<?php

$app->post('/articles', function () use ($app) {

    $query = $app->db->prepare('INSERT INTO articles VALUES (null, ?, ?)');

    $title = $app->request->post('title');
    $content = $app->request->post('content');
 
    validateArticle($title, $content, function () use ($app) {
        $app->redirect($app->urlFor('articles.create'));
    });

    $query->execute([$title, $content]);

    $id = $app->db->lastInsertId();
    
    $app->redirect($app->urlFor('articles.show', compact('id')));

})->name('articles.store');
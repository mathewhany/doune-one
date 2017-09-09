<?php

$app->put('/articles/:id', function ($id) use ($app) {

    $query = $app->db->prepare(
        'UPDATE articles SET title = ?, content = ? WHERE id = ?'
    );

    $title = $app->request->put('title');
    $content = $app->request->put('content');

    validateArticle($title, $content, function () use ($app, $id) {
        $app->redirect($app->urlFor('articles.edit', compact('id')));
    });

    $query->execute([$title, $content, $id]);

    $app->redirect($app->urlFor('articles.show', compact('id')));

})->name('articles.update');
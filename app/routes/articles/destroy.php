<?php

$app->delete('/articles/:id', function ($id) use ($app) {

    $query = $app->db->prepare('DELETE FROM articles WHERE id = ?');

    $query->execute([$id]);

    $app->redirect($app->urlFor('home'));

})->name('articles.destroy');
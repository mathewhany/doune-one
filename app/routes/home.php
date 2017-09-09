<?php

$app->get('/', function () use ($app) {

    $articles = $app->db->query('SELECT * FROM articles')->fetchAll();
    
    $app->render('home.html.twig', compact('articles'));
    
})->name('home');
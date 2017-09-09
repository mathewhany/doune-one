<?php

function validateArticle($title, $content, callable $fail)
{
    global $app;

    if (empty($title) || empty($content)) {
        $message = 'Please enter all fields.';
    } elseif (mb_strlen($title, 'utf-8') > 255) {
        $message = 'The title can\'t contain 256 characters or >.';
    }
    
    if (isset($message)) {     
       
        $app->flash('error', $message);

        return $fail();
    }
}
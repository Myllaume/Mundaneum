<?php

if (isset($_GET) && !empty($_GET['view'])) {
    $view = $_GET['view'];
} else {
    $view = 'home';
}

switch ($view) {
    case 'home':
        include_once './core/views/home.html';
        break;
    
    case 'article':
        if (empty($_GET['title'])) {
            exit;
        }

        include_once './core/models/page.php';
        $class_page = new Page;
        $class_page->set_path('./data/' . $_GET['title'] . '/');
        $class_page->gen_body();
        break;
}
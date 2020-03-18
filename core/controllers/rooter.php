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
    
    case 'publications':
        include_once './core/models/page.php';

        if (empty($_GET['title'])) {
            $class_page = new Page;
            $class_page->set_title('Liste des publications');
            $class_page->gen_page($main = 'publications.php', $lateral = false);

            exit;
        }

        $class_page = new Page;
        $class_page->set_path('./data/' . $_GET['title'] . '/');
        $class_page->set_title('Article ' . $_GET['title']);
        $class_page->gen_page();
        break;
}
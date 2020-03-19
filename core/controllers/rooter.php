<?php
ini_set('display_errors','on');
error_reporting(E_ALL);

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    define('CORE_ROOT', '..');
    define('ROOT', '../../');
} else {
    define('CORE_ROOT', './core');
    define('ROOT', './');
}

if (isset($_GET) && !empty($_GET['view'])) {
    $view = $_GET['view'];
} else {
    $view = 'home';
}

switch ($view) {
    case 'home':
        // include_once './core/views/home.html';
        break;
    
    case 'publications':
        
        include_once CORE_ROOT . '/models/page.php';

        if (empty($_GET['title'])) {
            $class_page = new Page;
            $class_page->set_title('Liste des publications');
            $class_page->gen_body($main = 'publications.php', $lateral = false);

            exit;
        }

        $class_page = new Page;
        $class_page->set_path( ROOT . '/data/' . $_GET['title'] . '/');
        $class_page->set_title('Article ' . $_GET['title']);
        $class_page->gen_body();
        break;
}
<?php
ini_set('display_errors','on');
error_reporting(E_ALL);

/**
 * Définition des constantes de chemins de fichier
 * - depuis rooter.php si les requêtes sont en XHR
 * - depuis l'index dans les autres cas
 */

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    $in_XHR_req = true;
    define('CORE_ROOT', '..'); // vers le repetoire 'core'
    define('ROOT', '../../'); // vers la racine
} else {

    $in_XHR_req = false;
    define('CORE_ROOT', './core');
    define('ROOT', './');
}

include_once CORE_ROOT . '/models/page.php';

$redirect = false;
$html = '';
$title = 'Page sans titre';

if (isset($_GET) && !empty($_GET['view'])) {
    $view = $_GET['view'];
} else {
    $view = 'home';
}

switch ($view) {
    case 'home':
        
        $class_page = new Page;
        $class_page->set_title('Mundaneum - Accueil');
        $title = $class_page->get_title();
        $class_page->set_main_content(false);
        $class_page->set_lateral_content(false);
        $class_page->set_menu_is_close(false);
        if ($in_XHR_req) {
            $html = $class_page->gen_content();
        } else {
            echo $class_page->gen_page();
            exit;
        }
                
        break;

    case 'publications':

        if (empty($_GET['title'])) {
            $class_page = new Page;
            $class_page->set_title('Liste des publications');
            $title = $class_page->get_title();
            $class_page->set_main_content('publications.php');
            $class_page->set_lateral_content(false);
            if ($in_XHR_req) {
                $html = $class_page->gen_content();
            } else {
                echo $class_page->gen_page();
                exit;
            }
        } else {
            try {
                $class_page = new Page;
                $class_page->set_path( ROOT . '/data/' . $_GET['title'] . '/');
                $class_page->set_title($_GET['title']);
                $title = $class_page->get_title();
                if ($in_XHR_req) {
                    $html = $class_page->gen_content();
                } else {
                    echo $class_page->gen_page();
                    exit;
                }
                
            } catch (Exception $error) {
                header('Location: /Mundaneum/publications');
                $class_page = new Page;
                $class_page->set_title('Liste des publications');
                $title = $class_page->get_title();
                $class_page->set_main_content('publications.php');
                $class_page->set_lateral_content(false);
                if ($in_XHR_req) {
                    $html = $class_page->gen_content();
                } else {
                    echo $class_page->gen_page();
                    exit;
                }
            }
        }
                
        break;

    default:
        header('Location: /Mundaneum/');
        go_home($in_XHR_req);
        break;
}

echo json_encode(array('redirect' => $redirect, 'title' => $title, 'html' => $html));
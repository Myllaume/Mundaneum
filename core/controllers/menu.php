<?php

if (!isset($_GET) || empty($_GET['type'])) {
    exit;
}

$content_repo = false;

switch ($_GET['type']) {
    case 'publications':
        $content_repo = scandir('../../data/articles/');
        break;

    case 'donnees':
        $content_repo = scandir('../../data/donnes/');
        break;
}

if ($content_repo) {
    // liste des fichiers à exclure :
    $hidden_items = array('.', '..', '.htaccess', '.DS_Store');
    // séparation des fichiers et exclus
    $list_article = array_diff($content_repo, $hidden_items);

    $html .= '<ul class="navigation-list">';

    foreach ($list_article as $key => $value) {
        $html .= '<li><a href="' . $_GET['type'] . '/' . $value . '">'. $value . '</a></li>';
    }

    $html .= '</ul>';
}

echo $html;
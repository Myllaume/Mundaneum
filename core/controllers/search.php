<?php

if (!isset($_GET) || empty($_GET['type']) || empty($_GET['search'])) {
    exit;
}

$html = '';
// $html = 'Aucun résultat.';

switch ($_GET['type']) {
    case 'publications':
        $repo_patch = '../../data/articles/';
        break;
    
    case 'donnees':
        $repo_patch = '../../data/donnees/';
        break;
}

$content_repo = scandir($repo_patch);
// liste des fichiers à exclure :
$hidden_items = array('.', '..', '.htaccess', '.DS_Store');
// séparation des fichiers et exclus
$meta_files = array_diff($content_repo, $hidden_items);

$JSONs_content = [];
$JSONs_tags = [];

foreach ($meta_files as $nb => $file) {
    $json_file_content = file_get_contents($repo_patch . '/' . $file . '/metadata.json');
    $json_file_content = json_decode($json_file_content, true);
    array_push($JSONs_content, $json_file_content);

    foreach ($json_file_content as $meta => $valeur) {
        if ($meta == 'keywords') {
            $keywords_array = explode(', ', $valeur);
            array_push($JSONs_tags, $keywords_array);
        }
    }

}

$i = 0;
$valid_JSONs = [];

foreach ($JSONs_tags as $key => $value) {
    if (in_array($_GET['search'], $value)) {
        array_push($valid_JSONs, $i);
    }
    $i++;
}

$html .= '<ul class="search-list">';

foreach ($valid_JSONs as $key) {
    $html .= '
    <li>
        <a href="' . $_GET['type'] . '/' . $JSONs_content[$key]['id'] . '">
            '. $JSONs_content[$key]['titre'] .'
        </a>
    </li>';
}

$html .= '</ul>';

echo $html;
<?php

if (!isset($_GET) || empty($_GET['type']) || empty($_GET['title'])) {
    exit;
}

$content_repo = false;

switch ($_GET['type']) {
    case 'publications':
        $file_path = '../../data/articles/' . $_GET['title'] . '/metadata.json';
        break;
    
    case 'donnees':
        $file_path = '../../data/donnees/' . $_GET['title'] . '/metadata.json';
        break;
}

$json_file_content = file_get_contents($file_path);
$json_file_content = json_decode($json_file_content, true);


$html = '
<h3>Métadonnées</h3>
<table>
    <tbody>';

foreach ($json_file_content as $meta => $value) {
$html .= '
        <tr>
            <td>' . $meta . '</td>
            <td>' . $value . '</td>
        <tr>';
}

$html .= '
    </tbody>
<table>';

echo $html;
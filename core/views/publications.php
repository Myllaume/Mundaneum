<?php
$content_repo = scandir(ROOT . '/data/');
// liste des fichiers à exclure :
$hidden_items = array('.', '..', '.htaccess', '.DS_Store');
// séparation des fichiers et exclus
$list_article = array_diff($content_repo, $hidden_items);

$html .= '
<h1>Liste des publications</h1>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Catégorie</th>
            <th>Tags</th>
        </tr>
    </thead>

    <tbody>';
    
    foreach ($list_article as $key => $name_article) {
        $name_article_clean = str_replace('-', ' ', $name_article);
        $name_article_clean = ucfirst($name_article_clean);

        
        $html .= '
        <tr>
            <td><a href="./publications/' .$name_article . '">' .$name_article_clean . '</a></td>
            <td>Divers</td>
            <td>Essaie, début, départ</td>
        </tr>';
    }

    $html .= '
    </tbody>

</table>';
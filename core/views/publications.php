<?php
$content_repo = scandir('./data/');
// liste des fichiers à exclure :
$hidden_items = array('.', '..', '.DS_Store');
// séparation des fichiers et exclus
$list_article = array_diff($content_repo, $hidden_items);
?>

<ul>
    <?php foreach ($list_article as $key => $name_article): ?>
    <a href="?view=article&title=<?= $name_article ?>"><li><?= $name_article ?></li></a>
    <?php endforeach; ?>
</ul>
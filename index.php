<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mundanuem - Web de connaissane</title>

    <link rel="stylesheet" href="./assets/main.css">
</head>

<body>

    <?php
    include_once './core/models/page.php';
    $class_page = new Page;
    $class_page->set_path('./data/essaie/');
    $class_page->gen_body();
    ?>

</body>

</html>
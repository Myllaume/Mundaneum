<?php

class Page {
    private $id;
    private $path;
    private $title;
    private $categorie;
    private $langage;

    function __construct() {
        $this->id = strval($this->id);
        $this->path = strval($this->path);
        $this->title = strval($this->title);
        $this->categorie = strval($this->categorie);
        $this->langage = 'fr';
    }

    /**
     * ======================================================
     * Ascensseurs
     * ======================================================
     */

    function set_id($var) {
        if (!is_string($var)) {
            throw new Exception("L'identifiant de la page doit être une chaine de caractère");
        }
        
        $this->id = $var;
    }

    function get_id() {
        return $this->id;
    }

    function set_path($var) {
        if (!is_string($var)) {
            throw new Exception("Le chemin de fichier de la page doit être une chaine de caractère");
        }
        
        $this->path = $var;
    }

    function get_path() {
        return $this->path;
    }

    function set_title($var) {
        if (!is_string($var)) {
            throw new Exception("Le titre de la page doit être une chaine de caractère");
        }

        if (strlen($var) > 50) {
            throw new Exception("Le titre de la page ne doit pas excéder 50 caractères");
        }
        
        $this->title = $var;
    }

    function get_title() {
        return $this->title;
    }

    function set_categorie($var) {
        $list_categories = ['bibliotéconomie', 'sans catégorie'];

        if (!in_array($var, $list_categories, true)) {
            throw new Exception("Cette catégorie de page n'est pas reconnue");
        }
        
        $this->categorie = $var;
    }

    function get_categorie() {
        return $this->categorie;
    }

    function set_langage($var) {
        $list_categories = ['fr', 'en'];

        if (in_array($var, $list_categories, true)) {
            throw new Exception("Cette langue n'est pas reconnue");
        }
        
        $this->langage = $var;
    }

    function get_langage() {
        return $this->langage;
    }

    /**
     * ======================================================
     * Générateurs
     * ======================================================
     */

    function gen_head() {
        echo '
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>' . $this->title . '</title>

            <link rel="stylesheet" href="/Mundaneum/libs/bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="/Mundaneum/assets/main.css">
        </head>';
    }

    function gen_header() {
        include_once './core/views/header.php';
    }

    function gen_main($type) {
        echo '<section class="content-page">';

        if ($type === true) {
            echo $this->markdown_file_to_HTML('main');
        } else {
            include_once './core/views/' . $type;
        }
        
        echo '</section>';
    }

    function gen_lateral($type) {
        echo '<section class="lateral-page">';

        echo $this->markdown_file_to_HTML('lateral');
        
        echo '</section>';
    }

    function gen_page($main = true, $lateral = true) {
        echo '
        <!DOCTYPE html>
        <html lang="fr">';

        $this->gen_head();

        echo '
        <body>

        <div class="bg-page"></div>
        <div class="wrapper-general">';

            $this->gen_header();

        echo '
            <div class="wrapper-content">

                <main class="main-page">
                    <div class="main-page__bg"></div>';

                    if ($main) {
                        $this->gen_main($main);
                    }
                    if ($lateral) {
                        $this->gen_lateral($lateral);
                    }

        echo '
                </main>

            </div>
        </div>';

        include_once './core/views/modals.php';

        echo '
        <script src="/Mundaneum/libs/jquery.min.js"></script>
        <script src="/Mundaneum/libs/bootstrap/js/bootstrap.min.js"></script>
        <script src="/Mundaneum/assets/main.js"></script>

        <body>

        </html>';
    }

    function gen_metadata_board() {
        $metadata_list = $this->JSON_file_to_Page();

        echo '
        <table>
            <tbody>';
        foreach ($metadata_list as $metadata => $value) {
            echo '
                <tr>
                    <td>' . $metadata . '<td>
                    <td>' . $value . '<td>
                </tr>';
        }
        echo '
            </tbody>
        </table>';
    }

    /**
     * ======================================================
     * Conversions
     * ======================================================
     */

    function markdown_file_to_HTML($file_type) {
        $file_path = $this->path . $file_type . '.md';
        $markdown_file_content = file_get_contents($file_path);

        if (!$markdown_file_content) {
            throw new Exception("Aucun fichier Markdown trouvé");
        }
    
        include_once './libs/parsedown/Parsedown.php';
        $parsedown_class = new Parsedown();
        return $parsedown_class->text($markdown_file_content);
    }

    function JSON_file_to_Page() {
        $file_path = $this->path . 'metadata.json';
        $json_file_content = file_get_contents($file_path);
    
        if (!$json_file_content) {
            throw new Exception("Aucun fichier JSON trouvé");
        }
    
        $json_file_content = json_decode($json_file_content, true);
        return $json_file_content;
    }
}
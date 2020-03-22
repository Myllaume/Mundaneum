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
        $this->main_content = true;
        $this->lateral_content = true;
        $this->menu_is_close = true;
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

    function set_main_content($var) {

        if (!is_string($var) && !is_bool($var)) {
            throw new Exception("Le main content doit être définis avec chaine de caractère ou un booléen");
        }

        $this->main_content = $var;
    }

    function get_main_content() {
        return $this->main_content;
    }

    function set_lateral_content($var) {
        if (!is_string($var) && !is_bool($var)) {
            throw new Exception("Le lateral content doit être définis avec chaine de caractère ou un booléen");
        }

        $this->lateral_content = $var;
    }

    function get_lateral_content() {
        return $this->lateral_content;
    }

    function set_menu_is_close($var) {
        if (!is_bool($var)) {
            throw new Exception("La fermeture de menu doit être indiquée avec un booléen");
        }

        $this->menu_is_close = $var;
    }

    function get_menu_is_close() {
        return $this->menu_is_close;
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

            <link rel="stylesheet" href="/Mundaneum/assets/main.css">
        </head>';
    }

    function gen_header() {
        include_once  CORE_ROOT . '/views/header.php';
    }

    function gen_menu() {
        if ($this->menu_is_close) {
        echo '
        <div class="home-content home-content--hide">';
    } else {
        echo '
        <div class="home-content">';
        }

        echo '
            <div class="home-bg"></div>
            <div class="home-roll"></div>
        </div>';
    }

    function gen_content() {
        $this->gen_main();

        $this->gen_lateral();
    }

    function gen_main() {
        echo '<section class="content-page">';

        if ($this->main_content === true) {
            echo $this->markdown_file_to_HTML('main');
        } elseif ($this->main_content !== false) {
            include_once CORE_ROOT . '/views/' . $this->main_content;
        }
        
        echo '</section>';
    }

    function gen_lateral() {
        echo '<section class="lateral-page">';

        if ($this->lateral_content === true) {
            echo $this->markdown_file_to_HTML('lateral');
        }
        
        echo '</section>';
    }

    function gen_page() {
        echo '
        <!DOCTYPE html>
        <html lang="fr">';

        $this->gen_head();

        echo '
        <body>';

        $this->gen_menu();
        
        echo '
            <div class="bg-page"></div>
            <div class="wrapper-general">';

        $this->gen_header();

        echo '
                <div class="wrapper-content">

                    <main class="main-page">

                        <div class="main-page__bg"></div>

                        <div id="cible" class="main-page__conteneur">';

        $this->gen_content();

        echo '
                        </div>
                    </main>

                </div>
            </div>';

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
    
        include_once ROOT . '/libs/parsedown/Parsedown.php';
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
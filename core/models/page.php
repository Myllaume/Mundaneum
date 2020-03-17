<?php

class Page {
    private $id;
    private $path;
    private $title;

    function __construct() {
        $this->id = strval($this->id);
        $this->path = strval($this->path);
        $this->title = strval($this->title);
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

    function get_pseudo() {
        return $this->title;
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

            <link rel="stylesheet" href="./assets/main.css">
        </head>
        ';
    }

    function gen_header() {
        include_once './core/views/header.php';
    }

    function gen_main() {
        echo '<section class="content-page">';

        echo $this->markdown_file_to_HTML('main');
        
        echo '</section>';
    }

    function gen_lateral() {
        echo '<section class="lateral-page">';

        echo $this->markdown_file_to_HTML('lateral');
        
        echo '</section>';
    }

    function gen_body() {
        echo '
        <div class="bg-page"></div>
        <div class="wrapper-general">';

            $this->gen_header();

        echo '
            <div class="wrapper-content">
            
                <main class="main-page">
                    <div class="main-page__bg"></div>';

                    $this->gen_main();
                    $this->gen_lateral();

        echo '
                </main>

            </div>
        </div>

        <script src="./assets/main.js"></script>';
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
    
        $json_file_content = json_decode($json_file, true);
        return $json_file_content;
    }
}
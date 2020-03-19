<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mundanuem - Web de connaissance</title>

    <link rel="stylesheet" href="/Mundaneum/assets/main.css">
</head>

<body>

    <div class="home-content <?php if (isset($_GET) && !empty($_GET['view'])) {echo 'home-content--hide';} ?> ">
        <div class="home-bg"></div>
        <div class="home-roll"></div>
    </div>

    <div class="bg-page"></div>

    <div class="wrapper-general">

        <header class="header-page">

            <div class="header-page__bg"></div>

            <div class="wrapper-content flex-center">
                
                <div class="header-page__btn-box">
                    <button class="header-page__btn header-page__btn--menu">Menu</button>
                </div>
                <div id="back-to-menu" class="logo-site">
                    <div class="logo-site__armillaire"></div>
                </div>
                <div class="header-page__btn-box">
                    <button class="header-page__btn header-page__btn--search">Rechercher</button>
                    <button class="header-page__btn header-page__btn--metadata">Métadonnées</button>
                </div>

            </div>

        </header>

        <div class="wrapper-content">

            <main class="main-page">

                <div class="main-page__bg"></div>

                <div id="cible" class="main-page__conteneur">
                    <?php include_once './core/controllers/rooter.php'; ?>
                </div>

            </main>

        </div>
    </div>

    <script src="/Mundaneum/libs/jquery.min.js"></script>
    <script src="/Mundaneum/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="/Mundaneum/assets/main.js"></script>

</body>

</html>
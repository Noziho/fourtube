<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FourTube - Le YouTube des Ksos</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<header>
    <div id="bar_tittle">
        <i class="fa-solid fa-bars"></i>
        <h1><a href="/?c=home">FourTube</a></h1>
    </div>

    <div id="search_container">
        <input id="search" type="search" placeholder="Rechercher">
        <div id="glass_container">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </div>

    <div id="login_register_button">
        <?php
            if (!isset($_SESSION['user'])) {?>
                <a href="/?c=user&a=register"><button>Inscription</button></a>
                <a href="/?c=user&a=login"><button>Connexion</button></a><?php
            }else {?>
                <a href="/?c=video"><button id="video_button"><i class="fa-solid fa-video"></i></button></a>
                <a href="/?c=user&a=log-out"><button>Déconnexion</button></a><?php
            }
        ?>

    </div>
</header>

<div><?= $html ?></div>


<script src="/assets/js/app.js"></script>
<script src="https://kit.fontawesome.com/e40f017040.js" crossorigin="anonymous"></script>
</body>
</html>

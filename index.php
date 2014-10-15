<html>
<head>
    <title>Ishetkutweer?</title>
    <link rel="icon" href="/include/images/favicon.ico" type="image/x-icon">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="include/css/style.css">
    <script src="include/js/script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php /* Open graph */ ?>
    <meta property="og:site_name" content="Is het kut weer?"/>
    <meta property="og:title" content="Ishetkutweer.nl"/>
    <meta property="og:image" content="http://www.ishetkutweer.nl/include/images/logo_wide.png"/>
    <meta property="og:image" content="http://www.ishetkutweer.nl/include/images/logo_square.png"/>
    <meta property="og:url" content="http://www.ishetkutweer.nl"/>

</head>

<body>
<header>Header</header>
<div class="content">

    <?php
    require_once('include/php/Controller.php');
    $dataImport = new Controller();

    ?>
</div>
<footer>
    <div class="madeby small">Gemaakt door Peter Ton</div><div class="source small">Gegevens afkomstig van <a target="_blank" href="http://www.buienradar.nl">Buienradar.nl</a></div>
</footer>
</body>
</html>
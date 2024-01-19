<?php
    $pageUrl = explode("/", $_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Hardware</title>
    <base href="/materiel-info/">
    <link rel="icon" href="assets/img/favicon.png">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=EB+Garamond' rel="stylesheet">
    <script>
        function afficherHeure(){
            let date = new Date();
            let h = date.getHours(); // 0 - 23
            let m = date.getMinutes(); // 0 - 59
            let s = date.getSeconds(); // 0 - 59
            
            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;
            
            let time = h + ":" + m + ":" + s;
            document.getElementById("heure").innerText = time;
        }
        
        window.onload = function() {
            afficherHeure();
            setInterval(afficherHeure, 1000);
        }
    </script>
  </head>
  <body>
	<div id="headerwrap">
		<div class="container">
            <div id="heure"></div>
			<nav class="navbar navbar-expand-lg mb-2">
				<div class="container-fluid">
				    <div class="navbar-brand logo">
                        <a href="">
                            <img src="assets/img/logo.png" height="100px" width="270px">
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
				    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                            <li class="nav-item">
                                <a class="nav-link <?= empty($pageUrl[2]) || $pageUrl[2] == 'index.php' ? 'active' : ''; ?>" aria-current="page" href="">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $pageUrl[2] == 'importer-donnees' ? 'active' : ''; ?>" href="importer-donnees">Importer les données</a>
                            </li>
                        </ul>
                    </div>
				</div>
            </nav>
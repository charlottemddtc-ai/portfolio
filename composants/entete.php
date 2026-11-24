<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titre_complet) ?></title>
    <meta name="description" content="Charlotte — étudiante en software engineering, frontend developer et designer.">
    <meta name="theme-color" content="#08090c">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wdth,wght@62..125,300..900&family=Martian+Mono:wght@400;700&display=swap">
    <link rel="stylesheet" href="assets/css/site.css">
    <script>
        // Applique l'inversion choisie avant l'affichage (pas de flash).
        try { if (localStorage.getItem('inverse') === '1') document.documentElement.classList.add('inverse'); } catch (e) {}
        document.documentElement.classList.add('js');
    </script>
    <script src="assets/js/site.js" defer></script>
</head>
<body class="page-<?= htmlspecialchars($page) ?>">
<a class="evitement" href="#contenu">Aller au contenu</a>
<?php require __DIR__ . '/navigation.php'; ?>
<main id="contenu">

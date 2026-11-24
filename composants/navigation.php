<?php
$page_courante = basename($_SERVER['PHP_SELF']);
$liens = [
    'index.php'    => 'Accueil',
    'about.php'    => 'À propos',
    'projects.php' => 'Projets',
    'contact.php'  => 'Contact',
];
?>
<header class="nav" data-nav>
    <a class="nav__logo" href="index.php" aria-label="Charlotte — accueil">Charlotte<span>.</span></a>

    <nav class="nav__liens" aria-label="Navigation principale">
        <?php foreach ($liens as $fichier => $libelle): ?>
            <a href="<?= $fichier ?>"<?= $page_courante === $fichier ? ' class="actif" aria-current="page"' : '' ?>><?= $libelle ?></a>
        <?php endforeach; ?>
    </nav>

    <button class="nav__inverse" type="button" data-inverse aria-pressed="false" title="Inverser noir et blanc">
        <span class="nav__inverse-pastille" aria-hidden="true"></span><span class="nav__inverse-texte">Inverser</span>
    </button>

    <button class="nav__menu" type="button" data-menu aria-expanded="false" aria-controls="menu-plein">Menu</button>
</header>

<div class="menu-plein" id="menu-plein" data-menu-panneau hidden>
    <nav aria-label="Navigation mobile">
        <?php foreach ($liens as $fichier => $libelle): ?>
            <a href="<?= $fichier ?>"<?= $page_courante === $fichier ? ' class="actif" aria-current="page"' : '' ?>><?= $libelle ?></a>
        <?php endforeach; ?>
    </nav>
    <p class="etiquette">charlottemddtc@gmail.com</p>
</div>

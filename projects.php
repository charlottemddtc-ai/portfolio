<?php
require 'fonctions.php';

$projets = projets();

// Recherche
$mot_cle = trim($_GET['q'] ?? '');
$affiches = $projets;
if ($mot_cle !== '') {
    $affiches = array_filter($projets, function ($p) use ($mot_cle) {
        return stripos($p['titre'], $mot_cle) !== false
            || stripos($p['description'], $mot_cle) !== false
            || stripos(implode(' ', $p['technologies']), $mot_cle) !== false;
    });
}

// Demande de projet
$types = ['website' => 'Website', 'mobile app' => 'Mobile App', 'Backend API' => 'Backend API'];
$erreurs = [];
$succes = false;
$demande = ['nom' => '', 'email' => '', 'titre_projet' => '', 'description' => '', 'type_de_projet' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($demande as $cle => $v) {
        $demande[$cle] = nettoyer($_POST[$cle] ?? '');
    }
    if (!champ_requis($demande['nom']))          $erreurs['nom'] = 'Nom obligatoire';
    if (!filter_var($demande['email'], FILTER_VALIDATE_EMAIL)) $erreurs['email'] = 'E-mail invalide';
    if (!champ_requis($demande['titre_projet'])) $erreurs['titre_projet'] = 'Titre obligatoire';
    if (!champ_requis($demande['description']))  $erreurs['description'] = 'Description obligatoire';
    if (!array_key_exists(htmlspecialchars_decode($demande['type_de_projet']), $types)) $erreurs['type_de_projet'] = 'Type obligatoire';
    $succes = empty($erreurs);
}

debut_page('Projets', 'projets');
?>

<section class="tete-page">
    <p class="etiquette etiquette--menthe entree" style="--d:.1s">Travaux</p>
    <h1 class="titre-affiche">
        <span class="ligne"><span class="entree" style="--d:.2s">Tous les</span></span>
        <span class="ligne"><span class="entree" style="--d:.32s">projets<sup><?= count($projets) ?></sup></span></span>
    </h1>

    <form class="recherche entree" style="--d:.5s" action="projects.php" method="get" role="search">
        <label class="etiquette" for="q">Rechercher</label>
        <div class="recherche__champ">
            <input type="search" id="q" name="q" placeholder="React, agriculteurs, SQL…" value="<?= htmlspecialchars($mot_cle) ?>">
            <button type="submit" class="btn btn--cobalt">Chercher</button>
        </div>
    </form>
</section>

<section class="plans" id="resultats">
    <?php if ($mot_cle !== ''): ?>
        <p class="plans__resultat etiquette">
            <?= count($affiches) ?> résultat<?= count($affiches) > 1 ? 's' : '' ?> pour « <?= htmlspecialchars($mot_cle) ?> »
            — <a href="projects.php">tout afficher</a>
        </p>
    <?php endif; ?>

    <?php if (!$affiches): ?>
        <p class="plans__vide">Rien ici. Essaie « React » ou « SQL ».</p>
    <?php endif; ?>

    <?php foreach ($affiches as $p): ?>
        <article class="projet projet--<?= $p['couleur'] ?>" data-revele>
            <div class="projet__image">
                <img src="<?= image($p['image']) ?>" alt="Aperçu : <?= htmlspecialchars($p['titre']) ?>" loading="lazy">
            </div>
            <div class="projet__texte">
                <ul class="puces">
                    <?php foreach ($p['technologies'] as $t): ?><li><?= htmlspecialchars($t) ?></li><?php endforeach; ?>
                </ul>
                <h2><?= htmlspecialchars($p['titre']) ?></h2>
                <p><?= htmlspecialchars($p['description']) ?></p>
                <div class="plan__boutons"><?= boutons_projet($p) ?></div>
            </div>
        </article>
    <?php endforeach; ?>
</section>

<section class="demande section-claire" id="demande">
    <div class="demande__tete">
        <p class="etiquette">Demande de projet</p>
        <h2 class="titre-geant" data-revele>Tu as une idée&nbsp;?</h2>
        <p class="demande__sous">Décris ton projet : fonctionnalités, budget, durée…</p>
    </div>

    <?php if ($succes): ?>
        <div class="recu" role="status">
            <p class="recu__titre">Demande envoyée.</p>
            <dl>
                <dt>Nom</dt><dd><?= $demande['nom'] ?></dd>
                <dt>E-mail</dt><dd><?= $demande['email'] ?></dd>
                <dt>Titre</dt><dd><?= $demande['titre_projet'] ?></dd>
                <dt>Description</dt><dd><?= nl2br($demande['description']) ?></dd>
                <dt>Type</dt><dd><?= $demande['type_de_projet'] ?></dd>
            </dl>
        </div>
    <?php else: ?>
        <form class="formulaire" action="projects.php#demande" method="post" novalidate>
            <div class="champ<?= isset($erreurs['nom']) ? ' champ--erreur' : '' ?>">
                <label for="d-nom">Nom</label>
                <input type="text" id="d-nom" name="nom" value="<?= $demande['nom'] ?>" autocomplete="name">
                <p class="champ__erreur"><?= $erreurs['nom'] ?? '' ?></p>
            </div>
            <div class="champ<?= isset($erreurs['email']) ? ' champ--erreur' : '' ?>">
                <label for="d-email">E-mail</label>
                <input type="email" id="d-email" name="email" value="<?= $demande['email'] ?>" autocomplete="email">
                <p class="champ__erreur"><?= $erreurs['email'] ?? '' ?></p>
            </div>
            <div class="champ champ--large<?= isset($erreurs['titre_projet']) ? ' champ--erreur' : '' ?>">
                <label for="d-titre">Titre du projet</label>
                <input type="text" id="d-titre" name="titre_projet" value="<?= $demande['titre_projet'] ?>">
                <p class="champ__erreur"><?= $erreurs['titre_projet'] ?? '' ?></p>
            </div>
            <div class="champ champ--large<?= isset($erreurs['description']) ? ' champ--erreur' : '' ?>">
                <label for="d-desc">Description</label>
                <textarea id="d-desc" name="description" rows="5" placeholder="Fonctionnalités, budget, durée…"><?= $demande['description'] ?></textarea>
                <p class="champ__erreur"><?= $erreurs['description'] ?? '' ?></p>
            </div>
            <fieldset class="champ champ--large choix<?= isset($erreurs['type_de_projet']) ? ' champ--erreur' : '' ?>">
                <legend>Type de projet</legend>
                <div class="choix__options">
                    <?php foreach ($types as $valeur => $libelle): ?>
                        <label class="choix__option">
                            <input type="radio" name="type_de_projet" value="<?= htmlspecialchars($valeur) ?>"<?= htmlspecialchars_decode($demande['type_de_projet']) === $valeur ? ' checked' : '' ?>>
                            <span><?= $libelle ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <p class="champ__erreur"><?= $erreurs['type_de_projet'] ?? '' ?></p>
            </fieldset>
            <button type="submit" class="btn btn--cobalt btn--grand">Envoyer la requête →</button>
        </form>
    <?php endif; ?>
</section>

<?php fin_page(); ?>

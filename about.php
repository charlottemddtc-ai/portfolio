<?php
require 'fonctions.php';

$experiences = [
    ['dates' => '2025 — aujourd\'hui',      'titre' => 'Software Developer',  'texte' => 'Applications web et UI design.'],
    ['dates' => 'Avril 2025 — juin 2025',   'titre' => 'Frontend Developer',  'texte' => 'Sites web responsive avec React.'],
    ['dates' => 'Février 2025 — mars 2025', 'titre' => 'UI Designer',         'texte' => 'Conception d\'interfaces modernes.'],
    ['dates' => 'Juillet 2024 — janvier 2025', 'titre' => 'Junior Developer', 'texte' => 'Réalisation de petits projets.'],
];

$education = [
    ['dates' => '2025 — 2026', 'titre' => 'Licence 2',          'texte' => 'ESTM'],
    ['dates' => '2024 — 2025', 'titre' => 'Licence 1',          'texte' => 'ESTM'],
    ['dates' => '2019 — 2024', 'titre' => 'Élève',              'texte' => 'Institution Sainte Jeanne d\'Arc'],
    ['dates' => '2013 — 2019', 'titre' => 'Élève en primaire',  'texte' => 'Sainte Abraham'],
];

debut_page('À propos', 'apropos');
?>

<!-- OUVERTURE : affiche cobalt -->
<section class="affiche affiche--cobalt">
    <div class="affiche__texte">
        <p class="etiquette entree" style="--d:.1s">À propos</p>
        <h1 class="titre-affiche">
            <span class="ligne"><span class="entree" style="--d:.2s">About</span></span>
            <span class="ligne"><span class="entree" style="--d:.32s">me<em>.</em></span></span>
        </h1>
        <p class="affiche__chapo entree" style="--d:.5s">
            Je suis une étudiante en software engineering, passionnée par la construction d'applications
            modernes et faciles à utiliser. J'aime transformer des idées en vrais produits digitaux, avec du code
            propre et un design créatif.
        </p>
    </div>

    <figure class="affiche__illustration entree" style="--d:.4s" data-parallaxe>
        <img src="<?= image('image0.png') ?>" alt="Charlotte en version illustrée" width="213" height="320">
    </figure>

    <p class="autocollant-texte autocollant-texte--rose entree" style="--d:.9s">Always learning<br>and exploring new<br>technologies.</p>
</section>

<!-- CHIFFRES -->
<section class="section-claire bloc-chiffres">
    <dl class="chiffres chiffres--grand">
        <div data-revele><dt>Éducation</dt><dd>5+</dd></div>
        <div data-revele style="--d:.1s"><dt>Expérience</dt><dd>1+</dd></div>
        <div data-revele style="--d:.2s"><dt>Projets</dt><dd>10+</dd></div>
    </dl>
    <div class="bloc-chiffres__actions">
        <a href="files/cv_design_exact.pdf" class="btn btn--noir" download>Télécharger le CV</a>
        <a href="projects.php" class="btn btn--contour-noir">Voir les projets</a>
    </div>
</section>

<!-- EXPÉRIENCE -->
<section class="parcours">
    <div class="parcours__tete">
        <p class="etiquette etiquette--menthe">Parcours</p>
        <h2 class="titre-geant" data-revele>Mon expérience</h2>
    </div>
    <ol class="parcours__liste">
        <?php foreach ($experiences as $e): ?>
            <li data-revele>
                <span class="parcours__dates"><?= htmlspecialchars($e['dates']) ?></span>
                <h3><?= htmlspecialchars($e['titre']) ?></h3>
                <p><?= htmlspecialchars($e['texte']) ?></p>
            </li>
        <?php endforeach; ?>
    </ol>
</section>

<!-- ÉDUCATION -->
<section class="parcours parcours--clair section-claire">
    <div class="parcours__tete">
        <p class="etiquette">Formation</p>
        <h2 class="titre-geant" data-revele>Mon éducation</h2>
    </div>
    <ol class="parcours__liste">
        <?php foreach ($education as $e): ?>
            <li data-revele>
                <span class="parcours__dates"><?= htmlspecialchars($e['dates']) ?></span>
                <h3><?= htmlspecialchars($e['titre']) ?></h3>
                <p><?= htmlspecialchars($e['texte']) ?></p>
            </li>
        <?php endforeach; ?>
    </ol>
</section>

<section class="appel appel--court">
    <h2 class="appel__titre" data-revele>On travaille ensemble&nbsp;?</h2>
    <a href="contact.php" class="btn btn--noir btn--grand">Me contacter →</a>
</section>

<?php fin_page(); ?>

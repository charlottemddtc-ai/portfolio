<?php
require 'fonctions.php';
$projets = projets();
$competences = competences();
debut_page('Accueil', 'accueil');
?>

<!-- OUVERTURE : l'affiche -->
<section class="ouverture">
    <figure class="ouverture__photo" data-parallaxe>
        <img src="<?= image('image0 (12).jpeg') ?>" alt="Portrait de Charlotte" width="1024" height="997" fetchpriority="high">
    </figure>

    <div class="ouverture__texte">
        <p class="etiquette etiquette--menthe entree" style="--d:.1s">Coucou, je suis</p>
        <h1 class="ouverture__nom" aria-label="Charlotte">
            <span class="ligne"><span class="entree" style="--d:.2s">Char</span></span>
            <span class="ligne"><span class="entree" style="--d:.32s">lotte<em>.</em></span></span>
        </h1>
        <p class="ouverture__role entree" style="--d:.5s">Frontend Developer <span>&amp;</span> Designer</p>
        <div class="ouverture__actions entree" style="--d:.62s">
            <a href="files/cv_design_exact.pdf" class="btn btn--blanc" download>Télécharger le CV</a>
            <a href="contact.php" class="btn btn--contour">Contacte-moi</a>
        </div>
    </div>

    <figure class="autocollant autocollant--ouverture entree" style="--d:.8s">
        <img src="<?= image('image0.png') ?>" alt="Charlotte en version illustrée" width="213" height="320">
        <figcaption>moi, en dessin</figcaption>
    </figure>

    <a href="#bandeau" class="ouverture__defiler etiquette">Défiler ↓</a>
</section>

<!-- BANDEAU : les outils qui défilent -->
<div class="bandeau" id="bandeau" aria-label="Technologies : <?= htmlspecialchars(implode(', ', array_column($competences, 'nom'))) ?>">
    <div class="bandeau__piste" aria-hidden="true">
        <?php for ($i = 0; $i < 2; $i++): ?>
            <div class="bandeau__groupe">
                <?php foreach ($competences as $c): ?>
                    <span><?= htmlspecialchars($c['nom']) ?></span><b>✶</b>
                <?php endforeach; ?>
            </div>
        <?php endfor; ?>
    </div>
</div>

<!-- DÉVELOPPEMENT : qui elle est -->
<section class="manifeste section-claire">
    <p class="etiquette">À propos</p>
    <p class="manifeste__texte" data-revele>
        Étudiante en <mark>software engineering</mark>, passionnée par la construction d'applications
        <mark class="rose">modernes et faciles à utiliser</mark>. J'aime transformer des idées en vrais produits
        digitaux, avec du code propre et un design créatif.
    </p>
    <p class="manifeste__chute" data-revele>Toujours apprendre, toujours progresser.</p>

    <dl class="chiffres">
        <div data-revele><dt>Éducation</dt><dd>5+</dd></div>
        <div data-revele style="--d:.1s"><dt>Expérience</dt><dd>1+</dd></div>
        <div data-revele style="--d:.2s"><dt>Projets</dt><dd>10+</dd></div>
    </dl>

    <a href="about.php" class="btn btn--noir">En savoir plus</a>
</section>

<!-- COMPÉTENCES : le tableau d'affichage -->
<section class="competences">
    <div class="competences__tete">
        <p class="etiquette etiquette--menthe">Mes skills</p>
        <h2 class="titre-geant" data-revele>Les technologies<br>que j'utilise</h2>
    </div>

    <ul class="competences__liste">
        <?php foreach ($competences as $c): ?>
            <li class="competence" data-revele style="--c: <?= $c['couleur'] ?>; --n: <?= $c['niveau'] ?>%">
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/<?= $c['icone'] ?>" alt="" width="40" height="40" loading="lazy">
                <span class="competence__nom"><?= htmlspecialchars($c['nom']) ?></span>
                <span class="competence__jauge" aria-hidden="true"><span></span></span>
                <span class="competence__valeur"><?= $c['niveau'] ?>%</span>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<!-- PROJETS : les plans, en carrousel -->
<section class="vitrine">
    <div class="vitrine__tete">
        <h2 class="titre-geant" data-revele>Mes projets</h2>
        <div class="vitrine__fleches">
            <button type="button" class="fleche" data-carrousel-prec aria-label="Projet précédent">←</button>
            <button type="button" class="fleche" data-carrousel-suiv aria-label="Projet suivant">→</button>
        </div>
    </div>

    <div class="carrousel" data-carrousel tabindex="0" aria-label="Projets">
        <?php foreach ($projets as $p): ?>
            <article class="plan plan--<?= $p['couleur'] ?>">
                <div class="plan__image">
                    <img src="<?= image($p['image']) ?>" alt="Aperçu : <?= htmlspecialchars($p['titre']) ?>" loading="lazy">
                </div>
                <div class="plan__texte">
                    <ul class="puces">
                        <?php foreach ($p['technologies'] as $t): ?><li><?= htmlspecialchars($t) ?></li><?php endforeach; ?>
                    </ul>
                    <h3><?= htmlspecialchars($p['titre']) ?></h3>
                    <p><?= htmlspecialchars($p['description']) ?></p>
                    <div class="plan__boutons"><?= boutons_projet($p) ?></div>
                </div>
            </article>
        <?php endforeach; ?>
        <a class="plan plan--tous" href="projects.php">
            <span>Tous les projets</span>
            <b aria-hidden="true">→</b>
        </a>
    </div>
</section>

<!-- CHUTE : l'appel -->
<section class="appel">
    <p class="etiquette">Contact</p>
    <h2 class="appel__titre" data-revele>La pièce manquante de votre équipe&nbsp;?</h2>
    <p class="appel__sous" data-revele>Je suis peut-être la bonne.</p>
    <a href="contact.php" class="btn btn--noir btn--grand">Parlons-en →</a>
</section>

<?php fin_page(); ?>

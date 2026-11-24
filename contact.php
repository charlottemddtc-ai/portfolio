<?php
require 'fonctions.php';

$erreurs = [];
$succes = false;
$nom = $email = $message = '';
$accord = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom     = nettoyer($_POST['nom'] ?? '');
    $email   = nettoyer($_POST['email'] ?? '');
    $message = nettoyer($_POST['message'] ?? '');
    $accord  = isset($_POST['accord']);

    if (!champ_requis($nom))     $erreurs['nom'] = 'Nom obligatoire';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erreurs['email'] = 'E-mail invalide';
    if (!champ_requis($message)) $erreurs['message'] = 'Message obligatoire';
    if (!$accord)                $erreurs['accord'] = 'Coche la case pour que je puisse te répondre';
    $succes = empty($erreurs);
}

debut_page('Contact', 'contact');
?>

<section class="contact">
    <div class="contact__affiche">
        <p class="etiquette etiquette--menthe entree" style="--d:.1s">Contact</p>
        <h1 class="titre-affiche">
            <span class="ligne"><span class="entree" style="--d:.2s">Get in</span></span>
            <span class="ligne"><span class="entree" style="--d:.32s">touch<em>.</em></span></span>
        </h1>
        <p class="contact__chapo entree" style="--d:.5s">
            En recherche de la dernière pièce manquante pour perfectionner votre équipe&nbsp;?
            <strong>Let’s chat — je suis peut-être la bonne&nbsp;!</strong>
        </p>

        <div class="enveloppe entree" style="--d:.65s" aria-hidden="true">
            <span class="enveloppe__lettre enveloppe__lettre--rose">Interview</span>
            <span class="enveloppe__lettre enveloppe__lettre--menthe">Offre d'emploi</span>
            <span class="enveloppe__corps">
                <span class="enveloppe__adresse">Charlotte<br>charlottemddtc@gmail.com</span>
            </span>
        </div>

        <ul class="contact__directs entree" style="--d:.8s">
            <li><span class="etiquette">E-mail</span><a href="mailto:charlottemddtc@gmail.com">charlottemddtc@gmail.com</a></li>
            <li><span class="etiquette">Téléphone</span><a href="tel:+221774564099">+221 77 456 40 99</a></li>
        </ul>
    </div>

    <div class="contact__formulaire" id="formulaire">
        <?php if ($succes): ?>
            <div class="recu recu--sombre" role="status">
                <p class="recu__titre">Message envoyé.</p>
                <p>Merci <?= $nom ?>, je te réponds à <?= $email ?> très vite.</p>
                <a href="contact.php" class="btn btn--contour">Écrire un autre message</a>
            </div>
        <?php else: ?>
            <form class="formulaire formulaire--sombre" action="contact.php#formulaire" method="post" novalidate>
                <div class="champ champ--large<?= isset($erreurs['nom']) ? ' champ--erreur' : '' ?>">
                    <label for="c-nom">Nom</label>
                    <input type="text" id="c-nom" name="nom" value="<?= $nom ?>" autocomplete="name">
                    <p class="champ__erreur"><?= $erreurs['nom'] ?? '' ?></p>
                </div>
                <div class="champ champ--large<?= isset($erreurs['email']) ? ' champ--erreur' : '' ?>">
                    <label for="c-email">E-mail</label>
                    <input type="email" id="c-email" name="email" value="<?= $email ?>" autocomplete="email">
                    <p class="champ__erreur"><?= $erreurs['email'] ?? '' ?></p>
                </div>
                <div class="champ champ--large<?= isset($erreurs['message']) ? ' champ--erreur' : '' ?>">
                    <label for="c-message">Message</label>
                    <textarea id="c-message" name="message" rows="6"><?= $message ?></textarea>
                    <p class="champ__erreur"><?= $erreurs['message'] ?? '' ?></p>
                </div>
                <div class="champ champ--large case<?= isset($erreurs['accord']) ? ' champ--erreur' : '' ?>">
                    <label class="case__ligne">
                        <input type="checkbox" name="accord" value="1"<?= $accord ? ' checked' : '' ?>>
                        <span>En cliquant sur « Envoyer », tu me donnes la permission de stocker tes infos et de te contacter.</span>
                    </label>
                    <p class="champ__erreur"><?= $erreurs['accord'] ?? '' ?></p>
                </div>
                <button type="submit" class="btn btn--cobalt btn--grand">Envoyer →</button>
            </form>
        <?php endif; ?>
    </div>
</section>

<?php fin_page(); ?>

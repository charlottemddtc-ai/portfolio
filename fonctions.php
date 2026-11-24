<?php
function champ_requis(string $valeur): bool {
    return !empty(trim($valeur));
}

// Nettoie une saisie : espaces retirés + caractères HTML échappés.
function nettoyer(string $valeur): string {
    return htmlspecialchars(trim($valeur));
}

// Chemin d'image sûr (les noms de fichiers contiennent espaces et parenthèses).
function image(string $fichier): string {
    return 'images/' . rawurlencode($fichier);
}

// Les projets, partagés par l'accueil et la page Projets.
// 'code' et 'demo' : à remplir avec les vraies URL (GitHub, site en ligne).
function projets(): array {
    return [
        [
            'titre'        => 'Plateforme e-commerce',
            'description'  => 'Boutique en ligne complète avec paiement intégré.',
            'technologies' => ['React', 'Node', 'MongoDB'],
            'image'        => 'image0 (11).jpeg',
            'couleur'      => 'rose',
            'code'         => '',
            'demo'         => '',
        ],
        [
            'titre'        => 'Plateforme pour agriculteurs',
            'description'  => 'Aide à savoir quand la pluie va tomber.',
            'technologies' => ['React', 'HTML', 'CSS'],
            'image'        => 'image1 (1).jpeg',
            'couleur'      => 'vert',
            'code'         => '',
            'demo'         => '',
        ],
        [
            'titre'        => 'Application pour une startup',
            'description'  => 'Application personnalisée au goût du client.',
            'technologies' => ['React', 'Tailwind'],
            'image'        => 'image2.jpeg',
            'couleur'      => 'cobalt',
            'code'         => '',
            'demo'         => '',
        ],
        [
            'titre'        => 'Requête client',
            'description'  => 'Une technologie basée sur des requêtes client-serveur.',
            'technologies' => ['SQL', 'C'],
            'image'        => 'image4.jpeg',
            'couleur'      => 'menthe',
            'code'         => '',
            'demo'         => '',
        ],
    ];
}

// Boutons Code / Démo : vrai lien si l'URL existe, sinon href="#" signalé « bientôt ».
function boutons_projet(array $p): string {
    $html = '';
    foreach (['code' => 'Code', 'demo' => 'Démo'] as $cle => $libelle) {
        if (!empty($p[$cle])) {
            $html .= '<a class="btn btn--' . $cle . '" href="' . htmlspecialchars($p[$cle]) . '" target="_blank" rel="noopener">' . $libelle . ' <span aria-hidden="true">↗</span></a>';
        } else {
            $html .= '<a class="btn btn--' . $cle . ' btn--bientot" href="#" aria-disabled="true" title="Lien à venir">' . $libelle . ' <small>bientôt</small></a>';
        }
    }
    return $html;
}

// Compétences et niveaux (valeurs d'origine du portfolio).
function competences(): array {
    return [
        ['nom' => 'Laravel',    'icone' => 'laravel/laravel-original.svg',         'niveau' => 95, 'couleur' => '#ff2d20'],
        ['nom' => 'React',      'icone' => 'react/react-original.svg',             'niveau' => 85, 'couleur' => '#61dafb'],
        ['nom' => 'JavaScript', 'icone' => 'javascript/javascript-original.svg',   'niveau' => 90, 'couleur' => '#f7df1e'],
        ['nom' => 'Python',     'icone' => 'python/python-original.svg',           'niveau' => 80, 'couleur' => '#3776ab'],
        ['nom' => 'Java',       'icone' => 'java/java-original.svg',               'niveau' => 75, 'couleur' => '#f89820'],
        ['nom' => 'HTML',       'icone' => 'html5/html5-original.svg',             'niveau' => 95, 'couleur' => '#e34c26'],
        ['nom' => 'CSS',        'icone' => 'css3/css3-original.svg',               'niveau' => 90, 'couleur' => '#264de4'],
        ['nom' => 'Tailwind',   'icone' => 'tailwindcss/tailwindcss-original.svg', 'niveau' => 85, 'couleur' => '#38bdf8'],
    ];
}

// Début de page commun : <head>, polices, CSS, navigation.
function debut_page(string $titre, string $page): void {
    $titre_complet = $titre . ' — Charlotte, Frontend Developer & Designer';
    require __DIR__ . '/composants/entete.php';
}

function fin_page(): void {
    require __DIR__ . '/composants/piedpage.php';
}

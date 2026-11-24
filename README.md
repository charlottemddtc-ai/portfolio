# Portfolio — Charlotte

Portfolio personnel de Charlotte, frontend developer & designer.
Site en PHP, sans framework : fond noir, accents cobalt, rose et menthe, grandes typographies et animations au défilement.

## Lancer le site en local

```
php -S localhost:8000
```

Puis ouvrir http://localhost:8000 dans un navigateur.

## Pages

- `index.php` — accueil : ouverture avec portrait, bandeau des technologies, à propos, compétences, projets
- `about.php` — parcours : expérience et éducation
- `projects.php` — tous les projets, recherche et formulaire de demande de projet
- `contact.php` — formulaire de contact

## Organisation

- `composants/` — en-tête (`entete.php`), navigation et pied de page partagés par les 4 pages
- `fonctions.php` — fonctions utiles, et la liste des **projets** et des **compétences**
- `assets/css/site.css` — tout le style (couleurs et polices en variables en tête de fichier)
- `assets/js/site.js` — animations, menu mobile, bouton « Inverser »
- `images/` — photos et visuels des projets
- `files/` — CV en PDF

## Ajouter ou modifier un projet

Dans `fonctions.php`, fonction `projets()` : titre, description, technologies, image, couleur de fond,
et les liens `code` (GitHub) et `demo` (site en ligne). Tant qu'un lien est vide, le bouton affiche « bientôt ».

## Polices

Archivo et Martian Mono, chargées via Google Fonts.

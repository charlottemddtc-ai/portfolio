<?php
// Point d'entrée Vercel : exécute la page PHP demandée, restée à la racine du projet.
// En local, rien ne change : php -S localhost:8000 sert directement les pages.

$pages = ['index', 'about', 'projects', 'contact'];
$page  = $_GET['page'] ?? 'index';
unset($_GET['page']);

if (!in_array($page, $pages, true)) {
    http_response_code(404);
    $page = 'index';
}

$racine = dirname(__DIR__);
chdir($racine);
$_SERVER['SCRIPT_NAME'] = '/' . $page . '.php';
$_SERVER['PHP_SELF']    = '/' . $page . '.php';

require $racine . '/' . $page . '.php';

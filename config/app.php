<?php

/**
 * Aliases : raccourcis pour les noms de classes
 */
class_alias('\Bramus\Router\Router', 'Router');

/**
 * Constantes : éléments de configuration propres au système
 */
$GLOBALS['WEBSITE_TITLE'] = getenv('WEBSITE_TITLE');
$GLOBALS['BASE_URL'] = getenv('BASE_URL');

/**
 * Liste des dossiers source pour l'autoload des classes
 */
const CLASSES_SOURCES = [
    'controllers',
    'config',
    'models',
    'managers'
];
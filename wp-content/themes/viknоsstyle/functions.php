<?php

// Include used custom classes
require_once 'inc/classes.php';

// Theme configuration
require_once('inc/configuration.php');

// Recommended plugins installer
require_once('inc/plugins.php');

// Register theme shortcodes
require_once('inc/shortcodes.php');

// Enqueuing styles and js
require_once 'inc/enqueue.php';

// WP misc registration
require_once 'inc/registration.php';

// Optimization Images (jpeg||jpg||jpe)
require_once 'inc/image-optimization.php';

// Custom helper functions
require_once 'inc/custom-functions.php';

// Include theme hooks
require_once __DIR__ . '/inc/theme-hooks.php';







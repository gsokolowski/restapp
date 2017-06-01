<?php

// Require database component
require_once 'core/Database.php';

// Require core files
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Model.php';

define("DOMAIN", "http://$_SERVER[HTTP_HOST]");

$app = new App();

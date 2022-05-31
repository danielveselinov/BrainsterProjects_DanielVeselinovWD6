<?php

require_once __DIR__ . "/../../../autoload.php";

use BLibrary\Auth\Auth;
use BLibrary\Database\Connection\DB;

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'authRegister') {
    Auth::register($_POST);
    // Auth::login($_POST); or if uspesno reg togaj u taj proces auth login
}
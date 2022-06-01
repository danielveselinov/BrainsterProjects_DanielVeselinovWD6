<?php

require_once __DIR__ . "/../../../autoload.php";

use BLibrary\Auth\Auth;
use BLibrary\Database\Connection\DB;

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'authRegister') {
    # Validators
    emptyFields($_POST);
    Auth::register($_POST);
}
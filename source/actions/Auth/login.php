<?php

require_once __DIR__ . "/../../../autoload.php";

use BLibrary\Database\Connection\DB;

if ($_POST['process'] = 'authLogin') {

    try {
        $stmt = DB::connect()->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$_POST['email']]);

        if ($stmt->rowCount() == 0) {
            echo json_encode(['auth' => $result = false]);
            return;
        }

        $user = $stmt->fetch();

        if (password_verify($_POST['password'], $user['password'])) {
            // $_SESSION['auth'] = $user;
            echo json_encode(['auth' => $result = true]);
            return;
        } else {
            echo json_encode(['auth' => $result = false]);
            return;
        }

    } catch (PDOException $e) {
        echo json_encode(['auth' => $result = false]);
        return;
    }
}
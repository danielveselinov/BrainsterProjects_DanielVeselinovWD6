<?php

namespace BLibrary\Auth;

use BLibrary\Database\Connection\DB;
use PDOException;

class Auth
{
    /**
     * Login existing user
     */
    public static function login($object)
    {
        try {
            $stmt = DB::connect()->prepare('SELECT * FROM users WHERE email = ?');
            $stmt->execute([$object['email']]);
    
            if ($stmt->rowCount() == 0) {
                echo json_encode(['auth' => false]);
                exit;
            }
    
            $user = $stmt->fetch();
    
            if (password_verify($object['password'], $user['password'])) {
                $_SESSION['auth'] = $user;
                echo json_encode(['auth' => true]);
                exit;
            } else {
                echo json_encode(['auth' => false]);
                exit;
            }
    
        } catch (PDOException $e) {
            // echo json_encode(['auth' => $result = false]);
            redirect(route('broken'));
        }
    }

    /**
     * Register a new user
     */
    public static function register($object) 
    {
        // print_r($object);
    }

    /**
     * Logout existing user
     */
    public static function logout() 
    {
        $_SESSION['auth'] = null;
        session_destroy();
        redirect(route('home'));
    }

    /**
     * Check if user is logged in
     */
    public static function isLogged()
    {
        return isset($_SESSION["auth"]) ?? null;
    }

    /**
     * Check if user is administrator
     */
    public static function isAdmin()
    {
        return ($_SESSION['auth']['is_admin'] == 1) ? true : false;
    }
}

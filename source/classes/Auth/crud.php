<?php

namespace BLibrary\Auth;

use BLibrary\Database\Connection\DB;
use PDOException;

class Auth
{
    public function __construct(
        private $properties = []
    ) {
        $this->setProperties($properties);
    }

    /**
     * Get the value of properties
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set the value of properties
     *
     * @return  self
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Check if user exist and enter correct credentials
     */
    public static function Login()
    {
        $data = self::getProperties();

        try {
            $stmt = DB::connect()->prepare("");
        } catch (PDOException $ex) {
            echo $ex;
            die();
        }
    }
}

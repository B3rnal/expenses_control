<?php
if (!class_exists('Db')){
  class Db {

    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    //Singleton pattern
    public static function getConnection() {
      if (!isset(self::$instance)) {
        self::$instance = new mysqli("localhost", "root", "root", "ExpRep_DB");
      }
      return self::$instance;
    }
    public static function closeConnection(){
      $instance->close();
    }

  }
}
?>
<?php

class Db {
  protected $dbName = 'cms-example';
  protected $dbHost = 'localhost';
  protected $dbUser = 'root';
  protected $dbPass = 'root';
  protected $dbHandler, $dbStmt;


  /**
   * @param null|void
   * @return null|void
   * ? Creates or resumes an existing database connection
  */ 
  public function __construct()
  {
    // Connection Info
    $dsn = 'mysql:host=' . $this->dbHost .';dbname=' . $this->dbName;
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    // Try Connection
    try {
      $this->dbHandler = new PDO($dsn, $this->dbUser, $this->dbPass, $options);
    } catch (Exception $e) {
      var_dump('Could not establish connection with DB: ' . $e->getMessage());
    }

  }

  /**
   * @param string
   * @return null|void
   * ? Creates a PDO statement object
  */
  public function query($query) {
    $this->dbStmt = $this->dbHandler->prepare($query);
  }

  public function bind($param, $value, $type = null) {
    if(is_null($type)) {
      switch (true) {
        case is_int($value):
          $type =  PDO::PARAM_INT;
        break;
        case is_bool($value):
          $type =  PDO::PARAM_BOOL;
        break;
        case is_null($value):
          $type =  PDO::PARAM_NULL;
        break;
        default:
          $type = PDO::PARAM_STR;
        break;
      }
    }
    $this->dbStmt->bindValue($param, $value, $type);
  }

  public function execute() {
    $this->dbStmt->execute();
    return true;
  }

  public function fetch() {
    $this->execute();
    return $this->dbStmt->fetch(PDO::FETCH_ASSOC);
  }

  public function fetchAll() {
    $this->execute();
    return $this->dbStmt->fetchAll(PDO::FETCH_ASSOC);
  }


}



?>
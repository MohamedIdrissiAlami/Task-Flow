<?php

class clsDataBase
{
  private $_db_server ;
  private $_db_user ;
  private $_db_pass ;
  private $_db_name ;


  public function __construct($db_server,$db_user, $db_pass,$db_name)
  {
    $this->_db_server=$db_server;
    $this->_db_user=$db_user;
    $this->_db_pass=$db_pass;
    $this->_db_name=$db_name;
  }
  public function ConnectToDataBase($db_server,$db_user, $db_pass,$db_name):object
  {
    return  mysqli_connect($db_server,$db_user,$db_pass,$db_name); 
  }
  public function Connect():object
  {
    return $this->ConnectToDataBase($this->_db_server,$this->_db_user,$this->_db_pass,$this->_db_name);
  }
}
?>
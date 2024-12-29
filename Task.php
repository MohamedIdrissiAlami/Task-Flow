<?php
require_once "database.php";
class clsTask
{
  private $_Title;
  private $_Description;
  private $_Type;
  private $_AssignedTo;
  private $_Status;
  private $_ConnectionState;

  private function _IsTaskExists():bool
  {
    $sql="Select TaskID From task where Title='$this->_Title'";
    return $this->_ConnectionState->query($sql)->num_rows>0;
  }

  public function __construct($Title,$Description,$Type,$AssignTo,$Status)
  {
    $this->_Title=$Title;
    $this->_Description=$Description;
    $this->_Type=$Type;
    $this->_AssignedTo=$AssignTo;
    $this->_Status=$Status;
    try{
     $this->_ConnectionState=clsDataBase::ConnectToDataBase("localhost","root","","TaskFlow");
  }
  catch(mysqli_sql_exception)
  {
    echo"could not connect!";
  }

  }
  /* ================= get and set properties ===============*/
  public function SetTitle($Title)
  {
    $this->_Title=$Title;

  }
  public function GetTitle()
  {
    return $this->_Title;
  }
  public function SetDescription($Description)
  {
    $this->_Description=$Description;

  }
  public function GetDescription()
  {
    return $this->_Description;
  }

  public function SetType($Type)
  {
    $this->_Type=$Type;

  }
  public function GetType()
  {
    return $this->_Type;
  }

  public function SetUser($User)
  {
    $this->_AssignedTo=$User;
  }
  public function GetUser()
  {
    return $this->_AssignedTo;
  }

  public function SetStatus($Status)
  {
    $this->_Status=$Status;
  }
  public function GetStatus()
  {
    return $this->_Status;
  }
  
  public function CreateNewTask()
{
    if (!$this->_IsTaskExists()) {
        
        //get userID from users t able: 
        $sql = "SELECT UserID FROM assignedto WHERE Name='$this->_AssignedTo'";
        $result = $this->_ConnectionState->query($sql);

        if ($result === false) {
            die("Error in query (SELECT): " . $this->_ConnectionState->error);
        }

        if ($result->num_rows === 0) {
            //insert user if it doesn't exist : 
            $sql = "INSERT INTO assignedto (Name) VALUES ('$this->_AssignedTo')";
            $insertResult = $this->_ConnectionState->query($sql);

            if ($insertResult === false) {
                die("Error in query (INSERT): " . $this->_ConnectionState->error);
            }

            $result = $this->_ConnectionState->query("SELECT UserID FROM assignedto WHERE Name='$this->_AssignedTo'");

            if ($result === false) {
                die("Error in query (SELECT after INSERT): " . $this->_ConnectionState->error);
            }
        }

        $row = $result->fetch_assoc();
        if (!$row) {
            die("No UserID found for the user '$this->_AssignedTo'.");
        }

        //insert the new task into task table : 
         $Query = "INSERT INTO task (Title, Description, Type, UserID, Status) 
                  VALUES ('$this->_Title', '$this->_Description', '$this->_Type', '{$row['UserID']}', '$this->_Status')";

        $insertTaskResult = $this->_ConnectionState->query($Query);

        if ($insertTaskResult === false) {
            die("Error in query (INSERT task): " . $this->_ConnectionState->error);
        }

        echo "<p>Task created successfully!</p>";
    } else {
        echo "<p>Task already exists!</p>";
    }
}

}
?>
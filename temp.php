<?php
class User
{
  public function connect_db($host, $username, $password, $port, $db)
  {
    try {
      $this->bdd = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8;", $username, $password);
    }
    catch (Exception $error) {
      echo $error->getMessage();
    }
  }

  protected $bdd;
  public function __construct()
  {
    $this->connect_db('localhost', 'root', 'Aeqdwcrfv0106', '3306', 'pool_php_rush');
  }
  public function createUser($username, $mail, $passwd, $passwd2, $admin)
  {
     if ($this->checkNname($username) && $this->checkMail($email) && $this->checkPasswd($passwd, $passwd2)) {
     $hash = password_hash($_POST['passwd'], PASSWORD_BCRYPT);
     $sql = $bdd->prepare('INSERT INTO users (username, password, email, admin) VALUES (?, ?, ?, 0)');
     $sql->bindParam(1, $username);
     $sql->bindParam(2, $password);
     $sql->bindParam(3, $email);
     $sql->execute();
     echo "User created";
    }

  }
  public function deleteUser($username)
  {
    $id = $_GET['id'];
    $msg = $db->prepare('SELECT id FROM users');
    $msg->execute();
    $count = $msg->rowCount();
    $query = $db->prepare('DELETE FROM users WHERE id=?');
    $query->execute(array($_GET['id']));
      echo "User deleted";
 /*    $msg = $db->prepare('SELECT id FROM users');
   $msg->execute();
   $count = $msg->rowCount();
   $query = $db->prepare('DELETE FROM users WHERE id=$id');
   $query->execute(array($_POST['remove']));*/
    }

  public function editUser()
  {
    if ($_POST['user_to_edit'] != NULL)
    {
      if (isset($_POST['new_username']) && $_POST['new_username'] != "")
      {
        if ($this->checkUsername($_POST['new_username']))
        {
          $editUser = $this->bdd->prepare('UPDATE users SET username = ? WHERE username = ?');
          $editUser->execute(array($_POST['new_username'], $_POST['user_to_edit']));
          echo "Username edited.";
          //unset($_POST['new_username']);
          //$this->editUser();
        }
      }
      //elseif
      if (isset($_POST['new_email']) && $_POST['new_email'] != "")
      {
        if ($this->checkMail($_POST['new_email']))
        {
          $editUser2 = $this->bdd->prepare('UPDATE users SET email = ? WHERE username = ?');
          $editUser2->execute(array($_POST['new_email'], $_POST['user_to_edit']));
          echo "Email edited.";
        }
      }/*
      elseif (isset($_POST['new_password']) && $_POST['new_password'] != "")
      {
        if ($this->checkPasswd($_POST['new_password'], $_POST['new_password_confirmation']))
        {
          $editUser = $this->bdd->prepare('UPDATE users SET password = ? WHERE username = ?');
          $editUser->execute(array(password_hash($_POST['new_password'], PASSWORD_BCRYPT), $_POST['user_to_edit']));
          echo "Password edited.";
        }
      }
      elseif (isset($_POST['is_admin']))
      {
        $editUser = $this->bdd->prepare('UPDATE users SET admin = ? WHERE username = ?');
        $editUser->execute(array($_POST['is_admin'], $_POST['user_to_edit']));
        echo "Admin value edited.";
      }
    }*/
    else {
      echo "Please select a user to edit !";
      return FALSE;
    }
  }
}
  public function getUsers()
  {
        $query = $this->bdd->prepare('SELECT username, email FROM users');
        $query->execute();
        $fetch = $query->fetchAll();
        return $fetch;
  }

  public function checkName($username)
  {
    $checkUsername = $this->bdd->prepare('SELECT username FROM users');
    $checkUsername->execute();
    $userUsername = $checkUsername->fetchAll();
    foreach($userUsername as $value) {
      if(isset($username) && ($username == $value['username']))
      {
        echo "Username already taken";
        return FALSE;
      }
    }
    if (isset($username) && (strlen($username) <= 3 || strlen($username) > 10)){
      var_dump($username);
      echo "Invalid username";
      return FALSE;
    }
    else {
      return TRUE;
    }
  }
  public function checkPasswd($passwd, $passwd2)
  {
    if (isset($passwd) && isset($passwd2) && ((strlen($passwd) < 3 || strlen($passwd) > 10) || $passwd != $passwd2)) {
      echo "Wrong password";
      return FALSE;
    }
    else {
      return TRUE;
    }
  }
  public function checkMail($mail)
  {
    $checkMail = $this->bdd->prepare('SELECT email FROM users');
    $checkMail->execute();
    $userMail = $checkMail->fetchAll();
    foreach($userMail as $value) {
      if(isset($mail) && ($mail == $value['email']))
      {
        echo "Email already taken";
        return FALSE;
      }
    }
    if (isset($mail) && (filter_var($mail, FILTER_VALIDATE_EMAIL) == FALSE)) {
      echo "wrong email";
      return FALSE;
    }
    else {
      return TRUE;
    }
  }
}
?>

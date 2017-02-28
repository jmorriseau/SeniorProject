
<?php
  class Login {

    public function getLogin($email,$password,$db){

      $username = $db->sql("SELECT * FROM [User] where user_name = '".$email."';");

      if(password_verify($password,$username[0]['password'])){
        $_SESSION['account']=$username;
        $_SESSION['logged_in']=true;
        return true;
      }
      else{
        return false;
      }
    }
  }

?>

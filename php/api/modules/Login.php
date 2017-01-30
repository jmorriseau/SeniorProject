
<?php
  class Login {

    public function getLogin($email,$password,$db){

      $username = $db->sql("SELECT * FROM [User] where user_name = '".$email."';");

      //var_dump($username);
      //var_dump($email);

      if(password_verify($password,$username[0]['password'])){
        $_SESSION['account']=$username;
        $_SESSION['logged_in']=true;
        return true;
      }
      else{
        return false;
      }

      //$binds = array(":user_name" => $mail,
        //              ":password" => $password);

    }

    /*public function checkUserLogin($connection,$email, $pass) {
        $pass = sha1($pass);
        $dbs = $connection->prepare('SELECT * FROM user_profiles WHERE email = :email and password = :password');
        // you must bind the data before you execute
        $dbs->bindParam(':email', $email, PDO::PARAM_STR);
        $dbs->bindParam(':password', $pass, PDO::PARAM_STR);
        // When you execute remember that a rowcount means a change was made
        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }*/
  }

?>

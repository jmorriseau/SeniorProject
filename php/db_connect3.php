<?php

      //$serverName = "sql.neit.edu"; // serverName\instance

      // Disconnect the database from the database handle.
      //odbc_close($conn);
          //  $username = filter_input(INPUT_POST, 'username');
            //$password = filter_input(INPUT_POST, 'password');

            //hash password before inputting into the db
            //$password = sha1($password);
            //$pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
            //$dbs = $pdo->prepare('select * from User where username = :user_name and password = :password');

          //  $dbs->bindParam(':username', $username, PDO::PARAM_STR);
            //$dbs->bindParam(':password', $password, PDO::PARAM_STR);
            try {
              $connection = odbc_connect("Driver={SQL Server};Server=sql.neit.edu;Database=SE414_GroupProject;", "SE414_GroupProject","1234567890");
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }

            //$connectionInfo = array( "Database"=>"SE414_GroupProject", "UID"=>"SE414_GroupProject", "PWD"=>"1234567890");
            //$conn = sqlsrv_connect( $serverName, $connectionInfo);

            //if ( $conn) {
                //    header('Location:index.php');
                //    echo "Success full Connection.<br />";
            //} else {
            //        echo "Connection failed.<br />";
                //    die( print_r( sqlsrv_errors(), true));

            //}


//var_dump('HELP');
  //var_dump('ME');

?>

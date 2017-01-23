<?php

class DAO{
	private $db = '';
    private $host = '';
    private $port = '';
    private $dbName = '';
    private $user = '';
    private $password = '';

    function getDb(){
        return $this->db;
    }
    function getHost(){
        return $this->host;
    }

    function setHost($host){
        $this->host = $host;
    }

    function getPort(){
        return $this->port;
    }

    function setPort($port){
        $this->port = $port;
    }

    function getDbName(){
        return $this->dbName;
    }

    function setDbName($dbName){
        $this->dbName = $dbName;
    }

    function getUser(){
        return $this->user;
    }

    function setUser($user){
        $this->user = $user;
    }

    function getPassword(){
        return $this->password;
    }

    function setPassword($password){
        $this->password = $password;
    }

	function __construct() {
        $this->host = 'sql.neit.edu';
        $this->port = '4500';
        $this->dbName = 'SE414_GroupProject';
        $this->user = 'SE414_GroupProject';
        $this->password = '1234567890';
    }

    // getDBConnection this function connects you to the $db
    public function getDbSql() {
        if ( null != $this->db ) {
            return $this->db;
        }
        try {
            $this->db = new PDO('sqlsrv:server='.$this->getHost().','.$this->getPort().';Database='.$this->getDbName(), $this->getUser(), $this->getPassword());
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch (Exception $ex) {
            $this->closeDB();
            throw new Exception('DB ERROR');
        }
        return $this->db;
    }

    public function closeDB() {
        $this->db = null;
    }


    //Please use this 1 of three ways.
    //I made this to make sql easier with php.
    //1. sql($sql);
    //this way will return info from the sql.

    //2. sql($sql,$vars);
    //this way will return the vars must be in array like so.
    /*			array(
			    	":nameinSql" => $value,
			    	":otherNameinsql" => $value2
			    	);
	*/

    //3. sql($sql,$vars,$bool);
	//this way should only be used when you do not want to return info.
	//the $bool can be true or false as it defaults true only use this when its false otherwise use 2
    function sql(){
        $sql = '';
        $binds = array();
        $return = true;
        switch(func_num_args()){
            case 1:
                $sql = func_get_args(0)[0];
                break;
            case 2:
                $sql = func_get_args(0)[0];
                $binds = func_get_args(1)[1];
                break;
            case 3:
                $sql = func_get_args(0)[0];
                $binds = func_get_args(1)[1];
                $return = func_get_args(2)[0];
                break;
            default:
                throw new Exception("Arguments Invaild");
        }
        if($return != true && $return != false){
            throw new Exception('Execute Error :bool incorrect');
        }


		$this->getDbSql();
		$sql = $this->db->prepare($sql);

		if($binds != null){
			if ($sql->execute($binds)) {
		    	if($return){
		    		$this->closeDB();
		    		$data = $sql->fetchAll();
		    		return $data;
		    	}
		    }
		    else{
		    	$this->closeDB();
		    	throw new Exception('Execute Error :make sure your sql is correct');
		    }
		}
		else{
		if ($sql->execute()) {
		    	if($return){
		    		$this->closeDB();
                    $data = $sql->fetchAll();
                    return $data;
		    	}
		    }
		    else{
		    	$this->closeDB();
		    	throw new Exception('Execute Error :make sure your sql is correct');
		    }
		}
	}

}

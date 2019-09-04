<?php


// Database Access Object
class Dao {
    private $db = NULL;
    private $connection_string = NULL;
    private $db_type = DB_TYPE;
    private $db_path = DB_PATH;
    private $db_host = DB_HOST;        
    private $db_user = DB_USER;        
    private $db_pass = DB_PASS;        
    private $db_name = DB_NAME;        
    private $con = false;
 
    public function __construct()
    {
        $this->db_host = BD_HOST;
        $this->db_user = BD_USER;
        $this->db_pass = BD_PASSWORD;
        $this->db_name = BD_NAME;
        $this->db_type = BD_TYPE;
 
        switch($this->db_type){
            case "mysql":
            $this->connection_string = "mysql:host=".BD_HOST.";dbname=".BD_NAME;
            break;

        }
        return $this;
    }
 
    public function connect() {
        if(!$this->con) {
            try {
                $this->db = new PDO($this->connection_string,$this->db_user, $this->db_pass);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db -> exec("SET CHARACTER SET utf8");
                $this->con = true;
                return $this->con;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            return true;
        }
    }
 
    public function disconnect() {
        if($this->con) {
            unset($this->db);$this->con = false;
            return true;
        }
    }
    
    /**
    $db = new dao('username','password','database');
    $db->connect();
    if ($db->connect()) {
      echo "tersambung dengan database";
    } else {
      echo "gagal tersambung"
    $db->disconnect(); // kalau mau disconnect
    **/
    
    // SELECT
    public function select($table, $rows = '*', $where = null, $order = null,$ver=false) {
        
            $q = 'SELECT '.$rows.' FROM '.$table;
            if($where != null)
                $q .= ' WHERE '.$where;
            if($order != null)
                $q .= ' ORDER BY '.$order;
            $this->numResults = null;
            try {
                $sql = $this->db->prepare($q);
                if($ver){
                   // print_r($q);
                }
                $sql->execute();
                $this->result = $sql->fetchAll(PDO::FETCH_ASSOC);
                $this->numResults = count($this->result);
                $this->numResults === 0 ? $this->result = null : true ;
                return true;
            } catch (PDOException $e) {
                return $e->getMessage().''.$e->getTraceAsString().''; 
            } 
        
    }
    // SELECT
    public function selectRet($table, $rows = '*', $where = null, $order = null,$ver=false) {

            $q = 'SELECT '.$rows.' FROM '.$table;
            if($where != null)
                $q .= ' WHERE '.$where;
            if($order != null)
                $q .= ' ORDER BY '.$order;
            $this->numResults = null;
            try {
                $sql = $this->db->prepare($q);
                if($ver){
                   // print_r($q);
                }
                $sql->execute();
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return $e->getMessage().''.$e->getTraceAsString().'';
            }

    }
    // SELECT
    public function query($q,$ver = false) {

            $this->numResults = null;
            try {
                $sql = $this->db->prepare($q);
                if($ver){
                    //print_r($q);
                }
                $sql->execute();
                $this->result = $sql->fetchAll(PDO::FETCH_ASSOC);
                $this->numResults = count($this->result);
                $this->numResults === 0 ? $this->result = null : true ;
                return true;
            } catch (PDOException $e) {
                return $e->getMessage().''.$e->getTraceAsString().'';
            }

    }
    public function queryRet($q,$ver = false) {

            $this->numResults = null;
            try {
                $sql = $this->db->prepare($q);
                if($ver){
                    //print_r($q);
                }
                $sql->execute();
                $this->result = $sql->fetchAll(PDO::FETCH_ASSOC);
                $this->numResults = count($this->result);
                $this->numResults === 0 ? $this->result = null : true ;
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return $e->getMessage().''.$e->getTraceAsString().'';
            }

    }
    
    public function getResult(){
        return $this->result?$this->result:null;
    }
    
    /**
    $result = $db->select('users');
    if ($result === true){
        echo "result select ";
        print_r($db->getResult());
    } else {
        var_dump($result);
    }
    **/
    
    // INSERT
    public function insert ($table,$values,$rows = null) {
        $insert = 'INSERT INTO '.$table;
        if($rows != null) {
            $insert .= ' ('.$rows.')';
        }
     
        for($i = 0; $i < count($values); $i++) {
            if(is_string($values[$i]))
                $values[$i] = '"'.$values[$i].'"';
        }
     
        $values = implode(',',$values);
        $insert .= ' VALUES ('.$values.')';
        //print_r($insert);
        try {

            $ins = $this->db->prepare($insert);
            $ins->execute();
            return $this->db->lastInsertId();

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    // INSERT
    public function update ($table,$values,$rows = null,$where,$ver = false) {
        $insert = 'UPDATE '.$table." SET ";


        for($i = 0; $i < count($values); $i++) {
            if(is_string($values[$i]))
                $insert.= $rows[$i]."='".$values[$i]."' ";
            if($i < count($values)-1){
                $insert .= ",  ";
            }
        }


        $insert .= "WHERE ".$where;

       // print_r($insert);
        if($ver){
            //print_r($insert);
        }
        try {

            $ins = $this->db->prepare($insert);

            $ins->execute();
            return true;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
    /**
    $result = $db->insert("user", array("","test123","test","0"), "id,username,password,active");
    **/
    
}
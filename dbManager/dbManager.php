<?php
/**
 * Created by PhpStorm.
 * User: Sameera
 * Date: 1/23/2018
 * Time: 9:49 PM
 */

class DbManager
{
    var $servername = "localhost";
    var $username = "root";
    var $password = "";
    var $dbname = "udaya";

    function save($sql)
    {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec($sql);
            $conn = null;
            return "New record created successfully";
        } catch (PDOException $e) {
            $conn = null;
            die($sql . "<br>" . $e->getMessage());
        }
    }

    function select($sql){
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $data = [];
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
                $data[$k] = $v;
            }
            $conn = null;
            return $data;
        }
        catch(PDOException $e) {
            $conn = null;
            die("Error: " . $e->getMessage());
        }
    }

    function update($sql){
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $conn = null;
            return $stmt->rowCount() . " records UPDATED successfully";
        }
        catch(PDOException $e)
        {
            $conn = null;
            die( $sql . "<br>" . $e->getMessage());
        }
    }

    function delete($sql){

        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec($sql);
            $conn = null;
            return "Record deleted successfully";
        }
        catch(PDOException $e)
        {
            $conn = null;
            die( $sql . "<br>" . $e->getMessage());
        }
    }
}




//$sql = "INSERT INTO `items` (`id`, `code`, `description`) VALUES (NULL, 'ddfgh', 'hhh');";
//$DbManager = new DbManager();
//echo $DbManager->save($sql);

//$sql = "SELECT * FROM items";
//$DbManager = new DbManager();
//var_dump($DbManager->select($sql));

//$sql = "UPDATE items SET code='haUUha' WHERE id=2";
//$DbManager = new DbManager();
//var_dump($DbManager->update($sql));


//$sql = "DELETE FROM items WHERE id=1";
//$DbManager = new DbManager();
//var_dump($DbManager->delete($sql));
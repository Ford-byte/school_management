<?php
require_once("../Connection/Dbconnect.php");

class facultyModel
{
    private $dbCon;
    private $con;
    public function __construct()
    {
        try {
            $this->dbCon = new Database();
            $this->con = $this->dbCon->GetDbconfig();
        } catch (PDOException $exception) {
            echo "Error Dbconnection connection:" . $exception->getMessage();
        }
    }

    public function All($procedure)
    {
        try {
            $sql = "CALL $procedure";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error executing stored procedure: " . $e->getMessage());
        }
    }

    public function Auth($procedure, $data)
    {
        try {
            $placeholders = implode(',', array_map(fn($key) => ":$key", array_keys($data)));
            $sql = "CALL $procedure($placeholders)";
            
            $stmt = $this->con->prepare($sql);
    
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
    
            $stmt->execute();
    
            return $stmt->fetch(PDO::FETCH_ASSOC);  
        } catch (PDOException $e) {
            throw new Exception("Error executing stored procedure: " . $e->getMessage());
        }
    }
    

    public function create($procedure, $data)
    {
        try {
            $placeholders = implode(',', array_map(fn($key) => ":$key", array_keys($data)));
            $sql = "CALL $procedure($placeholders)";

            $stmt = $this->con->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Error executing stored procedure: " . $e->getMessage());
        }
    }

    public function update($procedure, $data)
    {
        try {
            $placeholders = implode(',', array_map(fn($key) => ":$key", array_keys($data)));
            $sql = "CALL $procedure($placeholders)";
            $stmt = $this->con->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Error executing stored procedure: " . $e->getMessage());
        }
    }

    public function destroy($procedure, $id)
    {
        $placeholder = ":" . $id;
        $sql = "CALL $procedure($placeholder)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue($placeholder, $id);
        $stmt->execute();
        return $stmt;
    }
   
    
}

<?php


class Contact extends Database
{

    public function getAll()
    {

        $query = "SELECT * FROM contact";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }



    public function create($input = [])
    {

        if ($this->getAll()->rowCount() > 0) {
            $this->delete();
        }

        $query = "INSERT INTO 
                    contact(id, 
                    phone,
                    email,
                    location)
                    VALUES(NULL,:phone,:email,:location)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":phone", $input["phone"]);
        $stmt->bindParam(":location", $input["location"]);
        $stmt->bindParam(":email", $input["email"]);
 

        // execute query
        return $stmt->execute();
    }


    public function update($input = [])
    {
        $query = "UPDATE contact 
        SET phone=:phone,
        location=:location,
        email=:email        ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":phone", $input["phone"]);
        $stmt->bindParam(":location", $input["location"]);
        $stmt->bindParam(":email", $input["email"]);
 
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete()
    {
        $query = "delete FROM contact";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}

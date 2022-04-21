<?php


class UserMessage extends Database
{

    public function getAll()
    {

        $query = "SELECT * FROM user_message";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getBy($id)
    {

        $query = "SELECT * FROM user_message WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function create($input = [])
    {

        $query = "INSERT INTO user_message
        (id, name, email, message)
         VALUES (NULL,:name,:email,:message)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);
        $stmt->bindParam(":message", $input["message"]);
        $stmt->bindParam(":email", $input["email"]);


        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function delete($id)
    {
        $query = "delete FROM user_message where id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}

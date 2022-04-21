<?php


class MonthSpecials extends Database
{

    public function getAll($limit = 10)
    {

        $query = "SELECT * FROM month_specials";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getBy($id)
    {
        $query = "SELECT * FROM month_specials WHERE id=? ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function create($input = [])
    {
        $query = "INSERT INTO month_specials values(NULL,:title,:sub_title,:price,:path)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $input["title"]);
        $stmt->bindParam(":path", $input["path"]);
        $stmt->bindParam(":sub_title", $input["sub_title"]);
        $stmt->bindParam(":price", $input["price"]);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function update($input = [], $id)
    {
        $query = "UPDATE month_specials SET title=:title, sub_title=:sub_title, 
        price=:price, path=:path WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $input["title"]);
        $stmt->bindParam(":path", $input["path"]);
        $stmt->bindParam(":sub_title", $input["sub_title"]);
        $stmt->bindParam(":price", $input["price"]);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }



    public function delete($id)
    {
        $query = "delete FROM month_specials where id=?";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}

<?php

require_once ('db/Database.php');

class user extends Database
{

    /* Properties */
    private $conn;
    /* Get database access */
    public

    function __construct()
    {
        $this->conn = new Database();
        $this->conn = $this->conn->getmyDB();
    }

    public function read()
    {
         // Query
        $query = $this->conn->prepare("SELECT * FROM users ");
        if($query->execute()) {
            return $query->fetchAll();
        }
    }

    public function create($columns)
    {
        // Prepare query
        $query = "INSERT INTO users SET ";

        $i  = 1;
        $length = count($columns);
        // Loop column (as associative array, with key value pairs) into the query (Dynamic query)
        foreach($columns as $key => $value) {

            // Append column with name and value to query
            $query .= '' . $key . '=' . $this->columnTypeValidate($value);

            // Add comma to query if it isn't the last item
            $i < $length ? $query .= ', ' : $query .= '';

            // increase iterator with one
            $i++;
        } // end loop

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Execute query
        // Validate is INSERT has been successful, if so return true
        if($stmt->execute()) {
            return true;
        }
    }

    public function update($id, $columns)
    {
        // Create query
        $query = "UPDATE users SET ";

        $i = 1;// start at one

        $length = count($columns);  // get the length of the columns in the database of the given table
        foreach($columns as $key => $value) {
            // Check if $value is numeric or just a string value (see columnValidate method)
            $query .= '' . $key . "=" . $this->columnTypeValidate($value);

            // Add a comma if it isn't the last item
            $i < $length ? $query .= ", " : $query .= "";
            // Increase i by 1
            $i++;
        }
        $query .= " WHERE id = {$id}";

        var_dump($query);
        // Prepare and execute query
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()) {
            // Validate if update has been successful
            if($stmt->rowCount() > 0) {
                return true;
            }
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = {$id}";

        // Prepare query
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute()) {
            return true;
        }
    }


    /**
     * columnTypeValidate()
     * is a private method to check which data type is used. For strings add quotes around the $columnValue. However, for a numeric $columnValue none quotes are added.
     * @param $columnValue is the column value.
     * @return the modified column value with or without quotes.
     */
    public function columnTypeValidate($columnValue) {
        return is_numeric($columnValue) == true ? $columnValue . ' ' : "'{$columnValue}' ";
    }

}

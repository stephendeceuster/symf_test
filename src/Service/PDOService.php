<?php

namespace App\Service;


class PDOService
{
    private $conn;
    
    function CreateConnection()
    {
        // Create and check connection
        try {
            $this->conn = new \PDO("mysql:host=127.0.0.1;dbname=afspraken", "root", "steven123", array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function GetData( $sql )
    {
        $this->CreateConnection();

        //define and execute query
        $result = $this->conn->query( $sql );

        //show result (if there is any)
        if ( $result->rowCount() > 0 )
        {
            //$rows = $result->fetchAll(PDO::FETCH_ASSOC); //geeft array zoals ['lan_id'] => 1, ...
            //$rows = $result->fetchAll(PDO::FETCH_NUM); //geeft array zoals [0] => 1, ...
            $rows = $result->fetchAll(\PDO::FETCH_BOTH); //geeft array zoals [0] => 1, ['lan_id'] => 1, ...
            //var_dump($rows);
            return $rows;
        }
        else
        {
            return [];
        }
    }

    function ExecuteSQL( $sql )
    {
        $this->CreateConnection();

        //define and execute query
        $result = $this->conn->query( $sql );

        return $result;
    }
}
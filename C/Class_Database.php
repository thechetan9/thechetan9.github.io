<?php
    class Database 
    {
        private static $conn;
        private final function  __construct() 
        { }

        private static function makeConnection() 
        {
            $db         = 'test';
            $server     = 'localhost';
            $user       = 'root';
            $password   = '';
            
            try 
            {
                Database::$conn = new PDO("mysql:host=".$server."; dbname=".$db, $user, $password);
            } 
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public static function select($table, $column = [], $where = "") 
        {
            Database::makeConnection();
            $column_list    = "";
            
            if(!empty($column)) {
                foreach($column as $col) 
                {
                    $column_list .= "`$col`, ";
                }
                
                $column_list = trim($column_list, ", ");
            } 
            else 
            {
                $column_list = "*";
            }

            if($where === "") 
            {
                $where = "1 = 1";
            }

            $sql = "SELECT $column_list FROM $table WHERE $where";
            $sql_stmt = Database::$conn->prepare($sql);
            $sql_stmt->execute();
            // echo"111111";
            // print_r($sql_stmt);
            $result = $sql_stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public static function select_sql($sql) 
        {
            Database::makeConnection();
            $sql_stmt = Database::$conn->prepare($sql);
            $sql_stmt->execute();
            // print_r($sql_stmt);
            $result = $sql_stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public static function update($table, $column = [], $where)
        {
            Database::makeConnection();
            $column_list    = "";

            if(!empty($column)) 
            {
                foreach($column as $col => $val) 
                {
                    $column_list .= "$col = '$val', ";
                }

                $column_list = trim($column_list, ", ") . ", updated_date = NOW()";
            }

            if($where === "") 
            {
                $where = "1 = 1";
            }

            $sql = "UPDATE $table SET $column_list WHERE $where";

            $sql_stmt = Database::$conn->prepare($sql);
            // print_r($sql_stmt);
            return ($sql_stmt->execute());
        }

        public static function insert($table, $column = []) 
        {
            Database::makeConnection();
            $col_list    = "";
            $val_list    = "";

            if(!empty($column)) {
                foreach($column as $col => $val) {
                    $col_list .= "`$col`, ";
                    $val_list .= "'$val', ";
                }
                
                $col_list = $col_list . "created_date, updated_date";
                $val_list = $val_list . "NOW(), NOW()";
            }

            $sql = "INSERT INTO $table ($col_list) VALUES ($val_list)";

            $sql_stmt = Database::$conn->prepare($sql);
            // print_r($sql_stmt);
            return ($sql_stmt->execute());
        }
    }
?>

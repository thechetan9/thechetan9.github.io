<?php
    class Manufacturer 
    {
        private $table = 'manufacturer';

        public function select() 
        { }
        public function selectAll()
        {

            $result = Database::select($this->table, ["manufacturer_id", "manufacturer_name"]);
            return $result;
        }

        public function insert($columns = []) 
        {
            $result = Database::select($this->table, ["manufacturer_name"], "manufacturer_name = '$columns[manufacturer_name]'");
            
            if(count($result) > 0) 
            {
                return "Duplicate";
            }

            $result = Database::insert($this->table, $columns);
            if($result) 
            {
                return "Success";
            } 
            else 
            {
                return "Failure";
            }
        }
    }
?>
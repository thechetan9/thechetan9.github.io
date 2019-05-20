<?php

    class Model 
    {
        private $table = 'model';

        public function select() 
        { }
        public function selectAll()
        {
            $result = Database::select($this->table);
            return $result;
        }

        public function insert($columns = []) 
        {
            // $result = Database::select($this->table);
            
            // if(count($result) > 0) 
            // {
            //     return "Duplicate";
            // }

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

        public function soldOut($id) 
        {
            $result = Database::update($this->table, ["model_count" => 0], "manufacturer_id = $id");
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
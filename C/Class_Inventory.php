<?php
    class Inventory 
    {
        public function select($id) 
        {
            // SELECT `manufacturer_id`, `manufacturer_name`, `created_date`, `updated_date` FROM `manufacturer` WHERE 1

            // SELECT `manufacturer_id`, `model_name`, `model_color`, `model_year`, `registration_number`, `model_note`, `model_count`, `model_imgPath_1`, `model_imgPath_2`, `created_date`, `updated_date` FROM `model` WHERE 1

            $sql = "SELECT m.manufacturer_id AS id, m.model_name AS model_name, 
                            mf.manufacturer_name AS manufacturer_name, m.model_color AS color, m.model_year, m.registration_number, m.model_note, m.model_imgPath_1, m.model_imgPath_2, m.model_count AS count 
                            FROM manufacturer mf LEFT JOIN model m ON mf.manufacturer_id = m.manufacturer_id 
                            WHERE m.manufacturer_id = $id";
            $result = Database::select_sql($sql);
            return $result;
        }

        public function selectAll()
        {
            $sql = "SELECT m.manufacturer_id AS id, m.model_name AS model_name, 
                            mf.manufacturer_name AS manufacturer_name, 
                            IF(m.model_count = NULL OR m.model_count = '0', 'Sold Out', m.model_count) AS count 
                            FROM model m INNER JOIN manufacturer mf ON mf.manufacturer_id = m.manufacturer_id";
            $result = Database::select_sql($sql);
            return $result;
        }

        public function insert($columns = []) {

            $result = Database::insert($this->table, $columns);
            if($result) {
                return "Success";
            } else {
                return "Failure";
            }
        }
    }
?>
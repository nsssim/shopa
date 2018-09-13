<?php
class clock_mdl extends CI_Model
{
       
        public function get_products()
        {
        $qry_str = "SELECT * from products";
        $q = $this->db->query($qry_str);
        return $q->result();            
        }
}


?>



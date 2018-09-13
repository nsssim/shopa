<?php
class currency_mdl extends CI_Model
{
       
        public function get_currency_details($currency_id)
        {
        $qry_str = 'SELECT
					*
					FROM `currencies`
					WHERE
					currencies.id = '.$currency_id;
					
        $q = $this->db->query($qry_str);
        return $q->result();            
        }
        
        // update_db_currency_rate
        /*
        currencies_table
        +-----+---------------+----------+--------------+------+-------+--------+----------+-----------------+---------+--------+
		| id  | name          | iso_code | iso_code_num | sign | blank | format | decimals | conversion_rate | deleted | active |
		+-----+---------------+----------+--------------+------+-------+--------+----------+-----------------+---------+--------+
		|   8 | Lek           | ALL      |            8 |      |     0 |      0 |        1 | 0               |       0 |      0 |
		| 643 | Russian Ruble | RUB      |          643 | ₽    |     0 |      0 |        1 | 66              |       0 |      1 |
		| 840 | US Dollar     | USD      |          840 | $    |     0 |      0 |        1 | 1               |       0 |      1 |
		| 949 | Turkish Lira  | TRY      |          949 | TL   |     0 |      0 |        1 | 2               |       0 |      1 |
		| 978 | Euro          | EUR      |          978 | €    |     0 |      0 |        1 | 0.7             |       0 |      1 |
		+-----+---------------+----------+--------------+------+-------+--------+----------+-----------------+---------+--------+
        */
        
        public function update_db_currency_rate($rates)
        {
	        // update Turkish Lira rate
	        $qry_str = 'UPDATE  `currencies` SET
	        				conversion_rate ="'.$rates["TRY"].'",
	        				last_update = NOW()
	        			WHERE
	        					`id`= 949';
	        $q = $this->db->query($qry_str);
	        
	        // update Euro rate
	        $qry_str = 'UPDATE  `currencies` SET
	        				conversion_rate ="'.$rates["EUR"].'",
	        				last_update = NOW()
	        			WHERE
	        					`id`= 978';
	        $q = $this->db->query($qry_str);
	        
	        // update Russian Ruble rate
	        $qry_str = 'UPDATE  `currencies` SET
	        				conversion_rate ="'.$rates["RUB"].'",
	        				last_update = NOW()
	        			WHERE
	        					`id`= 643';
	        $q = $this->db->query($qry_str);
	        
	        return 0;            
        }
        
        public function get_timediff()
        {
			$qry_str= 'SELECT TIMEDIFF(NOW(), UTC_TIMESTAMP) AS timediff;';
			$q = $this->db->query($qry_str);
			$timediff = $q->result();
        	return $timediff[0]; 
		}
        
        
}


?>
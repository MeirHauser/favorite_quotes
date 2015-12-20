<?php
    class Quote extends CI_Model {

         function add_quote($quote_info)
         {
             $posted_by = $this->session->userdata('user_id');
             $query = "INSERT INTO quotes (quote, posted_by, quoted_by, created_at, updated_at) VALUES (?,?,?,?,?)";
             $values = array($quote_info['quote'], $posted_by, $quote_info['quoted_by'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s")); 
             $this->db->query($query, $values);
         }
    }
?>
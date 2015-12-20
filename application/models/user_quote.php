<?php
    class User_quote extends CI_Model {

         function get_user_quotes_by_user_id($user_id)
         {
            return $this->db->query("SELECT users2.alias as posted_by, user_quotes.id, quotes.quote, quotes.quoted_by, quotes.id AS quote_id FROM quotes
                                     LEFT JOIN user_quotes
                                     ON quotes.id = user_quotes.quote_id
                                     LEFT JOIN users
                                     ON user_quotes.user_id = users.id
                                     LEFT JOIN users AS users2
                                     ON quotes.posted_by = users2.id
                                     WHERE users.id = ?", array($user_id))->result_array();
         }
         function get_all_quotes_except_user($user_id)
         {
            return $this->db->query("SELECT users2.alias as posted_by, user_quotes.id, quotes.quote, quotes.quoted_by, quotes.id AS quote_id FROM quotes
                                     LEFT JOIN user_quotes
                                     ON quotes.id = user_quotes.quote_id
                                     LEFT JOIN users
                                     ON user_quotes.user_id = users.id
                                     LEFT JOIN users AS users2
                                     ON quotes.posted_by = users2.id
                                     Where quotes.id NOT IN (

                                     SELECT quotes.id FROM quotes
                                     LEFT JOIN user_quotes
                                     ON quotes.id = user_quotes.quote_id
                                     LEFT JOIN users
                                     ON user_quotes.user_id = users.id
                                     WHERE users.id = $user_id

                                     )GROUP BY quotes.id")->result_array();
         }
         function add_to_favorites($quote_id)
         {
             $user_id = $this->session->userdata('user_id');
             $query = "INSERT INTO user_quotes (quote_id, user_id, created_at, updated_at) VALUES (?,?,?,?)";
             $values = array($quote_id, $user_id, date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s")); 
             $this->db->query($query, $values);
         }
         function remove($users_quote_id)
         {
            return $this->db->query("DELETE FROM user_quotes
                                     WHERE id = ?", array($users_quote_id));
         }
    }
?>
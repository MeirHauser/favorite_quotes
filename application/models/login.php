<?php
    class Login extends CI_Model {
         function get_all_users()
         {
             return $this->db->query("SELECT * FROM users")->result_array();
         }
         function get_user_by_id($user_id)
         {
             return $this->db->query("SELECT * FROM users WHERE id = ?", array($user_id))->row_array();
         }
         function get_user_by_email($email)
         {
             return $this->db->query("SELECT name, alias, id, password, email FROM users WHERE email = ?", array($email))->row_array();
         }
         function add_user($user)
         {
             $query = "INSERT INTO users (name, alias, email, password, birthday, created_at, updated_at) VALUES (?,?,?,?,?,?,?)";
             $values = array($user['name'], $user['alias'], $user['email'], $user['password'], $user['birthday'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s")); 
             return $this->db->query($query, $values);
         }
    }
?>
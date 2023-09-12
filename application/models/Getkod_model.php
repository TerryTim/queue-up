<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getkod_model extends CI_Model {

     function get_kodjad(){
        $q = $this->db->query("SELECT MAX(RIGHT(id_timetable,3)) AS id_max FROM tbl_timetable");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%04s", $tmp);
            }
        }else{
            $id = "001";
        }
        return "J".$id;
    }
    function get_kodtuj(){
        $q = $this->db->query("SELECT MAX(RIGHT(id_destination,3)) AS id_max FROM tbl_destination");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%03s", $tmp);
            }
        }else{
            $id = "001";
        }
        return "TJ".$id;
    }
    function get_kodbus(){
        $q = $this->db->query("SELECT MAX(RIGHT(id_bus,3)) AS id_max FROM tbl_bus");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%03s", $tmp);
            }
        }else{
            $id = "001";
        }
        return "B".$id;
    }
    function get_kodtmporder(){
        $q = $this->db->query("SELECT MAX(RIGHT(id_order,3)) AS id_max FROM tbl_order");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%05s", $tmp);
            }
        }else{
            $id = "001";
        }
        return "ORD".$id;
    }
    function get_kodpel(){
        $q = $this->db->query("SELECT MAX(RIGHT(id_customer,3)) AS id_max FROM customer");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%04s", $tmp);
            }
        }else{
            $id = "00001";
        }
        return "CA".$id;
    }
    function get_kodkon(){
        $q = $this->db->query("SELECT MAX(RIGHT(id_confirmation,3)) AS id_max FROM tbl_confirmation");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%04s", $tmp);
            }
        }else{
            $id = "00001";
        }
        return "KF".$id;
    } 

    function get_kodadm(){
        $q = $this->db->query("SELECT MAX(RIGHT(id_admin,3)) AS id_max FROM tbl_admin");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%04s", $tmp);
            }
        }else{
            $id = "00001";
        }
        return "ADM".$id;
    }

    function get_kodbank(){
        $q = $this->db->query("SELECT MAX(RIGHT(id_bank,3)) AS id_max FROM tbl_bank");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%04s", $tmp);
            }
        }else{
            $id = "00001";
        }
        return "BNK".$id;
    }

    function getUserInfo($id) {
        $this->db->where('id_customer', $id);
        $query = $this->db->get('customers');
        return $query->row();
    }
    
    function get_id_product(){
        $q = $this->db->query("SELECT MAX(RIGHT(product_id,3)) AS id_max FROM products");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%04s", $tmp);
            }
        }else{
            $id = "001";
        }
        return "P".$id;
    }

    function get_id_order(){
        $q = $this->db->query("SELECT MAX(RIGHT(order_id,3)) AS id_max FROM orders");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%04s", $tmp);
            }
        }else{
            $id = "001";
        }
        return "ODR".$id;
    }

    function get_entrepreneur_id(){
        $q = $this->db->query("SELECT MAX(RIGHT(entrepreneur_id,3)) AS id_max FROM entrepreneurs");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%04s", $tmp);
            }
        }else{
            $id = "0001";
        }
        return "EN".$id;
    }

    function get_rating_id(){
        $q = $this->db->query("SELECT MAX(RIGHT(rating_id,3)) AS id_max FROM ratings");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%04s", $tmp);
            }
        }else{
            $id = "0001";
        }
        return "RT".$id;
    }

    function get_id_chat(){
        $q = $this->db->query("SELECT MAX(RIGHT(chat_id,3)) AS id_max FROM chats");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%04s", $tmp);
            }
        }else{
            $id = "0001";
        }
        return "CHAT".$id;
    }

    function get_id_category(){
        $q = $this->db->query("SELECT MAX(RIGHT(category_id,3)) AS id_max FROM categories");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%03s", $tmp);
            }
        }else{
            $id = "0001";
        }
        return "CAT".$id;
    }

    function get_id_parcel_delivery_company(){
        $q = $this->db->query("SELECT MAX(RIGHT(company_id,3)) AS id_max FROM parcel_delivery_companies");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%03s", $tmp);
            }
        }else{
            $id = "001";
        }
        return "PDC".$id;
    }
}

/* End of file getkod_model.php */
/* Location: ./application/models/getkod_model.php */
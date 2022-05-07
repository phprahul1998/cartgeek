<?php
 class Product_model extends CI_Model  
 {  
      var $table = "products";  
      var $select_column = array("id", "product_name", "product_price", "product_desccription");  
      var $order_column = array(null, "product_name", "product_price", null, null);  
      function make_query()  
      {  
           $this->db->select($this->select_column);  
           $this->db->from($this->table);  
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("product_name", $_POST["search"]["value"]);  
                $this->db->or_like("product_price", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('id', 'DESC');  
           }  
      }  
      function create_datatables(){  
           $this->make_query();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data(){  
           $this->make_query();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table);  
           return $this->db->count_all_results();  
      }  

      function insertProduct($data){
    $this->db->insert('products', $data);

    return   $this->db->insert_id();
      }
      function getUpdateproduct($product_id){
            $this->db->select("*");  
           $this->db->from($this->table);  
           $this->db->where('id',$product_id);  
             $query = $this->db->get();  
           return $query->row_array();  
      }
    function  updateProductDetails($productArr,$product_id){
      $this->db->where('id', $product_id);
            return $this->db->update('products', $productArr);
    }

    function getproduct_img($product_id){
            $this->db->select("*");  
           $this->db->from('product_img');  
           $this->db->where('product_id',$product_id);  
             $query = $this->db->get();  
           return $query->result_array();  
      }
      function delProduct($id){
           $this->db->where('id', $id);
   return $this->db->delete('products');
      }

    
 }  


?>
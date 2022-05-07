<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
public function __construct(){

     parent::__construct();

     // Load model
     $this->load->model('product_model','product');
    }

	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function add_product(){

		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_desccription = $_POST['product_desc'];
		$productArr = array(
			'product_name'=>$product_name,
			'product_price'=>$product_price,
			'product_desccription'=>$product_desccription,

		);
		$get_id = $this->product->insertProduct($productArr);  
		$countfiles = count($_FILES['product_img']['name']);
  
        for($i=0;$i<$countfiles;$i++){
        if(!empty($_FILES['product_img']['name'][$i])){
  
          // Define new $_FILES array - $_FILES['file']
          $_FILES['file']['name'] = $_FILES['product_img']['name'][$i];
          $_FILES['file']['type'] = $_FILES['product_img']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['product_img']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['product_img']['error'][$i];
          $_FILES['file']['size'] = $_FILES['product_img']['size'][$i];
 
          // Set preference
          $config['upload_path'] = './uploads/'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '5000'; // max_size in kb
          $config['file_name'] = $_FILES['product_img']['name'][$i];
  
          //Load upload library
          $this->load->library('upload',$config); 
          $arr = array('msg' => 'something went wrong !', 'success' => false);
          // File upload
          if($this->upload->do_upload('file')){
           
           $data = $this->upload->data(); 
           $insert['product_image'] = $data['file_name'];
           $insert['product_id'] = $get_id;

           $this->db->insert('product_img',$insert);
           $get = $this->db->insert_id();
          $arr = array('msg' => 'Products has been uploaded successfully', 'success' => true);
 
          }
        }
  
      }
      echo json_encode($arr);
	}
}

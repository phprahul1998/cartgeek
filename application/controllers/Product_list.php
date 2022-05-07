<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_list extends CI_Controller {

	public function __construct(){

     parent::__construct();

     // Load model
     $this->load->model('product_model','product');
    }

	public function index()
	{
		$this->load->view('prduct_list');
	}
	public function product_data(){
           $fetch_data = $this->product->create_datatables();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
               
                $sub_array[] = $row->product_name;  
                $sub_array[] = $row->product_price; 
                $sub_array[] = $row->product_desccription; 
                 // $sub_array[] = '<img src="'.base_url().'upload/'.$row->product_image.'" class="img-thumbnail" width="50" height="35" />';    
                $sub_array[] = '<a  href="'.base_url("product_list/edit_product/".$row->id."").'" id="'.$row->id.'" class="btn btn-warning btn-xs">Update</a>';  
                $sub_array[] = '<button onClick="delfunction('.$row->id.')" type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs">Delete</button>';  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                  =>     intval($_POST["draw"]),  
                "recordsTotal"          =>     $this->product->get_all_data(),  
                "recordsFiltered"       =>     $this->product->get_filtered_data(),  
                "data"                  =>     $data  
           );  
           echo json_encode($output);
	}

	public function edit_product($product_id){
      $product_data['product'] = $this->product->getUpdateproduct($product_id);  
            $product_data['product_img'] = $this->product->getproduct_img($product_id);  
     		$this->load->view('edit_page.php',$product_data);


	}
	public function edit_productDetails(){
		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_desccription = $_POST['product_desc'];
		$product_id = $_POST['product_id'];
		$productArr = array(
			'product_name'=>$product_name,
			'product_price'=>$product_price,
			'product_desccription'=>$product_desccription,

		);
		$getproductdetails = $this->product->updateProductDetails($productArr,$product_id);  
		if($getproductdetails){
			          $arr = array('msg' => 'Products has been updated successfully', 'success' => true);
			                echo json_encode($arr);


		}
	}
	public function deleteproduct($id){
				$getproductdetails = $this->product->delProduct($id);  

	}
}

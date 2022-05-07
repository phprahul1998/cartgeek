<!DOCTYPE html>
<html lang="en">
<head>
  <title>Products</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/style.css') ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  

</head>
<body>

<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-8 login-sec">
		    <h2 class="text-center">Add product</h2>
				<form class="login-form" enctype="multipart/form-data"  id="add_product"  method="post">
				<div class="row">
					<div class="col-md-6 form-group">
				<label for="exampleInputEmail1" class="text-uppercase">Product Name</label>
				<input type="text" required class="form-control" name="product_name" placeholder="">

				</div>
				<div class="col-md-6 form-group">
				<label for="exampleInputPassword1" class="text-uppercase">Product Price</label>
				<input type="number" required  class="form-control" name="product_price" placeholder="">
				</div>
				<div class="col-md-12 form-group">
				<label for="exampleInputPassword1" class="text-uppercase">Product Description</label>
				<textarea class="form-control" required name="product_desc"></textarea>
				</div>
				<div class="col-md-12">
				<label for="exampleInputPassword1" class="text-uppercase">Product Image</label>
				<div class="field_wrapper">
				<div>
				<input style="width:95%" required type="file" class="form-control" name="product_img[]" value=""/>
				<a style="float:right;position: relative;bottom: 34px;width: 5%;"  href="javascript:void(0);" class="add_button" title="Add field"><img width="20" src="https://www.freepnglogos.com/uploads/plus-icon/plus-icon-download-png-and-vector-17.png"/></a>
				</div>
				</div>		
				</div>
				<div class="col-md-12">
                <input id="send"  class="btn btn-sm btn-primary" type="submit" name="send" value="Add product">
                  <a  class="btn btn-success btn-sm ml-3" href="<?= base_url('product_list') ?>">
                    <i class="fa fa-eye"></i> View Product
                </a>
                <br>
                <strong id="message" style="color:red"></strong>
				</div>
				</div>


			

				</form>
		</div>
		<div class="col-md-4 banner-sec">
      
	</div>
</div>
</section>
<style type="text/css">
	.field_wrapper{
		 margin-left:auto;
    margin-right:auto;
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">

            
 $('#add_product').on('submit', function (e) {
 	  $('#message').empty();
e.preventDefault();
var formData = new FormData(this);

$.ajax({
         type: "POST",
         url:'<?= base_url('welcome/add_product') ?>', 
           data: formData,
           cache: false,    
            contentType: false,
                processData: false,
         success: 
              function(data){
              	var returnedData = JSON.parse(data);

              $('#message').append(returnedData.msg);

              },
              error:
              function(data){
              	console.log(data);
              }

          });// you have missed this bracket
})

$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input style="width:95%"  required type="file" class="form-control" name="product_img[]" value=""/><a  style="float:right;position: relative;bottom: 34px;width: 5%;"  href="javascript:void(0);" class="remove_button"><img   width="20"  src="https://png.pngtree.com/png-vector/20190419/ourmid/pngtree-vector-minus-icon-png-image_956426.jpg"></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});






</script>
</body>
</html>


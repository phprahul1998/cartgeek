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
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-5 login-sec">
            <h2 class="text-center">Update product</h2>
          
                <form class="login-form" enctype="multipart/form-data"  id="add_product"  method="post">
                <div class="row">
                    <div class="col-md-6 form-group">
                <label for="exampleInputEmail1" class="text-uppercase">Product Name</label>
                <input type="text" required class="form-control" value="<?= $product['product_name'] ?>" name="product_name" placeholder="">

                </div>
                <div class="col-md-6 form-group">
                <label for="" class="text-uppercase">Product Price</label>
                <input type="number" required   value="<?= $product['product_price'] ?>" class="form-control" name="product_price" placeholder="">
                </div>
                <div class="col-md-12 form-group">
                <label for="" class="text-uppercase">Product Description</label>
                <textarea cols="5" rows="7" class="form-control" required name="product_desc"><?= $product['product_desccription'] ?></textarea>
                </div>
               
                <div class="col-md-12">
                <input id="send"  class="btn btn-sm btn-primary" type="submit" name="send" value="Update product">
                  <a class="btn btn-success btn-sm ml-3" href="<?= base_url('product_list') ?>">
                    <i class="fa fa-eye"></i> View Product
                </a>
                <br>
                <strong id="message" style="color:black"></strong>
                </div>
                </div>

                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
            

                </form>
        </div>
        <div class="col-md-7 card">
                        <h4>Product Image</h4>

            <div class="row">
            <?php 
                if(count($product_img) == 0){
                    echo "No image found";
                }else{
                    foreach($product_img as $img){
                ?>
                <div class=" col-md-4">
                    <img style="width: 100%;height: 140px;" src="<?= base_url('uploads/') ?><?= $img['product_image'] ?>">
                </div>
                <?php
               }
 
                }
              
            ?>
        </div>
    </div>
</div>
</section>
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
         url:'<?= base_url('product_list/edit_productDetails') ?>', 
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

          });
})


</script>
</body>
</html>


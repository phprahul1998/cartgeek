<!DOCTYPE html>
<html lang="en">
<head>
  <title>Products</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
 
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
  <style type="text/css">
    .form-inline {
    display: -ms-flexbox;
     display: unset !important; 
    -ms-flex-flow: row wrap;
    flex-flow: row wrap;
    -ms-flex-align: center;
    align-items: center;
}
  </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url(); ?>">CartGeek</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarsExampleDefault">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>">CartGeek</a>
                </li>
               
            </ul>

                
                <a class="btn btn-success btn-sm ml-3" href="<?= base_url('welcome') ?>">
                    <i class="fa fa-plus"></i> Add Product
                </a>
        </div>
    </div>
</nav>
<div class="container-fluid">
  <div class="row">
    <div class="col-10 mx-auto">
      <br>
      <br>
      <table id="product_data" class="table table-striped table-bordered" style="width:100%">

                     <thead>  
                          <tr>  
                               <th >Product Name</th>  
                               <th >Product Price</th>  
                               <th >Product Description</th>  
                               <th >Edit</th>  
                               <th>Delete</th>  
                          </tr>  
                     </thead>  
                </table>  
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript" language="javascript" >  
 $(document).ready(function(){  
      var dataTable = $('#product_data').DataTable({  
           "processing":true,  
           "serverSide":true,  
           "order":[],  
           "ajax":{  
                url:"<?= base_url('product_list/product_data'); ?>",  
                type:"POST"  
           },  
           "columnDefs":[ 
                {  
                     "orderable":false,  
                },  
           ],  
      });  
 });  
 </script>  

<script type="text/javascript">
    function delfunction(id){
        var id = id;
    
       swal({
        title: "Are you sure?",
        text: "You will not be able to recover this Product!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
             url: '<?= base_url('product_list/deleteproduct/') ?>'+id,
             type: 'DELETE',
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
                  
                  swal("Deleted!", "Product has been deleted.", "success");
                         location.reload();


             }
          });
        } else {
          swal("Cancelled", "Product is safe :)", "error");
        }
      });
     
    }
    
</script>
   
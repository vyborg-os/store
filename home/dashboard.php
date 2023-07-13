<?php
include_once('index.php');
include_once('../model/controller.php');
$username = $_SESSION['username'];
$val = getchkAdminUsr($username);
    if($val!=true){
        //session_destroy();
        //header("Location: authorize");
        include_once('authorize.php');
        exit;
    }
?>
<link rel="stylesheet" href="../assets/datatable/datatables.css">
<link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css">
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Dashboard</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>            
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" data-toggle="modal" data-target="#exampleModal">Add Product</a>
                    </div>
                </div>
            </div>

            <div class="row clearfix" >
                <div class="col-lg-12 col-md-12">
                    <div class="card planned_task">
                        <div class="header">
                            <h2>Dashboard</h2>
                            <ul class="header-dropdown dropdown">                                
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body" style="background-color: white;">
							 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="body wizard_validation">
                            <form id="postpd" class="postpro"  method="POST" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                                    <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Product Name" name="productname" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                 <textarea class="form-control" placeholder="Product Description" name="productdescription"></textarea>
                                                
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Product Price" name="productprice" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Product Quantity" name="productquantity" required>
                                            </div>
											</div>
											
											<div class="col-lg-12 col-md-12">
                                                <select class="btn btn-primary form-group" name="productsize">
												<option disabled selected>Select Product size</option>
                                                <option>other</option>
												<option>small</option>
												<option>medium</option>
                                                <option>big</option>
                                                    
												</select>
                                        </div>
                                    </div>
								</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                                           <button type="submit" class="btn btn-round btn-primary"><input type="hidden" name="postpr">Add Product</button>
                                        
                                        </div>
                                    </div>
									</form>
                                </div>
                            </div>
							<p></p>
							     <div class="col-lg-12">
                    <div class="card">
                       <!--  <form id="navbar-search" class="navbar-form search-form" method="POST"  enctype="multipart/form-data">
                    <div class="input-group mb-2" style="width: 30%;">
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                        <div class="input-group-append">
                            <button class="btn btn-primary"><i class="icon-magnifier"></i><input type="hidden" name="searchfor"></button>
                           
                        </div>
                    </div>
                </form> -->
                        <div class="header">
                            <h2>Total Products </h2>
                            <h2 class="pull-right" style="color: red;">Total Estimates (<?php
									$sum = 0;
									$result = fetch_store();
                                    if ($result->num_rows > 0) {
                                       while ($fetch = $result->fetch_assoc()) {
                                           $totl = $fetch['productprice'] * $fetch['productquantity'];
                                           $sum = $sum + $totl;
                                           
                                       }
                                       echo '<span>&#8358</span>'.number_format($sum); 
                                    }?>)</h2>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product ID</th>
                                        <th>Name</th>
										<th>Description</th>
                                        <th>Price</th>
                                        <th>Qty</th>
										<th>Size</th>
										<th>Total-price</th>
										<th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
                                    if(isset($_POST['searchfor'])){
                                    $no = 1;
                                    $search = secure($_POST['search']);
									$result = fetch_prod($search);
                                    if ($result->num_rows > 0) {
                                       while ($fetch = $result->fetch_assoc()) { ?>
									   <tr>
                                        <td scope="row"><?php echo $no++; ?></td>
                                           <td><?php echo $fetch['productid'];?></td>
                                        <td><?php echo $fetch['productname'];?></td>
										<td><?php echo $fetch['productdescription']; ?> </td>
                                        <td><span>&#8358</span><?php echo number_format($fetch['productprice']); ?></td>
										<td><?php echo $fetch['productquantity']; ?></td>
										<td><?php echo $fetch['productsize']; ?></td>
										<td><span>&#8358</span><?php $total = $fetch['productprice'] * $fetch['productquantity'];
                                            echo number_format($total);?></td>
										<td><a class="btn btn-info" title="edit" id="pr<?php echo $fetch['id']; ?>"  data-toggle="modal" data-target="#pr<?php echo $fetch['id']; ?>">edit</a> <a class="del btn btn-danger" title="delete" id="<?php echo $fetch['id']; ?>">X</a></td>
                                           <a href="dashboard" class="btn btn-success">BACK</a>
                                        </tr>
                                     <div class="modal fade" id="pr<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Edit Product</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="body wizard_validation">
                            <form id="editpd" class="editpd" action="<?php $_SERVER['PHP_SELF'];?>" method="POST"  enctype="multipart/form-data">
                                    <div class="row clearfix">
                                        <input type="hidden" name="productid" value="<?php echo $fetch['productid']; ?>">
                                            <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Product Name" name="productname" value="<?php echo $fetch['productname']; ?>" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                 <textarea class="form-control" placeholder="Product Description" name="productdescription"><?php echo $fetch['productdescription']; ?></textarea>
                                                
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Product Price" name="productprice"  value="<?php echo $fetch['productprice']; ?>" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Product Quantity" name="productquantity"  value="<?php echo $fetch['productquantity']; ?>" required>
                                            </div>
											</div>
											
											<div class="col-lg-12 col-md-12">
                                                <select class="btn btn-primary form-group" name="productsize" >
												<option disabled selected>Select Product size</option>
                                                <option selected><?php echo $fetch['productsize']; ?></option>
                                                <option>other</option>
												<option>small</option>
												<option>medium</option>
                                                <option>big</option>
                                                    
												</select>
                                        </div>
                                    </div>
								</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                                           <button type="submit" class="btn btn-round btn-primary"><input type="hidden" name="editpr">Edit Product</button>
                                        
                                        </div>
                                    </div>
									</form>
                                </div>
                            </div>
										<?php
									   }
									}else{
										echo '<tr><td><td>No Record Found!</td></td></tr>
                                        <a href="dashboard" class="btn btn-success">BACK</a>';
                                        
									}
                                    }else{
                                        
                                    
									$no = 1;
									$result = fetch_store();
                                    if ($result->num_rows > 0) {
                                       while ($fetch = $result->fetch_assoc()) { ?>
									   <tr>
                                        <td scope="row"><?php echo $no++; ?></td>
                                           <td><?php echo $fetch['productid'];?></td>
                                        <td><?php echo $fetch['productname'];?></td>
										<td><?php echo $fetch['productdescription']; ?> </td>
                                        <td><span>&#8358</span><?php echo number_format($fetch['productprice']); ?></td>
										<td><?php echo $fetch['productquantity']; ?></td>
										<td><?php echo $fetch['productsize']; ?></td>
										<td><span>&#8358</span><?php $total = $fetch['productprice'] * $fetch['productquantity'];
                                            echo number_format($total);?></td>
										<td><a class="btn btn-info" title="edit" id="pr<?php echo $fetch['id']; ?>"  data-toggle="modal" data-target="#pr<?php echo $fetch['id']; ?>">edit</a> <a class="del btn btn-danger" title="delete" id="<?php echo $fetch['id']; ?>">X</a></td>
                                        </tr>
                                     <div class="modal fade" id="pr<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Edit Product</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="body wizard_validation">
                            <form id="editpd" class="editpd" action="<?php $_SERVER['PHP_SELF'];?>" method="POST"  enctype="multipart/form-data">
                                    <div class="row clearfix">
                                        <input type="hidden" name="productid" value="<?php echo $fetch['productid']; ?>">
                                            <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Product Name" name="productname" value="<?php echo $fetch['productname']; ?>" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                 <textarea class="form-control" placeholder="Product Description" name="productdescription"><?php echo $fetch['productdescription']; ?></textarea>
                                                
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Product Price" name="productprice"  value="<?php echo $fetch['productprice']; ?>" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Product Quantity" name="productquantity"  value="<?php echo $fetch['productquantity']; ?>" required>
                                            </div>
											</div>
											
											<div class="col-lg-12 col-md-12">
                                                <select class="btn btn-primary form-group" name="productsize" >
												<option disabled selected>Select Product size</option>
                                                <option selected><?php echo $fetch['productsize']; ?></option>
                                                <option>other</option>
												<option>small</option>
												<option>medium</option>
                                                <option>big</option>
                                                    
												</select>
                                        </div>
                                    </div>
								</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                                           <button type="submit" class="btn btn-round btn-primary"><input type="hidden" name="editpr">Edit Product</button>
                                        
                                        </div>
                                    </div>
									</form>
                                </div>
                            </div>
										<?php
									   }
									}else{
										echo '<tr><td><td>No data</td></td></tr>';
									}
                                    }
										?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				      
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
</div>
<script src="../assets/vendor/toastr/toastr.js"></script>
<script src="assets/js/jquery.3.3.1.min.js"></script>
<script src="../assets/datatable/datatables.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
        $('#postpd').submit(function(e){
            e.preventDefault()
            var datas = new FormData(this);
            $.ajax({
                url: 'ajaxcall.php',
                method: 'POST',
                data: datas,
                success: function(data){
                    if(data==='Product Added successfully'){
  		            $(function() {
					toastr.options.timeOut = "5000";
					toastr.options.closeButton = true;
					toastr.options.positionClass = 'toast-top-full-width';
					toastr['success'](data);
					setTimeout(function(){
                        location.reload();
                    },1000);

					});
					
				
  					}else{
                    $(function() {
					toastr.options.timeOut = "5000";
					toastr.options.closeButton = true;
					toastr.options.positionClass = 'toast-top-full-width';
					toastr['error'](data);
					
					setTimeout(function(){
                        location.reload();
                    },1000);
					}); 
					
                    }
                    //console.log('error log');
                    console.log(data);
                },
                cache: false,
                contentType: false,
                processData: false
            })
        })
     })
   $(document).ready(function(){
        $('#example').DataTable();
            
        });
     $(document).ready(function(){
        $('.editpd').submit(function(e){
            e.preventDefault()
            var datas = new FormData(this);
            $.ajax({
                url: 'ajaxcall.php',
                method: 'POST',
                data: datas,
                success: function(data){
                    if(data==='Product Updated'){
  		            $(function() {
					toastr.options.timeOut = "5000";
					toastr.options.closeButton = true;
					toastr.options.positionClass = 'toast-top-full-width';
					toastr['success'](data);
					setTimeout(function(){
                        location.reload();
                    },1000);

					});
					
				
  					}else{
                    $(function() {
					toastr.options.timeOut = "5000";
					toastr.options.closeButton = true;
					toastr.options.positionClass = 'toast-top-full-width';
					toastr['error'](data);
					
					setTimeout(function(){
                        location.reload();
                    },1000);
					}); 
					
                    }
                    //console.log('error log');
                    console.log(data);
                },
                cache: false,
                contentType: false,
                processData: false
            })
        })
     })
	 $('.del').click(function(){
                      var del = $(this).attr("id");
                      if(confirm("Are you sure you want to delete?")){
                          $.ajax({
                            url:'ajaxcall.php',
                            method:'POST',
                            data:'del='+del,
                            success:function(data){
                             if(data==='Product Deleted Successfully!'){
                                 $(function() {
								toastr.options.timeOut = "5000";
								toastr.options.closeButton = true;
								toastr.options.positionClass = 'toast-top-full-width';
								toastr['success'](data);
							setTimeout(function(){
							location.reload();
							},1000);

							});
                            }else{
                             $(function() {
							toastr.options.timeOut = "5000";
							toastr.options.closeButton = true;
							toastr.options.positionClass = 'toast-top-full-width';
							toastr['error'](data);
					
							setTimeout(function(){
							location.reload();
							},1000);
							});
                            }
                            },
                            error: function(data){
                            }
                          });
                          
                        }
                    });
			
					
</script>
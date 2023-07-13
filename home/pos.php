<?php
include_once('index.php');
include_once('../model/controller.php');

?>
<link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css">
<link rel="stylesheet" href="../assets/datatable/datatables.css">
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Point of Sale</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">POS</li>
                            </ol>
                        </nav>
                    </div> 
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card planned_task">
                        <div class="header">
                            <h2>Point of Sales</h2>
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
							<p></p>
							     <div class="col-lg-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <h4>CHECKLIST</h4>
                                   <?php if(mysqli_num_rows(fetch_es()) < 1){
    echo'';
}else{ ?>
                                    <form class="delfor"  method="POST"  enctype="multipart/form-data">
                                    <input type="hidden" name="deleteallchk" value="deltrue">
                                    <button class="btn btn-danger pull-right"><input type="hidden" name="delall">Clear checklist</button>
                                    </form>
                                    <?php  } ?>
                                    <tr>
                                        <th>#</th>
                                        <th>Product ID</th>
                                        <th>Name</th>
										<th>Description</th>
                                        <th>Price</th>
                                        <th>Qty</th>
										<th>Size</th>
										<th>Product Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
                                    $no = 1;
                                    $count = 0;
									$result = fetch_escrow();
                                    if ($result->num_rows > 0) {
                                       while ($fetch = $result->fetch_assoc()) { ?>
									   <tr>
                                        <td scope="row"><?php echo $no++; ?></td>
                                           <td><?php echo $fetch['productid'];?></td>
                                        <td><?php echo $fetch['productname'];?></td>
										<td><?php echo $fetch['productdescription']; ?> </td>
                                        <td><span>&#8358</span><?php echo number_format($fetch['productprice']); ?></td>
										<td><?php echo $fetch['qty']; ?></td>
										<td><?php echo $fetch['productsize']; ?></td>
										<td><span>&#8358</span><?php $total = $fetch['productprice'] * $fetch['qty'];
                                            echo number_format($total);?></td>
										<td> <a class="deles btn btn-danger" title="delete" id="<?php echo $fetch['id']; ?>">X</a> </td>
                                        </tr>
										<?php
                                            $count = $count + $total;
									   }
                                        ?>
                                        <tr><td><td><td><td><td><td><td>TOTAL<td><span>&#8358</span><?php echo number_format($count); ?><td>
                                        <form class="psadd" method="POST"  enctype="multipart/form-data">
										<input type="hidden" name="paddfig" value="postruef">
                                        <select name="pmethod" required>
                                            <option disabled selected>Payment Method</option>
                                            <option>Cash</option>
                                            <option>Transfer</option>
                                            <option>POS</option>
                                            <option>Other</option>
                                            </select>
                                        <button class="chkout btn btn-success"><input type="hidden" name="possadd"><i class="icon-check"></i></button>
                                        </form>
                                        </td></td></td></td></td></td></td></td></td></tr>
                                    <?php
									}else{
										echo '<tr><td><td>No Record Found!</td></td></tr>';
                                        
									}
                                    
										?>
                                    
                                </tbody>
                            </table>
                
                        <form id="navbar-search" class="navbar-form search-form"  method="POST"  enctype="multipart/form-data">
                  <!--   <div class="input-group mb-2" style="width: 30%;">
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                        <div class="input-group-append">
                            <button class="btn btn-primary"><i class="icon-magnifier"></i><input type="hidden" name="searchfor"></button>
                           
                        </div>
                    </div> -->
                </form>
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
										<td><a class="btn btn-info" title="edit" id="pr<?php echo $fetch['id']; ?>"  data-toggle="modal" data-target="#pr<?php echo $fetch['id']; ?>">check</a> </td>
                                           <a href="pos" class="btn btn-success">BACK</a>
                                        </tr>
                                     <div class="modal fade" id="pr<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Check Product</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="body wizard_validation">
                            <form class="escr" action="<?php $_SERVER['PHP_SELF'];?>" method="POST"  enctype="multipart/form-data">
                                    <div class="row clearfix">
                                        <input type="hidden" name="productid" value="<?php echo $fetch['productid']; ?>">
                                            <div class="col-lg-12 col-md-12">
                                                <legend><?php echo $fetch['productname']; ?></legend>
                                                <p><?php echo $fetch['productdescription']; ?></p>
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" placeholder="Product Name" name="productname" value="<?php echo $fetch['productname']; ?>">
                                            </div>
											</div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="productdescription" value="<?php echo $fetch['productdescription']; ?>" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="hidden" class="form-control" placeholder="Product Price" name="productprice"  value="<?php echo $fetch['productprice']; ?>" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="hidden" class="form-control" placeholder="Product Quantity" name="productsize"  value="<?php echo $fetch['productsize']; ?>" required>
                                            </div>
                                                <div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Product Quantity" name="qty" required>
                                            </div>
											</div>
                                    </div>
								</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                                           <button type="submit" class="btn btn-round btn-primary"><input type="hidden" name="escrw">Check</button>
                                        
                                        </div>
                                    </div>
									</form>
                                </div>
                            </div>
										<?php
									   }
									}else{
										echo '<tr><td><td>No Record Found!</td></td></tr>
                                        <a href="pos" class="btn btn-success">BACK</a>';
                                        
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
										<td><a class="btn btn-info" title="edit" id="pr<?php echo $fetch['id']; ?>"  data-toggle="modal" data-target="#es<?php echo $fetch['productid']; ?>">check</a></td>
                                        </tr>
                                     <div class="modal fade" id="es<?php echo $fetch['productid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Check Product</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="body wizard_validation">
                            <form class="escr" action="<?php $_SERVER['PHP_SELF'];?>" method="POST"  enctype="multipart/form-data">
                                   <div class="row clearfix">
                                        <input type="hidden" name="productid" value="<?php echo $fetch['productid']; ?>">
                                            <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <legend><?php echo $fetch['productname']; ?></legend>
                                                <p><?php echo $fetch['productdescription']; ?></p>
                                                <input type="hidden" class="form-control" placeholder="Product Name" name="productname" value="<?php echo $fetch['productname']; ?>">
                                            </div>
											</div>
                                       <div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="hidden" class="form-control" name="productdescription"  value="<?php echo $fetch['productdescription']; ?>" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="hidden" class="form-control" placeholder="Product Price" name="productprice"  value="<?php echo $fetch['productprice']; ?>" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="hidden" class="form-control" placeholder="Product Size" name="productsize"  value="<?php echo $fetch['productsize']; ?>" required>
                                            </div>
                                                <div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Product Quantity" name="qty" required>
                                            </div>
											</div>
                                    </div>
								</div>
								</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                                           <button type="submit" class="btn btn-round btn-primary"><input type="hidden" name="escrw">Check</button>
                                        
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
        $('.escr').submit(function(e){
            e.preventDefault()
            var datas = new FormData(this);
            $.ajax({
                url: 'ajaxcall.php',
                method: 'POST',
                data: datas,
                success: function(data){
                    if(data==='Product Added to checklist'){
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
        $('.delfor').submit(function(e){
            e.preventDefault()
            var datas = new FormData(this);
            if(confirm("Are you sure you want to delete all?")){
            $.ajax({
                url: 'ajaxcall.php',
                method: 'POST',
                data: datas,
                success: function(data){
                    if(data==='Checklist cleared!'){
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
            }
        })
     })
       $(document).ready(function(){
        $('.psadd').submit(function(e){
            e.preventDefault()
            var datas = new FormData(this);
            if(confirm("Confirm Checkout?")){
            $.ajax({
                url: 'ajaxcall.php',
                method: 'POST',
                data: datas,
                success: function(data){
                    if(data==='Order complete'){
  		            $(function() {
					toastr.options.timeOut = "5000";
					toastr.options.closeButton = true;
					toastr.options.positionClass = 'toast-top-full-width';
					toastr['success'](data);
					setTimeout(function(){
                        window.location = "generate.php";
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
            }
        })
     })
  
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
     $('.delall').click(function(){
         var delall = true;
                      if(confirm("Are you sure you want to delete all?")){
                          $.ajax({
                            url:'ajaxcall.php',
                            method:'POST',
                            data:'delall='+delall,
                            success:function(data){
                             if(data==='Checklist cleared!'){
                                 $(function() {
								toastr.options.timeOut = "5000";
								toastr.options.closeButton = true;
								toastr.options.positionClass = 'toast-top-full-width';
								toastr['success'](data);
                                     console.log(data);
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
					       console.log(data);
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
	 $('.deles').click(function(){
                      var deles = $(this).attr("id");
                      if(confirm("Are you sure you want to delete?")){
                          $.ajax({
                            url:'ajaxcall.php',
                            method:'POST',
                            data:'deles='+deles,
                            success:function(data){
                             if(data==='Product removed from checklist!'){
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
					 $('.pdel').click(function(){
                      var pdel = $(this).attr("id");
                      if(confirm("Are you sure you want to delete?")){
                          $.ajax({
                            url:'ajaxcall.php',
                            method:'POST',
                            data:'pdel='+pdel,
                            success:function(data){
                             if(data==='Game Deleted Successfully!'){
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
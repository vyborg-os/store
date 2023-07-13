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
<link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css">
<link rel="stylesheet" href="../assets/datatable/datatables.css">
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>History</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">History</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card planned_task">
                        <div class="header">
                            <h2>History</h2>
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
							
            				<div class="col-lg-12">
                                <div class="card">
                        <form id="navbar-search" class="navbar-form search-form" method="POST"  enctype="multipart/form-data">
                    <div class="input-group mb-2" style="width: 30%;">
                        <input type="text" name="search" class="form-control" placeholder="Search Tid and generate receipt">
                        <div class="input-group-append">
                            <button class="btn btn-primary"><i class="icon-magnifier"></i><input type="hidden" name="searchfor"></button>
                           
                        </div>
                    </div>
                </form>
                        <div class="header">
                            <h2>Transaction History</h2>
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
                                        <th>tid</th>
                                        <th>pid</th>
                                        <th>Sold by</th>
                                        <th>date</th>
                                        <th>P.Name</th>
										<th>Desc</th>
                                        <th>Price</th>
                                        <th>Qty</th>
										<th>Pay Method</th>
										<th>Total-price</th>
										<th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
                                    if(isset($_POST['searchfor'])){
                                    $no = 1;
                                    $count = 0;
                                    $search = secure($_POST['search']);
									$result = fetch_hist($search);
                                    if ($result->num_rows > 0) {
                                       while ($fetch = $result->fetch_assoc()) { ?>
									   <tr>
                                        <td scope="row"><?php echo $no++; ?></td>
                                           <td><?php echo $fetch['tid'];?></td>
                                           <td><?php echo $fetch['productid'];?></td>
                                           <td><?php echo $fetch['username']; ?></td>
                                           <td><?php echo $fetch['date'];?></td>
                                        <td><?php echo $fetch['productname'];?></td>
										<td><?php echo $fetch['productdescription']; ?> </td>
                                        <td><span>&#8358</span><?php echo number_format($fetch['productprice']); ?></td>
										<td><?php echo $fetch['qty']; ?></td>
										<td><?php echo $fetch['pmethod']; ?></td>
										<td><span>&#8358</span><?php $total = $fetch['productprice'] * $fetch['qty'];
                                            echo number_format($total);?></td>
										<td><a class="dely btn btn-danger" title="delete" id="<?php echo $fetch['id']; ?>">X</a></td>
                                        
                                        </tr>
                                         
										<?php
                                            $count = $count + $total;                                      
									   }
                                        ?>
                                        <tr><td><td><td><td><td><td><td><td><td>TOTAL<td><span>&#8358</span><?php echo number_format($count); ?><td>
                                        
                                            </td></td></td></td></td></td></td></td></td></td></td></tr>
                                    <?php
                                        echo '<a href="history" class="btn btn-primary">BACK</a><a href="generate?tid='.$search.'" class="btn btn-success">generate receipt</a>';
									}else{
										echo '<tr><td><td>No Record Found!</td></td></tr>
                                        <a href="history" class="btn btn-success">BACK</a>';
                                        
									}
                                    }else{
                                        
                                    
									$no = 1;
									$result = fetch_hist_all();
                                    if ($result->num_rows > 0) {
                                       while ($fetch = $result->fetch_assoc()) { ?>
									   <tr>
                                        <td scope="row"><?php echo $no++; ?></td>
                                           <td><?php echo $fetch['tid'];?>
                                           <td><?php echo $fetch['productid'];?></td>
                                           <td><?php echo $fetch['username']; ?></td>
                                           <td><?php echo $fetch['date'];?></td>
                                        <td><?php echo $fetch['productname'];?></td>
										<td><?php echo $fetch['productdescription']; ?> </td>
                                        <td><span>&#8358</span><?php echo number_format($fetch['productprice']); ?></td>
										<td><?php echo $fetch['qty']; ?></td>
										<td><?php echo $fetch['pmethod']; ?></td>
										<td><span>&#8358</span><?php $total = $fetch['productprice'] * $fetch['qty'];
                                            echo number_format($total);?></td>
										<td><a class="dely btn btn-danger" title="delete" id="<?php echo $fetch['id']; ?>">X</a></td>
                                        </tr>
                        
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
   $(document).ready(function(){
        $('#example').DataTable();
            
        });
	 $('.dely').click(function(){
                      var dely = $(this).attr("id");
                      if(confirm("Are you sure you want to delete?")){
                          $.ajax({
                            url:'ajaxcall.php',
                            method:'POST',
                            data:'dely='+dely,
                            success:function(data){
                             if(data==='History Deleted Successfully!'){
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
		});							
</script>
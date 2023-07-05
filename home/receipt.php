<?php
include_once('index.php');
include_once('../model/controller.php');

?>
<link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css">
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Receipt</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Receipt</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card planned_task">
                        <div class="header">
                            <h2>Receipt</h2>
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
                        <div class="body">
							
							     <div class="col-lg-12">
                    <div class="card">
                       
                        <div class="header">
                            <h2>Transaction Receipt</h2>
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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>tid</th>
                                        <th>pid</th>
                                        <th>Name</th>
										<th>Desc</th>
                                        <th>Price</th>
                                        <th>Qty</th>
										<th>Size</th>
										<th>Total-price</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
                                    if(isset($_GET['tid'])){
                                    $tid = $_GET['tid'];
                                    $no = 1;
                                    $count = 0;
                                    $search = $tid;
									$result = fetch_hist($search);
                                    if ($result->num_rows > 0) {
                                       while ($fetch = $result->fetch_assoc()) { ?>
									   <tr>
                                        <td scope="row"><?php echo $no++; ?></td>
                                           <td><?php echo $fetch['tid'];?></td>
                                           <td><?php echo $fetch['productid'];?></td>
                                        <td><?php echo $fetch['productname'];?></td>
										<td><?php echo $fetch['productdescription']; ?> </td>
                                        <td><span>&#8358</span><?php echo number_format($fetch['productprice']); ?></td>
										<td><?php echo $fetch['qty']; ?></td>
										<td><?php echo $fetch['productsize']; ?></td>
										<td><span>&#8358</span><?php $total = $fetch['productprice'] * $fetch['qty'];
                                            echo number_format($total); $count = $count + $total;?></td>
                                           
                                        </tr>
                                         
										<?php
									   }
                                        ?>
                                    <tr><td><td><td><td><td><td><td>TOTAL<td><span>&#8358</span><?php echo number_format($count); ?><td>
                                        </td></td></td></td></td></td></td></td></td></tr>
                                    <?php
                                        echo '<a href="history" class="btn btn-success">BACK</a>';
                                        echo '<a href="#" class="btn btn-primary">generate receipt</a>';
									}else{
										echo '<tr><td><td>No Record Found!</td></td></tr>
                                        <a href="history" class="btn btn-success">BACK</a>';
                                        
									}
                                    }else{
                                        
                                echo '';
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

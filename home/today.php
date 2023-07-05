<?php
include_once('index.php');

?>
<link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css">
<link rel="stylesheet" href="../assets/datatable/datatables.css">
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Today</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Today</li>
                            </ol>
                        </nav>
                    </div>            
               
                </div>
            </div>
            	
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card planned_task">
                        <div class="header">
                            <h2>Today's Record</h2>
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
                        <div class="header">
                            <h2>Today's sales</h2>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>tid</th>
                                        <th>pid</th>
										<th>Product Name</th>
                                        <th>price</th>
                                        <th>qty</th>
										<th>Pay Method</th>
                                        <th>Sold By</th>
                                        <th>total-price</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
									$no = 1;
                                    $count = 0;
                                    $validatedate = date("FdY");
									$result = fetch_datey($validatedate);
                                    if ($result->num_rows > 0) {
                                       while ($fetch = $result->fetch_assoc()) { ?>
									   <tr>
                                        <td scope="row"><?php echo $no++; ?></td>
										<td><?php echo $fetch['tid'];?></td>
                                           <td><?php echo $fetch['productid'];?></td>
                                        <td><?php echo $fetch['productname'];?></td>
                                        <td><span>&#8358</span><?php echo number_format($fetch['productprice']); ?></td>
										<td><?php echo $fetch['qty']; ?></td>
										<td><?php echo $fetch['pmethod']; ?></td>
                                        <td><?php echo $fetch['username']; ?></td>
										<td><span>&#8358</span><?php $total = $fetch['productprice'] * $fetch['qty'];
                                            echo number_format($total);?></td>
										
                                        </tr>
										<?php
                                            $count = $count + $total;
									   }
                                        ?>
                                        <tr><td><td><td><td><td><td><td><td>TOTAL<td><span>&#8358</span><?php echo number_format($count); ?>
                                        </td></td></td></td></td></td></td></td></td></td></tr>
                                <?php
									}else{
										echo'<tr><td><td><td><td>No data</td></td></td></td></tr>';
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
        $('#adusr').submit(function(e){
            e.preventDefault()
            var datas = new FormData(this);
            $.ajax({
                url: 'ajaxcall.php',
                method: 'POST',
                data: datas,
                success: function(data){
                    if(data==='User Registered Successfully'){
  		            $(function() {
					toastr.options.timeOut = "5000";
					toastr.options.closeButton = true;
					toastr.options.positionClass = 'toast-top-full-width';
					toastr['success'](data);
					setTimeout(function(){
                        location.reload();
                    },6000);

					});
					
				
  					}else{
                    $(function() {
					toastr.options.timeOut = "5000";
					toastr.options.closeButton = true;
					toastr.options.positionClass = 'toast-top-full-width';
					toastr['error'](data);
					
					setTimeout(function(){
                        location.reload();
                    },6000);
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
	$('.usdel').click(function(){
                      var delus = $(this).attr("id");
                      if(confirm("Are you sure you want to delete?")){
                          $.ajax({
                            url:'ajaxcall.php',
                            method:'POST',
                            data:'delus='+delus,
                            success:function(data){
                             if(data==='User Deleted Successfully!'){
                                 $(function() {
								toastr.options.timeOut = "5000";
								toastr.options.closeButton = true;
								toastr.options.positionClass = 'toast-top-full-width';
								toastr['success'](data);
							setTimeout(function(){
							location.reload();
							},6000);

							});
                            }else{
                             $(function() {
							toastr.options.timeOut = "5000";
							toastr.options.closeButton = true;
							toastr.options.positionClass = 'toast-top-full-width';
							toastr['error'](data);
					
							setTimeout(function(){
							location.reload();
							},6000);
							});
                            }
                            },
                            error: function(data){
                            }
                          });
                          
                        }
                    });				
</script>
<?php
include_once('index.php');

?>
<link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css">
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Users</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                            </ol>
                        </nav>
                    </div>            
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" data-toggle="modal" data-target="#exampleModal">Add User</a>
                    </div>
                </div>
            </div>
            	 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="body wizard_validation">
                            <form id="adusr" class="adusr"  method="POST" enctype="multipart/form-data">
                                    <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Username" name="username" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Password" name="password" required>
                                            </div>
											</div>
											
											
                                    </div>
								</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                                           <button type="submit" class="btn btn-round btn-primary"><input type="hidden" name="register">register</button>
                                        
                                        </div>
                                    </div>
									</form>
                                </div>
                            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card planned_task">
                        <div class="header">
                            <h2>Users</h2>
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
							<p></p>
					<div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Store Users</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>USERNAME</th>
                                        <th>PASSWORD</th>
										<th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
									$no = 1;
									$result = getAdminUsr();
                                    if ($result->num_rows > 0) {
                                       while ($fetch = $result->fetch_assoc()) { ?>
									   <tr>
                                        <td scope="row"><?php echo $no++; ?></td>
										<td><?php echo $fetch['username']; ?> </td>
                                        <td><?php echo $fetch['pass']; ?></td>
										<td> <a class="usdel btn btn-danger" id="<?php echo $fetch['id']; ?>" title="delete">X</a></td>
                                        </tr>
										<?php
									   }
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
<?php
include_once('index.php');

?>

<link rel="stylesheet" href="../assets/vendor/dropify/css/dropify.min.css">
<link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css">
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Settings</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Settings</li>
                            </ol>
                        </nav>
                    </div>            
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" title="" data-toggle="modal" data-target="#exampleModal">Add New Settings</a>
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New Settings</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="body wizard_validation">
                            <form id="spost" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Site Description *" name="description" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Site About *" name="about" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Terms & Condition *" name="terms" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Our Services *" name="service" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Site Mail *" name="site_mail" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Site Mobile *" name="site_phone" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
                                                <div class="card">
											<div class="header">
											<h2>Site Logo <small>png,jpeg,jpg only</small></h2>
											</div>
											<div class="body">
											<input type="file" name="image" class="dropify" data-allowed-file-extensions="jpeg jpg png">
											</div>
											</div>
                                        </div>
                                    </div>
								</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-round btn-primary"><input type="hidden" name="addnew">Post</button>
                                        </div>
										</form>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card planned_task">
                        <div class="header">
                            <h2>Site Settings</h2>
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
                            <h2>Site Settings</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>About</th>
										<th>site description</th>
										<th>Terms & Condition</th>
										<th>Services</th>
                                        <th>Contact mail</th>
                                        <th>Contact phone</th>
										<th>Site logo</th>
										<th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									$no = 1;
									$result = fetch_site_details();
                                    if ($result->num_rows > 0) {
                                       while ($fetch = $result->fetch_assoc()) { ?>
									   <tr>
                                        <td scope="row"><?php echo $no++; ?></td>
                                       <td><?php echo $fetch['about']; ?> </td>
                                        <td><?php echo $fetch['description']; ?></td>
										<td><?php echo $fetch['terms']; ?></td>
										<td><?php echo $fetch['service']; ?></td>
										<td><?php echo $fetch['site_mail']; ?></td>
										<td><?php echo $fetch['site_phone']; ?></td>
										<td><?php echo'
		                  <a href="'.$fetch['image_id'].'/'.$fetch['image'].'" target="_blank"><img src="'.$fetch['image_id'].'/'.$fetch['image'].'" class="rounded-circle img-responsive" style="height: 10em; width: 10em;" ></a>';
	                        ?></td>
										<td><a class="sdel btn btn-danger" title="delete" id="<?php echo $fetch['id']; ?>">X</a>  
										<a class="btn btn-info" data-toggle="modal" data-target="#ex<?php echo $fetch['id']; ?>">Edit</a></td>
										<div class="modal fade" id="ex<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New Settings</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="body wizard_validation">
                            <form id="sepost" class="seclass" method="POST" enctype="multipart/form-data">
                                    <div class="row clearfix">
									<input type="hidden" name="id" value="<?php echo $fetch['id']; ?>">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Site Description *" name="description" value="<?php echo $fetch['description']; ?>" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Site About *" name="about" value="<?php echo $fetch['about']; ?>" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Terms & Condition *" name="terms" value="<?php echo $fetch['terms']; ?>" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Our Services *" name="service" value="<?php echo $fetch['service']; ?>" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Site Mail *" name="site_mail" value="<?php echo $fetch['site_mail']; ?>" required>
                                            </div>
											</div>
											<div class="col-lg-12 col-md-12">
											 <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Site Mobile *" name="site_phone" value="<?php echo $fetch['site_phone']; ?>" required>
                                            </div>
											</div>
                                    </div>
								</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-round btn-primary"><input type="hidden" name="editsite">Edit</button>
                                        </div>
										</form>
                                    </div>
                                </div>
                            </div>
                                        </tr>
										<?php
									   }
									}else{
										echo'<tr><td><td>No data</td></td></tr>';
									}
										?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				         <div class="card">
                        <div class="header">
                            <h2>Special Users</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>USERNAME</th>
										<th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">1</td>
                                        <td>Markrea</td>
										<td><a class="btn btn-info" title="subscribe"><i class="icon-lock"></i></a> <a class="btn btn-danger" title="delete">X</a></td>
                                        
                                    </tr>
                                    
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
<script src="assets/bundles/libscripts.bundle.js"></script>    
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="../assets/vendor/dropify/js/dropify.js"></script>
<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="assets/js/pages/forms/dropify.js"></script>
<script src="../assets/vendor/toastr/toastr.js"></script>
<script src="assets/js/jquery.3.3.1.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
        $('#spost').submit(function(e){
            e.preventDefault()
            var datas = new FormData(this);
            $.ajax({
                url: 'ajaxcall.php',
                method: 'POST',
                data: datas,
                success: function(data){
                    if(data==='Site Info Created'){
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
					toastr['danger'](data);
					
					setTimeout(function(){
                        location.reload();
                    },6000);
					}); 
					
                    }
                    //console.log('error log');
                    //console.log(data);
                },
                cache: false,
                contentType: false,
                processData: false
            })
        })
     })
	 $(document).ready(function(){
        $('.seclass').submit(function(e){
            e.preventDefault()
            var datas = new FormData(this);
            $.ajax({
                url: 'ajaxcall.php',
                method: 'POST',
                data: datas,
                success: function(data){
                    if(data==='Site Info Updated'){
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
					toastr['danger'](data);
					
					setTimeout(function(){
                        location.reload();
                    },6000);
					}); 
					
                    }
                    //console.log('error log');
                    //console.log(data);
                },
                cache: false,
                contentType: false,
                processData: false
            })
        })
     })
	 $('.sdel').click(function(){
                      var sdel = $(this).attr("id");
                      if(confirm("Are you sure you want to delete?")){
                          $.ajax({
                            url:'ajaxcall.php',
                            method:'POST',
                            data:'sdel='+sdel,
                            success:function(data){
                             if(data==='Site Details Deleted Successfully!'){
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
							toastr['danger'](data);
					
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
<?php
include_once('index.php');
if (isset($_POST["resetpw"])) {
            // Grab Variable Values And Escape String
            $username = $_SESSION['username'];
            $oldpassword   = secure(md5($_POST["oldpassword"]));
            $password   = secure(md5($_POST["password"]));
            $cpassword = secure(md5($_POST["cpassword"]));

	            //Check if Values supplied are valid
	            if (empty($oldpassword) || empty($password) || empty($cpassword)) {
	                $error =  'Please Fill all details Before submiting';
	            }else{
	            	$chk = user_exist($username, 'admin');
			                if ($chk) {
			                    //Get password From Database where email = $email
			                    $stmt =  $stmt = $mysqli->prepare("SELECT * FROM admin WHERE username = ?");
			                    $stmt->bind_param("s", $username);
			                    $stmt->execute();
			                    $result = $stmt->get_result();
			                    $rows = $result->fetch_assoc();
			                    $db_password = $rows['password'];
			                    if($password !== $cpassword){
			                    	$error = 'New Password not same as Confirm Password';
			                    }else{
			                    	if($oldpassword==$db_password){
						                    if ($oldpassword == $db_password) {
						                        $ccc = $stmt = $mysqli->prepare("UPDATE admin SET password = '$password' WHERE username = '$username'");
						                         if($stmt->execute()){
											            $success = 'Password Updated Successfully';
											        }else{
											            $error = 'Cannot Update Password, Try Later';
											        }
						                    	$result = $stmt->get_result();
						                    }else{
						                        $error =  'Old Password Not correct';
						                    }
						                 }else{
						                 		$error = 'Old Password Incorrect';
						                 }
					                   }
			                }else{
			                    $error =  'This username does not exist';
			                }
	            	}

       	 }
       	 else if(isset($_POST['resetpass'])){
       	 	$username = $_SESSION['username'];
       	 	$passwordraw = 'pass'.rand(0,100000000);
       	 	$password = md5($passwordraw);
       	 	$ccc = $stmt = $mysqli->prepare("UPDATE admin SET password = '$password' WHERE username = '$username'");
                         if($stmt->execute()){
					            $success = 'Password Reset Successful';
					            $pshow = $passwordraw;
					        }else{
					            $error = 'Cannot Reset Password, Try Later';
					        }
                    	$result = $stmt->get_result();
       	 }
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
                            <li class="breadcrumb-item active" aria-current="page">Password</li>
                            </ol>
                        </nav>
                    </div>   
                </div>
            </div>
	<center><div class="col-lg-6 card">
	            <div class="body">
	                <p class="lead">Update Password <p>Click Reset Password if you can't remember your old password, else simply update password if you remember old password</p>  <form class="form-auth-small m-t-20" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data"><button type="submit" class="mb-3 btn btn-danger btn-round pull-right"><input type="hidden" name="resetpass">Reset Password</button></form></p>
					 <?php
	                	if(isset($error)){
	                		echo '<center><span class="badge badge-danger">'.$error.'</span></center>';
	                	}
	                	if(isset($success)){
	                		echo '<center><span class="badge badge-success">'.$success.'</span></center>';
	                	}
	                	if(isset($pshow)){
	                		echo '<p style="color: orange;">Copy your new password: <span style="color: white;">'.$pshow.'</span></p>';
	                	}
	                	?>
	                <form class="form-auth-small m-t-20" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
	                    <div class="form-group">
	                        <label for="signin-username" class="control-label sr-only">Old Password</label>
	                        <input type="text" name="oldpassword" class="form-control round" id="signin-usn"  placeholder="Old Password" autocomplete="OFF">
	                    </div>
	                    <div class="form-group">
	                        <label for="signin-password" class="control-label sr-only">New Password</label>
	                        <input type="text" name="password" class="form-control round" id="signin-password"  placeholder="New Password" autocomplete="OFF">
	                    </div>
	                    <div class="form-group">
	                        <label for="signin-password" class="control-label sr-only">Confirm New Password</label>
	                        <input type="text" name="cpassword" class="form-control round" id="signin-password"  placeholder="Confirm New Password" autocomplete="OFF">
	                    </div>
	                    <button type="submit" class="btn btn-primary btn-round btn-block"><input type="hidden" name="resetpw">Update Password</button>
	                  
	                </form>
	            </div>
	        </div>
	    </center>
    </div>
</div>
<script src="../assets/vendor/toastr/toastr.js"></script>
<script src="assets/js/jquery.3.3.1.min.js"></script>
<script type="text/javascript">
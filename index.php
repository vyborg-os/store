<?php
include_once('model/controller.php');
   if (isset($_POST["login"])) {
            // Grab Variable Values And Escape String
            session_start();
            $username   = secure($_POST["username"]);
            $password   = secure(md5($_POST["password"]));

            //Check if Values supplied are valid
            if (empty($username) || empty($password)) {
                $error =  'Please Fill all details Before submiting';
            }else{
            	$chk = user_exist($username, 'admin');
                if ($chk) {
                    //Get password From Database where email = $email
                    $stmt = $mysqli->prepare("SELECT * FROM admin WHERE username = ?");
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $rows = $result->fetch_assoc();
                    $db_password = $rows['password'];

                    if ($password == $db_password) {
                        $_SESSION['username'] = $username;
                        $success =  'Login Successful!';
                        $ccc = mysqli_num_rows(fetchtoken($username));
                        if($ccc > 0){
                            $cstrong = True;
                            $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                            $_SESSION['token'] = $token;
                            $tokenz = update_token($token,$username);
                        }else{
                            $cstrong = True;
                            $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                       
                        $_SESSION['token'] = $token;
                             $tokenzz = tokenize($username,$token);
                    
                        }
                        header("Location: home/pos");
                        
                    }else{
                        $error =  'Incorrect Password Entered';
                    }

                }else{
                    $error =  'This username does not exist';
                }
            }

        }

?>
<!doctype html>
<html lang="en">


<!-- Mirrored from nsdbytes.com/template/oculux/html/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2020 11:42:26 GMT -->
<head>
<title>BitesFarm | Login</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Oculux Bootstrap 4x admin is super flexible, powerful, clean &amp; modern responsive admin dashboard with unlimited possibilities.">
<meta name="author" content="GetBootstrap, design by: puffintheme.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/vendor/animate-css/vivify.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets/css/site.min.css">

</head>
<body class="theme-cyan font-montserrat">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>

<div class="pattern">
    <span class="red"></span>
    <span class="indigo"></span>
    <span class="blue"></span>
    <span class="green"></span>
    <span class="orange"></span>
</div>

<div class="auth-main particles_js">
    <div class="auth_div vivify popIn">
        <div class="auth_brand">
            <a class="navbar-brand" href="javascript:void(0);"><span class="icon-user d-inline-block align-top mr-2" alt=""></span>Bites Multi Global Farm</a>
        </div>
        <div class="card">
            <div class="body">
                <p class="lead">Login to your account</p>
				 <?php
                	if(isset($error)){
                		echo '<center><span class="badge badge-danger">'.$error.'</span></center>';
                	}
                	if(isset($success)){
                		echo '<center><span class="badge badge-success">'.$success.'</span></center>';
                	}
                	?>
                <form class="form-auth-small m-t-20" method="POST" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="signin-username" class="control-label sr-only">Username</label>
                        <input type="text" name="username" class="form-control round" id="signin-usn"  placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="signin-password" class="control-label sr-only">Password</label>
                        <input type="password" name="password" class="form-control round" id="signin-password"  placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-round btn-block"><input type="hidden" name="login">LOGIN</button>
                  
                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</div>
<!-- END WRAPPER -->
    
<script src="assets/bundles/libscripts.bundle.js"></script>    
<script src="assets/bundles/vendorscripts.bundle.js"></script>
<script src="assets/bundles/mainscripts.bundle.js"></script>
</body>

<!-- Mirrored from nsdbytes.com/template/oculux/html/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2020 11:42:26 GMT -->
</html>

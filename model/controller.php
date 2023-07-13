<?php
//Require config config file
include_once ('config.php');
	$stmt = $mysqli->prepare("SELECT * FROM settings ORDER BY id DESC LIMIT 1");
	$stmt->execute();
	$result = $stmt->get_result();
	$data = $result->fetch_assoc();
	$site_name = $data['site_name'];
	$site_address = $data['site_address'];
	$site_phone = $data['site_phone'];
	//$site_mail = $data['site_mail'];
	define('DS', DIRECTORY_SEPARATOR);

	/////site name
	define('SITE_NAME', $site_name);
	define('SITE_ADDR', $site_address);
	define('SITE_PHONE', $site_phone);

	/////App Root
	define('APP_ROOT', dirname(dirname(__FILE__)));
	define('URL_ROOT', '/store');
	define('URL_SUBFOLDER','store');

    function secure($string){
		$sec = htmlentities($string);
		return $sec;
	}
    function user_exist($username, $table){
		//Require Databse config file
		require 'config.php';

		//Sanitize function variables
		$table = secure($table);

		//Check if email exist
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE username = ?");
		$stmt->bind_param("s", $username);
		if($stmt->execute()){
			$result = $stmt->get_result();

			if ($result->num_rows >0) {
				return true;
			}else{
				return false;
			}
		}else{
			die($mysqli->error);
		}
	}
	function deleteF($del, $table){
		require 'config.php';
		$stmt = $mysqli->prepare("DELETE FROM ".$table." WHERE id='$del' LIMIT 1");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
//	function deleteN($ndel, $table){
//		require 'config.php';
//		$stmt = $mysqli->prepare("DELETE FROM ".$table." WHERE id='$ndel' LIMIT 1");
//		if($stmt->execute()){
//			return true;
//		}else{
//			return false;
//		}
//		$result = $stmt->get_result();
//		return $result;
//	}
	function getAdmin(){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM admin");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function fetchrecord(){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM escrow");
		$stmt->execute();
		$result = $stmt->get_result();
 
		return $result;
	}
	function char_tbl($table,$created_at_month,$created_at_year){
		require 'config.php';
		$stmt = $mysqli->prepare("SELECT count(*) AS total FROM ".$table." WHERE date_format(date,'%m') = $created_at_month AND date_format(date,'%Y') = $created_at_year");
		$stmt->execute();
		$res = $stmt->get_result();
		$re = $res->fetch_assoc();
		
		return $re["total"];
	}
	function char_tbl_($table,$created_at_year){
		require 'config.php';
		$stmt = $mysqli->prepare("SELECT count(*) AS total FROM ".$table." WHERE date_format(date,'%Y') = $created_at_year");
		$stmt->execute();
		$res = $stmt->get_result();
		$re = $res->fetch_assoc();
		
		return $re["total"];
	}
	function fetchrecordpt(){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT tid FROM pointsale ORDER BY id DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->get_result();
 
		return $result;
	}
	function fetchrectid($tid){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM pointsale WHERE tid='$tid'");
		$stmt->execute();
		$result = $stmt->get_result();
 
		return $result;
	}
	function fetchrectidd($tid){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM pointsale WHERE tid='$tid' LIMIT 1");
		$stmt->execute();
		$result = $stmt->get_result();
 
		return $result;
	}

    function getAdminUsr(){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM admin where access != 1");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getchkAdminUsr($username){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM admin WHERE username = '$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		$privilege = $data['access'];
		if($privilege=='1'){
			return true;
		}else{
			return false;
		}
	}
   function getAdminUsrz($username){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM admin where username = '$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function admin_login($username,$password){
		//Require Databse config file
		require 'config.php';

		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM admin WHERE username='$username' AND password = '$password'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function add_admin($username,$pass,$admin_id){
		//Require Databse config file
		require 'config.php';

		//add admin
		$stmt = $mysqli->prepare("INSERT INTO admin(username, password,admin_id) VALUES(?,?,?)");
		$stmt->bind_param("sss",$username,$pass,$admin_id);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
	function add_category($category){
		//Require Databse config file
		require 'config.php';

		//add admin
		$stmt = $mysqli->prepare("INSERT INTO categories(category) VALUES(?)");
		$stmt->bind_param("s",$category);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
 function fetch_admin_username($table,$username){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
///user functions
    function fetch($table){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." ORDER BY id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
   function fetch_set($table){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." ORDER BY id DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
 function fetch_data($table){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table."");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
/////////////////////the functions valid ///////////////////////////////////////
function deleteAll(){
		require 'config.php';
		$stmt = $mysqli->prepare("DELETE FROM escrow");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
 function fetch_store(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM products");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
 function fetch_es(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM escrow");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
 function fetch_datey($validatedate){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM pointsale WHERE validatedate = '$validatedate'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
 function fetch_access_check($username){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT access FROM admin WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function add_product($productid,$productname,$productdescription,$productprice,$productquantity,$productsize,$username,$dateadded){
		//Require Databse config file
		require 'config.php';

		//add admin
		$stmt = $mysqli->prepare("INSERT INTO products(productid,productname,productdescription,productprice,productquantity,productsize,username,dateadded) VALUES(?,?,?,?,?,?,?,?)");
		$stmt->bind_param("ssssisss",$productid,$productname,$productdescription,$productprice,$productquantity,$productsize,$username,$dateadded);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}

function pos_insert($productid,$productname,$productdescription,$productprice,$productsize,$qty,$amount,$username,$status,$dateadded){
		//Require Databse config file
		require 'config.php';

		//add admin
		$stmt = $mysqli->prepare("INSERT INTO pointsale(productid,productname,productdescription,productprice,productsize,qty,amount,username,dateadded) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("ssssssisss",$productid,$productname,$productdescription,$productprice,$productsize,$qty,$amount,$username,$status,$dateadded);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function pos_escrow($productid,$productname,$productdescription,$productprice,$productsize,$qty,$username,$status){
		//Require Databse config file
		require 'config.php';

		//add admin
		$stmt = $mysqli->prepare("INSERT INTO escrow(productid,productname,productdescription,productprice,productsize,qty,username,status) VALUES(?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssiss",$productid,$productname,$productdescription,$productprice,$productsize,$qty,$username,$status);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function pos_escrow_new($tid,$productid,$productname,$productdescription,$productprice,$productsize,$qty,$username,$amount,$pmethod,$status,$dateadded,$validatedate){
		//Require Databse config file
		require 'config.php';

		//add admin
		$stmt = $mysqli->prepare("INSERT INTO pointsale(tid,productid,productname,productdescription,productprice,productsize,qty,username,amount,pmethod,status,dateadded,validatedate) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("ssssssissssss",$tid,$productid,$productname,$productdescription,$productprice,$productsize,$qty,$username,$amount,$pmethod,$status,$dateadded,$validatedate);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function add_new($username,$passw,$pass){
		//Require Databse config file
		require 'config.php';

		//add admin
		$stmt = $mysqli->prepare("INSERT INTO admin(username,password,pass) VALUES(?,?,?)");
		$stmt->bind_param("sss",$username,$passw,$pass);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function update_product($productname,$productdescription,$productprice,$productquantity,$productsize,$productid){
    require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE products SET productname = ?, productdescription = ?, productprice = ?, productquantity = ?, productsize = ? WHERE productid = ?");
        $stmt->bind_param("ssssss",$productname,$productdescription,$productprice,$productquantity,$productsize,$productid);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
}
function update_sales($productquantity,$productid){
    require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE products SET productquantity = ? WHERE productid = ?");
        $stmt->bind_param("ss",$productquantity,$productid);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
}
function fetch_quantity($productid){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT productquantity FROM products WHERE productid = '$productid'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_prod($search){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM products WHERE productname = '$search' || productid = '$search'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_hist($search){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM pointsale WHERE tid = '$search'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_hist_all(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM pointsale");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_escrow(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM escrow");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
///////////////////end dunno ///////////////////////////////////////////////
   function fetch_usr($table,$username){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function updateStat($pid,$table,$status){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET status = '$status' WHERE id = '$pid'");
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function update_log($table,$username,$login){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET login = '$login' WHERE username = '$username'");
        $stmt->bind_param("ssi",$table,$username,$login);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}

///////token
  function fetchtoken($username){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM login_tokens WHERE  username = '$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function tokenize($username,$token){
    //Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("INSERT INTO login_tokens(username,token) VALUES(?,?)");
		$stmt->bind_param("ss",$username,$token);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}	
function token_fetch_val($username){
    //Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("SELECT token FROM login_tokens WHERE username = '$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function update_token($token,$username){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("UPDATE login_tokens SET token = '$token' WHERE username = '$username'");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
	/////site settings
	function fetchsiteset(){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM settings ORDER BY id DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->get_result();
 
		return $result;
	}
	function update_site_settings($token,$username){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("UPDATE settings SET token = '$token' WHERE username = '$username'");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
?>
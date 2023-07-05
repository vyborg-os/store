<?php
	//Require config config file
include_once ('config.php');

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
function add_date_spec($username,$log_date,$com_date,$click_date,$spon_date,$post_date,$ref_date,$rup_date){
		//Require Databse config file
		require 'config.php';

		//add admin
		$stmt = $mysqli->prepare("INSERT INTO withdraw(username,log_date,com_date,click_date,spon_date,post_date,ref_date,rup_date) VALUES(?,?,?,?,?,?,?,?)");
		$stmt->bind_param("ssssssss",$username,$log_date,$com_date,$click_date,$spon_date,$post_date,$ref_date,$rup_date);
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
  function fetch_news_stat($table,$status){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE status='$status' ORDER BY id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
 function fetch_usr($table,$username){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
    function fetch_level($table,$level){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE level='$level'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
   function fetchSpec($table,$url){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE url = '$url'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
 function updatePoints($table,$username,$points){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET points = '$points' WHERE username = '$username'");
        $stmt->bind_param("ssi",$table,$username,$points);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function update_lvl($table,$username,$level,$ldue){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET level = '$level',ldue = '$ldue' WHERE username = '$username'");
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function update_click($table,$username,$open_post){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET open_post = '$open_post' WHERE username = '$username'");
        $stmt->bind_param("ssi",$table,$username,$open_post);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function update_com($table,$username,$comment){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET comment = '$comment' WHERE username = '$username'");
        $stmt->bind_param("ssi",$table,$username,$comment);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
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
function update_spost($table,$username,$spon_post){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET spost = '$spon_post' WHERE username = '$username'");
        $stmt->bind_param("ssi",$table,$username,$spon_post);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
	function add_siteset($about,$description,$terms,$service,$site_phone,$site_mail,$image_id,$image,$status){
		//Require Databse config file
		require 'config.php';

		//add admin
		$stmt = $mysqli->prepare("INSERT INTO site(about,description,terms,service,site_phone,site_mail,image_id,image,status) VALUES(?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssssss",$about,$description,$terms,$service,$site_phone,$site_mail,$image_id,$image,$status);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
	function update_site_details($about,$description,$terms,$service,$site_phone,$site_mail,$id){
		//Require Databse config file
		require 'config.php';
		//set outcome to won
		$stmt = $mysqli->prepare("UPDATE site SET about = ?, description = ?, terms = ?, service = ?, site_phone = ?, site_mail = ? WHERE id = ?");
        $stmt->bind_param("ssssssi",$about,$description,$terms,$service,$site_phone,$site_mail,$id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function update_outcome_won($outcome,$id){
		//Require Databse config file
		require 'config.php';
		//set outcome to won
		$stmt = $mysqli->prepare("UPDATE predict SET outcome = ? WHERE id = ?");
        $stmt->bind_param("si",$outcome,$id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function update_outcome_lost($outcome,$id){
		//Require Databse config file
		require 'config.php';
		//set outcome to lost
		$stmt = $mysqli->prepare("UPDATE predict SET outcome = ? WHERE id = ?");
        $stmt->bind_param("si",$outcome,$id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
	function update_sub($usertype,$id){
		//Require Databse config file
		require 'config.php';
		//set outcome to lost
		$stmt = $mysqli->prepare("UPDATE users SET usertype = ? WHERE id = ?");
        $stmt->bind_param("si",$usertype,$id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
	 function fetch_user_sub(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users WHERE usertype = 'subscribed'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function fetch_site_details(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM site ");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function fetch_user_free(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users WHERE usertype != 'subscribed'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function update_referal($table,$username,$referred){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET referred = '$referred' WHERE username = '$username'");
        $stmt->bind_param("ssi",$table,$username,$referred);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function update_refup($table,$username,$r_upgrade){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET r_upgrade = '$r_upgrade' WHERE username = '$username'");
        $stmt->bind_param("ssi",$table,$username,$referred);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function points_f($username){
		//Require Databse config file
		require 'config.php';

		//fetch all user
		$stmt = $mysqli->prepare("SELECT * ".$table." WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function points_ff($username){
		//Require Databse config file
		require 'config.php';

		//fetch all user
		$stmt = $mysqli->prepare("SELECT points FROM activities WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function comments_ff($username){
		//Require Databse config file
		require 'config.php';

		//fetch all user
		$stmt = $mysqli->prepare("SELECT comments FROM activities WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function click_ff($username){
		//Require Databse config file
		require 'config.php';

		//fetch all user
		$stmt = $mysqli->prepare("SELECT open_post FROM activities WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function sponpost_ff($username){
		//Require Databse config file
		require 'config.php';

		//fetch all user
		$stmt = $mysqli->prepare("SELECT spon_post FROM activities WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function post_ff($username){
		//Require Databse config file
		require 'config.php';

		//fetch all user
		$stmt = $mysqli->prepare("SELECT post_news FROM activities WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function ref_ff($username){
		//Require Databse config file
		require 'config.php';

		//fetch all user
		$stmt = $mysqli->prepare("SELECT referred FROM activities WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function refup_ff($username){
		//Require Databse config file
		require 'config.php';

		//fetch all user
		$stmt = $mysqli->prepare("SELECT r_upgrade FROM activities WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function login_ff($username){
		//Require Databse config file
		require 'config.php';

		//fetch all user
		$stmt = $mysqli->prepare("SELECT login FROM activities WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
///posts
function add_news($news_id,$news_title,$news_content,$image, $image_id,$posted_by,$category,$url,$status){
		//Require Databse config file
		require 'config.php';

		//adding news
		$stmt = $mysqli->prepare("INSERT INTO news(news_id,news_title,  news_content, image, image_id, posted_by,category,url,status) VALUES(?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssssss",$news_id,$news_title,$news_content,$image,$image_id,$posted_by,$category,$url,$status);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function add_ads($ads_id,$ads_title, $image, $image_id,$due,$ads_content,$url,$posted_by,$status){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("INSERT INTO sponsor(ads_id,ads_title, image,image_id,due, ads_content,url,posted_by,status) VALUES(?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssssss",$ads_id,$ads_title,$image,$image_id,$due,$ads_content,$url,$posted_by,$status);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function add_site_settings($site_title,$site_description,$site_email,$site_logo,$logo_id,$fb_link,$instagram_link,$twitter_link,$site_number){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("INSERT INTO site(site_title,site_description,site_email,image,logo_id,fb_link,instagram_link,twitter_link,site_number) VALUES(?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssssss",$site_title,$site_description,$site_email,$site_logo,$logo_id,$fb_link,$instagram_link,$twitter_link,$site_number);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function update_site_settings($id,$site_title,$site_description,$site_email,$site_logo,$logo_id,$fb_link,$instagram_link,$twitter_link,$site_number){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("UPDATE site SET site_title = '$site_title',site_description = '$site_description',site_email = '$site_email',image = '$site_logo',logo_id = '$logo_id',fb_link = '$fb_link',instagram_link = '$instagram_link',twitter_link = '$twitter_link',site_number = '$site_number' WHERE id = '$id'");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}

function add_coupon_page($couponpage,$whatsapplink){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("INSERT INTO couponpage(couponpage,whatsapplink) VALUES(?,?)");
		$stmt->bind_param("ss",$couponpage,$whatsapplink);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function add_testimony($testifier,$testimony){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("INSERT INTO testimonypage(testifier,testimony) VALUES(?,?)");
		$stmt->bind_param("ss",$testifier,$testimony);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
	//functions location for the system
		//functions location for the system
			//functions location for the system
				//functions location for the system
					//functions location for the system
	function add_predict($teama,$teamb,$league,$tips,$odd,$postype,$posted_date,$outcome){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("INSERT INTO predict(teama,teamb,league,tips,odd,postype,posted_date,outcome) VALUES(?,?,?,?,?,?,?,?)");
		$stmt->bind_param("ssssssss",$teama,$teamb,$league,$tips,$odd,$postype,$posted_date,$outcome);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
	function predict_pend_fetch(){
		//Require Databse config file
		require 'config.php';

		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM predict WHERE outcome ='pending'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function predict_true_fetch(){
		//Require Databse config file
		require 'config.php';

		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM predict WHERE outcome !='pending'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
//24hrs checking for points
function update_logdate($table,$username,$log_date){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET log_date = '$log_date' WHERE username = '$username'");
        $stmt->bind_param("sss",$table,$username,$log_date);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function update_comdate($table,$username,$com_date){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET com_date = '$com_date' WHERE username = '$username'");
        $stmt->bind_param("sss",$table,$username,$com_date);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function update_clickdate($table,$username,$click_date){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET click_date = '$click_date' WHERE username = '$username'");
        $stmt->bind_param("sss",$table,$username,$click_date);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function update_spondate($table,$username,$spon_date){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET spon_date = '$spon_date' WHERE username = '$username'");
        $stmt->bind_param("sss",$table,$username,$spon_date);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function update_postdate($table,$username,$post_date){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET post_date = '$post_date' WHERE username = '$username'");
        $stmt->bind_param("sss",$table,$username,$post_date);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function update_refdate($table,$username,$ref_date){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET ref_date = '$ref_date' WHERE username = '$username'");
        $stmt->bind_param("sss",$table,$username,$ref_date);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function update_rupdate($table,$username,$rup,
                        $rup_date){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET
        rup_date = '$rup'
        rup_date' WHERE username = '$username'");
        $stmt->bind_param("ssss",$table,$username,$rup
                          ,$rup_date);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}
function add_level($level_id,$level,$level_name,$cashout_point,$point_fig){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("INSERT INTO levels(level_id,level,level_name,cashout_point,point_fig) VALUES(?,?,?,?,?)");
		$stmt->bind_param("sssii",$level_id,$level,$level_name,$cashout_point,$point_fig);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function update_level($level_id,$level,$level_name,$cashout_point,$point_fig){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("UPDATE levels SET level_name = '$level_name',cashout_point = '$cashout_point',point_fig = '$point_fig' WHERE level_id = '$level_id'");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function update_coupon($id,$couponpage,$whatsapplink){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("UPDATE couponpage SET couponpage= '$couponpage',whatsapplink = '$whatsapplink' WHERE id = '$id'");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
   function fetch_level_id($table,$level_id){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE level_id='$level_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
   function fetch_level_idd($table,$id){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE id='$id'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
    function update_tst($id,$testifier,$testimony){
        //Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("UPDATE testimonypage SET testifier = '$testifier',testimony= '$testimony' WHERE id = '$id'");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
    }
function create_coupon($code,$level,$status,$expires){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("INSERT INTO couponcode(code,level,status,expires) VALUES(?,?,?,?)");
		$stmt->bind_param("ssss",$code,$level,$status,$expires);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
  function fetch_coupon_code($table){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." ORDER BY id DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
  function fetchComment($postid){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM comment WHERE  postid = '$postid'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function create_about($about,$faq,$privacy,$terms){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("INSERT INTO abouts(about,faq,privacy,terms) VALUES(?,?,?,?)");
		$stmt->bind_param("ssss",$about,$faq,$privacy,$terms);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function update_about($id,$about,$faq,$privacy,$terms){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("UPDATE abouts SET about = '$about',faq = '$faq',privacy = '$privacy', terms = '$terms' WHERE id = '$id'");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
////
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
?>
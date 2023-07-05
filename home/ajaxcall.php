<?php
include_once('../model/controller.php');
if(isset($_POST['postpr'])){
    session_start();
    $d = '1234567890';
    $productid = 'prodt'.substr(str_shuffle($d),0,6);
    $productname = secure($_POST['productname']);
    $productdescription = secure($_POST['productdescription']);
    $productprice = secure($_POST['productprice']);
    $productquantity = secure($_POST['productquantity']);
    $productsize = secure($_POST['productsize']);
    $username = $_SESSION['username'];
	$dateadded = date("F d, Y h:i:sa");
	if(empty($productname) || empty($productprice) || empty($productquantity)){
		echo 'Missing Important Field';
	}else if($productprice < 1 || $productquantity < 1){
        echo 'Value cannot be less than 1';
    }
    else{
		$prd = add_product($productid,$productname,$productdescription,$productprice,$productquantity,$productsize,$username,$dateadded);
		if($prd==true){
			echo 'Product Added successfully';
		}else{
			echo 'Cannot add product, try again';
		}	
    }
}
if(isset($_POST['escrw'])){
    session_start();
    $username = $_SESSION['username'];
    $productid = $_POST['productid'];
	$productname = secure($_POST['productname']);
    $productdescription = secure($_POST['productdescription']);
    $productprice = secure($_POST['productprice']);
    $qty = secure($_POST['qty']);
    $productsize = secure($_POST['productsize']);
    $amount = $productprice * $qty;
    $dateadded = date("F d, Y h:i:sa");
    $status = 'check';
    $fff = fetch_quantity($productid);
    if ($fff->num_rows > 0) {
            while ($fetch = $fff->fetch_assoc()) {
                $qq = $fetch['productquantity'];
                if($qq=='0'){
                    echo 'Product not in stock';
                }else if($qty>$qq){
                    echo 'Not enough Product, add more if available';
                }else if($qty<1){
                    echo 'invalid quantity added';
                }else{
                    $poss = pos_escrow($productid,$productname,$productdescription,$productprice,$productsize,$qty,$username,$status);
                if($poss==true){
                        echo 'Product Added to checklist';
                    }else{
                        echo 'Cannot add product, try again';
                }
                            }
            }
       }
    
}
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $passw = md5($_POST['password']);
    $pass = $_POST['password'];
    $result = getAdminUsrz($username);
        if ($result->num_rows > 0) {
                   echo 'username already exists!';
               }
    else{
           
    $poss = add_new($username,$passw,$pass);
    if($poss==true){
			echo 'User Registered Successfully';
		}else{
			echo 'Cannot add user, try again';
    }
    }
}

    
if(isset($_POST['possadd']) && isset($_POST['pmethod'])){
    $padd = $_POST['paddfig'];
    if($padd=='postruef'){
    $trigg = fetch_escrow();
    if ($trigg->num_rows > 0) {
   while ($fetch = $trigg->fetch_assoc()) {
        $tid = 'trstn'.date("dmyhi");
        $productid = $fetch['productid'];
        $productname = $fetch['productname'];
        $productdescription = $fetch['productdescription'];
        $productprice = $fetch['productprice'];
        $qty = $fetch['qty'];
        $productsize = $fetch['productsize'];
        $username = $fetch['username'];
        $dateadded = date("F d, Y h:i:sa");
        $validatedate = date("FdY");
        $amount = $productprice * $qty; 
        $pmethod = $_POST['pmethod'];
        $status = 'sold';
        $posad = pos_escrow_new($tid,$productid,$productname,$productdescription,$productprice,$productsize,$qty,$username,$amount,$pmethod,$status,$dateadded,$validatedate);
        $fff = fetch_quantity($productid);
		if(!empty($pmethod)){
			   if ($fff->num_rows > 0) {
					while ($fetch = $fff->fetch_assoc()) {
						$qq = $fetch['productquantity'];
						$productquantity = $qq - $qty;
						$usales = update_sales($productquantity,$productid);
						if($usales==true){
							deleteAll();
						}
					}
			   }
		}else{
			echo 'Payment Method not defined!';
		}
   }
        if($posad==true && $usales==true){
            echo 'Order complete';
        }else{
            echo 'Cannot checkout, try again';
        }
     }
  }
}else{
	echo 'Invalid';
}
if(isset($_POST['editpr'])){
	$productid = $_POST['productid'];
	$productname = secure($_POST['productname']);
    $productdescription = secure($_POST['productdescription']);
    $productprice = secure($_POST['productprice']);
    $productquantity = secure($_POST['productquantity']);
    $productsize = secure($_POST['productsize']);
    if($productprice < 1 || $productquantity < 1){
        echo 'Value cannot be less than 1';
    }else{
	$ups = update_product($productname,$productdescription,$productprice,$productquantity,$productsize,$productid);
	if($ups==TRUE){
		echo 'Product Updated';
	}else{
		echo 'Cannot Update Product';
	}
    }
}
if(isset($_POST['del'])){
$del = $_POST['del'];
$table = 'products';
$query = deleteF($del, $table);
if($query==TRUE){
	echo 'Product Deleted Successfully!';
}else{
	echo 'Cannot delete, try again';
}
}
if(isset($_POST['dely'])){
$del = $_POST['dely'];
$table = 'pointsale';
$query = deleteF($del, $table);
if($query==TRUE){
	echo 'History Deleted Successfully!';
}else{
	echo 'Cannot delete, try again';
}
}
if(isset($_POST['delus'])){
$del = $_POST['delus'];
$table = 'admin';
$query = deleteF($del, $table);
if($query==TRUE){
	echo 'User Deleted Successfully!';
}else{
	echo 'Cannot delete, try again';
}
}
if(isset($_POST['deles'])){
$del = $_POST['deles'];
$table = 'escrow';
$query = deleteF($del, $table);
if($query==TRUE){
	echo 'Product removed from checklist!';
}else{
	echo 'Cannot delete, try again';
}
}
if(isset($_POST['delall'])){
$dela = $_POST['deleteallchk'];
if($dela=='deltrue'){
$query = deleteAll();
if($query==TRUE){
	echo 'Checklist cleared!';
}else{
	echo 'Cannot delete, try again';
}
}
}

if(isset($_POST['sdel'])){
$del = $_POST['sdel'];
$table = 'site';
$query = deleteF($del, $table);
if($query==TRUE){
	echo 'Site Details Deleted Successfully!';
}else{
	echo 'Cannot delete, try again';
}
}
if(isset($_POST['pdel'])){
$del = $_POST['pdel'];
$table = 'predict';
$query = deleteF($del, $table);
if($query==TRUE){
	echo 'Game Deleted Successfully!';
}else{
	echo 'Cannot delete, try again';
}
}
if(isset($_POST['usdel'])){
$del = $_POST['usdel'];
$table = 'users';
$query = deleteF($del, $table);
if($query==TRUE){
	echo 'Account Deleted Successfully!';
}else{
	echo 'Cannot delete, try again';
}
}
if(isset($_POST['ussdel'])){
$del = $_POST['ussdel'];
$table = 'users';
$query = deleteF($del, $table);
if($query==TRUE){
	echo 'Account Deleted Successfully!';
}else{
	echo 'Cannot delete, try again';
}
}
if(isset($_POST['wid'])){
$wid = $_POST['wid'];
$table = 'predict';
$outcome = 'won';
$id = $wid;
$query = update_outcome_won($outcome,$id);
if($query==TRUE){
	echo 'Game Won!';
}else{
	echo 'Error, try again';
}
}
if(isset($_POST['lid'])){
$lid = $_POST['lid'];
$outcome = 'lost';
$table = 'predict';
$id = $lid;
$query = update_outcome_lost($outcome,$id);
if($query==TRUE){
	echo 'Game Lost!';
}else{
	echo 'Error, try again';
}
}
if(isset($_POST['usid'])){
$usid = $_POST['usid'];
$usertype = 'subscribed';
$id = $usid;
$query = update_sub($usertype,$id);
if($query==TRUE){
	echo 'Account Subscription Activated';
}else{
	echo 'Error, try again';
}
}
if(isset($_POST['unsid'])){
$unsid = $_POST['unsid'];
$usertype = 'free';
$id = $unsid;
$query = update_sub($usertype,$id);
if($query==TRUE){
	echo 'Account Subscription Deactivated';
}else{
	echo 'Error, try again';
}
}
if(isset($_POST['addnew'])){
	$about = secure($_POST['about']);
	$terms = secure($_POST['terms']);
	$service = secure($_POST['service']);
	$description = secure($_POST['description']);
	$site_phone = secure($_POST['site_phone']);
	$site_mail = secure($_POST['site_mail']);
	$status = 'active';
		$image_id = 'site/siteimg'.'NO'.rand(0,100000000);
		$dir = mkdir($image_id);
		//$upload_dir = FULL_ROOT."../img/profile/";
		$folder = "img/".$dir."/";
		$image = $_FILES['image']['name'];
		$pictype = $_FILES['image']['type'];
		$pic_size = $_FILES['image']['size'];
		$path = $image_id.'/'.$image;
		$target = $dir.basename($_FILES['image']['name']);
		$type = pathinfo($target,PATHINFO_EXTENSION);
		$void = array('jpeg','png','jpg');
		$filename = $_FILES['image']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(empty($image)){
		echo 'you have not picked any file';
		}
		else{
		$move = move_uploaded_file($_FILES['image']['tmp_name'], $path);
		$addnew = add_siteset($about,$description,$terms,$service,$site_phone,$site_mail,$image_id,$image,$status);
			if($addnew==TRUE && $move==TRUE){
				echo 'Site Info Created';
			}else{
				echo 'Error Try Again';
			}
	}
	
}
if(isset($_POST['editprkkfk'])){
	$id = $_POST['id'];
	$about = secure($_POST['about']);
	$description = secure($_POST['description']);
	$terms= secure($_POST['terms']);
	$service = secure($_POST['service']);
	$site_phone = secure($_POST['site_phone']);
	$site_mail = secure($_POST['site_mail']);
	$ups = update_site_details($about,$description,$terms,$service,$site_phone,$site_mail,$id);
	if($ups==TRUE){
		echo 'Site Info Updated';
	}else{
		echo 'Cannot Update Site';
	}
}




?>
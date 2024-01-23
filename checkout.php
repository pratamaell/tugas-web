<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['username'])){
header('location:admin.php');
                };
 $_GET['id'];
 $id_transaksi = mysqli_insert_id($koneksi);
  $query = mysqli_query($koneksi,"select * from transaksi where id_transaksi='$id_transaksi' ");
                   
     if(isset($_POST['submit'])){
        $total = $_POST['total'];

        $result = mysqli_query($koneksi,"INSERT INTO transaksi(total) VALUES('$total')");
        header("Location: index.php");
     }

     unset($_SESSION["cart"]);
    echo'<script>window.location="cetak.php?id='.$id_transaksi.' "</script>';
    ?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Safire - Furniture  | Checkout</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/safire2.png">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.php"><img src="img/core-img/safire.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="checkout.php">Check Out</a></li>
                    
                </ul>
            </nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
               
            <a href="pembeli.php" class="btn amado-btn mb-15">Signup</a>
                <a href="admin.php" class="btn amado-btn active">login</a>
            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="cart.php" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Cart <span>(0)</span></a>
                <a href="#" class="fav-nav"><img src="img/core-img/favorites.png" alt=""> Favourite</a>
               
            </div>
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Checkout</h2>
                            </div>
                             

                            <form action="cetak.php" method="POST">
                            <div class="container d-flex justify-content-center mt-5">
	<div class="card">
		


		<div>
			<div class="d-flex pt-3 pl-3">
			<div><img src="img/core-img/safire.png" width="60" height="80" /></div>
			<div class="mt-3 pl-2"><span class="name"> </span><div><span class="cross"></span><span class="pin ml-2"></span></div></div>
		    </div>


		    <div class="py-2  px-3">
		    	<div class="first pl-2 d-flex py-2">
			    <div class="form-check">
				<input type="radio" name="optradio" class="form-check-input mt-3 dot" checked>
			    </div>
                
			    <div class="border-left pl-2"><span class="head">Total</span><div><span class="dollar">Rp<?= $_GET['total'];?></span><span class="amount"></span></div></div>

		         </div>
		    </div>


		    

		    	<div class="d-flex justify-content-between px-3 pt-4 pb-3">
		    		<div><span class="back">Go back</span></div>
		    		<input type="submit"  value="BAYAR" class="btn btn-primary button" ><a href="cetak.php?id='.$id_transaksi.'"></a></input>
                    
		    	</div>
                 
               <script>
                alert("Terima Kasih Sudah Berbelanja Di Toko Kami !");
               
                </script>

		</div>
	</div>
</form>

</div>

<style>
    body{
	background-color: #ffffff;

}
.container{
	width: 600px;
	background-color: #fff;
	padding-top: 100px;
    padding-bottom: 100px;

}
.card{
	background-color: #fff;
	width: 300px;
	border-radius: 15px;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.name{
	font-size: 15px;
	color: #403f3f;
	font-weight: bold;
}
.cross{
	font-size: 11px;
	color: #b0aeb7;
}
.pin{
	font-size: 14px;
	color: #b0aeb7;
}
.first{
	border-radius: 8px;
	border: 1.5px solid #78b9ff;
	color: #000;
	background-color: #eaf4ff;
}
.second{
	border-radius: 8px;
	border: 1px solid #acacb0;
	color: #000;
	background-color: #fff;
}
.dot{

}
.head{
	color: #137ff3;
	font-size: 12px;
}
.dollar{
	font-size: 18px;
	color: #097bf7;
}
.amount{
	color: #007bff;
	font-weight: bold;
	font-size: 18px;

}
.form-control{
	font-size: 18px;
	font-weight: bold;
	width: 60px;
	height: 28px;

}
.back{
	color: #aba4a4;
	font-size: 15px;
	line-height: 73px;
	font-weight: 400;
}
.button{
	width: 150px;
	height: 60px;
	border-radius: 8px;
	font-size: 17px;		
}
</style>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Newsletter Area Start ##### -->
    
</html>
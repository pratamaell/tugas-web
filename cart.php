<?php
            session_start();
                 include "koneksi.php";

                 if(!isset($_SESSION['username'])){
                    header('location:admin.php');
                 };
                
                  if(isset($_POST["keranjang"])){
                   if (isset($_SESSION["cart"])){
                   $item_array_id = array_column($_SESSION["cart"],"id_barang");
                   if(!in_array($_GET["id_barang"],$item_array_id)){
                   $count = count($_SESSION["cart"]);
                   $id_transaksi = $_POST['id'];
                   $item_array = array(
                    'id_barang'=>$_GET["id_barang"],
                    'img'=>$_POST["foto"],
                    'nama_barang'=>$_POST["nama_barang"],
                    'harga_barang'=>$_POST["harga_barang"],
                    'kuantity'=>$_POST["kuantity"],
                 );
                     $_SESSION["cart"][$count] = $item_array;
                     echo'<script>alert("Produk Berhasil Dimasukkan ke Keranjang")</script>';
                     echo'<script>window.location="cart.php"</script>';
                     }else{
                       echo'<script>alert("Produk Sudah ada di Keranjang")</script>';
                        echo'<script>window.location="index.php"</script>';
                     };
                     }else{
                       $item_array = array(
                        'id_barang'=>$_GET["id_barang"],
                        'img'=>$_POST["foto"],
                        'nama_barang'=>$_POST["nama_barang"],
                        'harga_barang'=>$_POST["harga_barang"],
                        'kuantity'=>$_POST["kuantity"],
                     ); $_SESSION["cart"][0] = $item_array;
                 };
              };

              if(isset($_GET['action'])){
           
              if(($_GET['action'])=='delete'){
                foreach ($_SESSION["cart"] as $key => $value){
                    if ($value ["id_barang"] == $_GET ["id_barang"]){
                        unset($_SESSION["cart"] [$key]);
                        echo'<script>alert("Barang berhasil di Hapus...!")</script>';
                        echo '<script>window.location="cart.php"</script>';
                    }
                }
              }elseif($_GET["action"] == "CheckOut"){

                $total= 0;
                    foreach($_SESSION["cart"]as $key => $value){
                
                        $total = $total +($value["kuantity"] * $value["harga_barang"]);
                        $grand = $total + 10000 ;
                        $id_barang = $value['id_barang'];
                        $qty = $value['kuantity'];
                        $query = "INSERT INTO transaksi (date_transaksi,id_barang,qty,total) VALUES ('".date("Y-m-d")."','$id_barang','$qty','$grand')";
                        $s = mysqli_query($koneksi,$query);
                    }
                    
                   $id = mysqli_insert_id($koneksi);
               
                foreach($_SESSION["cart"]as $key => $value){
                    
                    $tgl = $value['tgl_transaksi'];
                    $id_barang = $value['id_barang'];
                    $qty = $value['kuantity'];
                    $total = $total +($value["kuantity"] * $value["harga_barang"]);
                    $sub = 10000;
                    $grand = $total + $sub ;
                    $sql = "INSERT INTO cart (id_transaksi,id_barang,qty,total,tgl_transaksi) VALUES ('$id','$id_barang','$qty','$grand','".date("Y-m-d")."')";
                    $res = mysqli_query($koneksi,$sql);
                    
                };
               
            }
            

                unset($_SESSION["cart"]);
                echo'<script>window.location="cetak.php?id='.$id.'&total='.$grand.'  "</script>';
               
              }
            
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
    <title>Safire - Furniture| Cart</title>

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
                <a href="index.php"><img src="img/core-img/safire.png" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    
                    <li><a href="cart.php">Cart</a></li>
                    
                    <li><a href="product-details.php">Best Seller</a></li>
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
                        <div class="cart-title mt-50">
                            <h2>Shopping Cart</h2>
                        </div>
                             
                        
                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>IMG</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>

       

                <?php
                if(!empty($_SESSION["cart"])){
                 $total = 0;
                 foreach($_SESSION["cart"] as $key => $value){
                  ?>
                   <tr>
                     <td><img src="img.1/<?=$value["img"]?>"  width="70px" height="70px"> </td>
                     <td><?php echo $value["nama_barang"]?> </td>
                     <td>Rp<?php echo $value["harga_barang"]?> </td>
                     <td><?php echo $value["kuantity"]?> </td>
                     <td>Rp <?php echo number_format($value["kuantity"] * $value["harga_barang"]);?>
                     <td><a href="cart.php?action=delete&id_barang=<?php echo $value["id_barang"];?>"><span 
                     class="text-danger">Hapus </span></a></td>
                    </td>
                    </tr>
                 <?php
                    $total = $total +($value["kuantity"] * $value["harga_barang"]);
                 }
                 ?>
                   <tr>
                     <td colspan="3" align="right">Grand total</td>
                      <th align="right">Rp <?php echo number_format($total);?></th>
                     <td></td>
                   </tr>
                 <?php
              }else{
                $total = 0;
                $sub = 0;
             }
                ?>


                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span>Rp <?php echo number_format($total);?></span></li>
                                <li><span>delivery:</span> <span>Rp.<?=$sub=10000?></span></li>
                                
                                <li><span>total:</span> <span>Rp <?php  $grand = $total + $sub ;
                                echo number_format($grand);?></span></li>
                            </ul>
                            <div class="cart-btn mt-100">
                                <a href="cart.php?action=CheckOut" class="btn amado-btn w-100">BAYAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Newsletter Area Start ##### -->
    <section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <!-- Newsletter Text -->
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Berlangganan Untuk<span>25% Discount</span></h2>
                        <p>Dapatkan Furniture dengan kualitas yang baik dan bagus hanya di toko kami. Anda puas Kami Senang Melayani Anda Kembali.</p>
                    </div>
                </div>
                <!-- Newsletter Form -->
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="newsletter-form mb-100">
                        <form action="#" method="post">
                            <input type="email" name="email" class="nl-email" placeholder="Your E-mail">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Newsletter Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="index.php"><img src="img/core-img/safire2.png" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script>by Pratama Companny
Safire sendiri diambil karena melambangkan keindahan sebuah perhiasan dimana perusahaan kami ingin menjadi perusahaan
    yang mengkedepankan keindahan sebuah furniture yang terbaik.
</p>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="index.php">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="shop.php">Shop</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="product-details.php">Product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="cart.php">Cart</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="checkout.php">Checkout</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

   

</body>

</html>
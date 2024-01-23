
<?php
$host  ="localhost";
$user  ="root";
$pass  ="";
$db    ="db_furniture";

$koneksi=mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){
    die("tidak bisa terkoneksi ke database");
}
$id_transaksi   ="";
$date_transaksi ="";
$total="";
$sukses  ="";
$eror    ="";

if(isset($_GET['op'])){
  $op=$_GET['op'];
}else{
  $op="";
}

if($op=='delete'){
  $id_transaksi=$_GET['id'];
  $sql1="delete from transaksi where id_transaksi= '$id_transaksi'";
  $q1=mysqli_query($koneksi,$sql1);
  if($q1){
    $sukses="berhasil menghapus data";
  }else{
    $eror="Gagal menghapus data";
  }
}

if($op =='edit'){
  $id_transaksi      =$_GET['id'];
  $sql1    ="select * from transaksi where id_transaksi ='$id_transaksi'";
  $q1      =mysqli_query($koneksi,$sql1);
  $r1      =mysqli_fetch_array($q1);
  $id_membeli    =$r1['id_membeli'];
  $date_transaksi =$r1['date_transaksi'];
  $total=$r1['total'];
  

  if($id_membeli==''){
    $eror="data tidak ditemukan";
  }
}

if(isset($_POST['simpan'])){
  $id_transaksi     =$_POST['id_transaksi'];
  $date_transaksi =$_POST['date_transaksi'];
  $total=$_POST['total'];
  

  if($id_transaksi && $date_transaksi && $total ){
    if($op=='edit'){
      $sql1="update transaksi set id_transaksi='$id_transaksi',date_transaksi='$date_transaksi',total='$total' where id_transaksi='$id_transaksi'";
      $q1=mysqli_query($koneksi,$sql1);
      if($q1){
        $sukses="Data berhasil di update";
      }else{
        $eror="Data Gagal di Update";
      }
    }else{
    $sql1="insert into transaksi (id_transaksi,date_transaksi,total_harga) values('$id_transaksi','$date_transaksi','$total')";
     $q1= mysqli_query($koneksi,$sql1);
     if($q1){
      $sukses="berhasil memasukkan data";
     }else{
      $eror="gagal memasukkan data";
     }
    }
    
  }else{
    $eror="silakan memasukkan semua data";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
  </head>
  <style>
    body{
      background: url(img/core-img/image.jpeg);
    }
  </style>
    <style>
      .mx-auto{width:800px}
      .card{margin-top:10px;}
      .nav-link{
        color:white;
      }
    </style>
</head>
<body>
<nav class="nav nav-pills nav-fill">
  <a class="nav-link" href="barang.php">BARANG</a>
  <a  class="nav-link" href="pembeli2.php">PEMBELI</a>
  <a class="nav-link active" aria-current="page" href="transaksi.php">TRANSAKSI</a>
  <a href="penjual2.php"> <button type="button" class="btn btn-light" name="keluar" value="keluar" >KELUAR</button></a>
</nav>
   
    <?php
    if($eror){
        ?>

        <div class="alert alert-danger" role="alert">
  <?php  echo $eror?>
</div>
        <?php
        header("refresh:5;url=transaksi.php");
    }
    ?>
    <?php
    if($sukses){
        ?>

        <div class="alert alert-success" role="alert">
 <?php  echo $sukses?>
</div>
        <?php header("refresh:5;url=transaksi.php");
    }
    ?>
    


<div class="card">
  <div class="card-header text-white bg-secondary">
   Data Transaksi
  </div>
  <div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">ID TRANSAKSI</th>
        <th scope="col">TANGGAL</th>
        <th scope="col">TOTAL</th>
        <th scope="col">AKSI</th>
      </tr>
      <tbody>
        <?php
        session_start();
        if(!isset($_SESSION['user'])){
          header('location:penjual.php');
        };
        $mysql_adm=mysqli_query($koneksi,"select * from penjual where username ='$_SESSION[user]'");
        $data_adm=mysqli_fetch_array($mysql_adm);
        $sql2="select * from transaksi order by id_transaksi desc";
        $q2=mysqli_query($koneksi,$sql2);
        $urut=1;
        while($r2=mysqli_fetch_array($q2)){
          $id_transaksi=$r2['id_transaksi'];
          $date_transaksi=$r2['date_transaksi'];
          $total=$r2['total'];
          
          ?>
            <tr>
              <th scope="row"><?php  echo $urut++ ?></th>
              <td scope="row"><?php echo $id_transaksi?></td>
              <td scope="row"><?php echo $date_transaksi?></td>
              <td scope="row"><?php echo $total?></td>
              <td scope="row">
                <a href="transaksi.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                <a href="transaksi.php?op=delete&id=<?=$id?>" onclick="return confirm('yakin mau delete data')"> <button type="button" class="btn btn-danger">Delete</button></a>
               
                
              </td>

            </tr>

          <?php
        }
        ?>
      </tbody>
    </thead>
  </table>
  </div>
</div>
    </div>
    
</body>
</html>
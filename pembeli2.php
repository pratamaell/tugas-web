
<?php
$host  ="localhost";
$user  ="root";
$pass  ="";
$db    ="db_furniture";

$koneksi=mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){
    die("tidak bisa terkoneksi ke database");
}
$nama_pembeli    ="";
$username    ="";
$password ="";
$alamat="";
$no_hp="";
$sukses  ="";
$eror    ="";

if(isset($_GET['op'])){
  $op=$_GET['op'];
}else{
  $op="";
}

if($op=='delete'){
  $id_pembeli=$_GET['id'];
  $sql1="delete from pembeli where id_pembeli= '$id_pembeli'";
  $q1=mysqli_query($koneksi,$sql1);
  if($q1){
    $sukses="berhasil menghapus data";
  }else{
    $eror="Gagal menghapus data";
  }
}

if($op =='edit'){
  $id_pembeli      =$_GET['id'];
  $sql1    ="select * from pembeli where id_pembeli ='$id_pembeli'";
  $q1      =mysqli_query($koneksi,$sql1);
  $r1      =mysqli_fetch_array($q1);
  $nama_pembeli    =$r1['nama_pembeli'];
  $username    =$r1['username'];
  $password =$r1['password'];
  $alamat=$r1['alamat'];
  $no_hp=$r1['no_hp'];


  if($nama_pembeli==''){
    $eror="data tidak ditemukan";
  }
}

if(isset($_POST['simpan'])){
  $nama_pembeli     =$_POST['nama_pembeli'];
  $username    =$_POST['username'];
  $password  =$_POST['password'];
  $alamat=$_POST['alamat'];
  $no_hp=$_POST['no_hp'];

  if($nama_pembeli && $username && $password && $alamat && $no_hp){
    if($op=='edit'){
      $sql1="update pembeli set nama_pembeli='$nama_pembeli',username='$username',password='$password',alamat='$alamat',no_hp='$no-hp' where id_pembeli='$id_pembeli'";
      $q1=mysqli_query($koneksi,$sql1);
      if($q1){
        $sukses="Data berhasil di update";
      }else{
        $eror="Data Gagal di Update";
      }
    }else{
    $sql1="insert into pembeli (nama_pembeli,username,password,alamat,no_hp) values('$nama_pembeli','$username','$password','$alamat','$no_hp')";
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
    <title>Data Barang</title>
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
  <a class="nav-link active" aria-current="page" href="barang.php">PEMBELI</a>
  <a class="nav-link" href="transaksi.php">TRANSAKSI</a>
  <a href="penjual2.php"> <button type="button" class="btn btn-light" name="keluar" value="keluar" >KELUAR</button></a>
</nav>
   
    <?php
    if($eror){
        ?>

        <div class="alert alert-danger" role="alert">
  <?php  echo $eror?>
</div>
        <?php
        header("refresh:5;url=pembeli2.php");
    }
    ?>
    <?php
    if($sukses){
        ?>

        <div class="alert alert-success" role="alert">
 <?php  echo $sukses?>
</div>
        <?php header("refresh:5;url=pembeli2.php");
    }
    ?>




<div class="card">
  <div class="card-header text-white bg-secondary">
   Data Pembeli
  </div>
  <div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">NAMA</th>
        <th scope="col">USER</th>
        <th scope="col">PASS</th>
        <th scope="col">ALAMAT</th>
        <th scope="col">NO HP</th>
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
        $sql2="select * from pembeli order by id_pembeli desc";
        $q2=mysqli_query($koneksi,$sql2);
        $urut=1;
    
        while($r2=mysqli_fetch_array($q2)){
          $id=$r2['id_pembeli'];
          $nama_pembeli=$r2['nama_pembeli'];
          $username=$r2['username'];
          $password=$r2['password'];
          $alamat=$r2['alamat'];
          $no_hp=$r2['no_hp'];

          ?>
            <tr>
              <th scope="row"><?php  echo $urut++ ?></th>
              <td scope="row"><?php echo $nama_pembeli?></td>
              <td scope="row"><?php echo $username?></td>
              <td scope="row"><?php echo $password?></td>
              <td scope="row"><?php echo $alamat?></td>
              <td scope="row"><?php echo $no_hp?></td>
              <td scope="row">
               
                <a href="pembeli2.php?op=delete&id=<?=$id?>" onclick="return confirm('yakin mau delete data')"> <button type="button" class="btn btn-danger">Delete</button></a>
               
                
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
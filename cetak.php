<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        <style>
        @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

        *{
            font-family: 'Titillium Web', sans-serif;
        }
        .product{
            border: 1px solid #eaeaec;
            margin: -1px 19px 3px -1px;
            padding: 10px;
            text-align: center;
            background-color: #efefef;
        }
        table, th, tr{
            text-align: center;
        }
        .title2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        h2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        table th{
            background-color: #efefef;
        }
    </style>
    
</head>
<body>
<div class="container" style="width: 65%">
    <?php 
       $koneksi = mysqli_connect("localhost","root","","db_furniture");
       
       $id = $_GET['id'];
       
                   
     if(isset($_POST['submit'])){
        $total = $_POST['total'];

        $result = mysqli_query($koneksi,"INSERT INTO transaksi(total) VALUES('$total')");
        header("Location: index.php");
     }
        
        

        //Menampilkan data pada tabel detail (id transaksi, nama barang dan jumlah barang)
        $transaksi = "SELECT * FROM cart inner join transaksi
        on cart.id_transaksi = transaksi.id_transaksi
        where cart.id_transaksi='$id'";
        $query = mysqli_query($koneksi, $transaksi);
        $data = mysqli_fetch_array($query);
        
    ?>
        <div style="clear: both"></div>
        <img src="img/core-img/safire.png" alt="" width="100px" height="100px"><hr>
        <h3 class="title2">Nota Pembelian</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                
            No. Invoice : INV-<?=$id?> <br>
            Tanggal Pembelian: <?=$data['tgl_transaksi'] ?>
            <tr>
                <th width="30%">Nama Barang</th><hr>
                <th width="10%">Qty</th>
            </tr>

            <?php
            $barang = "SELECT * FROM cart 
            inner join barang on cart.id_barang = barang.id_barang 
            where cart.id_transaksi='$id'";
            $query2 = mysqli_query($koneksi, $barang);
                while($row = mysqli_fetch_array($query2)){ ?>
                        <tr>   
                        <div class="alert alert-primary" role="alert">
                        <td><?=$row["nama_barang"]?></td>
                        </div>
                        <div class="alert alert-primary" role="alert">
                        <td><?=$row["qty"]?></td>
                        </div>
                            
                        </tr>
                        <?php } ?>
                    <tr>
                        <td><b>Grand Total<b></td>
                        <td align="right"> <i>Rp<i> <?php echo"<b>".number_format($data['total'])."<b>" ;?></td>
                    </tr>
                        
            </table>
        </div>

    </div>
    
    <script>window.print();</script>

</body>
</html>

<?php
    include 'koneksi.php';

    $query = "SELECT * FROM tb_siswa;";
    $sql = mysqli_query($conn, $query);
    $no = 0;


    // while($result= mysqli_fetch_assoc($sql)){
    // echo $result['nama_siswa']."<br>";
    // }

    // untuk test data
    // $result = mysqli_fetch_assoc($sql);      beberapa baris
    // $result = mysqli_fetch_row($sql);        berbentuk row
    // echo $result[0];                         untuk mengecek
    // var_dump($result);                       untuk melihat apakah query sudah bekerja atau belum
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap 5 -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- font awesome -->
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>data siswa</title>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">
            Data Siswa
        </a>
        </div>
    </nav>

    <!-- Judul -->

    <div class="container">
        <figure class="mt-3">
            <blockquote class="blockquote">
                <p>data yang tersimpan di data base</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                CRUD <cite title="Source Title">Creat Read Update Delete</cite>
            </figcaption>
        </figure>
        
        <a href="kelola.php" type="button" class="btn btn-primary mb-3" >
            <i class="fa fa-plus" aria-hidden="true"></i>
            Tambah Data
        </a>

        <div class="table-responsive">
            <table class="table align-middle table-bordered table-hover">
                <thead>
                    <tr>
                        <th> <center>No.</center> </th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Foto Siswa</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <!-- untuk menampilkan semua data dengan while -->
                    <?php
                        while($result= mysqli_fetch_assoc($sql)){
                    ?>

                        <tr>
                            <td><center>
                                <?php echo ++$no; ?>
                            </center></td>
                            <td>
                                <?php echo $result["nisn"]; ?>
                            </td>
                            <td>
                                <?php echo $result["nama_siswa"]; ?>
                            </td>
                            <td>
                                <?php echo $result["jenis_kelamin"]; ?>
                            </td>
                            <td>
                                <img src="img/<?php echo $result["foto_siswa"]; ?>" alt="gam 1" style="width: 150px;">
                            </td>
                            <td>
                                <?php echo $result["alamat"]; ?>
                            </td>
                            <td>
                                <a href="kelola.php?ubah=<?php echo $result["id_siswa"]; ?>" type="button" class="btn btn-success btn-sm">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    Ubah
                                </a>
                                <a href="proses.php?hapus=<?php echo $result["id_siswa"]; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')" >
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
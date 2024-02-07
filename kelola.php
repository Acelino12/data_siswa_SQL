<!DOCTYPE html>

<?php

include "koneksi.php";

    $nisn = "";
    $nama_siswa = "";
    $jenis_kelamin = "";
    $alamat = "";

    if (isset($_GET['ubah'])) {
        $id_siswa = $_GET['ubah'];
        $query = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa'" ;
        $sql = mysqli_query($conn, $query);
        $result = mysqli_fetch_array($sql);

        $nisn = $result["nisn"];
        $nama_siswa = $result["nama_siswa"];
        $jenis_kelamin = $result["jenis_kelamin"];
        $alamat = $result["alamat"];

        // var_dump($result);
        // die();
    }
?>

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

    <div class="container mt-3">
        <!-- enctype agar type foto dapat diproses -->
        <form method="post" action="proses.php" enctype="multipart/form-data">
            <input type="hidden" value=" <?php echo $id_siswa; ?>" name="id_siswa" >
            <div class="mb-3 row">
                <label bel for="nisn" class="col-sm-2 col-form-label">NISN</label>
                <div class="col-sm-10">
                    <input required type="text" name="nisn" class="form-control" id="nisn" placeholder="Ex: 112233" value="<?php echo $nisn; ?>" >
                </div>  
            </div>

            <div class="mb-3 row">
                <label bel for="Name" class="col-sm-2 col-form-label">Nama Siswa</label>
                <div class="col-sm-10">
                    <input required type="text" name="nama_siswa" class="form-control" id="Name" placeholder="Ex: Rudi Tabudi" value="<?php echo $nama_siswa; ?>">
                </div>  
            </div>

            <div class="mb-3 row">
                <label bel for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select required id="jk" name="jenis_kelamin" class="form-select" aria-label="Default select example">
                        <option <?php if($jenis_kelamin == "Laki - Laki"){ echo "selected";} ?> value="Laki - Laki">Laki - Laki</option>
                        <option <?php if($jenis_kelamin == "Perempuan"){ echo "selected";} ?> value="Perempuan" >Perempuan</option>
                    </select>
                </div>  
            </div>

            <div class="mb-3 row">
                <label for="foto" class="col-sm-2 col-form-label ">Foto Siswa</label>
                <div class="col-sm-10">
                    <input <?php if(!isset($_GET['ubah'])){ echo "required" ; } ?> class="form-control" type="file" name="foto" id="foto" accept="image/*"> <!-- accept agar fokus kegambar -->
                </div>  
            </div>

            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label ">Alamat</label>
                <div class="col-sm-10">
                    <textarea required class="form-control" id="alamat" name="alamat" rows="3" ><?php echo $alamat; ?></textarea> <!-- required tidak boleh kosong -->
                </div>  
            </div>

            <div class="mb-3 row mt-3">
                <div class="col">
                    <?php
                        if (isset($_GET['ubah'])) {
                    ?>
                        <button type="submit" name="aksi" value="edit" class="btn btn-primary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Simpan Perubahan
                        </button>
                    <?php
                        } else{
                    ?>
                        <button type="submit" name="aksi" value="tambah" class="btn btn-primary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Tambah
                        </button>

                    <?php
                        }
                    ?>

                    <a href="index.php" type="button" class="btn btn-danger">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>
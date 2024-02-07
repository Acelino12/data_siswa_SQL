<?php

    include "koneksi.php";

    if (isset($_POST["aksi"])) {
        if ($_POST["aksi"] == "tambah") {

            $nisn = $_POST['nisn']; // ambil dari name = nisn
            $nama_siswa = $_POST['nama_siswa'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $foto = $_FILES['foto']['name'];
            $alamat = $_POST['alamat'];

            $directory = "img/";
            $tmpFile = $_FILES['foto']['tmp_name'] ;

            // memindahkan data file dari defauld menuju tempat yang kita inginkan
            move_uploaded_file($tmpFile,$directory.$foto);

            $query = "INSERT INTO tb_siswa VALUES(null, '$nisn', '$nama_siswa','$jenis_kelamin','$foto','$alamat')";
            $sql = mysqli_query($conn, $query) ;

            if ($sql) {
                header("location: index.php");  // berpindah ke home
                // echo "berhasil <a href='index.php'>Home</a>";
            } else {
                echo $query;
            }

            // melakukan pengecekan data dari mysql
            // var_dump($_POST);
            // var_dump($_FILES); // agar file .jpg dapat terlihat
            // die(); // sama seperti break
            // echo"Tambah Data <a href='index.php'>Home</a> ";
        }   
        else if ($_POST["aksi"] == "edit") {
            // echo "Edit Data  <a href='index.php'>Home</a> ";

            $id_siswa = $_POST['id_siswa'];
            $nisn = $_POST['nisn']; // ambil dari name = nisn
            $nama_siswa = $_POST['nama_siswa'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $alamat = $_POST['alamat'];

            // deteksi file foto
            $queryShow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa'" ;
            $sqlShow = mysqli_query($conn, $queryShow) ;
            $result = mysqli_fetch_array($sqlShow) ;

            // apakah input foto kosong
            if($_FILES["foto"]["name"] == "") { //null
                $foto = $result['foto_siswa'] ; //output nama foto yang lama
            } else {
                $foto = $_FILES["foto"]["name"] ;
                unlink("img/".$result["foto_siswa"]);
                move_uploaded_file($_FILES["foto"]["tmp_name"],"img/".$_FILES["foto"]["name"]);
            }

            $query = "UPDATE tb_siswa SET nisn='$nisn', nama_siswa='$nama_siswa', 
                    jenis_kelamin='$jenis_kelamin', alamat='$alamat', foto_siswa='$foto' WHERE id_siswa='$id_siswa'; ";
            $sql = mysqli_query($conn, $query) ;
            header("location: index.php");
            // var_dump($_POST);
        }
    }

    if (isset($_GET['hapus'])) {
        $id_siswa = $_GET['hapus'];

        // melakukan deteksi foto
        $queryShow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa'" ;
        $sqlShow = mysqli_query($conn, $queryShow) ;
        $result = mysqli_fetch_array($sqlShow) ;
        // hapus foto
        unlink("img/". $result["foto_siswa"]);

        // menghapus table data
        $query = "DELETE FROM tb_siswa WHERE id_siswa = '$id_siswa' ";
        $sql = mysqli_query($conn, $query);
        if ($sql) {
            header("location: index.php");
            // echo "berhasil <a href='index.php'>Home</a>";
        } else {
            echo $query;
        }
        // echo " Hapus data <a href='index.php'>Home</a>";
    }

<?php
    include "fungsi.php";
    session_start();
    
    if (isset($_POST["aksi"])) {
    //tambah
        if ($_POST["aksi"] == "tambah") {

            $berhasil = tambah_data($_POST,$_FILES);

            if ($berhasil) {
                $_SESSION["eksekusi"] = "data berhasil ditambahkan";
                header("location: index.php");  // berpindah ke home
            } else {
                echo $berhasil;
            }
        }   
    // edit
        else if ($_POST["aksi"] == "edit") {

            $berhasil = ubah_data($_POST,$_FILES);

            if ($berhasil) {
                $_SESSION["eksekusi"] = "data berhasil diperbarui";
                header("location: index.php");  // berpindah ke home
            } else {
                echo $berhasil;
            }
        }
    }

    // hapus
    if (isset($_GET['hapus'])) {
        
        $berhasil = hapus_data($_GET);

        if ($berhasil) {
            $_SESSION["eksekusi"] = "data berhasil dihapus";
            header("location: index.php");
        } else {
            echo $berhasil;
        }
    }
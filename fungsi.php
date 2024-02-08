<?php
    include "koneksi.php";
    function tambah_data($data,$files){

        $nisn = $data['nisn']; // ambil dari name = nisn // $_POST  diubah mejadi $data
        $nama_siswa = $data['nama_siswa'];
        $jenis_kelamin = $data['jenis_kelamin'];

        $split = explode('.',$files['foto']['name']) ; // fungsi explode untuk memisahkan "." kebelakang

        // echo count($split); // melihat berapa banyak array
        $ekstensi = $split[1] ;
        
        $foto = $nisn.".".$ekstensi;   // agar nama foto di ubah sesuai nisn      // $files['foto']['name']   // $_FILES diubah menjadi $files
        $alamat = $data['alamat'];

        $directory = "img/";
        $tmpFile = $files['foto']['tmp_name'] ;

        // memindahkan data file dari defauld menuju tempat yang kita inginkan
        move_uploaded_file($tmpFile,$directory.$foto);

        $query = "INSERT INTO tb_siswa VALUES(null, '$nisn', '$nama_siswa','$jenis_kelamin','$foto','$alamat')";

        // ($conn, $query) di ubah ($GLOBALS['conn'], $query) karena fariable conn ada di global
        $sql = mysqli_query($GLOBALS['conn'], $query) ; 

        // agar mengembalikan ke dalam proses
        return true;
    }

    function ubah_data($data,$files){
        $id_siswa = $data['id_siswa'];
            $nisn = $data['nisn']; // ambil dari name = nisn
            $nama_siswa = $data['nama_siswa'];
            $jenis_kelamin = $data['jenis_kelamin'];
            $alamat = $data['alamat'];

            // deteksi file foto
            $queryShow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa'" ;
            $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow) ;
            $result = mysqli_fetch_array($sqlShow) ;

            // apakah input foto kosong
            if($files["foto"]["name"] == "") { //null
                $foto = $result['foto_siswa'] ; //output nama foto yang lama
            } else {
                $split = explode('.',$files['foto']['name']) ;
                $ekstensi = $split[1] ;

                $foto = $result["nisn"].".".$ekstensi ;
                unlink("img/".$result["foto_siswa"]);
                move_uploaded_file($files["foto"]["tmp_name"],"img/".$foto);
            }

            $query = "UPDATE tb_siswa SET nisn='$nisn', nama_siswa='$nama_siswa', 
                    jenis_kelamin='$jenis_kelamin', alamat='$alamat', foto_siswa='$foto' WHERE id_siswa='$id_siswa'; ";
            $sql = mysqli_query($GLOBALS['conn'], $query) ;

            return true;
    }

    function hapus_data($data){
        $id_siswa = $data['hapus'];

        // melakukan deteksi foto
        $queryShow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa'" ;
        $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow) ;
        $result = mysqli_fetch_array($sqlShow) ;

        // hapus foto
        unlink("img/". $result["foto_siswa"]);

        // menghapus table data
        $query = "DELETE FROM tb_siswa WHERE id_siswa = '$id_siswa' ";
        $sql = mysqli_query($GLOBALS['conn'], $query);
        return true;
    }
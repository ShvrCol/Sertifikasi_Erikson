<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class userModel extends Model
{
    use HasFactory;
    public $timestamps = false;

    //cek login
    public function cekLogin($tboxLogin){
        $queryCekLogin = "SELECT * from admin WHERE username = :username AND password = :password";
        $executeQueryCekLogin = DB::select($queryCekLogin, $tboxLogin);

        if(isset($executeQueryCekLogin) && count($executeQueryCekLogin) > 0){
            return $executeQueryCekLogin;
        }
        return null;
    }

    //Untuk insert peminjam buku
    function post_insert($tboxinsertpeminjam)
    {
        $queryinsert = "INSERT INTO pinjaman( id_pinjaman, id_member, id_buku, tgl_pinjaman, tgl_pengembalian, tgl_wajib_kembali, `status`, img, delete_pinjaman) VALUES (:add_idpeminjam, :add_idmember, :add_idbuku, :add_tglpinjam, :add_tglkembali, :add_tglwajibkembali, :add_status, :add_filename,'0')";
        $executequeryinsert = DB::insert($queryinsert, $tboxinsertpeminjam);
        return $executequeryinsert;
    }

    //query menampilkan koleksi buku disort by judulnya pada page member
    function get_koleksi()
    {
        $queryKoleksi = "SELECT judul, pembuat, penerbit, tahun_terbit, stok FROM buku ORDER BY judul ASC;";
        $executequeryKoleksi = DB::select($queryKoleksi);
        return $executequeryKoleksi;
    }


    //query menampilkan koleksi buku disort by judulnya pada page admin
    function get_dashadmin()
    {
        $queryKoleksi = "SELECT judul, pembuat, penerbit, tahun_terbit, stok FROM buku ORDER BY judul ASC;";
        $executequeryKoleksi = DB::select($queryKoleksi);
        return $executequeryKoleksi;
    }

    //query menampilkan members di sort by nama pada page admin
    function get_adminembers()
    {
        $queryKoleksi = "SELECT id_member, nama_member, email, alamat, nomor_tlp FROM members WHERE delete_member = 0 ORDER BY nama_member ASC;";
        $executequeryKoleksi = DB::select($queryKoleksi);
        return $executequeryKoleksi;
    }

    //query update untuk melakukan delete member pada admin
    public function deleteMembers($id_member){
        $update = "UPDATE `members` SET `delete_member` = 1 WHERE id_member = '".$id_member."'";
        $cmd = DB::update($update);
        return true;
    }

    //query Update di page updatestok
    function post_update($tboxupdatemenu)
    {
        $cmd = "UPDATE buku SET stok = :stok WHERE id_buku = :id_buku";
        $result = DB::update($cmd, $tboxupdatemenu);
        // dd($result);
        return $result;
    }

    //pengembalian
    function post_updatepinjaman($tboxupdatemenu)
    {
        $cmd = "UPDATE pinjaman SET `status` = :status_pjm WHERE id_pinjaman = :id_pinjaman AND id_buku = :id_buku";
        $result = DB::update($cmd, $tboxupdatemenu);
        // dd($result);
        return $result;
    }
}

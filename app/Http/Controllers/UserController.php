<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\userModel;

class UserController extends Controller
{
    //LOGIN ADMIN
    public function send_login(Request $request)
    {
        session_start();

        $loginUname = $request->input('username');
        $loginPass = $request->input('password');

        $tboxLogin = [
            'username' => $loginUname,
            'password' => $loginPass
        ];

        $sambungKeModel = new userModel();
        $loginCountCheck = $sambungKeModel->cekLogin($tboxLogin);


        if ($loginCountCheck) {

            //logi sesi admin
            Session::flash('success', 'Anda berhasil login');
            return redirect('/dashboardadmin');
        } else {

            Session::flash('loginError', 'Email atau password salah.');
            return redirect('/login');
        }
    }


    //function untuk insert data peminjaman dari member
    public function send_addpeminjaman(request $request)
    {
        $add_idpeminjam = $request->input('id_pinjaman');
        $add_idmember = $request->input('id_member');
        $add_idbuku = $request->input('id_buku');
        $add_tglpinjam = $request->input('tgl_pinjaman');
        $add_tglkembali = $request->input('tgl_pengembalian');
        $add_tglwajibkembali = $request->input('tgl_wajib_pengembalian');
        $add_status = $request->input('status');

        $connpostinsert = new userModel();

        $tboxinsertpeminjam = [
            'add_idpeminjam' => $add_idpeminjam,
            'add_idmember' => $add_idmember,
            'add_idbuku' => $add_idbuku,
            'add_tglpinjam' => $add_tglpinjam,
            'add_tglkembali' => $add_tglkembali,
            'add_tglwajibkembali' => $add_tglwajibkembali,
            'add_status' => $add_status,
        ];

        $checkinsert = $connpostinsert->post_insert($tboxinsertpeminjam);

        if ($checkinsert == 1) {


            Session::flash('success', 'Data Berhasil di insert');
            return redirect('/peminjaman');

            Session::flash('loginError', 'Mohon Data yang kosong');
        }
    }

    //
    public function loginIndex()
    {
        return view('/login', [
            'title' => 'login',
            'active' => 'login'
        ]);
    }

    //untuk menampilkan katalog pada member
    public function send_koleksi()
    {
        $member = new userModel();
        $koleksiBuku = $member->get_koleksi();
        return view('welcome', compact('koleksiBuku'));
    }

    //function untuk menampilkan katalog pada dashboard admin
    public function send_dashadmin()
    {
        $admin = new userModel();
        $dashAdmin = $admin->get_dashadmin();
        return view('dashboardadmin', compact('dashAdmin'));
    }

    //function untuk menampilkan katalog pada dashboard admin
    public function send_adminmembers()
    {
        $adminmembers = new userModel();
        $dashAdminMembers = $adminmembers->get_adminembers();
        return view('members', compact('dashAdminMembers'));
    }

    //function delete members pada admin
    function send_deletemembers(Request $request){
        $id_member = $request->input('id_member');
        $sambungKeModel = new userModel();
        $DeleteMembers = $sambungKeModel->deleteMembers($id_member);
        return redirect('/members');
    }

    //function update stok manual
    public function send_updatestok(request $request)
    {
        $add_idbuku = $request->input('id_buku');
        $add_stok = $request->input('stok');

        $sambungpostupdate = new userModel();

        $tboxupdatemenu = [
            'id_buku' => $add_idbuku,
            'stok' => $add_stok
        ];

        $sambungpostupdate->post_update($tboxupdatemenu);
        return redirect('/dashboardadmin');
    }
}

<?php

function belum_login()
{
    // buat instansiasi, karena kita tidak bisa membuat this begitu saja
    $ci = get_instance();
    // jika user belum login maka arahkan ke halaman login
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        // jika sudah login di cek dulu, user tersebut dari level apa dengan cara mengambil data dari session level
        $id_role   = $ci->session->userdata('id_role');
        // kemudian cek, kita berada di menu apa dengan menggunakan uri->segment()
        $menu       = $ci->uri->segment(1);
        // jika user di izinkan mengakses menu, maka tidak ada error
        // tetapi jika user tidak ada izin, maka tampilkan halaman error

        // lalu query tb_menu untuk mendapatkan id_menu
        $queryMenu  = $ci->db->get_where('tb_user_menu', ['menu'  => $menu])->row_array();
        $menuId     = $queryMenu['id_menu'];

        // kemudian cek id menu dan cocokan dengan tb akses menu
        $queryAccessMenu    = $ci->db->get_where('tb_user_access_menu', [
            'id_role'  => $id_role,
            'id_menu'   => $menuId
        ]);

        // lalu di cek kembali, jika user akses ada datanya maka jalankan
        // jika tidak ada atau < 1, maka arahkann ke halaman blocked
        if ($queryAccessMenu->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

// function cek akses untuk membuat checked 
// variabel yang ada pada function ini dikirimkan dari halaman role akses
function cek_akses($id_role, $id_menu)
{
    $ci = get_instance();
    // get data terlebih dahulu dari tabel user akses menu, kemudian di sesuaikan
    // id_role = $id_role dan id_menu = $id_menu
    $akses_menu = $ci->db->get_where('tb_user_access_menu', [
        'id_role'  => $id_role,
        'id_menu'   => $id_menu
    ]);

    // jika query akses menu tersebut nilainya lebih dari 1, atau bernilai TRUE maka tampilkan checked

    if ($akses_menu->num_rows() > 0) {
        return "checked='checked'";
    }
}

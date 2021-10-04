<?php
defined('BASEPATH') or exit('No direct script access allowed');

class web extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['konten'] = $this->load->view('dashboard', NULL, TRUE);
        $this->load->view('main', $data);
    }
    public function lihat_ketegori()
    {
        $data['konten'] = $this->load->view('kategori', NULL, TRUE);
        $this->load->view('main', $data);
    }
    public function lihat_cari()
    {
        $data['konten'] = $this->load->view('cari', NULL, TRUE);
        $this->load->view('main', $data);
    }
    public function cari_data(){
		$respon['respon']='sukses'; 
		echo json_encode($respon);
	}
    public function masuk()
    {

        $post = $this->input->post();

        function antiInjection($str)
        {
            $r = stripslashes(strip_tags(htmlspecialchars($str, ENT_QUOTES)));
            return $r;
        }
        $user = @antiInjection($post['uname']);
        $pass = $post['upass'];
        $password = @paramEncrypt($pass);


        $get = $this->db->query("SELECT * FROM master_user WHERE uname = '$user' AND upass = '$password'");
        $hasil = $get->row();


        if (!empty($hasil)) {
            $this->session->set_userdata('usersession', $hasil);
            $respon['respon'] = 'sukses';
        } else {
            $respon['respon'] = 'gagal';
        }



        echo json_encode($respon);
    }
    public function cari_username()
    {

        $post = $this->input->post();


        $this->db->where('uname', $post['uname']);
        $get = $this->db->get('master_user')->row();
        // echo 'Haloo';
        if (!empty($get)) {
            $ambil['response'] = 'ada';
        } else {
            $ambil['response'] = 'kosong';
        }


        echo json_encode($ambil);
    }
    public function daftar()
    {
        $input = $this->input->post();
        $input['upass'] = paramEncrypt(@$input['upass']);
        $get = $this->db->insert('master_user', $input);

        if (!empty($get)) {
            $respon['respon'] = 'sukses';
        } else {
            $respon['respon'] = 'gagal';
        }


        echo json_encode($respon);
    }
    public function edit_profile()
    {
        $input = $this->input->post();
        $user = $this->session->userdata('usersession');

        $this->db->where('id', $user->id);
        $this->db->where('upass', paramEncrypt(@$input['upass']));
        $ambil = $this->db->get('master_user')->row();

        if (!empty($ambil)) {
            $input['upass'] = paramEncrypt(@$input['upass']);
            $this->db->where('id', $input['id']);
            $get = $this->db->update('master_user', $input);
            $respon['respon'] = 'sukses';
        } else {
            $respon['respon'] = 'gagal';
        }


        echo json_encode($respon);
    }


    public function logout()
    {
        $this->session->unset_userdata('usersession');
        $this->session->sess_destroy();
        clearstatcache();
        redirect($this->cname);
    }
}

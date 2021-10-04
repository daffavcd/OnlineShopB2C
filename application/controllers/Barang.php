<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('usersession') == FALSE) {
            $message = "Silahkan Login Terlebih Dahulu !";
            echo "<script type='text/javascript'>alert('$message');</script>";
            redirect(base_url('web'));
        }
    }

    public function lihat_barang()
    {
        $data['konten'] = $this->load->view('barang', NULL, TRUE);
        $this->load->view('main', $data);
    }
    public function masuk_keranjang()
    {
        $input = $this->input->post();

        $this->db->where('id_produk', $input['id_produk']);
        $this->db->where('id_user', $input['id_user']);
        @$ambil = $this->db->get('opsi_transaksi_temp')->row();

        if (!empty($ambil)) {
            $data['jumlah'] = ($ambil->jumlah + $input['jumlah']);
            $data['keterangan'] = $input['jumlah'];
            $this->db->where('id_produk', $input['id_produk']);
            $this->db->where('id_user', $input['id_user']);
            $get = $this->db->update('opsi_transaksi_temp', $data);
        } else {
            $get = $this->db->insert('opsi_transaksi_temp', $input);
        }

        if (!empty($get)) {
            $respon['respon'] = 'sukses';
        } else {
            $respon['respon'] = 'gagal';
        }


        echo json_encode($respon);
    }
}

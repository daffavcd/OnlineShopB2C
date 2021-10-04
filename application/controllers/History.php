<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('usersession') == FALSE) {
            redirect(base_url('web'));
        }
    }
    public function transaksi()
    {
        $data['konten'] = $this->load->view('transaksi', NULL, TRUE);
        $this->load->view('main', $data);
    }
    public function index()
    {
        $data['konten'] = $this->load->view('history', NULL, TRUE);
        $this->load->view('main', $data);
    }
    public function tanggapan()
    {
        $data['konten'] = $this->load->view('tanggapan', NULL, TRUE);
        $this->load->view('main', $data);
    }
    public function detail()
    {
        $data['konten'] = $this->load->view('detail', NULL, TRUE);
        $this->load->view('main', $data);
    }
    public function simpan_tanggapan()
    {
        $input = $this->input->post();
        $no = 1;
        $this->db->from('opsi_transaksi');
        $this->db->order_by('opsi_transaksi.id', 'desc');
        $this->db->join('data_produk', 'data_produk.id = opsi_transaksi.id_produk', 'left');
        $this->db->where('opsi_transaksi.kode_transaksi', $input['kode_transaksi']);
        @$ambil = $this->db->get()->result();
        foreach ($ambil as $key => $value) {

            $masuk['rating'] = $input['isibintang_' . $no];
            $masuk['komentar'] = $input['komentar_' . $no];

            $this->db->where('id_produk', $value->id_produk);
            $this->db->where('kode_transaksi', $input['kode_transaksi']);
            $get= $this->db->update('opsi_transaksi', $masuk);
            
            $no++;
        }

        if (!empty($get)) {
            $respon['respon'] = 'sukses';
        } else {
            $respon['respon'] = 'gagal';
        }


        echo json_encode($respon);
    }
}

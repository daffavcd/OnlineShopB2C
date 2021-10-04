<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('usersession') == FALSE) {
            redirect(base_url('web'));
        }
    }

    public function index()
    {
        $data['konten'] = $this->load->view('keranjang', NULL, TRUE);
        $this->load->view('main', $data);
    }
    public function transaksi()
    {
        $data['konten'] = $this->load->view('transaksi', NULL, TRUE);
        $this->load->view('main', $data);
    }
    public function hapus()
    {
        $input = $this->input->post();

        $this->db->where('id', $input['id']);
        $this->db->delete('opsi_transaksi_temp');
        echo $this->db->last_query();
        
    }
    public function masuk_transaksi()
    {
        $input = $this->input->post();
        $user = $this->session->userdata('usersession');


        $this->db->from('opsi_transaksi_temp');
        $this->db->join('data_produk', 'data_produk.id = opsi_transaksi_temp.id_produk', 'left');
        $this->db->where('opsi_transaksi_temp.id_user', $user->id);
        $get_data = $this->db->get()->result();
        $biaya_total = 0;
        foreach ($get_data as $key => $value) {
            $input['kode_transaksi'] = $input['kode_transaksi'];
            $input['id_produk'] = $value->id_produk;
            $input['jumlah'] = $value->jumlah;
            $input['keterangan'] = $value->keterangan;
            $biaya_total += ($value->jumlah * $value->harga);

            $get = $this->db->insert('opsi_transaksi', $input);

            $this->db->where('id', $value->id_produk);
            $get_produk = $this->db->get('data_produk')->row();

            $input3['stok'] = ((int)$get_produk->stok - (int)$value->jumlah);
            $this->db->where('id', $value->id_produk);
            $this->db->update('data_produk', $input3);
        }
        $input2['status'] = 'Belum Dibayar';
        $input2['tgl_transaksi'] = date('Y-m-d');
        $input2['kode_transaksi'] = $input['kode_transaksi'];
        $input2['id_user'] = $user->id;
        $input2['biaya_total'] = ($biaya_total + 34000);
        $this->db->insert('transaksi', $input2);


        if (!empty($get)) {
            $this->db->where('id_user', $user->id);
            $this->db->delete('opsi_transaksi_temp');
        }
        $awan['respon'] = 'sukses';
        echo json_encode($awan);
    }
    public function update_transaksi()
    {
        $input = $this->input->post();

        $filename = substr(date("Y"), 2, 4) . date("mdHis");

        if (!empty($_FILES['gambar_1']['tmp_name'])) {
            move_uploaded_file(
                $_FILES['gambar_1']['tmp_name'],
                './component/bukti_pembayaran/' . 'BT_' . $filename . '.' . pathinfo($_FILES['gambar_1']['name'], PATHINFO_EXTENSION)
            );
            $gambar1  = 'BT_' . $filename . '.' . pathinfo($_FILES['gambar_1']['name'], PATHINFO_EXTENSION);

            if ($input['gambar_1_old'] != '') {
                $path1   = './component/bukti_pembayaran/' . $input['gambar_1_old'];
                unlink($path1);
            }

            $input2['bukti_transfer'] = $gambar1;
        } else {
            $input2['bukti_transfer'] = $input['gambar_1_old'];
        }
        $input2['status'] = 'Menunggu';
        unset($input['gambar_1_old']);
        $this->db->where('kode_transaksi', $input['kode_transaksi']);
        $insert = $this->db->update('transaksi', $input2);
        if ($insert) {
            $data['response'] = 'sukses';
        } else {
            $data['response'] = 'gagal';
        }


        echo json_encode($data);
    }
}

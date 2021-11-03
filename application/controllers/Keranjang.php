<?php
defined('BASEPATH') or exit('No direct script access allowed');
include("./vendor/autoload.php");

class Keranjang extends MY_Controller
{
    var $oracle_region = "ap-melbourne-1";
    var $oracle_access_key = "0286972d61f1a7871406c666f2add4313c693e7c";
    var $oracle_secret_key = "xUp77cXErp0F8EwfNPrrNIEYjeE+BvS4tN4bnZy42rM=";
    var $oracle_namespace = "axg2uln4zrfd";

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
            // move_uploaded_file(
            //     $_FILES['gambar_1']['tmp_name'],
            //     './component/bukti_pembayaran/' . 'BT_' . $filename . '.' . pathinfo($_FILES['gambar_1']['name'], PATHINFO_EXTENSION)
            // );
            $gambar1  = 'BT_' . $filename . '.' . pathinfo($_FILES['gambar_1']['name'], PATHINFO_EXTENSION);

            // if ($input['gambar_1_old'] != '') {
            //     $path1   = './component/bukti_pembayaran/' . $input['gambar_1_old'];
            //     unlink($path1);
            // }

            // $this->upload_file_oracle('mrshop-bukti_pembayaran', '', $_FILES['gambar_1']['tmp_name']);
            $bucket_name = "mrshop-bukti_pembayaran";
            $file_uri = $_FILES['gambar_1']['tmp_name'];

            $keyname = $gambar1;
            $endpoint =  "{$bucket_name}/{$keyname}";
            $s3 = $this->get_oracle_client($endpoint);
            $s3->getEndpoint();

            $file_url = "https://objectstorage." . $this->oracle_region . ".oraclecloud.com/n/" . $this->oracle_namespace . "/b/{$bucket_name}/o/{$keyname}";
            try {
                $s3->putObject(array(
                    'Bucket' => $bucket_name,
                    'Key' => $keyname,
                    'SourceFile' => $file_uri,
                    'ContentType' => 'image/jpeg',
                    'StorageClass' => 'REDUCED_REDUNDANCY'
                ));

                $input2['bukti_transfer'] = $gambar1;
            } catch (S3Exception $e) {
                return array('success' => false, 'message' => $e->getMessage());
            } catch (Exception $e) {
                return array('success' => false, 'message' => $e->getMessage());
            }
            $input2['status'] = 'Menunggu';
        } else {
            $input2['status'] = 'Menunggu';
            unset($input['gambar_1_old']);
        }
        $this->db->where('kode_transaksi', $input['kode_transaksi']);
        $insert = $this->db->update('transaksi', $input2);
        if ($insert) {
            $data['response'] = 'sukses';
        } else {
            $data['response'] = 'gagal';
        }


        echo json_encode($data);
    }


    function get_oracle_client($endpoint)
    {
        $endpoint = "https://" . $this->oracle_namespace . ".compat.objectstorage." . $this->oracle_region . ".oraclecloud.com/{$endpoint}";

        return new Aws\S3\S3Client(array(
            'credentials' => [
                'key' => $this->oracle_access_key,
                'secret' => $this->oracle_secret_key,
            ],
            'version' => 'latest',
            'region' => $this->oracle_region,
            'bucket_endpoint' => true,
            'endpoint' => $endpoint
        ));
    }
}

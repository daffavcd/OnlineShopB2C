<?php
$nama = $this->uri->segment(3);
$kode2 = rawurldecode($nama);
$nama_fix = ucwords($kode2);

$this->db->like('nama_produk', $nama_fix);
$this->db->order_by('id', 'desc');
$this->db->where('stok >', '0');
$get_barang = $this->db->get('data_produk')->result();

?>
<?php if (empty($get_barang)) { ?>
    <div class="jual" style="margin-top: 20px;width: 1220px">
    <?php } else { ?>
        <div class="jual" style="margin-top: 20px;">
        <?php } ?>
        <h1 style="text-align: left;margin-top:10px">Hasil pencarian : <?php echo $nama_fix ?></h1>
        <?php


        if (empty($get_barang)) { ?>
            <h3>Barang dari kategori ini masih kosong !</h3>
            <?php } else {
            foreach ($get_barang as $key => $value) {
                $this->db->from('transaksi');
                $this->db->select('SUM(opsi_transaksi.rating) total_rating,COUNT(transaksi.id_user) total_user');
                $this->db->join('opsi_transaksi', 'opsi_transaksi.kode_transaksi = transaksi.kode_transaksi', 'left');
                $this->db->where('opsi_transaksi.id_produk', $value->id);
                $this->db->where('transaksi.status', 'Selesai');


                $bawa_rat = $this->db->get()->row();
                @$total_user = $bawa_rat->total_user;
                @$hasil = ($bawa_rat->total_rating / $total_user);
                @$total_bintang = round($hasil, 0);
            ?>
                <a href="<?php echo base_url('barang/lihat_barang/' . $value->id) ?>">
                    <div class="box-jual">
                        <div class="jual-atas">
                            <img src="<?php echo base_url('component/img/' . $value->gambar) ?>" style="max-height: 220px;" class="gambar-jual">
                        </div>
                        <div class="jual-bawah">
                            <h3 style="color: #000000;text-align: left;margin-top: 6px;"><?php echo $value->nama_produk ?></h3>
                            <h3 style="color: #e6891f;margin-top: -18px;text-align:left"><?php echo format_rupiah($value->harga) ?></h3>
                            <p style="text-align: left;margin-top: -16px">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $total_bintang) { ?>
                                        <span class="fa go fa-star checked"></span>
                                    <?php } else { ?>
                                        <span class="fa go fa-star"></span>
                                    <?php
                                    }
                                    ?>

                                <?php } ?>
                                <span style="color:#97a6b5">(<?php echo $total_user ?>)</span>
                            </p>
                        </div>
                    </div>
                </a>
        <?php
            }
        }
        ?>
        </div>
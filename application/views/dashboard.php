<!-- <div class="iklan">
    <div style="float: left;margin-right:10px">
        <img src="<?php echo base_url() ?>component/img/kfc.jpg" style="width: 700px;">
    </div>
    <div style="display: grid;float:left">
        <img src="<?php echo base_url() ?>component/img/iklanpep.jpg" style="width: 398px;">
        <img src="<?php echo base_url() ?>component/img/iklan2.jfif" style="width: 398px;margin-top:10px">
    </div>
</div> -->
<div class="kategori" style="margin-top: 20px">
    <h1 style="text-align: left;margin-top:10px">Kategori</h1>
    <?php

    $this->db->order_by('id', 'desc');
    $get_kategori = $this->db->get('master_kategori')->result();
    foreach ($get_kategori as $key => $value) { ?>
        <a href="<?php echo base_url('web/lihat_ketegori/' . $value->id) ?>">
            <div class="box-kategori">
                <div class="kategori-atas">
                    <img src="<?php echo base_url('component/img/' . $value->gambar_kategori) ?>" class="gambar-kategori">
                </div>
                <div class="kategori-bawah">
                    <h3 style="color: #000000;"><?php echo $value->nama_kategori ?></h3>
                </div>
            </div>
        </a>
    <?php
    }
    ?>
</div>

<div class="jual" style="margin-top: 20px">
    <h1 style="text-align: left;margin-top:10px">New Release</h1>
    <?php

    $this->db->order_by('id', 'desc');
    $this->db->where('stok >', '0');
    $this->db->limit(10);
    $get_barang = $this->db->get('data_produk')->result();
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
    ?>
</div>
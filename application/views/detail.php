<style>
    table,
    td,
    th {
        border: 1px solid #ddd;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 15px;
    }
</style>
<div class="jual-barang" style="margin-top: 20px;">
    <div>
        <div class="kiri">
            <h1>Detail Pesanan</h1><br>
        </div>
        <div>
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
                <?php
                $no = 1;
                $kode = $this->uri->segment(3);



                $this->db->from('opsi_transaksi');
                $this->db->join('data_produk', 'data_produk.id = opsi_transaksi.id_produk', 'left');
                $this->db->where('opsi_transaksi.kode_transaksi', $kode);
                @$ambil = $this->db->get()->result();
                foreach ($ambil as $key => $value) { ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $value->nama_produk ?></td>
                        <td><?php echo $value->jumlah ?> Buah</td>
                        <td><?php echo $value->keterangan ?></td>
                    </tr>
                <?php
                }

                ?>
                <tr>
                    <td colspan="4">
                        <?php
                        $this->db->where('kode_transaksi', $kode);
                        $get_data = $this->db->get('transaksi')->row();

                        if ($get_data->status == 'Menunggu') { ?>
                            <h3>*Bukti transfer yang anda kirimkan akan segera dikonfirmasi oleh admin.</h3>
                        <?php } else if ($get_data->status == 'Dikirim') { ?>
                            <h3>*Barang yang anda beli sedang dalam proses pengiriman oleh kurir mohon bersabar menunggu.</h3>
                        <?php } else if ($get_data->status == 'Diterima') { ?>
                            <h3>*Barang telah di terima oleh admin,barang anda akan segera kami kirimkan :) .</h3>
                        <?php } else if ($get_data->status == 'Selesai') { ?>
                            <h3>*Barang telah sampai ke tempat tujuan jika ada kesalahan silahkan hubungi nomor berikut untuk refund HP. 08234523123.</h3>
                        <?php } else if ($get_data->status == 'Belum Dibayar') { ?>
                            <h3>*Silahkan ke menu transaksi untuk mengupload bukti transfer pembayaran.</h3>
                        <?php } else if ($get_data->status == 'Ditolak') { ?>
                            <h3>*Bukti pembayaran yang anda kirimkan ditolak admin mohon update bukti pembayaran, jika ada kesalahan silahkan hubungi HP. 08234523123.</h3>
                        <?php } ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
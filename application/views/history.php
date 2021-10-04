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
            <h1>History</h1><br>
        </div>
        <div>
            <table>
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal Pengiriman</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                $no = 1;
                $user = $this->session->userdata('usersession');
                $this->db->order_by('id', 'desc');
                $this->db->where('id_user', $user->id);
                $get = $this->db->get('transaksi')->result();
                if (!empty($get)) {
                    foreach ($get as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $value->kode_transaksi ?></td>
                            <td><?php echo @tanggalIndo($value->tgl_transaksi) ?></td>
                            <td><?php echo $value->status ?></td>
                            <td>
                                <?php if ($value->status == 'Belum Dibayar') { ?>
                                    <a href="<?php echo base_url('history/detail/' . $value->kode_transaksi) ?>" style="margin-right: 10px;" class="tombol-hijau">Detail</a>
                                    <a href="<?php echo base_url('history/transaksi/' . $value->kode_transaksi) ?>" class="tombol-1"><?php if ($value->status != 'Belum Dibayar'){echo 'Update';} ?> Transaksi</a>
                                <?php } else if ($value->status == 'Menunggu') { ?>
                                    <a href="<?php echo base_url('history/detail/' . $value->kode_transaksi) ?>" style="margin-right: 10px;" class="tombol-hijau">Detail</a>
                                    <a href="<?php echo base_url('history/transaksi/' . $value->kode_transaksi) ?>" class="tombol-1"><?php if ($value->status != 'Belum Dibayar'){echo 'Update';} ?> Transaksi</a>
                                <?php } else if ($value->status == 'Diterima') { ?>
                                    <a href="<?php echo base_url('history/detail/' . $value->kode_transaksi) ?>" style="margin-right: 10px;" class="tombol-hijau">Detail</a>
                                <?php } else if ($value->status == 'Selesai') { ?>
                                    <a href="<?php echo base_url('history/detail/' . $value->kode_transaksi) ?>" style="margin-right: 10px;" class="tombol-hijau">Detail</a>
                                    <a href="<?php echo base_url('history/tanggapan/' . $value->kode_transaksi) ?>" class="tombol-kuning">Beri Tanggapan</a>
                                <?php } else if ($value->status == 'Dikirim') { ?>
                                    <a href="<?php echo base_url('history/detail/' . $value->kode_transaksi) ?>" style="margin-right: 10px;" class="tombol-hijau">Detail</a>
                                <?php } else if ($value->status == 'Ditolak') { ?>
                                    <a href="<?php echo base_url('history/detail/' . $value->kode_transaksi) ?>" style="margin-right: 10px;" class="tombol-hijau">Detail</a>
                                <?php } ?>

                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5" style="text-align: center">History anda masih kosong !</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
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
            <h1>Daftar Belanja</h1><br>
        </div>
        <div>
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                </tr>
                <?php
                $kode = 'KT_' . date('ymdhis');

                $user = $this->session->userdata('usersession');
                $this->db->where('id_user', $user->id);
                @$ambil = $this->db->get('opsi_transaksi_temp')->row();

                $no = 1;
                $this->db->from('opsi_transaksi_temp');
                $this->db->select('*,opsi_transaksi_temp.id as id_temp');
                
                $this->db->join('data_produk', 'data_produk.id = opsi_transaksi_temp.id_produk', 'left');
                $this->db->where('opsi_transaksi_temp.id_user', $user->id);
                @$ambil = $this->db->get()->result();
                if (!empty($ambil)) {
                    foreach ($ambil as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $value->nama_produk ?></td>
                            <td><?php echo $value->jumlah ?> Buah</td>
                            <td><a onclick="actDelete('<?php echo $value->id_temp; ?>')" style="margin-right: 10px;" class="tombol-merah"><i class="fa fa-trash"></i></a></a></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4" style="text-align: center">Keranjang anda masih kosong !</td>
                    </tr>
                <?php
                }
                if (!empty($ambil)) {
                ?>
                    <tr>
                        <td colspan="4">
                            <a onclick="lanjut()" class="tombol-krj">Lanjutkan Ke Transaksi</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
<div id="modal-hapus" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
        <header class="w3-container w3-teal">
            <span onclick="document.getElementById('hapus-modal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <h2>KONFIRMASI</h2>
        </header>
        <form id="form-login">
            <div class="w3-container" style="display: inline-grid;padding: 15px 0px 15px 0px;">
                <h2>Apa anda yakin ingin menghapus data tersebut ?</h2>
                <input type="hidden" id="id_temp">
            </div>
            <footer class="w3-container w3-teal" style="padding: 5px 0px 5px 0px;">
                <a onclick="hapus()" class="tombol-biru">HAPUS</a>
            </footer>
        </form>
    </div>
</div>
<script>
    function actDelete(key) {
        document.getElementById('modal-hapus').style.display='block';
        $('#id_temp').val(key);
    }

    function hapus() {
        var id = $('#id_temp').val();
        $.ajax({
            url: '<?php echo base_url('keranjang/hapus'); ?>',
            type: 'post',
            data: {
                id: id
            },
            beforeSend: function() {
                $(".tunggu").show();
            },
            success: function(hasil) {
                $(".tunggu").hide();
                document.getElementById('modal-hapus').style.display='none';

                 document.location.reload(true);
            }
        });
    }

    function lanjut() {
        var kode = "<?php echo $kode ?>";
        if (confirm('Apakah alamat yang ada di profile anda sudah sesuai ?')) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url() . 'keranjang/masuk_transaksi' ?>",
                cache: false,
                data: {
                    kode_transaksi: kode
                },
                dataType: 'Json',
                beforeSend: function() {
                    $(".tunggu").show();
                },
                success: function(data) {
                    if (data.respon == 'sukses') {
                        $(".tunggu").hide();
                        $(".alert_berhasil").show();
                        window.location = "<?php echo base_url('keranjang/transaksi/' . $kode); ?>";
                    } else {
                        alert('Gagal Menyimpan data');
                        $(".tunggu").hide();
                        setInterval(function() {
                            location.reload()
                        }, 2000);
                    }
                },
                error: function() {
                    alert("Data gagal dimasukkan.");
                }
            });
            return false;

        }
    }
</script>
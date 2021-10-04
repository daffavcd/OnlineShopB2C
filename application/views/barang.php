<?php
$user = $this->session->userdata('usersession');

$id = $this->uri->segment(3);
$this->db->order_by('id', 'desc');
$this->db->where('id', $id);
$get_barang = $this->db->get('data_produk')->row();

$this->db->where('id_produk', $id);
$this->db->where('id_user', $user->id);
@$ambil = $this->db->get('opsi_transaksi_temp')->row();

// Panggil Rating
$this->db->from('transaksi');
$this->db->select('SUM(opsi_transaksi.rating) total_rating,COUNT(transaksi.id_user) total_user,SUM(opsi_transaksi.jumlah) total_dibeli ');
$this->db->join('opsi_transaksi', 'opsi_transaksi.kode_transaksi = transaksi.kode_transaksi', 'left');
$this->db->where('opsi_transaksi.id_produk', $id);
$this->db->where('transaksi.status', 'Selesai');

$bawa_rat = $this->db->get()->row();
@$total_user = $bawa_rat->total_user;
@$hasil = round(($bawa_rat->total_rating / $total_user), 1);
@$total_bintang = round($hasil, 0);
// Panggil Rating
?>
<style>
    .gambar-brg {
        transition: transform .2s;
    }

    .gambar-brg:hover {
        -ms-transform: scale(1.2);
        /* IE 9 */
        -webkit-transform: scale(1.2);
        /* Safari 3-8 */
        transform: scale(1.2);
    }
</style>
<div class="jual-barang" style="margin-top: 20px;">
    <div style="display:flex">
        <div class="kiriatas" style="float: left">
            <img src="<?php echo base_url('component/img/' . $get_barang->gambar) ?>" class="gambar-brg">
        </div>
        <div class="kanan" style="float: left;padding-left:15px;width: 100%;">
            <h1 style="text-align: left;margin-top: 0px;"><?php echo $get_barang->nama_produk ?></h1>
            <p style="text-align: left;margin-top: -16px">
                <table>
                    <td style="border-right: #dbdbdb 1px solid;">
                        <span style="color:#97a6b5"><?php echo $hasil ?></span>
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
                        &nbsp
                    </td>
                    <td>
                        &nbsp
                        <span style="color:#97a6b5"><?php echo $bawa_rat->total_dibeli ?>x Terjual</span>
                    </td>
                </table>
            </p>
            <hr style="margin-top:-10px; border: 0; border-top: 1px solid rgba(49, 53, 59, 0.32);">
            <table>
                <td style="border-right: #dbdbdb 1px solid;    width: 100px;">
                    <h4 style="text-align: left;color:rgba(49, 53, 59, 0.46);">HARGA </h4>
                </td>
                <td style="padding-left: 18px">
                    <span style="color: #e6891f!important;font-size: 35px;"><?php echo format_rupiah($get_barang->harga) ?></span>
                </td>
            </table><br>
            <table>
                <td style="border-right: #dbdbdb 1px solid;    width: 100px;">
                    <h4 style="text-align: left;color:rgba(49, 53, 59, 0.46);">SISA STOK </h4>
                </td>
                <td style="text-align: justify;margin-left:40px;padding-left:18px">
                    <span style="color: #504b44;font-size: 18px;"><?php echo $get_barang->stok ?></span>
                </td>
            </table><br>
            <table>
                <td style="border-right: #dbdbdb 1px solid;    width: 100px;">
                    <h4 style="text-align: left;color:rgba(49, 53, 59, 0.46);">DESKRIPSI </h4>
                </td>
                <td style="text-align: justify;margin-left:40px;padding-left:18px">
                    <span style="color: #504b44;font-size: 18px;"><?php echo $get_barang->deskripsi ?>.</span>
                </td>
            </table>
        </div>
    </div>
</div>

<div class="jual-barang" style="margin-top: 20px;margin-bottom: 60px;">
    <div style="display:flex">
        <div class="kiri" style="float: left">
            <h1>Daftar Review</h1><br>
            <?php
            $no = 1;
            $this->db->from('opsi_transaksi');
            $this->db->join('transaksi', 'transaksi.kode_transaksi = opsi_transaksi.kode_transaksi', 'left');
            $this->db->join('master_user', 'master_user.id = transaksi.id_user', 'left');
            $this->db->order_by('opsi_transaksi.id', 'desc');
            $this->db->where('transaksi.status', 'Selesai');
            $this->db->where('opsi_transaksi.id_produk', $id);

            $ambil_table = $this->db->get()->result();
            if (!empty($ambil_table)) {
                foreach ($ambil_table as $key => $value) {
                    $now = time();
                    $your_date = strtotime($value->tgl_transaksi);
                    $datediff = $now - $your_date;
            ?>
                    <table class="table-comment">
                        <tr>
                            <td style="text-align: left">
                                <span style="color: #fdaf11;"><?php echo $value->nama_user ?> <br>
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $value->rating) { ?>
                                            <span class="fa go fa-star checked"></span>
                                        <?php } else { ?>
                                            <span class="fa go fa-star"></span>
                                        <?php
                                        }
                                        ?>

                                    <?php } ?>
                                    &nbsp <span style="color:#97a6b5"><?php if (round($datediff / (60 * 60 * 24)) == 0) {
                                                                            echo "Hari ini";
                                                                        } else {
                                                                            echo round($datediff / (60 * 60 * 24)) . ' hari yang lalu';
                                                                        } ?> </span>
                                </span>
                                <br><?php echo $value->komentar ?>
                            </td>
                        </tr>
                    </table>
                <?php
                }
            } else { ?>
                Jadilah yang pertama untuk mereview !
            <?php }
            ?>

        </div>
    </div>
</div>
</div>
<div class="kaki-beli">
    <form id="masuk_keranjang">
        <table style="float: right;margin-top: -20px;">
            <td style="padding-right: 10px;">
                <h4 style="text-align: left;color:rgba(49, 53, 59, 0.46);" class="input-bawah">Jumlah
                    <select name="jumlah" class="opsi" required>
                        <option value="">-- Masukkan Jumlah --</option>
                        <?php
                        for ($i = 1; $i <= $get_barang->stok; $i++) {
                        ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="hidden" name="id_user" value="<?php echo $user->id ?>">
                    <input type="hidden" name="id_produk" value="<?php echo $get_barang->id ?>">
                </h4>
            </td>
            <td>
                <h4 style="text-align: left;color:rgba(49, 53, 59, 0.46);" class="input-bawah">Keterangan
                    <input type="text" name="keterangan" maxlength="255" style="width: 390px;" value="<?php echo @$ambil->keterangan ?>" placeholder="Masukkan Keterangan... (ex: warna1=hijau,etc)" required>
                </h4>
            </td>

            <td>
                <button type="submit" class="tombol-krj"><i class="fa fa-shopping-cart"></i> Masukkan Keranjang</button>
            </td>
        </table>
    </form>
</div>
<script>
    $("#masuk_keranjang").submit(function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url() . 'barang/masuk_keranjang' ?>",
            cache: false,
            data: $(this).serialize(),
            dataType: 'Json',
            beforeSend: function() {
                $(".tunggu").show();
            },
            success: function(data) {
                if (data.respon == 'sukses') {
                    $(".tunggu").hide();
                    $(".alert_berhasil").show();
                    window.location = "<?php echo base_url('keranjang'); ?>";
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
    });
</script>
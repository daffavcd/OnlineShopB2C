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
            <h1>Tanggapan Produk</h1><br>
        </div>
        <div>
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Beri Rating</th>
                    <th>Beri Komentar</th>
                </tr>
                <form id="form_simpan">
                    <?php
                    $no = 1;
                    $kode = $this->uri->segment(3);



                    $this->db->from('opsi_transaksi');
                    $this->db->order_by('opsi_transaksi.id', 'desc');
                    $this->db->join('data_produk', 'data_produk.id = opsi_transaksi.id_produk', 'left');
                    $this->db->where('opsi_transaksi.kode_transaksi', $kode);
                    @$ambil = $this->db->get()->result();
                    foreach ($ambil as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $value->nama_produk ?></td>
                            <td>
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $value->rating) { ?>
                                        <span class="fa go fa-star checked" id="bintang<?php echo $i . '_' . $no ?>"></span>
                                    <?php } else { ?>
                                        <span class="fa go fa-star" id="bintang<?php echo $i . '_' . $no ?>"></span>
                                    <?php
                                    }
                                    ?>

                                <?php } ?>
                            </td>
                            <td style="width: 1px">
                                <input type="hidden" name="isibintang_<?php echo $no ?>" id="isibintang_<?php echo $no ?>" value="<?php echo $value->rating ?>">
                                <input type="text" style="width: 550px;" name="komentar_<?php echo $no ?>" id="komentar<?php echo $no ?>" placeholder="Masukkan Tanggapan.." value="<?php echo $value->komentar ?>">
                            </td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                    <tr>
                        <td colspan="4">
                            <input type="hidden" name="kode_transaksi" id="kode_transaksi" value="<?php echo $kode ?>">
                            <a onclick="simpan()" class="tombol-biru">Simpan</a>
                        </td>
                    </tr>
                </form>
                <tr>
                    <td colspan="4">
                        <h3>*Jika ada masalah terhadap barang mohon hubungi nomer berikut 08291238321.</h3>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>
<script>
    function simpan() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url() . 'history/simpan_tanggapan' ?>",
            cache: false,
            data: $('#form_simpan').serialize(),
            dataType: 'Json',
            beforeSend: function() {
                $(".tunggu").show();
            },
            success: function(data) {
                if (data.respon == 'sukses') {
                    $(".tunggu").hide();
                    $(".alert_berhasil").show();
                    document.location.reload(true);
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
    }
</script>
<script>
    <?php
    for ($i = 1; $i < $no; $i++) {
        for ($j = 1; $j <= 5; $j++) { ?>
            $("#bintang<?php echo $j . '_' . $i ?>").hover(function() {
                <?php for ($k = 1; $k <= $j; $k++) { ?>
                    document.getElementById("bintang<?php echo $k . '_' . $i ?>").className = "fa go fa-star checked";
                <?php } ?>
                <?php for ($l = ($j + 1); $l <= 5; $l++) { ?>
                    document.getElementById("bintang<?php echo $l . '_' . $i ?>").className = "fa go fa-star";
                <?php } ?>
           
            });
            // -------------------------------------------------------------------------
            $('#bintang<?php echo $j . '_' . $i ?>').on('click', function() {
                $(".tunggu").show();
                $('#isibintang<?php echo '_' . $i ?>').val('<?php echo $j ?>');
                <?php for ($k = 1; $k <= $j; $k++) { ?>
                    document.getElementById("bintang<?php echo $k . '_' . $i ?>").className = "fa go fa-star checked";
                <?php } ?>
                <?php for ($l = ($j + 1); $l <= 5; $l++) { ?>
                    document.getElementById("bintang<?php echo $l . '_' . $i ?>").className = "fa go fa-star";
                <?php } ?>
                setInterval(function() {
                    $(".tunggu").hide();
                    }, 100);         
            });
    <?php
        }
    }
    ?>
</script>
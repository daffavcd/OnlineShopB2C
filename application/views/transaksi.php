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
<?php 
 $kode=$this->uri->segment(3);
 $this->db->where('kode_transaksi', $kode);
 $get_data=$this->db->get('transaksi')->row();
 
?>
<div class="jual-barang" style="margin-top: 20px;">
    <div>
        <div class="kiri">
            <h1>Transaksi Pembelian</h1><br>
            <h1 style="margin-top: -40px;"><?php echo $get_data->kode_transaksi ?></h1>
        </div>
        <div>
            <form id="form-tambah">
            <table>
                <tr>
                    <td>
                        <h2>Total Pembayaran : <?php echo format_rupiah($get_data->biaya_total) ?></h2>
                        <h2 style="margin-top: -20px;">Transfer Ke Bank BCA No Rekening : 1234 567 822</u></h2>
                        <p style="font-size: 15px;">*Tujuan dan tarif pengiriman sudah dikalibrasi berdasarkan alamat  yang tertera di profile anda (Rp. 34.000 seluruh Indonesia).</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><b>Masukkan Bukti Transfer Pembayaran</b></label><br>
                        <input type="file" class="form-control input_file" <?php if(empty($get_data->bukti_transfer)){echo 'required';} ?> name="gambar_1" onchange="change_image1(event)">
                        <input type="hidden" value="<?php echo $get_data->bukti_transfer ?>" name="gambar_1_old">
                        <input type="hidden" value="<?php echo $get_data->kode_transaksi ?>" name="kode_transaksi">
                        <br>
                        <?php if (!empty($get_data->bukti_transfer)) { ?>
                            <a href="<?php echo base_url('component/bukti_pembayaran/' . $get_data->bukti_transfer) ?>" target="_blank">
                                <img style="width:300px" id="output_image1" src="<?php echo base_url('component/bukti_pembayaran/' . $get_data->bukti_transfer) ?>">
                            </a>
                        <?php } ?>
                        <br>

                        <img style="width:300px;" alt="" id="output_image_needed1">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <button type="submit" class="tombol-biru"><?php if($get_data->status=='Belum Dibayar'){echo 'Simpan';}else{echo 'Update';} ?></button>
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<script>
    function change_image1(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output_image_needed1');
            output.src = reader.result;
            $('#output_image1').hide();
        }
        reader.readAsDataURL(event.target.files[0]);

    }
    $("#form-tambah").submit( function() { 
        var form = $('#form-tambah')[0];
        var data = new FormData(form);

        $.ajax( {  
            type :"post",  
            url : "<?php echo base_url() . 'keranjang/update_transaksi' ?>",  
            cache :false,  
            enctype: 'multipart/form-data',
            data: data,
            processData: false,
            contentType: false,
            dataType: 'Json',
            beforeSend:function(){
                $(".tunggu").show();   
            },
            success : function(ambil) { 
                if (ambil.response == 'sukses') {
                    $(".tunggu").hide();   
                    $(".alert_berhasil").show();   
                    window.location="<?php echo base_url('history');?>";
                }else{
                    alert('Gagal Menyimpan data');
                    setInterval(function(){ location.reload() }, 2000);
                }
            },  
            error : function() {
                alert("Data gagal dimasukkan.");  
            }  
        });
        return false; 
    });

</script>
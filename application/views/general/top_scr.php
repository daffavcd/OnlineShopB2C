<!DOCTYPE html>
<html lang="en">

<head>
    <title>MR SHOP</title>
    <link href="<?php echo base_url(); ?>assets/style.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/stylew3.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/main/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <!-- Jquery JS-->
    <script src="<?php echo base_url(); ?>assets/main/vendor/jquery-3.2.1.min.js"></script>
</head>
<div class="tunggu" style="z-index:9999999999999999; background:rgba(255,255,255,0.8); width:100%; height:100%; position:fixed; top:0; left:0; text-align:center; padding-top:23%; display:none ; ">
    <img src="<?php echo base_url() ?>assets/images/rolling.gif" />
</div>

<div class="alert_berhasil" style="z-index:9999999999999999; background:rgba(255,255,255,0.8); width:100%; height:100%; position:fixed; top:0; left:0; text-align:center; padding-top:23%; display: none  ">
    <img src="<?php echo base_url() ?>assets/images/checked.png" />
</div>
<?php
$user = $this->session->userdata('usersession');
if (!empty($user)) {
    $this->db->where('id', $user->id);
    $bawa = $this->db->get('master_user')->row();
}

?>
<div id="login-modal" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
        <header class="w3-container w3-teal">
            <span onclick="document.getElementById('login-modal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <h2>LOGIN</h2>
        </header>
        <form id="form-login">
            <div class="w3-container" style="display: inline-grid;padding: 15px 0px 15px 0px;">
                <div style="float:left;margin-right:20px;">
                    <label for="uname">Username</label>
                    <input type="text" class="inputan" placeholder="Masukkan Username" id="uname" name="uname" required>
                </div>
                <div style="float:left;margin-right:20px;">
                    <label for="upass">Password</label>
                    <input type="password" class="inputan" placeholder="Masukkan password" id="upass" name="upass" required>
                </div>
            </div>
            <footer class="w3-container w3-teal" style="padding: 5px 0px 5px 0px;">
                <button type="submit" class="tombol-biru">LOGIN</button>
            </footer>
        </form>
    </div>
</div>
<div id="daftar-modal" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
        <header class="w3-container w3-teal">
            <span onclick="document.getElementById('daftar-modal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <h2>SIGN IN</h2>
        </header>
        <form id="form-daftar">
            <div class="w3-container" style="display:contents;padding: 15px 0px 15px 0px;">
                <div style="margin-top: 15px;">
                    <div style="float:left;margin-right:20px;margin-left: 15px;">
                        <label>Username</label>
                        <input type="text" class="inputan" placeholder="Masukkan Username" onchange="cari_username()" id="uname1" name="uname"><br>
                    </div>
                    <div style="float:left;margin-right:20px;">
                        <label>Password</label>
                        <input type="password" class="inputan" placeholder="Masukkan password" name="upass"><br>
                    </div>
                    <div style="float:left;margin-right:20px;">
                        <label>Nama</label>
                        <input type="text" class="inputan" placeholder="Masukkan Nama Lengkap" name="nama_user"><br>
                    </div>
                </div>
                <div style="float:left;margin-right:20px;margin-left: 15px;">
                    <label>Telepon</label>
                    <input type="number" class="inputan" placeholder="Masukkan No Telepon" name="telepon"><br>
                </div>
                <div style="float:left;margin-right:20px;">
                    <label>Email</label>
                    <input type="email" class="inputan" placeholder="Masukkan Email" name="email"><br>
                </div>
                <div style="float:left;margin-right:20px;">
                    <label>Alamat</label>
                    <input type="text" class="inputan" placeholder="Masukkan Alamat Lengkap" name="alamat">
                </div>
            </div>
            <footer class="w3-container w3-teal" style="padding: 5px 0px 5px 0px;margin-top: 15px;">
                <button type="submit" class="tombol-biru">SIGN IN</button>
            </footer>
        </form>
    </div>
</div>
<div id="edit-modal" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
        <header class="w3-container w3-teal">
            <span onclick="document.getElementById('edit-modal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <h2>UPDATE PROFILE</h2>
        </header>
        <form id="form-edit">
            <div class="w3-container" style="display:contents;padding: 15px 0px 15px 0px;">
                <div style="margin-top: 15px;">
                    <div style="float:left;margin-left: 15px;">
                        <label>Nama</label>
                        <input type="text" class="inputan" placeholder="Masukkan Nama Lengkap" name="nama_user" value="<?php echo @$bawa->nama_user ?>"><br>
                        <input type="hidden" name="id" value="<?php echo @$bawa->id ?>">
                    </div>
                    <div style="float:left;margin-right:20px;margin-left: 15px;">
                        <label>Telepon</label>
                        <input type="number" class="inputan" placeholder="Masukkan No Telepon" name="telepon" value="<?php echo @$bawa->telepon ?>"><br>
                    </div>
                    <div style="float:left;margin-right:20px;">
                        <label>Email</label>
                        <input type="email" class="inputan" placeholder="Masukkan Email" name="email" value="<?php echo @$bawa->email ?>"><br>
                    </div>
                </div>
                <div style="float:left;margin-right:15px;margin-left: 15px;">
                    <label>Alamat</label>
                    <input type="text" class="inputan" placeholder="Masukkan Alamat Lengkap" name="alamat" value="<?php echo @$bawa->alamat ?>">
                </div>
                <div style="float:left;margin-right:20px;">
                    <label>Masukkan Password</label>
                    <input type="password" class="inputan" id="password2" placehlder="Masukkan password" name="upass"><br>
                </div>
            </div>
            <footer class="w3-container w3-teal" style="padding: 5px 0px 5px 0px;margin-top: 15px;">
                <button type="submit" class="tombol-biru">UPDATE</button>
            </footer>
        </form>
    </div>
</div>
<script type="text/javascript">
    $("#form-login").submit(function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url() . 'web/masuk' ?>",
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
                    document.location.reload(true);
                } else if (data.respon == 'gagal') {
                    $(".tunggu").hide();
                    alert('Password / Username yang anda masukkan salah !');
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

    function cari_username() {
        uname = $('#uname1').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url() . 'web/cari_username' ?>",
            cache: false,
            data: {
                uname: uname
            },
            dataType: 'Json',
            beforeSend: function() {
                $(".tunggu").show();
            },
            success: function(data) {
                if (data.response == 'ada') {
                    $(".tunggu").hide();
                    alert('Username "' + uname + '" telah digunakan silahkan gunakan username lain !');
                    $('#uname1').val('');
                } else if (data.response == 'kosong') {
                    $(".tunggu").hide();
                }
            },
        });
        return false;
    }
    $("#form-daftar").submit(function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url() . 'web/daftar' ?>",
            cache: false,
            data: $(this).serialize(),
            dataType: 'Json',
            beforeSend: function() {
                $(".tunggu").show();
            },
            success: function(data) {
                if (data.respon == 'sukses') {
                    $(".tunggu").hide();
                    alert('Anda telah terdaftar silahkan login !');
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
        return false;
    });
    $("#form-edit").submit(function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url() . 'web/edit_profile' ?>",
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
                    document.location.reload(true);
                } else {
                    alert('Password yang anda masukkan Salah');
                    $(".tunggu").hide();
                    $("#password2").val('');
                }
            },
            error: function() {
                alert("Data gagal dimasukkan.");
            }
        });
        return false;
    });
</script>
<?php

if ($this->session->userdata('usersession') == TRUE) {
    $sesi = $this->session->userdata('usersession');
    $this->db->where('id', $sesi->id);
    $user = $this->db->get('master_user')->row();
    $myvalue = $user->nama_user;
    $arr = explode(' ', trim($myvalue));
}
$atas = $this->uri->segment(1);
?>


<body>
    <div class="atas">
        <div style="padding: 5px;">
            <a href="<?php echo base_url('web') ?>">
                <img src="https://objectstorage.ap-melbourne-1.oraclecloud.com/n/axg2uln4zrfd/b/mrshop-core/o/mrshop.png" style="width: 175px;margin-left: 10px;">
            </a>
        </div>
        <form id="cari_form">
            <div style="margin-left: 25px;padding: 5px;">
                <ul>
                    <li><a class="<?php if ($atas == "keranjang") {
                                        echo "active";
                                    } ?>" href="<?php echo base_url('keranjang') ?>">Keranjang</a></li>
                    <li><a class="<?php if ($atas == "history") {
                                        echo "active";
                                    } ?>" href="<?php echo base_url('history') ?>">History</a></li>
                    <input id="cari" style="margin-left: 12px;" type="text" placeholder="Cari barang..">
                    <button type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1"></button>
                </ul>
        </form>

    </div>

    <div style="margin-left: 25pc;padding: 5px;float: right">
        <?php if ($this->session->userdata('usersession') == TRUE) { ?>
            <ul>
                <li style="display: inline-block;padding: 3px 3px 3px 6px;width: 205px">
                    <a onclick="document.getElementById('edit-modal').style.display='block'">
                        <img src="<?php echo base_url('assets/images/user.png') ?>" style="margin-top: -14px;float: left;width: 35px;" alt="<?php echo $user->nama_user ?>" />
                        <p style="margin-top: -3px;"><?php echo $arr[0]; ?></p>
                    </a>
                </li>
                <li><a href="<?php echo base_url('web/logout') ?>">Log Out</a></li>
            </ul>
        <?php } else { ?>
            <ul>
                <li><a class="" onclick="document.getElementById('login-modal').style.display='block'">Login</a></li>
                <li><a onclick="document.getElementById('daftar-modal').style.display='block'">Sign In</a></li>
            </ul>
        <?php } ?>
    </div>

    </div>

    <script>
        $("#cari_form").submit(function() {
            cari = $('#cari').val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url() . 'web/cari_data' ?>",
                cache: false,
                data: $(this).serialize(),
                beforeSend: function() {
                    $(".tunggu").show();
                },
                success: function(data) {
                    $(".tunggu").hide();
                    window.location = "<?php echo base_url() . 'web/lihat_cari/'; ?>" + cari;
                },
                error: function() {
                    alert("Data gagal dimasukkan.");
                }
            });
            return false;
        });
    </script>
    <div id="badan">
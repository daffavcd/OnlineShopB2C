<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function warn_msg($param){
    return '
    <div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
    <strong>Warning!</strong> '.$param.'
    </div>
    ';
}

function succ_msg($param){
    return '
    <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
    <strong>Success!</strong> '.$param.'
    </div>
    ';
}

function err_msg($param){
    return '
    <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
    <strong>Error!</strong> '.$param.'
    </div>
    ';
}

function url_template_client()
{
    return base_url().'public/home/';
}

function cut_words($sentence,$word_count){
    $space_count = 0;
    $print_string = '';
    $last_string = '';
    for($i=0;$i<strlen($sentence);$i++){
        if($sentence[$i]==' ')
            $space_count ++;
        $print_string .= $sentence[$i];
        if($space_count == $word_count){
            $last_string= '...';
            break;
        }
    }
    
    echo preg_replace('/<img[^>]+./','',$print_string.$last_string);
}

function mix_word($value='')
{
    $word = explode(' ', $value);

    $word_mix = implode('_', $word);

    return $word_mix;
}

function TanggalIndo($date){
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);

    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;        
    return($result);
}

function BulanIndo($date){
    $BulanIndo = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $result = $BulanIndo[(int)$date];        
    return($result);
}
function TahunBulanIndo($date){
    $BulanIndo = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $bulan = substr($date, 5, 2);
    $result = $BulanIndo[(int)$bulan];        
    return($result);
}


function format_rupiah($angka)
{
    $jadi = "Rp " . number_format((double)$angka,2,',','.');
    return $jadi;
} 
function format_harga($angka)
{
    $jadi = number_format((double)$angka,0,',','.');
    return $jadi;
}

function format_number($input){
    $input = number_format($input);
    $input_count = substr_count($input, ',');
    if($input_count != '0'){
        if($input_count == '1'){
            return substr($input, 0, -4).'RB';
        } else if($input_count == '2'){
            return substr($input, 0, -8).'JT';
        } else if($input_count == '3'){
            return substr($input, 0,  -12).'M';
        } else {
            return;
        }
    } else {
        return $input;
    }
}

function curURL()
{
    $pageURL = 'http';
    if (@$_SERVER['HTTPS'] == 'on') {
        $pageURL .= 's';
    }
    
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    
    return $pageURL;
}

function curCname()
{
    $CI =& get_instance();
    $url = '';
    $url = $CI->router->fetch_directory().$CI->router->fetch_class();
    $url = strtolower($url);
    return $url;
}

function changeDateFormat($format,$date)
{
    switch($format)
    {
        case "database":
        return date('Y-m-d',strtotime($date));
        break;
        case "webview":
        return date('d-m-Y',strtotime($date));
        break;
        case "datepicker":
        return date('d/m/Y',strtotime($date));
        break;
    }	
}

function paging($url, $total, $perpage=NULL)
{
    $ci =& get_instance();
    $ci->load->library('Mypagination');

    $config['base_url'] = @$url;
    $config['num_links'] = 3;
    $config['total_rows'] = @$total;
    $config['per_page'] = @$perpage ? $perpage : 5;

    $config['full_tag_open'] = '<div id="paging" style="margin: 0px 0px 0px 15px;"><ul class="pagination">';
    $config['full_tag_close'] = '</ul></div>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';

    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $ci->mypagination->initialize($config);

    return $ci->mypagination->create_links();
}

function uri($param)
{
    $ci =& get_instance();
    return $ci->uri->segment($param);
}

function contact($col){
  $CI =& get_instance();
  $mod = $CI->load->model('admin/m_info','minfo');

  $data_profil = $mod->minfo->get_info();

  return @$data_profil[0]->$col;
}

function align_right($max,$nilai)
{
    $length = strlen($nilai);
    $sisa = $max - $length;

    $hasil="";
    for($i=0;$i<$sisa;$i++){
        $hasil.=" ";
    }
    $hasil.=$nilai;
    return $hasil;
}
function align_left($max,$nilai)
{
    $length = strlen($nilai);
    $sisa = $max - $length;
    $spasi = repeat_value($sisa,' ');
    return $nilai.$spasi;
}
function align_right_strip($max,$nilai)
{
    $length = strlen($nilai);
    $sisa = $max - $length;

    $hasil="";
    for($i=0;$i<$sisa;$i++){
        $hasil.="-";
    }
    $hasil.=$nilai;
    return $hasil;
}
function align_center($max,$nilai)
{
    // $length = strlen($nilai);
    // $stgh_length = $length / 2;
    // $stgh_max = (int)$max / 2;
    // $sisa = $stgh_max - $stgh_length;

    // $hasil="";
    // for($i=0;$i<$sisa;$i++){
    //     $hasil.=" ";
    // }
    // $hasil.=$nilai;
    // return $hasil;

    $length = strlen($nilai);
    $sisa = $max - $length;
    $spasi_awal = floor($sisa/2);
    $spasi_akhir = $sisa - $spasi_awal;

    return repeat_value($spasi_awal,' ').$nilai.repeat_value($spasi_akhir,' ');
}
function Terbilang($satuan){
    $huruf = array("","Satu","Dua","Tiga","Empat","Lima","Enam","Tujuh","Delapan","Sembilan","Sepuluh","Sebelas");

    if($satuan < 12)
        return " " . $huruf[$satuan];
    else if($satuan < 20)
        return Terbilang($satuan - 10) . " Belas";
    else if($satuan < 100)
        return Terbilang($satuan / 10) . " Puluh" . Terbilang($satuan % 10);
    else if($satuan < 200)
        return " Seratus" . Terbilang($satuan - 100);
    else if($satuan < 1000)
        return Terbilang($satuan / 100) . " Ratus" . Terbilang($satuan % 100);
    else if($satuan < 2000)
        return " Seribu" . Terbilang($satuan - 1000);
    else if($satuan < 1000000)
        return Terbilang($satuan / 1000) . " Ribu" . Terbilang($satuan % 1000);
    else if($satuan < 1000000000)
        return Terbilang($satuan / 100000000) . " Juta" . Terbilang($satuan % 1000000);
    else if($satuan >= 1000000000)
        echo "Hasil terbilang tidak dapat diproses karena nilai terlalu besar !";
} 
function cetak_garis($jumlah)
{
    $hasil="";
    for($i=0;$i<$jumlah;$i++){
        $hasil.="-";
    }
    return $hasil;
}
function repeat_value($jumlah,$delimiter){
    $hasil = '';
    for($i=0;$i<$jumlah;$i++){
        $hasil .= $delimiter;
    }
    return $hasil;
}

define('CLASS_ENCRYPT', dirname(__FILE__));
include('cryptography/AES.class.php');
include('cryptography/class.hash_crypt.php');

function keypass()
{
    return md5('inv'.md5('store'));
}

function paramEncrypt($x)
{

    $first_output = '';
    $count = 0;

    $Cipher = new AES();
    $key_256bit = keypass();
    
    $n = ceil(strlen($x)/16);
    $encrypt = "";

    for ($i=0; $i<=$n-1; $i++)
    {
        $cryptext = $Cipher->encrypt($Cipher->stringToHex(substr($x, $i*16, 16)),$key_256bit);
        $encrypt .= $cryptext;   
    }

    return $encrypt;
}

function paramDecrypt($x)
{
    $Cipher = new AES();
    $key_256bit = keypass();

    $n = ceil(strlen($x)/32);
    $decrypt = "";

    for ($i=0; $i<=$n-1; $i++)
    {
        $result = $Cipher->decrypt(substr($x, $i*32, 32), $key_256bit);
        $decrypt .= $Cipher->hexToString($result);
    }

    return $decrypt;
}

function encode($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function decode($data)
{
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

function save_as($file, $file_name, $file_size, $folder, $flag, $size)
{
    $ret['error'] = 0;

    if ($file == "none") :
        $ret['error'] = 1;
        $ret['msg'] = "Please, Fill file field...";
        return $ret;
        exit();
    endif;

    if ($flag) :
        if ($file_size >= $size*1024) :
            $ret['error'] = 1;
            $ret['msg'] = "File size too large. Maximum file size $size KB...";
            return $ret;
            exit();
        endif;
    endif;

    $name_file = time()." - ".$file_name;
    if (!@copy ($file,$folder."/".$name_file)) :
        $ret['error'] = 1;
        $ret['msg'] = "Copy file failed. Please check the file...";
        return $ret;
        exit();
    endif;

    $ret['nama_file'] = $name_file;
    return $ret;
    exit();
}

function decrease_arrnull($param)
{
    $arr = array();
    foreach ($param as $key => $val) {
        if(!empty($val)){
            $arr[$key] = $val;
        }
    }

    return $arr;
}

function complete_zero($number,$max_length)
{
 $number_length = strlen($number);
 $zero_length = $max_length - $number_length;
 $zero = "";
 for($i=1;$i<=$zero_length;$i++)
 {
  $zero .= '0';
}
return $zero.$number;
}

function complete_zero_after($number,$max_length)
{
 $number_length = strlen($number);
 $zero_length = $max_length - $number_length;
 $zero = "";
 for($i=1;$i<=$zero_length;$i++)
 {
  $zero .= '0';
}
return $number.$zero;
}

function space($num)
{
    $space = '';
    for($i=1;$i<=$num;$i++)
    {
        $space .= '&nbsp;&nbsp;&nbsp;';
    }
    return $space;
}

function unit_acuan($satuan)
{
    $CI =& get_instance();

    $CI->db->where('id', $satuan);
    $query = $CI->db->get('atombizz_converter');
    $result = $query->row();

    return $result->acuan;
}

function unit_converter($qty,$satuan)
{
    $CI =& get_instance();

    $CI->db->where('id', $satuan);
    $query = $CI->db->get('atombizz_converter');
    $result = $query->row();

    $data['qty'] = $qty*$result->acuan;

    if($result->kategori!='satuan'){
        $CI->db->where('kategori', $result->kategori);
        $CI->db->where('acuan', 1);
        $CI->db->limit(1);
        $query = $CI->db->get('atombizz_converter');
        $result = $query->row();
        $data['satuan'] = $result->id;
    } else {
        $data['satuan'] = $satuan;
    }

    return json_encode($data);
}

function autocutter($printer='')
{
    $Data = "\n";

    $handle = printer_open($printer); 
    printer_set_option($handle, PRINTER_MODE, "TEXT");
    printer_write($handle, $Data); 
    printer_close($handle);
}
function Triwulan($bulan)
{
    if($bulan >='01' and $bulan <= '03'){
        $triwulan='1';
    }elseif ($bulan >='04' and $bulan <= '06') {
        $triwulan='2';
    }elseif ($bulan >='07' and $bulan <= '09') {
        $triwulan='3';
    }elseif ($bulan >='10' and $bulan <= '12') {
        $triwulan='4';
    }
    return $triwulan;
} 
function terbilang_baru($x) {
    $x = abs($x);
    $angka = array("", "Satu", "Dua", "Tiga", "Empat", "Lima",
        "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = terbilang_baru($x - 10). " Belas";
    } else if ($x <100) {
        $temp = terbilang_baru($x/10)." Puluh". terbilang_baru($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . terbilang_baru($x - 100);
    } else if ($x <1000) {
        $temp = terbilang_baru($x/100) . " Ratus" . terbilang_baru($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . terbilang_baru($x - 1000);
    } else if ($x <1000000) {
        $temp = terbilang_baru($x/1000) . " Ribu" . terbilang_baru($x % 1000);
    } else if ($x <1000000000) {
        $temp = terbilang_baru($x/1000000) . " Juta" . terbilang_baru($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = terbilang_baru($x/1000000000) . " Milyar" . terbilang_baru(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = terbilang_baru($x/1000000000000) . " Trilyun" . terbilang_baru(fmod($x,1000000000000));
    }     
    return $temp;
}


function bill_php_right($variable,$karakter){
    $j_karakter = $karakter;
    $varia = $variable; 
    $hitung = $j_karakter - strlen($varia);

    if($hitung < 1){
        $hasil = substr($varia, 0, $j_karakter);
    } else {
        $hasil = repeat_value($hitung,' ').$varia;
    }
    

    return $hasil;
}
function bill_php_Left($variable,$karakter){
    $j_karakter = $karakter;
    $varia = $variable; 
    $hitung = $j_karakter - strlen($varia);

    if($hitung < 1){
        $hasil = substr($varia, 0, $j_karakter);
    } else {
        $hasil = $varia.repeat_value($hitung,' ');
    }
    

    return $hasil;
}
function bill_php_middle($variable,$karakter){
    $j_karakter = $karakter;
    $varia = $variable; 
    $hitung_awal = ($j_karakter - strlen($varia))/2;
    $hitung = round($hitung_awal, 0, PHP_ROUND_HALF_DOWN);

    if($hitung < 1){
        $hasil = substr($varia, 0, $j_karakter);
    } else {
        $hasil = repeat_value($hitung,' ').$varia.repeat_value($hitung,' ');
    }
    
    return $hasil;
}
function bill_php_middle_alamat($variable,$karakter){
    $j_karakter = $karakter;
    $varia = $variable; 
    $hitung_awal = ($j_karakter - strlen($varia))/2;
    $hitung = round($hitung_awal, 0, PHP_ROUND_HALF_DOWN);
    $nilai = ' ';
    $nilaii = '';
    for($nil=0;$nil<$hitung;$nil++){
        $nilaii = $nilai.$nilaii;
    }
    if($hitung < 1){
        $hasil = substr($varia, 0, $j_karakter)."\n";
        
        $varia2 = substr($varia, $j_karakter, ($j_karakter*2));
        $hitung_awal2 = ($j_karakter - strlen($varia2))/2;
        $hitung2 = round($hitung_awal2, 0, PHP_ROUND_HALF_DOWN);
        $nilai2 = ' ';
        $nilaii2 = '';
        for($nil=0;$nil<$hitung2;$nil++){
            $nilaii2 = $nilai2.$nilaii2;
        }
        $hasil .= $nilaii2.$varia2.$nilaii2;

    } else {
        $hasil = $nilaii.$varia.$nilaii;
    }
    
    return $hasil;
}
function bill_php_repeat($variable,$karakter){
    return repeat_value($karakter,$variable);
}
function get_kode($last_id,$karakter){
    $j_karakter = $karakter;
    $next_number = $last_id+1;
    $hitung = $j_karakter - strlen($next_number);
    $hasil = repeat_value($hitung,'0').$next_number;
    
    return $hasil;
}
?>
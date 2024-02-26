<?php
session_start();
ob_start();
set_time_limit(60);
// require_once "../../inc/koneksi.php";
// require_once "../../inc/function.php";

// $hari_ini = date("Y-m-d");
// $tglAwal  = isset($_GET['tglAwal']) ? date_format(date_create(mysqli_real_escape_string($koneksi, trim($_GET["tglAwal"]))), "Y-m-d") : date("Y-m-d");
// $tglAkhir = isset($_GET['tglAkhir']) ? date_format(date_create(mysqli_real_escape_string($koneksi, trim($_GET["tglAkhir"]))), "Y-m-d") : date("Y-m-d");
?>



<!-- START -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>LAPORAN</title>
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-admin/panel/css/laporan.css" />
</head>

<body>
  <br>
  <br>
  <div id="title" style="line-height:25px;">
    REPORT PENGADUAN<br>
    RSUD PALEMBANG BARI<br>
    Periode 
  </div>
  <br>
  <br>
  <div id="isi">
    <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
      <thead style="background:#FFF">
        <tr>
          <th height="25" valign="middle" style="text-align:left;">NAMA</th>
          <th height="25" valign="middle" style="text-align:left;">TELEPON</th>
          <th height="25" valign="middle" style="text-align:left;">EMAIL</th>
          <th height="25" valign="middle" style="text-align:left;">PESAN</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td width='245' style='text-align:left;' height='60' valign='middle'></td>
          <td width='245' style='text-align:left;' height='60' valign='middle'></td>
          <td width='245' style='text-align:left;' height='60' valign='middle'></td>
          <td width='245' style='text-align:left;' height='60' valign='middle'></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="footer-tempat">
    Palembang, ...........................
  </div>
  <div id="footer-mengetahui">
    Mengetahui,
  </div>
  <div id="footer-nama">
    ( .............................................. )
  </div>
</body>

</html>
<!-- END -->



<?php
$filename = "REPORT_PENGADUAN.pdf";
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">' . ($content) . '</page>';

// require_once('../../assets/html2pdf_v4.03/html2pdf.class.php');
require_once('"'.base_url().'"/assets-admin/panel/lib/html2pdf_v4.03/html2pdf.class.php');
try {
  $html2pdf = new HTML2PDF('L', 'F4', 'en', false, 'ISO-8859-15', array(15, 10, 10, 20));
  $html2pdf->setDefaultFont('Arial');
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
  $html2pdf->Output($filename);
} catch (HTML2PDF_exception $e) {
  echo $e;
}
?>
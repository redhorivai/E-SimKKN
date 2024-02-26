<?php
@date_default_timezone_set('Asia/Jakarta');
    // get the HTML
    ob_start();
?>
<page>
    <h1>Test de JavaScript 1</h1><br>
    <br>
    Normalement la fenetre d'impression devrait apparaitre automatiquement
</page>
<?php
    $content = ob_get_clean();

    // convert to PDF
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        $html2pdf->pdf->IncludeJS("print(true);");
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('js1.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>

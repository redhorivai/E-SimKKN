<script src="<?= base_url(); ?>/assets-admin/panel/lib/popper/popper.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/bootstrap/bootstrap.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/moment/moment.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/jquery-ui/jquery-ui.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/jquery-switchbutton/jquery.switchButton.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/peity/jquery.peity.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/highlightjs/highlight.pack.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/bracket.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/sidebar-menu.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/flatpickr/flatpickr.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/flatpickr/form-pickers.init.js"></script>
<?php 
if ($active == 'pengguna') {
    echo view ('admin/pengguna/js');
} else if ($active == 'imut') {
    echo view ('admin/imut/js');
} else if ($active == 'standar_pelayanan') {
    echo view ('admin/standar_pelayanan/js');
} else if ($active == 'layanan_unggulan') {
    echo view ('admin/layanan_unggulan/js');
} else if ($active == 'informasi_dokter') {
    echo view ('admin/dokter/js');
} else if ($active == 'tarif') {
    echo view ('admin/tarif/js');
} else if ($active == 'artikel') {
    echo view ('admin/artikel/js');
} else if ($active == 'pengumuman') {
    echo view ('admin/pengumuman/js');
} else if ($active == 'laporandpl') {
    echo view ('admin/laporandpl/js');
} else if ($active == 'laporansurvei') {
    echo view ('admin/laporansurvei/js');
} else if ($active == 'survei') {
    echo view ('admin/survei/js');
} else if ($active == 'harian') {
    echo view ('admin/harian/js');
} else if ($active == 'akhir') {
    echo view ('admin/akhir/js');
} else if ($active == 'laporanharian') {
    echo view ('admin/laporanharian/js');
} else if ($active == 'laporanakhir') {
    echo view ('admin/laporanakhir/js');
} else if ($active == 'alur_pelayanan') {
    echo view ('admin/alur_pelayanan/js');
} else if ($active == 'hak_kewajiban') {
    echo view ('admin/hak_kewajiban/js');
} else if ($active == 'tata_tertib') {
    echo view ('admin/tata_tertib/js');
} else if ($active == 'faq') {
    echo view ('admin/faq/js');
} else if ($active == 'produk') {
    echo view ('admin/produk/js');
} else if ($active == 'instansi') {
    echo view ('admin/instansi/js');
} else if ($active == 'item_fasilitas') {
        echo view ('admin/item_fasilitas/js');
} else if ($active == 'slider') {
    echo view ('admin/slider/js');
} else if ($active == 'changelog') {
    echo view ('admin/changelog/js');
} else if ($active == 'periode') {
    echo view ('admin/periode/js');
} else if ($active == 'kelompok') {
    echo view ('admin/kelompok/js');
} else if ($active == 'aturkelompok') {
    echo view ('admin/aturkelompok/js');
} else if ($active == 'gabung') {
    echo view ('admin/gabung/js');
} else if ($active == 'fakultas') {
    echo view ('admin/fakultas/js');
} else if ($active == 'prodi') {
    echo view ('admin/prodi/js');
} else if ($active == 'kelompok_detail') {
    echo view ('admin/kelompok_detail/js');
} else if ($active == 'profil') {
    echo view ('admin/profil/js');
} else if ($active == 'lapor' || $active == 'reportlapor') {
    echo view ('admin/lapor/js');
}
?>
<script type="text/javascript">
    // $.sidebarMenu($('.br-sideleft-menu'));
    $.sidebarMenu($('.sidebar-menu'));
    // SWAL TOASTR
    const Toast = Swal.mixin({
        toast            : true,
        position         : "top",
        showConfirmButton: false,
        timer            : 3000,
    });
    // SELECT2
    // $(".select2").select2();
    // SELECT2 ORDERING DATATABLES
    // $(function() {
    //     $('.dataTables_length select').select2({
    //     minimumResultsForSearch: Infinity
    //     });
    // });
    // LOGO
    const API_URL = 'http://localhost:8080';
    $(document).ready(function() {
        _getLogoApp()
    })
    function _getLogoApp() {
        $.ajax({
            url: API_URL + `/conApp/ambil_logo`,
            dataType: "json",
            success: function(response) {
                const logo = response.logo
                const path = `${API_URL}/img/aplikasi/${logo}`
                document.getElementById("logo").src = path
            },
            error: function(xhr, ajaxOptions, thrownError) {
            },
        });
    }
</script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/dataTables.responsive.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/select2/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript">
    function remove(id) {
        if (id == 'nama') {
            $('#' + id).removeClass('is-invalid');
        }
    }   
    $(document).ready(function() {
        $('#btnSimpan').hide();
        $('#btnBatal').hide();
        $('#btnUpdate').click(function() {
            $('#btnUpdate').hide();
            $('#btnSimpan').show();
            $('#btnBatal').show();
            $('#nama').removeAttr('readonly');
            $('#no_id').removeAttr('readonly');
            // $('#jenis_kelamin').removeAttr('readonly');
            $('#tempat_lahir').removeAttr('readonly');
            $('#tanggal_lahir').removeAttr('readonly');
            $('#alamat').removeAttr('readonly');
            // $('#prodi_nm').removeAttr('readonly');
            // $('#foto').removeClass('bg-gray-800');
            // $('#foto').addClass('bg-gray-800');
            $('#btnImg').removeClass('d-none');
        });
        $('#btnBatal').click(function() {
            $('#btnUpdate').show();
            $('#btnSimpan').hide();
            $('#btnBatal').hide();
            $('#nama').attr('readonly', true);
            $('#no_id').attr('readonly', true);
            // $('#jenis_kelamin').attr('readonly', true);
            $('#tempat_lahir').attr('readonly', true);
            $('#tanggal_lahir').attr('readonly', true);
            $('#alamat').attr('readonly', true);
            // $('#prodi_nm').attr('readonly', true);
            // $('#foto').addClass('bg-gray-800');
            // $('#foto').removeClass('bg-gray-800');
            $('#btnImg').addClass('d-none');
        });
        $('#remove').click(function(e) {
            e.preventDefault();
            $('.errorLogo').html('');
        });
        $('.formprofil').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?= base_url('Backend/Profil/update_data'); ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                        } else {
                            $('#nama').removeClass('is-invalid');
                        }
                        if (response.error.no_id) {
                            $('#no_id').addClass('is-invalid');
                        } else {
                            $('#no_id').removeClass('is-invalid');
                        }
                        // if (response.error.jenis_kelamin) {
                        //     $('#jenis_kelamin').addClass('is-invalid');
                        // } else {
                        //     $('#jenis_kelamin').removeClass('is-invalid');
                        // }
                        if (response.error.tempat_lahir) {
                            $('#tempat_lahir').addClass('is-invalid');
                        } else {
                            $('#tempat_lahir').removeClass('is-invalid');
                        }
                        if (response.error.tanggal_lahir) {
                            $('#tanggal_lahir').addClass('is-invalid');
                        } else {
                            $('#tanggal_lahir').removeClass('is-invalid');
                        }
                        if (response.error.alamat) {
                            $('#alamat').addClass('is-invalid');
                        } else {
                            $('#alamat').removeClass('is-invalid');
                        }
                        // if (response.error.prodi_nm) {
                        //     $('#prodi_nm').addClass('is-invalid');
                        // } else {
                        //     $('#prodi_nm').removeClass('is-invalid');
                        // }
                        // if (response.error.foto) {
                        //     $('.errorLogo').html(response.error.foto);
                        // } else {
                        //     $('.errorLogo').html('');
                        // }
                    } else {
                        Toast.fire({
                            icon: "success",
                            title: response.sukses,
                        });
                        $('#btnUpdate').show();
                        $('#btnSimpan').hide();
                        $('#btnBatal').hide();
                        $('#nama').attr('readonly', true);
                        $('#no_id').attr('readonly', true);
                        // $('#jenis_kelamin').attr('readonly', true);
                        $('#tempat_lahir').attr('readonly', true);
                        $('#tanggal_lahir').attr('readonly', true);
                        $('#alamat').attr('readonly', true);
                        // $('#prodi_nm').attr('readonly', true);
                        // $('#foto').addClass('bg-gray-800');
                        // $('#foto').removeClass('bg-gray-800');
                        // $('#btnImg').addClass('d-none');
                        // _getLogo();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
            });
            return false;
        });
    });
</script>
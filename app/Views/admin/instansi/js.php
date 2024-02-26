<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/dataTables.responsive.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/select2/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript">
    function remove(id) {
        if (id == 'company_nm' || id == 'email' || id == 'cellphone_informasi' || id == 'addr_txt') {
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
            $('#company_nm').removeAttr('readonly');
            $('#email').removeAttr('readonly');
            $('#cellphone_informasi').removeAttr('readonly');
            $('#cellphone_sms_online').removeAttr('readonly');
            $('#cellphone_marketing').removeAttr('readonly');
            $('#addr_txt').removeAttr('readonly');
            $('#link_website').removeAttr('readonly');
            $('#facebook').removeAttr('readonly');
            $('#instagram').removeAttr('readonly');
            $('#thumb').removeClass('bg-gray-600');
            $('#thumb').addClass('bg-gray-800');
            $('#btnImg').removeClass('d-none');
        });
        $('#btnBatal').click(function() {
            $('#btnUpdate').show();
            $('#btnSimpan').hide();
            $('#btnBatal').hide();
            $('#company_nm').attr('readonly', true);
            $('#email').attr('readonly', true);
            $('#cellphone_informasi').attr('readonly', true);
            $('#cellphone_sms_online').attr('readonly', true);
            $('#cellphone_marketing').attr('readonly', true);
            $('#addr_txt').attr('readonly', true);
            $('#link_website').attr('readonly', true);
            $('#facebook').attr('readonly', true);
            $('#instagram').attr('readonly', true);
            $('#thumb').addClass('bg-gray-600');
            $('#thumb').removeClass('bg-gray-800');
            $('#btnImg').addClass('d-none');
        });
        $('#remove').click(function(e) {
            e.preventDefault();
            $('.errorLogo').html('');
        });
        $('.formcompany').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?= base_url('Backend/Instansi/update_data'); ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        if (response.error.company_nm) {
                            $('#company_nm').addClass('is-invalid');
                        } else {
                            $('#company_nm').removeClass('is-invalid');
                        }
                        if (response.error.email) {
                            $('#email').addClass('is-invalid');
                        } else {
                            $('#email').removeClass('is-invalid');
                        }
                        if (response.error.cellphone_informasi) {
                            $('#cellphone_informasi').addClass('is-invalid');
                        } else {
                            $('#cellphone_informasi').removeClass('is-invalid');
                        }
                        if (response.error.addr_txt) {
                            $('#addr_txt').addClass('is-invalid');
                        } else {
                            $('#addr_txt').removeClass('is-invalid');
                        }
                        if (response.error.company_logo) {
                            $('.errorLogo').html(response.error.company_logo);
                        } else {
                            $('.errorLogo').html('');
                        }
                    } else {
                        Toast.fire({
                            icon: "success",
                            title: response.sukses,
                        });
                        $('#btnUpdate').show();
                        $('#btnSimpan').hide();
                        $('#btnBatal').hide();
                        $('#company_nm').attr('readonly', true);
                        $('#email').attr('readonly', true);
                        $('#cellphone_informasi').attr('readonly', true);
                        $('#cellphone_sms_online').attr('readonly', true);
                        $('#cellphone_marketing').attr('readonly', true);
                        $('#addr_txt').attr('readonly', true);
                        $('#link_website').attr('readonly', true);
                        $('#facebook').attr('readonly', true);
                        $('#instagram').attr('readonly', true);
                        $('#thumb').addClass('bg-gray-600');
                        $('#thumb').removeClass('bg-gray-800');
                        $('#btnImg').addClass('d-none');
                        _getLogo();
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
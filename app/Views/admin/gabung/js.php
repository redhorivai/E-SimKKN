<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/dataTables.responsive.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/select2/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/sweetalert2.all.min.js"></script>
<script type="text/javascript">   
    function remove(id) {
        if (id == 'title' || id == 'description') {
            $('#' + id).removeClass('is-invalid');
        } else {
            $('#' + id).removeClass('is-invalid');
            $('#' + id + '+ span').removeClass("is-invalid");
            $('#' + id + '+ span').focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
    }
    function _btnAdd() {
        $.ajax({
            url: "<?= site_url('Backend/Gabung/form') ?>",
            success: function(response) {
              $('#formData').html(response);
              $('#viewData').delay(100).fadeOut();
              $('#formData').removeClass('d-none');
              $('#viewTable').DataTable().ajax.reload();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }
    // function _simpan() {
    //     var kelompok_id = $("#kelompok_id").val();
    //     var status_user = $("#status_user").val();
    //     var user_id     = $("#user_id").val();

    //     var ajaxData = new FormData();
    //     ajaxData.append('action', 'forms');
    //     ajaxData.append('kelompok_id', kelompok_id);
    //     ajaxData.append('status_user', status_user);
    //     ajaxData.append('user_id', user_id);
    //     if (kelompok_id == "") {
    //         $('#kelompok_id').focus();
    //         $('#kelompok_id').addClass('is-invalid');
    //     } else {
    //         $('#kelompok_id').removeClass('is-invalid');
    //     }
    //     if (status_user == "") {
    //         $("#status_user + span").addClass("is-invalid");
    //         $("#status_user + span").focus(function() {
    //             $(this).addClass("is-invalid");
    //         });
    //     } else {
    //         $('#status_user').removeClass('is-invalid');
    //         $("#status_user + span").removeClass("is-invalid");
    //         $("#status_user + span").focus(function() {
    //             $(this).removeClass("is-invalid");
    //         });
    //     }
    //     if (user_id == "") {
    //         $('#user_id').addClass('is-invalid');
    //     } else {
    //         $('#user_id').removeClass('is-invalid');
    //     }
    //     if (kelompok_id && status_user && user_id) {
    //       $.ajax({
    //           url: "<?= site_url('Backend/Gabung/insert_data'); ?>",
    //           type: "POST",
    //           data: ajaxData,
    //           contentType: false,
    //           cache: false,
    //           processData: false,
    //           dataType: "json",
    //           success: function(response) {
    //               if (response == "Sukses") {
    //                   Toast.fire({
    //                       icon: "success",
    //                       title: "Data berhasil ditambahkan"
    //                   });
    //                   $('.form-data')[0].reset();
    //                   $('#formData').addClass('d-none');
    //                   $('#viewData').delay(100).fadeIn();
    //                   $('#viewTable').DataTable().ajax.reload();
    //               } else {
    //                   $("#user_id").focus();
    //                   $('#user_id').addClass('is-invalid');
    //                   Swal.fire({
    //                       title: 'Pemberitahuan',
    //                       html: response,
    //                       icon: 'warning',
    //                       showConfirmButton: true,
    //                   });
    //               }
    //           },
    //           error: function() {
    //               Toast.fire({
    //                   icon: "error",
    //                   title: "Error !, Silahkan coba beberapa saat lagi."
    //               });
    //           }
    //       });
    //     }
    // }
    function _simpan() {
        var kelompok_id = $("#kelompok_id").val();
        var status_user    = $("#status_user").val();
        var user_id     = $("#user_id").val();
        if (kelompok_id == "") {
            $('#kelompok_id').addClass('is-invalid');
        } else {
            $('#kelompok_id').removeClass('is-invalid');
        }
        if (status_user == "") {
            $("#status_user + span").addClass("is-invalid");
            $("#status_user + span").focus(function() {
                $(this).addClass("is-invalid");
            });
        } else {
            $('#status_user').removeClass('is-invalid');
            $("#status_user + span").removeClass("is-invalid");
            $("#status_user + span").focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
        if (user_id == "") {
            $('#user_id').addClass('is-invalid');
        } else {
            $('#user_id').removeClass('is-invalid');
        }
        if (kelompok_id && status_user) {
            $.ajax({
                url: "<?= site_url('Backend/Gabung/insert_data') ?>",
                type: "POST",
                data: {
                    kelompok_id : kelompok_id,
                    status_user : status_user,
                    user_id     : user_id,
                },
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data Kelompok berhasil ditambahkan"
                        });
                        $('.form-data')[0].reset();
                        $('#formData').addClass('d-none');
                        $('#viewData').delay(100).fadeIn();
                        $('#viewTable').DataTable().ajax.reload();
                    } else {
                        $("#username").focus();
                        $('#username').addClass('is-invalid');
                        Swal.fire({
                            title: 'Pemberitahuan',
                            html: response,
                            icon: 'warning',
                            showConfirmButton: true,
                        });
                    }
                },
                error: function() {
                    Toast.fire({
                        icon: "error",
                        title: "Error !, Silahkan coba beberapa saat lagi."
                    });
                }
            });
        }
    }
</script>
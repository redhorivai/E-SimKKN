<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/dataTables.responsive.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/select2/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    function remove(id) {
        if (id != 'gender' && id != 'level') {
            $('#' + id).removeClass('is-invalid');
        } else {
            $('#' + id).removeClass('is-invalid');
            $('#' + id + '+ span').removeClass("is-invalid");
            $('#' + id + '+ span').focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
    }
    $(window).ready(function() {
        _getKelompok();
        $('#checkAll').click(function(e){
            if($(this).is(':checked')){
                $('.checkedId').prop('checked', true);
            } else {
                $('.checkedId').prop('checked', false);
            }
        });
        $('.formMultiDelete').submit(function(e){
            e.preventDefault();
            let jmldata = $('.checkedId:checked');
            if(jmldata.length === 0){
                Swal.fire({
                    title: 'Pemberitahuan',
                    html: 'Silahkan pilih data yang akan dihapus!',
                    icon: 'warning',
                    showConfirmButton: true,
                });
            } else {
                Swal.fire({
                    title: 'Hapus Data?',
                    html: `<p class="mg-b-10">Anda akan menghapus <b>${jmldata.length} data</b> periode</p>`,
                    icon: 'warning',
                    showCancelButton: true,
                    showConfirmButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonColor: '#3085d6',
                    cancelButtonText: 'Tidak, batalkan',
                    confirmButtonText: 'Ya, proses',
                }).then((result) => {
                    if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        dataType: "JSON",
                        success: function(response) {
                        if (response.sukses) {
                            Toast.fire({
                            icon: "success",
                            html: response.sukses,
                            });
                            $('#checkAll').prop('checked', false);
                            $('#viewTable').DataTable().ajax.reload();
                        }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        },
                    });
                    }
                });
            }
            return false;
        });
    });
    function _getKelompok() {
        $('#viewTable').DataTable({
          responsive: true,
          processing: false,
          serverSide: false,
          language: {
            searchPlaceholder: 'Cari...',
            sSearch: '',
            lengthMenu: '_MENU_',
          },
          "order": [],
          "columnDefs": [
            {"targets": [0,2],"orderable": false},
          ],
          "columns": [
            {"data": "cek"},
            {"data": "col"},
            {"data": "action"},
          ],
          "ajax": "<?= site_url('Backend/Kelompok/getData') ?>",
        });
    }
    function _btnAdd() {
        $.ajax({
            url: "<?= site_url('Backend/Kelompok/form') ?>",
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
    function _simpan() {
        var nama      = $("#nama").val();
        var periode_id   = $("#periode_id").val();
        if (nama == "") {
            $("#nama").focus();
            $('#nama').addClass('is-invalid');
        } else {
            $('#nama').removeClass('is-invalid');
        }
        if (periode_id == "") {
            $('#periode_id').addClass('is-invalid');
        } else {
            $('#periode_id').removeClass('is-invalid');
        }
        if (nama && periode_id ) {
            $.ajax({
                url: "<?= site_url('Backend/Kelompok/insert_data') ?>",
                type: "POST",
                data: {
                    nama           : nama,
                    periode_id     : periode_id,
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
    // function _btnEdit(id) {
    //     $.ajax({
    //         type: "POST",
    //         url: "<?= site_url('Backend/Periode/form') ?>",
    //         data: {
    //             id: id
    //         },
    //         success: function(response) {
    //             if (response) {
    //               $('#formData').html(response);
    //               $('#viewData').delay(100).fadeOut();
    //               $('#formData').removeClass('d-none');
    //               $('#viewTable').DataTable().ajax.reload();
    //             }
    //         },
    //         error: function(xhr, ajaxOptions, thrownError) {
    //             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //         },
    //     });
    // }
    // function _update(id) {
    //     var periode_nm      = $("#periode_nm").val();
    //     var semester_cd     = $("#semester_cd").val();
    //     var tanggal_buka    = $("#tanggal_buka").val();
    //     var tanggal_tutup   = $("#tanggal_tutup").val();

    //     var ajaxData = new FormData();
    //     ajaxData.append('action', 'forms');
    //     ajaxData.append('periode_nm', periode_nm);
    //     ajaxData.append('semester_cd', semester_cd);
    //     ajaxData.append('tanggal_buka', tanggal_buka);
    //     ajaxData.append('tanggal_tutup', tanggal_tutup);
    //     ajaxData.append('id', id);
        
    //     if (periode_nm == "") {
    //         $("#periode_nm").focus();
    //         $('#periode_nm').addClass('is-invalid');
    //     } else {
    //         $('#periode_nm').removeClass('is-invalid');
    //     }
    //     if (semester_cd == "") {
    //         $("#semester_cd + span").addClass("is-invalid");
    //         $("#semester_cd + span").focus(function() {
    //             $(this).addClass("is-invalid");
    //         });
    //     } else {
    //         $('#semester_cd').removeClass('is-invalid');
    //         $("#semester_cd + span").removeClass("is-invalid");
    //         $("#semester_cd + span").focus(function() {
    //             $(this).removeClass("is-invalid");
    //         });
    //     }
    //     if (tanggal_buka == "") {
    //         $('#tanggal_buka').addClass('is-invalid');
    //     } else {
    //         $('#tanggal_buka').removeClass('is-invalid');
    //     }
    //     if (tanggal_tutup == "") {
    //         $('#tanggal_tutup').addClass('is-invalid');
    //     } else {
    //         $('#tanggal_tutup').removeClass('is-invalid');
    //     }
    //     if (periode_nm && semester_cd && tanggal_buka && tanggal_tutup) {
    //       $.ajax({
    //           url: "<?= site_url('Backend/Periode/update_data'); ?>",
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
    //                       title: "Data berhasil diperbaharui"
    //                   });
    //                   $('.form-data')[0].reset();
    //                   $('#formData').addClass('d-none');
    //                   $('#viewData').delay(100).fadeIn();
    //                   $('#viewTable').DataTable().ajax.reload();
    //               } else {
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
    // function _active(user_id, nama) {
    //     Swal.fire({
    //       title: 'Aktivasi Akun?',
    //       html: `<p class="mg-b-10">Anda akan mengaktifkan akun user:</p><p><b>${nama}</b></p>`,
    //       icon: 'question',
    //       showCancelButton: true,
    //       showConfirmButton: true,
    //       cancelButtonColor: '#d33',
    //       confirmButtonColor: '#3085d6',
    //       cancelButtonText: 'Tidak, batalkan',
    //       confirmButtonText: 'Ya, proses',
    //     }).then((result) => {
    //         if (result.value) {
    //           $.ajax({
    //             type: "POST",
    //             url: "<?= site_url('Backend/periode/active') ?>",
    //             data: {
    //               user_id: user_id
    //             },
    //             dataType: "JSON",
    //             success: function(response) {
    //               if (response.sukses) {
    //                 Toast.fire({
    //                   icon: "success",
    //                   title: response.sukses,
    //                 });
    //                 $('#viewTable').DataTable().ajax.reload();
    //               }
    //             },
    //             error: function(xhr, ajaxOptions, thrownError) {
    //               alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //             },
    //           });
    //         }
    //     });
    // }
    // function _deactive(id, periode_nm) {
    //     Swal.fire({
    //       title: 'Nonaktif Periode?',
    //       html: `<p class="mg-b-10">Anda akan menonaktifkan :</p><p><b>${periode_nm}</b></p>`,
    //       icon: 'question',
    //       showCancelButton: true,
    //       showConfirmButton: true,
    //       cancelButtonColor: '#d33',
    //       confirmButtonColor: '#3085d6',
    //       cancelButtonText: 'Tidak, batalkan',
    //       confirmButtonText: 'Ya, proses',
    //     }).then((result) => {
    //         if (result.value) {
    //           $.ajax({
    //             type: "POST",
    //             url: "<?= site_url('Backend/Periode/deactive') ?>",
    //             data: {
    //               id_periode: id_periode
    //             },
    //             dataType: "JSON",
    //             success: function(response) {
    //               if (response.sukses) {
    //                 Toast.fire({
    //                   icon: "success",
    //                   title: response.sukses,
    //                 });
    //                   $('#viewTable').DataTable().ajax.reload();
    //               }
    //             },
    //             error: function(xhr, ajaxOptions, thrownError) {
    //               alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //             },
    //           });
    //         }
    //     });
    // }
    // function _resetPassword(user_id, nama) {
    //     Swal.fire({
    //       title: 'Atur Ulang Kata Sandi?',
    //       html: `<p class="mg-b-10">Anda akan mengatur ulang kata sandi akun user:</p><p><b>${nama}</b></p>`,
    //       icon: 'question',
    //       showCancelButton: true,
    //       showConfirmButton: true,
    //       cancelButtonColor: '#d33',
    //       confirmButtonColor: '#3085d6',
    //       cancelButtonText: 'Tidak, batalkan',
    //       confirmButtonText: 'Ya, proses',
    //     }).then((result) => {
    //         if (result.value) {
    //           $.ajax({
    //             type: "POST",
    //             url: "<?= site_url('Backend/periode/reset_password') ?>",
    //             data: {
    //               user_id: user_id
    //             },
    //             dataType: "JSON",
    //             success: function(response) {
    //               if (response.sukses) {
    //                 Toast.fire({
    //                   icon: "success",
    //                   title: response.sukses,
    //                 });
    //                   $('#viewTable').DataTable().ajax.reload();
    //               }
    //             },
    //             error: function(xhr, ajaxOptions, thrownError) {
    //               alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //             },
    //           });
    //         }
    //     });
    // }
    function _delData(id, nama) {
        Swal.fire({
          title: 'Hapus Data?',
          html: `<p class="mg-b-10">Anda akan menghapus :</p><p><b>${nama}</b></p>`,
          icon: 'warning',
          showCancelButton: true,
          showConfirmButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#3085d6',
          cancelButtonText: 'Tidak, batalkan',
          confirmButtonText: 'Ya, proses',
        }).then((result) => {
            if (result.value) {
              $.ajax({
                type: "POST",
                url: "<?= site_url('Backend/Kelompok/del_data') ?>",
                data: {
                  id: id
                },
                dataType: "JSON",
                success: function(response) {
                  if (response.sukses) {
                    Toast.fire({
                      icon: "success",
                      title: response.sukses,
                    });
                      $('#viewTable').DataTable().ajax.reload();
                  }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
              });
            }
        });
    }
</script>
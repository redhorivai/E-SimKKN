<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/dataTables.responsive.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/select2/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/bootstrap-fileinput/bootstrap-fileinput.js"></script>
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
    $(window).ready(function() {
        _getLaporansurvei();
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
                    html: `<p class="mg-b-10">Anda akan menghapus <b>${jmldata.length} data</b> Laporan Dosen Pembimbing Lapangan</p>`,
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
    function _getLaporansurvei() {
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
            "ajax": "<?= site_url('Backend/Laporansurvei/getData') ?>",
        });
    }
    // function _btnAdd() {
    //     $.ajax({
    //         url: "<?= site_url('Backend/Laporandpl/form') ?>",
    //         success: function(response) {
    //           $('#formData').html(response);
    //           $('#viewData').delay(100).fadeOut();
    //           $('#formData').removeClass('d-none');
    //           $('#viewTable').DataTable().ajax.reload();
    //         },
    //         error: function(xhr, ajaxOptions, thrownError) {
    //             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //         },
    //     });
    // }
    // function _simpan() {
    //     var type = $("#type").val();
    //     var periode_id = $("#periode_id").val();
    //     var keterangan = $("#keterangan").val();
    //     var path        = $('#path')[0].files[0];
        
    //     var ajaxData = new FormData();
    //     ajaxData.append('action', 'forms');
    //     ajaxData.append('type', type);
    //     ajaxData.append('periode_id', periode_id);
    //     ajaxData.append('keterangan', keterangan);
    //     ajaxData.append('path', path);

    //     if (type == "") {
    //         $('#type').focus();
    //         $('#type').addClass('is-invalid');
    //     } else {
    //         $('#type').removeClass('is-invalid');
    //     }
    //     if (periode_id == "") {
    //         $('#periode_id').focus();
    //         $('#periode_id').addClass('is-invalid');
    //     } else {
    //         $('#periode_id').removeClass('is-invalid');
    //     }
    //     if (keterangan == "") {
    //         $('#keterangan').focus();
    //         $('#keterangan').addClass('is-invalid');
    //     } else {
    //         $('#keterangan').removeClass('is-invalid');
    //     }
    //     if (type && periode_id && keterangan) {
    //       $.ajax({
    //           url: "<?= site_url('Backend/Laporandpl/insert_data'); ?>",
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
    //                       title: "Data Laporan berhasil ditambahkan"
    //                   });
    //                   $('.form-data')[0].reset();
    //                   $('#formData').addClass('d-none');
    //                   $('#viewData').delay(100).fadeIn();
    //                   $('#viewTable').DataTable().ajax.reload();
    //               } else {
    //                   $("#nama").focus();
    //                   $('#nama').addClass('is-invalid');
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
    function _btnEdit(id) {
        $.ajax({
            type: "POST",
            url: "<?= site_url('Backend/Laporansurvei/form') ?>",
            data: {
                id: id
            },
            success: function(response) {
                if (response) {
                  $('#formData').html(response);
                  $('#viewData').delay(100).fadeOut();
                  $('#formData').removeClass('d-none');
                  $('#viewTable').DataTable().ajax.reload();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }
    function _update(id) {
        var status    = $("#status").val();
        var keterangan    = $("#keterangan").val();

        var ajaxData = new FormData();
        ajaxData.append('action', 'forms');
        ajaxData.append('status', status);
        ajaxData.append('keterangan', keterangan);
        ajaxData.append('id', id);
        if (status == "") {
            $("#status + span").addClass("is-invalid");
            $("#status + span").focus(function() {
                $(this).addClass("is-invalid");
            });
        } else {
            $('#status').removeClass('is-invalid');
            $("#status + span").removeClass("is-invalid");
            $("#status + span").focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
        if (keterangan == "") {
            $('#keterangan').addClass('is-invalid');
        } else {
            $('#keterangan').removeClass('is-invalid');
        }
        if (status && keterangan) {
          $.ajax({
              url: "<?= site_url('Backend/Laporansurvei/update_data'); ?>",
              type: "POST",
              data: ajaxData,
              contentType: false,
              cache: false,
              processData: false,
              dataType: "json",
              success: function(response) {
                  if (response == "Sukses") {
                      Toast.fire({
                          icon: "success",
                          title: "Data berhasil diperbaharui"
                      });
                      $('.form-data')[0].reset();
                      $('#formData').addClass('d-none');
                      $('#viewData').delay(100).fadeIn();
                      $('#viewTable').DataTable().ajax.reload();
                  } else {
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
    // function _delData(id, keterangan) {
    //     Swal.fire({
    //       title: 'Hapus Data?',
    //       html: `<p class="mg-b-10">Anda akan menghapus surat tugas:</p><p><b>${keterangan}</b></p>`,
    //       icon: 'warning',
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
    //             url: "<?= site_url('Backend/Laporandpl/del_data') ?>",
    //             data: {
    //               id: id
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
    function _detail(id) {
        $.ajax({
            url  : "<?= site_url('Backend/Laporansurvei/detail') ?>",
            type : "POST",
            data: {
              id: id
            },
            success: function(response) {
                $('#modaldetail').html(response);
                $('#modaldetail').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });      
    }
</script>
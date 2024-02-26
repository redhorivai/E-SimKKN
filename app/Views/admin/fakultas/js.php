<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/dataTables.responsive.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/select2/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/sweetalert2.all.min.js"></script>
<script type="text/javascript">   
    function remove(id) {
        if (id == 'title' || id == 'description') {
            $('#' + id).removeClass('is-invalid');
        }
    }
    $(window).ready(function() {
        _getFakultas();
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
                    html: `<p class="mg-b-10">Anda akan menghapus <b>${jmldata.length} data</b> Fakultas</p>`,
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
    function _getFakultas() {
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
          "ajax": "<?= site_url('Backend/Fakultas/getData') ?>",
        });
    }
    function _btnAdd() {
        $.ajax({
            url: "<?= site_url('Backend/Fakultas/form') ?>",
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
        var nama = $("#nama").val();

        var ajaxData = new FormData();
        ajaxData.append('action', 'forms');
        ajaxData.append('nama', nama);
        if (nama == "") {
            $('#nama').focus();
            $('#nama').addClass('is-invalid');
        } else {
            $('#nama').removeClass('is-invalid');
        }
        if (nama) {
          $.ajax({
              url: "<?= site_url('Backend/Fakultas/insert_data'); ?>",
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
                          title: "Data berhasil ditambahkan"
                      });
                      $('.form-data')[0].reset();
                      $('#formData').addClass('d-none');
                      $('#viewData').delay(100).fadeIn();
                      $('#viewTable').DataTable().ajax.reload();
                  } else {
                      $("#nama").focus();
                      $('#nama').addClass('is-invalid');
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
    function _btnEdit(id) {
        $.ajax({
            type: "POST",
            url: "<?= site_url('Backend/Fakultas/form') ?>",
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
        var nama = $("#nama").val();

        var ajaxData = new FormData();
        ajaxData.append('action', 'forms');
        ajaxData.append('nama', nama);
        ajaxData.append('id', id);
        if (nama == "") {
            $('#nama').focus();
            $('#nama').addClass('is-invalid');
        } else {
            $('#nama').removeClass('is-invalid');
        }
        if (nama) {
          $.ajax({
              url: "<?= site_url('Backend/Fakultas/update_data'); ?>",
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
    // function _delData(info_id, nama) {
    //     Swal.fire({
    //       title: 'Hapus Data?',
    //       html: `<p class="mg-b-10">Anda akan menghapus Fakultas:</p><p><b>${nama}</b></p>`,
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
    //             url: "<?= site_url('Backend/HakKewajiban/del_data') ?>",
    //             data: {
    //               info_id: info_id
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
</script>
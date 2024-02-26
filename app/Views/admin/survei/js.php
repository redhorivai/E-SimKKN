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
        _getSurvei();
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
    function _getSurvei() {
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
            "ajax": "<?= site_url('Backend/Survei/getData') ?>",
        });
    }
    function _btnAdd() {
        $.ajax({
            url: "<?= site_url('Backend/Survei/form') ?>",
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
        var kelompok_id = $("#kelompok_id").val();
        var user_id = $("#user_id").val();
        var path        = $('#path')[0].files[0];
        
        var ajaxData = new FormData();
        ajaxData.append('action', 'forms');
        ajaxData.append('kelompok_id', kelompok_id);
        ajaxData.append('user_id', user_id);
        ajaxData.append('path', path);

        if (kelompok_id == "") {
            $('#kelompok_id').focus();
            $('#kelompok_id').addClass('is-invalid');
        } else {
            $('#kelompok_id').removeClass('is-invalid');
        }
        if (user_id == "") {
            $('#user_id').focus();
            $('#user_id').addClass('is-invalid');
        } else {
            $('#user_id').removeClass('is-invalid');
        }
        if (kelompok_id && user_id) {
          $.ajax({
              url: "<?= site_url('Backend/Survei/insert_data'); ?>",
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
                          title: "Data Laporan Survei berhasil ditambahkan"
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
            url: "<?= site_url('Backend/Laporandpl/form') ?>",
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
    // function _update(id) {
    //     var judul         = $("#judul").val();
    //     var keterangan    = $("#keterangan").val();
    //     var path          = $('#path')[0].files[0];
    //     var path_lama     = $('#path_lama').val();

    //     var ajaxData = new FormData();
    //     ajaxData.append('action', 'forms');
    //     ajaxData.append('judul', judul);
    //     ajaxData.append('keterangan', keterangan);
    //     ajaxData.append('path', path);
    //     ajaxData.append('path_lama', path_lama);
    //     ajaxData.append('id', id);
    //     if (judul == "") {
    //         $('#judul').focus();
    //         $('#judul').addClass('is-invalid');
    //     } else {
    //         $('#judul').removeClass('is-invalid');
    //     }
    //     if (keterangan == "") {
    //         $('#keterangan').addClass('is-invalid');
    //     } else {
    //         $('#keterangan').removeClass('is-invalid');
    //     }
    //     if (judul && keterangan) {
    //       $.ajax({
    //           url: "<?= site_url('Backend/Pengumuman/update_data'); ?>",
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
    function _delData(id, keterangan) {
        Swal.fire({
          title: 'Hapus Data?',
          html: `<p class="mg-b-10">Anda akan menghapus surat tugas:</p><p><b>${keterangan}</b></p>`,
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
                url: "<?= site_url('Backend/Laporandpl/del_data') ?>",
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
    function _detail(id) {
        $.ajax({
            url  : "<?= site_url('Backend/Survei/detail') ?>",
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
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
    _getLaporanakhir();
    $('#checkAll').click(function(e) {
      if ($(this).is(':checked')) {
        $('.checkedId').prop('checked', true);
      } else {
        $('.checkedId').prop('checked', false);
      }
    });
    $('.formMultiDelete').submit(function(e) {
      e.preventDefault();
      let jmldata = $('.checkedId:checked');
      if (jmldata.length === 0) {
        Swal.fire({
          title: 'Pemberitahuan',
          html: 'Silahkan pilih data yang akan dihapus!',
          icon: 'warning',
          showConfirmButton: true,
        });
      } else {
        Swal.fire({
          title: 'Hapus Data?',
          html: `<p class="mg-b-10">Anda akan menghapus <b>${jmldata.length} data</b> Pengaduan</p>`,
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

  function _getLaporanakhir() {
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
      "columnDefs": [{
        "targets": [0, 2],
        "orderable": false
      }, ],
      "columns": [{
          "data": "cek"
        },
        {
          "data": "col"
        },
        {
          "data": "action"
        },
      ],
      "ajax": "<?= site_url('Backend/Laporanakhir/getData') ?>",
    });
  }
  function _btnReport() {
    var tglAwal = $("#tglAwal").val();
    var tglAkhir = $("#tglAkhir").val();

    if (tglAwal && tglAkhir) {
      $.ajax({
        url: "<?= site_url('Backend/Laporanakhir/view_report') ?>",
        type: "POST",
        data: {
          tglAwal: tglAwal,
          tglAkhir: tglAkhir,
        },
        success: function(response) {
          $('#formData').html(response);
          $('#formData').removeClass('d-none');
          $('.form-data')[0].reset();
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
      });
    }
  }
  function _detail(id) {
        $.ajax({
            url  : "<?= site_url('Backend/Laporanakhir/detail') ?>",
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
    function _btnCek(id) {
        $.ajax({
            url  : "<?= site_url('Backend/Laporanakhir/ceknilai') ?>",
            type : "POST",
            data: {
              id: id
            },
            success: function(response) {
                $('#modaldetail1').html(response);
                $('#modaldetail1').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });      
    }
    function _simpan(id) {
        var nilai     = $("#nilai").val();
        if (nilai == "") {
            $("#nilai").focus();
            $('#nilai').addClass('is-invalid');
        } else {
            $('#nilai').removeClass('is-invalid');
        }
        if (nilai) {
            $.ajax({
                url: "<?= site_url('Backend/Laporanakhir/insert_data') ?>",
                type: "POST",
                data: {
                    nilai     : nilai,
                    id       : id,
                },
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data Nilai berhasil ditambahkan"
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
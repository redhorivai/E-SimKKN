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
    _getLapor();
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

  function _getLapor() {
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
      "ajax": "<?= site_url('Backend/Lapor/getData') ?>",
    });
  }

  function _delData(lapor_id, nama) {
    Swal.fire({
      title: 'Hapus Data?',
      html: `<p class="mg-b-10">Anda akan menghapus Data Pengaduan:</p><p><b>${nama}</b></p>`,
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
          url: "<?= site_url('Backend/Lapor/del_data') ?>",
          data: {
            lapor_id: lapor_id
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

  function _btnReport() {
    var tglAwal = $("#tglAwal").val();
    var tglAkhir = $("#tglAkhir").val();

    if (tglAwal && tglAkhir) {
      $.ajax({
        url: "<?= site_url('Backend/Lapor/view_report') ?>",
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

  function _printReport(tglAwal, tglAkhir) {
    $.ajax({
      url: "<?= site_url('Backend/Lapor/print_report') ?>",
      type: "POST",
      data: {
        tglAwal  : tglAwal,
        tglAkhir : tglAkhir,
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
</script>
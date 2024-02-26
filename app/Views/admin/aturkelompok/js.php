<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/dataTables.responsive.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/select2/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    $(window).ready(function() {
        _getAturkelompok();
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
                    html: `<p class="mg-b-10">Anda akan menghapus <b>${jmldata.length} data</b> grafik</p>`,
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
    function _getAturkelompok() {
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
          "ajax": "<?= site_url('Backend/Aturkelompok/getData') ?>",
        });
    }
    function _btnAdd() {
        $.ajax({
            url      : "<?= site_url('Backend/Aturkelompok/form_insert') ?>",
            dataType : "JSON",
            beforeSend: function(){
                $('.viewdata').html('<div style="font-size:60px;margin-top:150px;margin-bottom:150px;align-items:center;display:flex;justify-content:center;width:100%;"><i class="fa fa-spin fa-spinner"></i></div>');
            },
            success: function(response) {
              $('.viewdata').html(response.data).show();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }
    function _btnEdit(id) {
        $.ajax({
            type     : "POST",     
            url      : "<?= site_url('Backend/Aturkelompok/form_update') ?>",
            dataType : "JSON",
            data : {id: id},
            beforeSend: function(){
                $('.viewdata').html('<div style="font-size:60px;margin-top:150px;margin-bottom:150px;align-items:center;display:flex;justify-content:center;width:100%;"><i class="fa fa-spin fa-spinner"></i></div>');
            },
            success: function(response) {
                $('.viewdata').html(response.data).show();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }
    function _delData(chart_id, tipe, periode) {
        Swal.fire({
          title: 'Hapus Data?',
          html: `<p class="mg-b-10">Anda akan menghapus grafik:</p><p class='mg-b-2'><b>${tipe}</b></p><p><b>${periode}</b></p>`,
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
                url: "<?= site_url('Backend/Imut/del_data') ?>",
                data: {
                  chart_id: chart_id
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
    function _detail(chart_id) {
        $.ajax({
            url  : "<?= site_url('Backend/Imut/detail') ?>",
            type : "POST",
            data: {
              chart_id: chart_id
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
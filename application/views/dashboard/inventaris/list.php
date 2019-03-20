<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('_partials/head'); ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      
      <?php $this->load->view('_partials/navbar'); ?>

      <?php $this->load->view('_partials/sidebar'); ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <?php //$this->load->view('_partials/breadcrumb'); ?>
          <?php $this->load->view('_partials/notif'); ?>
          <div class="section-body">
            <!-- <h2 class="section-title">Rekening</h2> -->

            <div class="row">
              <div class="col-12">
                <div class="card animated fadeIn">
                  <div class="card-header">
                    <h4>Data Inventaris</h4>
                    <div class="card-header-action">
                    <a href="<?php echo site_url('inventaris/tambah'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Inventaris</a>
                    <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteConfirm('<?php echo site_url('inventaris/hapus/all'); ?>')"><i class="fas fa-trash-alt"></i> Hapus Semua</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped hasdiuwehduiweh" id="list-inventaris">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Nama</th>
                            <th>Kondisi</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th>Tanggal Registrasi</th>
                            <th>Ruang</th>
                            <th>Kode</th>
                            <th>Petugas</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Nama</th>
                            <th>Kondisi</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th>Tanggal Registrasi</th>
                            <th>Ruang</th>
                            <th>Kode</th>
                            <th>Petugas</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card animated fadeIn">
                  <div class="card-header">
                    <h4>Stok Gudang</h4>
                    <div class="card-header-action">
                    <a href="<?php echo site_url('inventaris/tambah'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Inventaris</a>
                    <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteConfirm('<?php echo site_url('inventaris/hapus/all'); ?>')"><i class="fas fa-trash-alt"></i> Hapus Semua</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped hasdiuwehduiweh" id="list-stok">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Nama</th>
                            <th>Sedang Dipinjam</th>
                            <th>Stok</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th>Tanggal Registrasi</th>
                            <th>Ruang</th>
                            <th>Kode</th>
                            <th>Petugas</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Nama</th>
                            <th>Sedang Dipinjam</th>
                            <th>Stok</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th>Tanggal Registrasi</th>
                            <th>Ruang</th>
                            <th>Kode</th>
                            <th>Petugas</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <?php $this->load->view('_partials/footer'); ?>
      <?php $this->load->view('_partials/modals'); ?>
    </div>
  </div>
  <?php $this->load->view('_partials/js'); ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
      {
            return {
              "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
              };
        };

        var t = $("#list-inventaris").dataTable({
          initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                              api.search(this.value).draw();
                    }
                  });
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "<?php echo site_url('inventaris/getInventaris'); ?>", "type": "POST"},
            columns: [
              {
                    "data": "id_inventaris",
                    "orderable": false, width:10
                },
                {"data": "nama_inventaris", width:10},
                {"data": "kondisi_inventaris", width:10},
                {"data": "keterangan_inventaris", width:10},
                {"data": "jumlah_inventaris", width:10},
                {"data": "nama_jenis", width:10},
                {"data": "tanggal_register", width:10},
                {"data": "nama_ruang", width:10},
                {"data": "kode_inventaris", width:10},
                {"data": "nama_pegawai", width:10},
                {"data": "action", width:10},
              ],
            order: [[1, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
              },
            keys:!0,
            language:{
                Processing: "loading..."
              },
            drawCallback:function(){
              $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            },
            stateSave: true
        });

        var u = $("#list-stok").dataTable({
          initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                              api.search(this.value).draw();
                    }
                  });
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "<?php echo site_url('inventaris/getStokGudang'); ?>", "type": "POST"},
            columns: [
              {
                    "data": "id_inventaris",
                    "orderable": false, width:10
                },
                {"data": "nama_inventaris", width:10},
                {"data": "jumlah_detail_pinjam", width:10,"searchable":false},
                {"data": "jumlah_digudang", width:10,"searchable":false},
                {"data": "jumlah_inventaris", width:10,"searchable":false},
                {"data": "nama_jenis", width:10},
                {"data": "tanggal_register", width:10},
                {"data": "nama_ruang", width:10},
                {"data": "kode_inventaris", width:10},
                {"data": "nama_pegawai", width:10},
                {"data": "action", width:10},
              ],
            order: [[1, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
              },
            keys:!0,
            language:{
                Processing: "loading..."
              },
            drawCallback:function(){
              $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            },
            stateSave: true
        });
      });
</script>
<script>
  function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>
</body>
</html>
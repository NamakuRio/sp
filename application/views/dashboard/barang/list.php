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
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 animated fadeIn faster">
                  <div class="card-icon bg-warning">
                    <i class="fab fa-opencart"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Sedang Dipinjam</h4>
                    </div>
                    <div class="card-body">
                      <?php echo $total_sedang_dipinjam; ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 animated fadeIn fast">
                  <div class="card-icon bg-primary">
                    <i class="fab fa-codepen"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Barang Di gudang</h4>
                    </div>
                    <div class="card-body">
                      <?php echo $total_barang_di_gudang; ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 animated fadeIn">
                  <div class="card-icon bg-success">
                    <i class="fas fa-boxes"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Barang</h4>
                    </div>
                    <div class="card-body">
                      <?php echo $total_barang; ?>
                    </div>
                  </div>
                </div>
              </div>                  
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card  animated fadeIn">
                  <div class="card-header">
                    <h4>Data Peminjaman</h4>
                    <?php if($this->session->userdata('nama_level') != 'Peminjam'){ ?>
                    <div class="card-header-action">
                    <a href="<?php echo site_url('barang/tambah'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Peminjaman</a>
                    <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteConfirm('<?php echo site_url('barang/hapus/all'); ?>')"><i class="fas fa-trash-alt"></i> Hapus Semua</a>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped hasdiuwehduiweh" id="list-peminjaman">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Peminjam</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status Peminjaman</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Peminjam</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status Peminjaman</th>
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
                    <h4>History Peminjaman</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped hasdiuwehduiweh" id="list-history-peminjaman">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Peminjam</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status Peminjaman</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Peminjam</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status Peminjaman</th>
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

        var t = $("#list-peminjaman").dataTable({
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
            ajax: {"url": "<?php echo site_url('barang/getPeminjaman'); ?>", "type": "POST"},
            columns: [
              {
                    "data": "id_peminjaman",
                    "orderable": false, width:10
                },
                {"data": "nama_pegawai", width:10},
                {"data": "nama_inventaris", width:10},
                {"data": "jumlah_detail_pinjam", width:10},
                {"data": "tanggal_pinjam", width:10},
                {"data": "tanggal_kembali", width:10},
                {"data": "nama_status_peminjaman", width:10},
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
        
        var t = $("#list-history-peminjaman").dataTable({
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
            ajax: {"url": "<?php echo site_url('barang/getHistoryPeminjaman'); ?>", "type": "POST"},
            columns: [
              {
                    "data": "id_peminjaman",
                    "orderable": false, width:10
                },
                {"data": "nama_pegawai", width:10},
                {"data": "nama_inventaris", width:10},
                {"data": "jumlah_detail_pinjam", width:10},
                {"data": "tanggal_pinjam", width:10},
                {"data": "tanggal_kembali", width:10},
                {"data": "nama_status_peminjaman", width:10},
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
        $('#list-peminjaman').on('click','.edit_status_peminjaman',function(){
            var id=$(this).data('id');
            var status=$(this).data('status');
						// var nama=$(this).data('nama');
						// var harga=$(this).data('harga');
						// var kategori=$(this).data('kategori');
            $('#edit_status_peminjaman').modal('show');
            $('[name="id"]').val(id);
            $('[name="status_peminjaman"]').val(status);
						// $('[name="nama_barang"]').val(nama);
						// $('[name="harga"]').val(harga);
						// $('[name="kategori"]').val(kategori);
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
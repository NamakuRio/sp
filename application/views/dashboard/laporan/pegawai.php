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
                  <a href="<?php echo site_url('laporan'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                    <h4>Laporan Pegawai</h4>
                    <div class="card-header-action">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Export</a>
                            <div class="dropdown-menu">
                                <a href="<?php echo site_url('laporan/pegawai/pdf'); ?>" target="_blank" class="dropdown-item has-icon"><i class="far fa-file-pdf"></i> PDF</a>
                                <a href="<?php echo site_url('laporan/pegawai/excel'); ?>" class="dropdown-item has-icon"><i class="fas fa-file-excel"></i> EXCEL</a>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="list-pegawai">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Alamat</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Alamat</th>
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

        var t = $("#list-pegawai").dataTable({
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
            ajax: {"url": "<?php echo site_url('laporan/getLaporan/pegawai'); ?>", "type": "POST"},
            columns: [
                {
                    "data": "id_pegawai",
                    "orderable": false, width:10
                },
                {"data": "nama_pegawai", width:10},
                {"data": "nip_pegawai", width:10},
                {"data": "alamat_pegawai", width:10},
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

    function getLaporan(tanggal_laporan)
    {
        console.log(tanggal_laporan);
    }
</script>
<script>
  function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>
</body>
</html>
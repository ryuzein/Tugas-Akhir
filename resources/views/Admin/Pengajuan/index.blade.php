@extends('Master.Layouts.app', ['title' => $title])

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Pengajuan</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-gray">Admin</li>
                <li class="breadcrumb-item active" aria-current="page">Pengajuan</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->


    <!-- ROW -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h3 class="card-title">Data</h3>
                    @if ($hakTambah > 0)
                        <div>
                            <a class="modal-effect btn btn-primary-light" data-bs-effect="effect-super-scaled"
                                data-bs-toggle="modal" href="#modaldemo8">Tambah Data
                                <i class="fe fe-plus"></i></a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-1" width="100%"
                            class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
                            <thead>
                                <th class="border-bottom-0" width="1%">No</th>
                                <th class="border-bottom-0">Nama Barang</th>
                                <th class="border-bottom-0">Jenis Barang</th>
                                <th class="border-bottom-0">Jumlah</th>
                                <th class="border-bottom-0">Tujuan</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0" width="1%">Action</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END ROW -->

    @include('Admin.Pengajuan.tambah')
    @include('Admin.Pengajuan.edit')
    @include('Admin.Pengajuan.hapus')

    <script>
        function update(data) {
            $("input[name='idpengajuanU']").val(data.pengajuan_id);
            $("input[name='namabarangpengajuanU']").val(data.pengajuan_nama_barang.replace(/_/g, ' '));
            $("input[name='jenisbarangpengajuanU']").val(data.pengajuan_jenis_barang.replace(/_/g, ' '));
            $("input[name='jumlahbarangpengajuanU']").val(data.pengajuan_jumlah_barang);
            $("input[name='tujuanpengajuanU']").val(data.pengajuan_tujuan.replace(/_/g, ' '));
            $("select[name='statusU']").val(data.status);
        }

        function hapus(data) {
            $("input[name='idpengajuan']").val(data.pengajuan_id);
            $("#vpengajuan").html("pengajuan " + "<b>" + data.pengajuan_nama_barang.replace(/_/g, ' ') + "</b>");
        }

        function validasi(judul, status) {
            swal({
                title: judul,
                type: status,
                confirmButtonText: "Iya."
            });
        }
    </script>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table;
        $(document).ready(function() {
            //datatables
            table = $('#table-1').DataTable({

                "processing": true,
                "serverSide": true,
                "info": true,
                "order": [],
                "stateSave": true,
                "lengthMenu": [
                    [5, 10, 25, 50, 100],
                    [5, 10, 25, 50, 100]
                ],
                "pageLength": 10,

                lengthChange: true,

                "ajax": {
                    "url": "{{ route('pengajuan.getpengajuan') }}",
                },

                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'pengajuan_nama_barang',
                        name: 'pengajuan_nama_barang',
                    },
                    {
                        data: 'pengajuan_jenis_barang',
                        name: 'pengajuan_jenis_barang',
                    },
                    {
                        data: 'pengajuan_jumlah_barang',
                        name: 'pengajuan_jumlah_barang',
                    },
                    {
                        data: 'pengajuan_tujuan',
                        name: 'pengajuan_tujuan',
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],

            });
        });
    </script>
@endsection

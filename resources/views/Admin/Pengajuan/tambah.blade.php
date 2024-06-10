<!-- MODAL TAMBAH -->
<div class="modal fade" data-bs-backdrop="static" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Pengajuan</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="pengajuan_nama_barang" class="form-label">Nama Barang<span class="text-danger">*</span></label>
                    <input type="text" name="pengajuan_nama_barang" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="pengajuan_jenis_barang" class="form-label">Jenis Barang</label>
                    <input type="text" name="pengajuan_jenis_barang" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="pengajuan_jumlah_barang" class="form-label">Jumlah Barang</label>
                    <input type="text" name="pengajuan_jumlah_barang" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="pengajuan_tujuan" class="form-label">Tujuan</label>
                    <input type="text" name="pengajuan_tujuan" class="form-control" placeholder="">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary d-none" id="btnLoader" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="checkForm()" id="btnSimpan" class="btn btn-primary">Simpan <i
                        class="fe fe-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="reset()" data-bs-dismiss="modal">Batal <i
                        class="fe fe-x"></i></a>
            </div>
        </div>
    </div>
</div>


@section('formTambahJS')
    <script>
        function checkForm() {
            const pengajuan_nama_barang = $("input[name='pengajuan_nama_barang']").val();
            const pengajuan_jenis_barang = $("input[name='pengajuan_jenis_barang']").val();
            const pengajuan_jumlah_barang = $("input[name='pengajuan_jumlah_barang']").val();
            const pengajuan_tujuan = $("input[name='pengajuan_tujuan']").val();
            setLoading(true);
            resetValid();

            if (pengajuan_nama_barang == "") {
                validasi('Nama barang wajib di isi!', 'warning');
                $("input[name='pengajuan_nama_barang']").addClass('is-invalid');
                setLoading(false);
                return false;
            }

            if (pengajuan_jenis_barang == "") {
                validasi('Jenis barang wajib di isi!', 'warning');
                $("input[name='pengajuan_jenis_barang']").addClass('is-invalid');
                setLoading(false);
                return false;
            }

            if (pengajuan_jumlah_barang == "") {
                validasi('Jumlah barang wajib di isi!', 'warning');
                $("input[name='pengajuan_jumlah_barang']").addClass('is-invalid');
                setLoading(false);
                return false;
            }

            if (pengajuan_tujuan == "") {
                validasi('Tujuan barang wajib di isi!', 'warning');
                $("input[name='pengajuan_tujuan']").addClass('is-invalid');
                setLoading(false);
                return false;
            }
            
            else {
                submitForm();
            }

        }

        function submitForm() {
            const pengajuan_nama_barang = $("input[name='pengajuan_nama_barang']").val();
            const pengajuan_jenis_barang = $("input[name='pengajuan_jenis_barang']").val();
            const pengajuan_jumlah_barang = $("input[name='pengajuan_jumlah_barang']").val();
            const pengajuan_tujuan = $("input[name='pengajuan_tujuan']").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('pengajuan.store') }}",
                enctype: 'multipart/form-data',
                data: {
                    pengajuan_nama_barang: pengajuan_nama_barang,
                    pengajuan_jenis_barang: pengajuan_jenis_barang,
                    pengajuan_jumlah_barang: pengajuan_jumlah_barang,
                    pengajuan_tujuan: pengajuan_tujuan
                },
                success: function(data) {
                    $('#modaldemo8').modal('toggle');
                    swal({
                        title: "Berhasil ditambah!",
                        type: "success"
                    });
                    table.ajax.reload(null, false);
                    reset();

                }
            });
        }

        function resetValid() {
            $("input[name='pengajuan_nama_barang']").removeClass('is-invalid');
        };

        function reset() {
            resetValid();
            $("input[name='pengajuan_nama_barang']").val('');
            $("input[name='pengajuan_jenis_barang']").val('');
            $("input[name='pengajuan_jumlah_barang']").val('');
            $("input[name='pengajuan_tujuan']").val();
            setLoading(false);
        }

        function setLoading(bool) {
            if (bool == true) {
                $('#btnLoader').removeClass('d-none');
                $('#btnSimpan').addClass('d-none');
            } else {
                $('#btnSimpan').removeClass('d-none');
                $('#btnLoader').addClass('d-none');
            }
        }
    </script>
@endsection

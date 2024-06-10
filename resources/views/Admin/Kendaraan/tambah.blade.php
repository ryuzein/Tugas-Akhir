<!-- MODAL TAMBAH -->
<div class="modal fade" data-bs-backdrop="static" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Kendaraan</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kendaraan" class="form-label">Nama Kendaraan <span class="text-danger">*</span></label>
                    <input type="text" name="kendaraa" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="plat" class="form-label">Kendaraan</label>
                    <input name="plat" class="form-control" rows="4"></input>
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
            const kendaraan = $("input[name='kendaraan']").val();
            setLoading(true);
            resetValid();

            if (kendaraan == "") {
                validasi('Nama Kendaraan wajib di isi!', 'warning');
                $("input[name='kendaraan']").addClass('is-invalid');
                setLoading(false);
                return false;
            } else {
                submitForm();
            }

        }

        function submitForm() {
            const kendaraan = $("input[name='kendaraan']").val();
            const plat = $("input[name='plat']").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('kendaraan.store') }}",
                enctype: 'multipart/form-data',
                data: {
                    kendaraan: kendaraan,
                    plat: plat
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
            $("input[name='kendaraan']").removeClass('is-invalid');
        };

        function reset() {
            resetValid();
            $("input[name='kendaraan']").val('');
            $("textarea[name='ket']").val('');
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

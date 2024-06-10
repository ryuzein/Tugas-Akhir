<!-- MODAL EDIT -->
<div class="modal fade" data-bs-backdrop="static" id="Umodaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Teknisi</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idteknisiU">
                <div class="form-group">
                    <label for="teknisiU" class="form-label">Teknisi <span class="text-danger">*</span></label>
                    <input type="text" name="teknisiU" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="notelpU" class="form-label">No Telepon</label>
                    <input type="text" name="notelpU" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="alamatU" class="form-label">Alamat</label>
                    <textarea name="alamatU" class="form-control" rows="4"></textarea>
                </div>
                {{-- <div class="form-group">
                    <label for="test" class="form-label">Test</label>
                    <input type="text" name="test">
                </div> --}}
            </div>
            <div class="modal-footer">
                <button class="btn btn-success d-none" id="btnLoaderU" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="checkFormU()" id="btnSimpanU" class="btn btn-success">Simpan Perubahan <i class="fe fe-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="resetU()" data-bs-dismiss="modal">Batal <i class="fe fe-x"></i></a>
            </div>
        </div>
    </div>
</div>

@section('formEditJS')
<script>
    // const idTeknisi = $("input[name='idteknisiU']").val();
    // $("input[name='test']").val(idTeknisi);
    function checkFormU() {
        const teknisi = $("input[name='teknisiU']").val();
        setLoadingU(true);
        resetValidU();

        if (teknisi == "") {
            validasi('Nama teknisi wajib di isi!', 'warning');
            $("input[name='teknisiU']").addClass('is-invalid');
            setLoadingU(false);
            return false;
        } else {
            submitFormU();
        }
    }

    function submitFormU() {
        const id = $("input[name='idteknisiU']").val();
        const teknisi = $("input[name='teknisiU']").val();
        const notelp = $("input[name='notelpU']").val();
        const alamat = $("textarea[name='alamatU']").val();

        $.ajax({
            type: 'POST',
            url: "{{url('admin/teknisi/proses_ubah')}}/" + id,
            enctype: 'multipart/form-data',
            data: {
                teknisi: teknisi,
                notelp: notelp,
                alamat: alamat
            },
            success: function(data) {
                swal({
                    title: "Berhasil diubah!",
                    type: "success"
                });
                $('#Umodaldemo8').modal('toggle');
                table.ajax.reload(null, false);
                resetU();
            }
        });
    }

    function resetValidU() {
        $("input[name='teknisiU']").removeClass('is-invalid');
        $("input[name='notelpU']").removeClass('is-invalid');
        $("textarea[name='alamatU']").removeClass('is-invalid');
    };

    function resetU() {
        resetValidU();
        $("input[name='idteknisiU']").val('');
        $("input[name='teknisiU']").val('');
        $("input[name='notelpU']").val('');
        $("textarea[name='alamatU']").val('');
        setLoadingU(false);
    }

    function setLoadingU(bool) {
        if (bool == true) {
            $('#btnLoaderU').removeClass('d-none');
            $('#btnSimpanU').addClass('d-none');
        } else {
            $('#btnSimpanU').removeClass('d-none');
            $('#btnLoaderU').addClass('d-none');
        }
    }
</script>
@endsection
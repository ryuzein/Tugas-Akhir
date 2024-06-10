<!-- MODAL EDIT -->
<div class="modal fade" data-bs-backdrop="static" id="Umodaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Cabang</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idcabangU">
                <div class="form-group">
                    <label for="cabangU" class="form-label">Cabang <span class="text-danger">*</span></label>
                    <input type="text" name="cabangU" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="kodeU" class="form-label">Kode Cabang</label>
                    <input type="text" name="kodeU" class="form-control" placeholder="">
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
    // const idCabang = $("input[name='idcabangU']").val();
    // $("input[name='test']").val(idCabang);
    function checkFormU() {
        const cabang = $("input[name='cabangU']").val();
        setLoadingU(true);
        resetValidU();

        if (cabang == "") {
            validasi('Nama cabang wajib di isi!', 'warning');
            $("input[name='cabangU']").addClass('is-invalid');
            setLoadingU(false);
            return false;
        } else {
            submitFormU();
        }
    }

    function submitFormU() {
        const id = $("input[name='idcabangU']").val();
        const cabang = $("input[name='cabangU']").val();
        const kode = $("input[name='kodeU']").val();
        const alamat = $("textarea[name='alamatU']").val();

        $.ajax({
            type: 'POST',
            url: "{{url('admin/cabang/proses_ubah')}}/" + id,
            enctype: 'multipart/form-data',
            data: {
                cabang: cabang,
                kode  : kode,
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
        $("input[name='cabangU']").removeClass('is-invalid');
        $("input[name='kodeU']").removeClass('is-invalid');
        $("textarea[name='alamatU']").removeClass('is-invalid');
    };

    function resetU() {
        resetValidU();
        $("input[name='idcabangU']").val('');
        $("input[name='cabangU']").val('');
        $("input[name='kodeU']").val('');
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
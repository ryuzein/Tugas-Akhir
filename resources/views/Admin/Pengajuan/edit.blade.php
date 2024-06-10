<!-- MODAL EDIT -->
<div class="modal fade" data-bs-backdrop="static" id="Umodaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title title-edit">Ubah</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idpengajuanU">
                <input type="hidden" name="roleuserU" value="<?= $roleUser; ?>">
                <div class="form-group namabarangpengajuanU">
                    <label for="namabarangpengajuanU" class="form-label">Nama Barang<span class="text-danger">*</span></label>
                    <input type="text" name="namabarangpengajuanU" class="form-control" placeholder="">
                </div>
                <div class="form-group jenisbarangpengajuanU">
                    <label for="jenisbarangpengajuanU" class="form-label">Jenis Barang</label>
                    <input type="text" name="jenisbarangpengajuanU" class="form-control" placeholder="">
                </div>
                <div class="form-group jumlahbarangpengajuanU">
                    <label for="jumlahbarangpengajuanU" class="form-label">Jumlah Barang</label>
                    <input type="text" name="jumlahbarangpengajuanU" class="form-control" placeholder="">
                </div>
                <div class="form-group tujuanpengajuanU">
                    <label for="tujuanpengajuanU" class="form-label">Tujuan</label>
                    <input type="text" name="tujuanpengajuanU" class="form-control" placeholder="">
                </div>
                <div class="form-group statusU">
                    <label for="statusU" class="form-label">Status</label>
                    <select name="statusU" id="status" class="form-control" rows="4" va>
                        <option value="MENUNGGU">TUNGGU</option>
                        <option value="DITERIMA">TERIMA</option>
                        <option value="DITOLAK">TOLAK</option>
                    </select>
                </div>
            </div>
            {{-- <div class="modal-body">
                <input type="text" name="testIdCheck">
            </div> --}}
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

    const userRole = $("input[name='roleuserU']").val();
    if (userRole == 3) {
        $(".title-edit").text('Ubah Pengajuan');
        $(".statusU").hide();
    }
    else if (userRole == 2) {
        $(".title-edit").text('Ubah Status Pengajuan')
        $(".namabarangpengajuanU").hide();
        $(".jenisbarangpengajuanU").hide();
        $(".jumlahbarangpengajuanU").hide();
        $(".tujuanpengajuanU").hide();
    }

    function checkFormU() {
        const status = $("input[name='statusU']").val();
        setLoadingU(true);
        resetValidU();

        if (status == "") {
            validasi('Status wajib dipilih!', 'warning');
            $("input[name='statusU']").addClass('is-invalid');
            setLoadingU(false);
            return false;
        } else {
            submitFormU();
        }
    }

    function submitFormU() {
        const pengajuan_id = $("input[name='idpengajuanU']").val();
        const pengajuan_nama_barang = $("input[name='namabarangpengajuanU']").val();
        const pengajuan_jenis_barang = $("input[name='jenisbarangpengajuanU']").val();
        const pengajuan_jumlah_barang = $("input[name='jumlahbarangpengajuanU']").val();
        const pengajuan_tujuan = $("input[name='tujuanpengajuanU']").val();
        const status = $("select[name='statusU']").val();

        $.ajax({
            type: 'POST',
            url: "{{url('admin/pengajuan/proses_ubah')}}/" + pengajuan_id,
            enctype: 'multipart/form-data',
            data: {
                pengajuan_nama_barang: pengajuan_nama_barang,
                pengajuan_jenis_barang: pengajuan_jenis_barang,
                pengajuan_jumlah_barang: pengajuan_jumlah_barang,
                pengajuan_tujuan: pengajuan_tujuan,
                status: status
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
        $("input[name='idpengajuanU']").removeClass('is-invalid');
        $("input[name='namabarangpengajuanU']").removeClass('is-invalid');
        $("input[name='jenisbarangpengajuanU']").removeClass('is-invalid');
        $("input[name='jumlahbarangpengajuanU']").removeClass('is-invalid');
        $("input[name='tujuanpengajuanU']").removeClass('is-invalid');
        $("input[name='statusU']").removeClass('is-invalid');
    };

    function resetU() {
        resetValidU();
        $("input[name='idpengajuanU']").val('');
        $("input[name='namabarangpengajuanU']").val('');
        $("input[name='jenisbarangpengajuanU']").val('');
        $("input[name='jumlahbarangpengajuanU']").val('');
        $("input[name='tujuanpengajuanU']").val('');
        $("input[name='statusU']").val('');
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
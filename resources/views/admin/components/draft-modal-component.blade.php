<div class="modal fade" id="modal-draft" tabindex="-1" aria-labelledby="modal-draftLabel1">
    <div class="modal-dialog modal-sm" role="document">
        <form id="form-draft" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="modal-draftLabel1">
                        Konfirmasi simpan draf
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-dark fs-7 mb-0">Apakah anda yakin ini dijadikan draf?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white font-medium waves-effect"
                        data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button style="background-color: #1B3061" type="submit" class="btn text-white btn-create">
                        Yakin
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

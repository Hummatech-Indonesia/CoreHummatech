<div class="modal fade" id="modal-publish" tabindex="-1" aria-labelledby="modal-publishLabel1">
    <div class="modal-dialog modal-sm" role="document">
        <form id="form-publish" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="modal-publishLabel1">
                        Konfirmasi publish
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-dark fs-7 mb-0">Apakah anda yakin untuk mempublish ini?</p>
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

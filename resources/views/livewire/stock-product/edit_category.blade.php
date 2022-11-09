<!-- Modal -->
<div class="modal fade" id="edit_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Kemaskini Kategori</h5>
                <button type="button" class="btn btn-sm btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="row mb-4">
                                    <label for="cat_code" class="col-sm-5 col-form-label">Nama Kategori</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="modal_cat_name"
                                               name="modal_cat_name"
                                               wire:model.lazy="modal_cat_name">
                                        @error('modal_cat_name') <span
                                            class="text-danger font-weight-bold error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cat_code" class="col-sm-4 col-form-label">Kategori Status</label>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="modal_cat_status"
                                               id="ACTIVE" wire:model.lazy="modal_cat_status" value="1">
                                        <label class="form-check-label" for="ACTIVE">
                                            AKTIF
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="modal_cat_status"
                                               id="INACTIVE" wire:model.lazy="modal_cat_status" value="0">
                                        <label class="form-check-label" for="INACTIVE">
                                            TIDAK AKTIF
                                        </label>
                                    </div>
                                </div>
                                @error('modal_cat_status') <span
                                    class="text-danger font-weight-bold error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" wire:click="update_category()">KEMASKINI</button>
            </div>
        </div>
    </div>
</div>

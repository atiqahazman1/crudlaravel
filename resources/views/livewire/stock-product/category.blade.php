<div>
    @include('livewire.stock-product.edit_category')
    <div class="card">
        <div class="col-12">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-lg-center">
                        <b>Paparan Tambah Kategori</b>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <div class="row mb-3">
                            <label for="cat_name" class="col-sm-4 col-form-label">Nama Kategori</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="cat_name" name="cat_name"
                                       wire:model="cat_name" {{ $readonly }}>
                                @error('cat_name') <span
                                    class="text-danger font-weight-bold error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cat_code" class="col-sm-4 col-form-label">Status Kategori</label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cat_status"
                                           id="ACTIVE" wire:model="cat_status" value="1" {{ $disabled }}>
                                    <label class="form-check-label" for="ACTIVE">
                                        AKTIF
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cat_status"
                                           id="INACTIVE" wire:model="cat_status" value="0" {{ $disabled }}>
                                    <label class="form-check-label" for="INACTIVE">
                                        TIDAK AKTIF
                                    </label>
                                </div>
                            </div>
                            @error('cat_status') <span
                                class="text-danger font-weight-bold error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <div class="col-md-12 text-sm-center">
                    <button type="button" class="btn btn-secondary" wire:click="resetInput()">
                        SET SEMULA
                    </button>
                    @if($show_button)
                        <button type="button" class="btn btn-primary" wire:click="confirmSimpan()">
                            TAMBAH
                        </button>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <table class="table table-bordered table-hover table-responsive-sm text-nowrap">
                        <thead style="background-color: #C0C0C0;">
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Status Kategori</th>
                            <th>Tindakan</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                        <div class="col-4">
                            <input type="text" class="form-control" id="search" name="search"
                                   wire:model="search" placeholder="--Carian--">
                        </div> </br>
                        @foreach($categories as $category)
                            @if($categories->count() > 0)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        @if($category->category_status)
                                            <span class="badge bg-success">AKTIF</span>
                                        @else
                                            <span class="badge bg-danger">TIDAK AKTIF</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a type="button" wire:click="view_category('{{ $category->id }}')">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a type="button" wire:click="edit_category('{{ $category->id }}')">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <a type="button" wire:click="delete_category('{{ $category->id }}')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="5" style="text-align: center">NO DATA</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    {!! $categories->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        window.addEventListener('swal.category', event => {
            swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                @this.call(event.detail.function, event.detail.id);
                } else {
                @this.call('alertCancel');
                }
            });
        });
        window.addEventListener('swal:modal_category', event => {
            Swal.fire({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
            });
        });
        window.addEventListener('open_modal', event => {
            $('#edit_category_modal').modal({
                backdrop: 'static',
            });
        });
        window.addEventListener('close_modal', event => {
            $('#edit_category_modal').modal('hide');
        });
    });
</script>

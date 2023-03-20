{{-- modal --}}
<div class="modal modal-blur fade" wire:ignore.self id="showModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='save'>
                <div class="modal-body">
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <label class="form-label required">Nama Materi</label>
                            <input type="text" wire:model="name" class="form-control"
                                placeholder="Tuliskan nama materi">
                            @error('name')
                                <small class="error text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" id="closeModal" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- modal --}}

{{-- edit password --}}
<div class="modal modal-blur fade" wire:ignore.self id="editData" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='update'>
                <div class="modal-body">
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <label class="form-label required">Nama Materi</label>
                            <input type="text" wire:model="name" class="form-control"
                                placeholder="Tuliskan nama materi">
                            @error('name')
                                <small class="error text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" id="closeModal" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit password --}}
{{-- delete password --}}
<div wire:ignore.self class="modal modal-blur fade" id="delete" tabindex="-1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 9v2m0 4v.01"></path>
                    <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75">
                    </path>
                </svg>
                <h3>Apa anda yakin?</h3>
                <div class="text-muted">Akun <i><b>{{ $name }}</b></i> akan di hapus secara permanen
                </div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Batalkan
                            </a></div>
                        <div class="col"><a href="#" wire:click.prevent="confirmDelete"
                                class="btn btn-danger w-100" data-bs-dismiss="modal">
                                Lakukan
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- delete password --}}
<script>
    $(window).on('hidden.bs.modal', function() {
        Livewire.emit('resetForms');
    });

    window.addEventListener('hideModal', function(e) {
        $('#showModal').modal('hide')
        $('#closeModal').modal('hide')
        $('#editData').modal('hide')
        $('#delete').modal('hide')
    })
</script>

@section('titlePage', 'Materi')
<div>
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal">
                            Tambah Data
                        </a>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <div class="text-muted">
                                Total
                                <div class="mx-2 d-inline-block">
                                    <input type="number" wire:model='paginate' class="form-control form-control-sm"
                                        value="8" size="3">
                                </div>
                                Data
                            </div>
                            <div class="ms-auto text-muted">
                                Cari Data:
                                <div class="ms-2 d-inline-block">
                                    <input type="search" wire:model="find" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                            aria-label="Select all invoices"></th>
                                    <th class="w-1">No.</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $item)
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                aria-label="Select invoice"></td>
                                        <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            {{ $item->slug }}
                                        </td>
                                        <td>
                                            <div class="btn-list">
                                                <a href="{{ route('section', $item->id) }}" class="btn w-20 btn-icon"
                                                    title="Tambah Sub Materi {{ $item->name }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-circle-plus" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                        </path>
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                        <path d="M9 12l6 0"></path>
                                                        <path d="M12 9l0 6"></path>
                                                    </svg>
                                                </a>
                                                <a wire:click="edit({{ json_encode(encrypt($item->id)) }})"
                                                    href="#" data-bs-toggle="modal" data-bs-target="#editData"
                                                    class="btn w-20 btn-icon"
                                                    title="Ubah Sub Materi {{ $item->name }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-edit-circle" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                        </path>
                                                        <path
                                                            d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z">
                                                        </path>
                                                        <path d="M16 5l3 3"></path>
                                                        <path d="M9 7.07a7 7 0 0 0 1 13.93a7 7 0 0 0 6.929 -6">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <a wire:click="delete({{ json_encode(encrypt($item->id)) }})"
                                                    href="#" data-bs-toggle="modal" data-bs-target="#delete"
                                                    class="btn w-20 btn-icon" title="Hapus materi {{ $item->name }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-trash" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                        </path>
                                                        <path d="M4 7l16 0"></path>
                                                        <path d="M10 11l0 6"></path>
                                                        <path d="M14 11l0 6"></path>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                        </path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $courses->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.pages.app.operator.scripts.materi')
</div>

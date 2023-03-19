@section('titlePage', 'Tenaga Pendidik')
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
                                    <input type="text" wire:model='paginate' class="form-control form-control-sm"
                                        value="8" size="3">
                                </div>
                                Data
                            </div>
                            <div class="ms-auto text-muted">
                                Search:
                                <div class="ms-2 d-inline-block">
                                    <input type="text" wire:model="findTendik" class="form-control form-control-sm"
                                        aria-label="Search invoice">
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
                                    <th class="w-1">No.
                                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M6 15l6 -6l6 6"></path>
                                        </svg>
                                    </th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Password Sementara</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rolesTeachers as $item)
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                aria-label="Select invoice"></td>
                                        <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                                        <td><a href="invoice.html" class="text-reset"
                                                tabindex="-1">{{ $item->name }}</a>
                                        </td>
                                        <td>
                                            {{ $item->email }}
                                        </td>
                                        <td>
                                            12345678
                                        </td>
                                        <td>
                                            <div class="btn-list">
                                                @if ($item->id === 2)
                                                    <span class="text-danger">Tidak dapat menghapus data ini!</span>
                                                @else
                                                    <a wire:click="resetPassword({{ json_encode(encrypt($item->id)) }})"
                                                        href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modal-danger" class="btn w-20 btn-icon"
                                                        title="Setel kata sandi {{ $item->email }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-key" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path
                                                                d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z">
                                                            </path>
                                                            <path d="M15 9h.01"></path>
                                                        </svg>
                                                    </a>
                                                    <a wire:click="deleteAccount({{ json_encode(encrypt($item->id)) }})"
                                                        href="#" data-bs-toggle="modal"
                                                        data-bs-target="#confirmAccount" class="btn w-20 btn-icon"
                                                        title="Hapus akun {{ $item->email }}">
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
                                                @endif
                                                {{-- <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                        data-bs-toggle="dropdown">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">
                                                            Action
                                                        </a>
                                                        <a class="dropdown-item" href="#">
                                                            Another action
                                                        </a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.pages.app.operator.scripts.tenaga-didik')
</div>

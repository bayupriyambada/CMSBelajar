<div>

    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <span class="status-indicator status-green status-indicator-animated">
                <span class="status-indicator-circle"></span>
                <span class="status-indicator-circle"></span>
                <span class="status-indicator-circle"></span>
            </span>
        </div>
        <div class="col">
            <h2 class="page-title">
                Monitoring Sistem CMS
            </h2>
            <div class="text-muted">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><span class="text-green">Berjalan</span></li>
                    <li class="list-inline-item">Aktif Per 3 Menit</li>
                </ul>
            </div>
        </div>
        <div class="col-md-auto ms-auto d-print-none">
            <div class="btn-list">
                <a href="#" wire:click="monitoring()" class="btn btn-primary">
                    <!-- Download SVG icon from http://tabler-icons.io/i/player-pause -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M6 5m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v12a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z">
                        </path>
                        <path d="M14 5m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v12a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z">
                        </path>
                    </svg>
                    Atur Monitoring
                </a>
            </div>
        </div>
        <div class="row row-cards">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="subheader">Total Pengguna Aktif</div>
                        <div class="h3 m-0">{{ $userActive }} pengguna</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="subheader">Total Pengguna Tidak Aktif</div>
                        <div class="h3 m-0">{{ $userNoActive }} pengguna</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="subheader">Total Keseluruhan</div>
                        <div class="h3 m-0">{{ $allUser }} pengguna</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4" wire:poll.180000ms>
        <div class="card">
            <div class="card-table table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Riwayat Aktif</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userMonitoring as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->roles }}</td>
                                <td>
                                    @if ($user->last_login)
                                        <span class="text-danger">{{ $user->last_login->diffForHumans() }}</span>
                                    @elseif ($user->is_online === 1)
                                        <span class="text-green"><b>Sedang Aktif</b></span>
                                    @else
                                        <span class="text-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

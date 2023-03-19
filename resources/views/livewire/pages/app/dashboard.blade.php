@section('titlePage', 'Dashboard')
<div>
    <div class="page-header d-print-none">
        <div class="container">
            @if (auth()->user()->roles === 'operator')
                @livewire('pages.app.operator.dashboard')
            @elseif (auth()->user()->roles === 'teacher')
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Role</th>
                                        <th>Terakhir Login</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Today</td>
                                        <td>98.9533%</td>
                                        <td>1 minute</td>
                                        <td>1</td>
                                        <td>1 minute</td>
                                        <td>1 minute</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Time period</th>
                                        <th>Availability</th>
                                        <th>Downtime</th>
                                        <th>Incidents</th>
                                        <th>Longest incident</th>
                                        <th>Avg. incident</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Today</td>
                                        <td>98.9533%</td>
                                        <td>1 minute</td>
                                        <td>1</td>
                                        <td>1 minute</td>
                                        <td>1 minute</td>
                                    </tr>
                                    <tr>
                                        <td>Last 7 days</td>
                                        <td>98.9533%</td>
                                        <td>1 minute</td>
                                        <td>1</td>
                                        <td>1 minute</td>
                                        <td>1 minute</td>
                                    </tr>
                                    <tr>
                                        <td>Last 30 days</td>
                                        <td>98.9533%</td>
                                        <td>1 minute</td>
                                        <td>1</td>
                                        <td>1 minute</td>
                                        <td>1 minute</td>
                                    </tr>
                                    <tr>
                                        <td>Last 365 days</td>
                                        <td>98.9533%</td>
                                        <td>1 minute</td>
                                        <td>1</td>
                                        <td>1 minute</td>
                                        <td>1 minute</td>
                                    </tr>
                                    <tr>
                                        <td>All time</td>
                                        <td>98.9533%</td>
                                        <td>1 minute</td>
                                        <td>1</td>
                                        <td>1 minute</td>
                                        <td>1 minute</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

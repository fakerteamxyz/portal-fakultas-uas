@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\User::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Informasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Informasi::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Agenda</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Agenda::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pie Chart Card -->
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik User Berdasarkan Role</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2 d-flex justify-content-center">
                        <div style="width:300px;max-width:100%;">
                            <canvas id="userRolePieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('userRolePieChart').getContext('2d');
            var userRolePieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Admin', 'Dosen', 'Staff', 'Mahasiswa'],
                    datasets: [{
                        data: [
                            {{ \App\Models\User::where('role','admin')->count() }},
                            {{ \App\Models\User::where('role','dosen')->count() }},
                            {{ \App\Models\User::where('role','staff')->count() }},
                            {{ \App\Models\User::where('role','mahasiswa')->count() }}
                        ],
                        backgroundColor: [
                            '#4e73df', '#1cc88a', '#f6c23e', '#36b9cc'
                        ],
                        hoverBackgroundColor: [
                            '#2e59d9', '#17a673', '#dda20a', '#2c9faf'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        });
    </script>
@endsection

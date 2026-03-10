@extends('layout.dashboard_template')
@section('dashboard-content')

@if(Auth::user()->role === 'guru')
<!-- Dashboard Guru -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bolder">Selamat Datang, {{Auth::user()->nama}}</h4>
            <p class="mb-4">Kelola penilaian siswa PAUD dengan mudah</p>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">school</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Siswa</p>
                        <h4 class="mb-0">{{$total_siswa}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">assignment_turned_in</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Nilai Diberikan</p>
                        <h4 class="mb-0">{{$total_nilai_diberikan}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">pending_actions</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Belum Dinilai</p>
                        <h4 class="mb-0">{{$siswa_belum_dinilai}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">category</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Aspek Penilaian</p>
                        <h4 class="mb-0">{{$total_aspek}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{url('dashboard/nilai')}}" class="btn btn-primary w-100">
                                <i class="material-icons me-2">grade</i>
                                Input Nilai
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{url('dashboard/aspek')}}" class="btn btn-info w-100">
                                <i class="material-icons me-2">category</i>
                                Kelola Aspek
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{url('dashboard/poin-penilaian')}}" class="btn btn-success w-100">
                                <i class="material-icons me-2">checklist</i>
                                Poin Penilaian
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{url('dashboard/profile/'.Auth::user()->id)}}" class="btn btn-secondary w-100">
                                <i class="material-icons me-2">person</i>
                                Profil Saya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Aktivitas Penilaian Terbaru</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @if(count($recent_grades) > 0)
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">Siswa</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aspek</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_grades as $grade)
                                <tr>
                                    <td class="ps-4">
                                        <span class="text-xs font-weight-bold">{{$grade->nama}}</span>
                                    </td>
                                    <td>
                                        <span class="text-xs">{{$grade->nama_aspek}}</span>
                                    </td>
                                    <td>
                                        @php
                                            $badges = [
                                                'mb' => ['text' => 'MB', 'color' => 'warning'],
                                                'bsh' => ['text' => 'BSH', 'color' => 'info'],
                                                'bsb' => ['text' => 'BSB', 'color' => 'success']
                                            ];
                                            $badge = $badges[$grade->nilai] ?? ['text' => '-', 'color' => 'secondary'];
                                        @endphp
                                        <span class="badge badge-sm bg-gradient-{{$badge['color']}}">{{$badge['text']}}</span>
                                    </td>
                                    <td>
                                        <span class="text-xs">{{$grade->created_at->diffForHumans()}}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <p class="text-muted">Belum ada aktivitas penilaian</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->role === 'admin')
<!-- Dashboard Admin -->
<div class="row">
    <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Siswa</p>
                    <h4 class="mb-0">{{$total_siswa}}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-secondary shadow-secondary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Guru</p>
                    <h4 class="mb-0">{{$total_guru}}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Kelas A</p>
                    <h4 class="mb-0">{{$kelas_a}}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Kelas B</p>
                    <h4 class="mb-0">{{$kelas_b}}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Aspek</p>
                    <h4 class="mb-0">{{$total_aspek}}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->role === 'siswa')
<!-- Dashboard Siswa -->
<div class="card my-5">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Perkembangan Siswa</h6>
        </div>
    </div>
    <div class="card-body px-4 pb-2">
        <a target="_blank" href="dashboard/print/{{Auth::user()->id}}" class="btn btn-outline-info">
            <i class="fa-solid fa-print"></i>
            Print
        </a>
        <div class="table-responsive p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Semester</th>
                            <th scope="col">Tahun Ajaran</th>
                            <th scope="col">Aspek</th>
                            <th scope="col">Poin Penilaian</th>
                            <th scope="col">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($nilai) > 0)
                        @foreach($nilai as $item)
                        <tr>
                            <td>{{$item->semester}}</td>
                            <td>{{$item->awal_ajaran}}/{{$item->akhir_ajaran}}</td>
                            <td>{{$item->nama_aspek}}</td>
                            <td>{{$item->nama_poin}}</td>
                            <td>{{$item->nilai === "mb" ? 'Mulai Berkembang' : ($item->nilai === 'bsh' ? 'Berkembang Sesuai Harapan' : ($item->nilai === 'bsb' ? 'Berkembang Sangat Baik' : '-'))}}
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                {{$nilai->links()}}
            </div>
        </div>
    </div>
</div>
@endif

@endsection
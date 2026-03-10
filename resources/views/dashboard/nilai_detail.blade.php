@extends('layout.dashboard_template')
@section('dashboard-content')

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-dark" href="{{ url('dashboard/nilai') }}">Nilai</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Detail Siswa</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Penilaian Siswa</h6>
            </nav>
        </div>
    </div>

    <!-- Student Profile Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative">
                                <div class="avatar avatar-xl bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fas fa-user text-white text-lg"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mb-1">{{ $siswa->nama }}</h5>
                                    <p class="text-sm mb-1"><strong>NISN:</strong> {{ $siswa->nisn ?? 'Belum ada' }}</p>
                                    <p class="text-sm mb-0"><strong>Kelas:</strong> {{ $siswa->kelas ?? 'Belum ditentukan' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-sm mb-1"><strong>TTL:</strong> {{ $siswa->tempat_lahir ?? '-' }}, {{ $siswa->tanggal_lahir ? date('d M Y', strtotime($siswa->tanggal_lahir)) : '-' }}</p>
                                    <p class="text-sm mb-1"><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin ? ($siswa->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan') : '-' }}</p>
                                    <p class="text-sm mb-0"><strong>Agama:</strong> {{ $siswa->agama ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah_data">
                                <i class="fas fa-plus me-2"></i>Tambah Nilai
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grades Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header pb-0">
                    <h6>Riwayat Penilaian</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @if(count($nilai) > 0)
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">Periode</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aspek Penilaian</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Indikator</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nilai</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Catatan</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nilai as $item)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Semester {{$item->semester}}</h6>
                                            <p class="text-xs text-secondary mb-0">{{$item->awal_ajaran}}/{{$item->akhir_ajaran}}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->nama_aspek}}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$item->nama_poin}}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        @php
                                            $badges = [
                                                'mb' => ['text' => 'MB', 'color' => 'warning', 'full' => 'Mulai Berkembang'],
                                                'bsh' => ['text' => 'BSH', 'color' => 'info', 'full' => 'Berkembang Sesuai Harapan'],
                                                'bsb' => ['text' => 'BSB', 'color' => 'success', 'full' => 'Berkembang Sangat Baik']
                                            ];
                                            $badge = $badges[$item->nilai] ?? ['text' => '-', 'color' => 'secondary', 'full' => '-'];
                                        @endphp
                                        <span class="badge badge-sm bg-gradient-{{$badge['color']}}" title="{{$badge['full']}}">{{$badge['text']}}</span>
                                    </td>
                                    <td>
                                        <p class="text-xs mb-0">{{$item->catatan ? Str::limit($item->catatan, 50) : '-'}}</p>
                                    </td>
                                    <td class="align-middle">
                                        <form action="{{url('dashboard/nilai/'.$item->user_id.'/'.$item->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0" onclick="return confirm('Hapus nilai ini?')" title="Hapus">
                                                <i class="far fa-trash-alt me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg mb-3 mx-auto">
                            <i class="fas fa-chart-bar opacity-10"></i>
                        </div>
                        <h5>Belum Ada Penilaian</h5>
                        <p class="text-sm text-muted mb-4">Mulai tambahkan penilaian untuk siswa ini</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah_data">
                            <i class="fas fa-plus me-2"></i>Tambah Nilai Pertama
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambah_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_data">Perkembangan Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('dashboard/nilai/'.request()->route('user_id'))}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group input-group-static mb-4">
                                <label for="semester" class="ms-0">Semester</label>
                                <input min="1" type="number" name="semester" id="semester" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-static mb-4">
                                <label for="awal_ajaran" class="ms-0">Awal Ajaran (tahun)</label>
                                <input min="1900" max="2099" step="1" type="number" name="awal_ajaran" id="awal_ajaran"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-static mb-4">
                                <label for="akhir_ajaran" class="ms-0">Akhir Ajaran (tahun)</label>
                                <input min="1900" max="2099" step="1" type="number" name="akhir_ajaran"
                                    id="akhir_ajaran" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group input-group-static mb-4">
                                <label for="poin" class="ms-0">Poin Aspek Penilaian</label>
                                <select name="poin_id" class="form-control" id="poin" required>
                                    <option value="">Pilih poin aspek yang akan dinilai</option>
                                    @if(count($poins) > 0)
                                    @foreach($poins as $poin)
                                    <option value="{{$poin->id}}">
                                        ({{$poin->nama_aspek}}) {{$poin->nama_poin}}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group input-group-static mb-4">
                                <label for="nilai" class="ms-0">Nilai</label>
                                <select name="nilai" class="form-control" id="nilai" required>
                                    <option value="">Pilih nilai</option>
                                    <option value="mb">MB(Mulai Berkembang)</option>
                                    <option value="bsh">BSH(Berkembang Sesuai Harapan)</option>
                                    <option value="bsb">BSB(Berkembang Sangat Baik)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group input-group-static mb-4">
                                <label for="catatan" class="ms-0">Catatan (Opsional)</label>
                                <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan perkembangan siswa..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
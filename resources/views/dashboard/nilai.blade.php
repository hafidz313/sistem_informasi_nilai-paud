@extends('layout.dashboard_template')
@section('dashboard-content')
<div class="card my-5">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-white text-capitalize ps-3 mb-0">Daftar Siswa PAUD Teratai</h6>
                <button type="button" class="btn btn-light btn-sm me-3" data-bs-toggle="modal" data-bs-target="#tambahNilaiModal">
                    + Tambah Nilai
                </button>
            </div>
        </div>
    </div>
    <div class="card-body px-2 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center justify-content-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder">Nama Lengkap
                        </th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">NISN</th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Tempat Lahir
                        </th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Tanggal
                            Lahir</th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Jenis
                            Kelamin</th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Agama</th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Kelas</th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Alamat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($all_siswa) > 0)
                    @foreach($all_siswa as $user)
                    <tr>
                        <!-- <td>
                            <div class="d-flex px-2">
                                <div>
                                    <img src="{{ asset('storage/images/'.$user->poto) }}"
                                        class="avatar avatar-sm rounded-circle me-2" alt="profile-user">
                                </div>
                                <div class="my-auto">
                                    <h6 class="mb-0 text-sm">{{ $user->nama }}</h6>
                                </div>
                            </div>
                        </td> -->
                        <td>
                            <span class="text-xs font-weight-bold">{{ $user->nama}}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $user->nisn ? $user->nisn : '-' }}</span>
                        </td>
                        <td>
                            <span
                                class="text-xs font-weight-bold">{{ $user->tempat_lahir ? $user->tempat_lahir : '-' }}</span>
                        </td>
                        <td>
                            <span
                                class="text-xs font-weight-bold">{{ $user->tanggal_lahir ? $user->tanggal_lahir : '-' }}</span>
                        </td>
                        <td>
                            <span
                                class="text-xs font-weight-bold">{{ $user->jenis_kelamin ? strtoupper($user->jenis_kelamin) : '-' }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $user->agama ? $user->agama : '-' }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $user->kelas ? $user->kelas : '-' }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $user->alamat ? $user->alamat : '-' }}</span>
                        </td>
                        <td class="align-middle d-flex">
                            @if(Auth::user()->role === 'guru')
                            <a href="{{ url('dashboard/nilai/'.$user->id) }}" class="btn btn-link text-primary mb-0">
                                Lihat Nilai
                            </a>
                            <button type="button" class="btn btn-link text-success mb-0" onclick="setUserId({{$user->id}}, '{{$user->nama}}')" data-bs-toggle="modal" data-bs-target="#tambahNilaiModal">
                                + Nilai
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Nilai -->
<div class="modal fade" id="tambahNilaiModal" tabindex="-1" aria-labelledby="tambahNilaiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahNilaiLabel">Tambah Nilai Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTambahNilai" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Siswa</label>
                        <select id="selectSiswa" class="form-control" onchange="setSiswaData()" required>
                            <option value="">Cari dan pilih siswa...</option>
                            @foreach($all_siswa as $siswa)
                            <option value="{{$siswa->id}}" 
                                data-nama="{{$siswa->nama}}"
                                data-semester="{{$siswa->last_semester}}"
                                data-awal="{{$siswa->last_awal}}"
                                data-akhir="{{$siswa->last_akhir}}">
                                {{$siswa->nama}} - {{$siswa->nisn ?? 'No NISN'}} - Kelas {{$siswa->kelas ?? '-'}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Semester</label>
                                <input type="number" id="inputSemester" name="semester" class="form-control" min="1" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Awal Ajaran</label>
                                <input type="number" id="inputAwal" name="awal_ajaran" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Akhir Ajaran</label>
                        <input type="number" id="inputAkhir" name="akhir_ajaran" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Poin Aspek</label>
                        <select name="poin_id" class="form-control" required>
                            <option value="">Pilih Poin Aspek</option>
                            @php
                                $poins = App\Models\PoinAspek::join('aspek', 'aspek.id', '=', 'poin_aspek.aspek_id')
                                    ->select('poin_aspek.*', 'aspek.nama_aspek')
                                    ->get();
                            @endphp
                            @foreach($poins as $poin)
                            <option value="{{$poin->id}}">({{$poin->nama_aspek}}) {{$poin->nama_poin}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nilai</label>
                        <select name="nilai" class="form-control" required>
                            <option value="">Pilih Nilai</option>
                            <option value="mb">MB (Mulai Berkembang)</option>
                            <option value="bsh">BSH (Berkembang Sesuai Harapan)</option>
                            <option value="bsb">BSB (Berkembang Sangat Baik)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan perkembangan siswa..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function setUserId(userId, namaSiswa) {
    document.getElementById('formTambahNilai').action = '/dashboard/nilai/' + userId;
    document.getElementById('selectSiswa').value = userId;
    setSiswaData();
}

function setSiswaData() {
    const select = document.getElementById('selectSiswa');
    const selectedOption = select.options[select.selectedIndex];
    
    if (selectedOption.value) {
        document.getElementById('formTambahNilai').action = '/dashboard/nilai/' + selectedOption.value;
        document.getElementById('inputSemester').value = selectedOption.dataset.semester;
        document.getElementById('inputAwal').value = selectedOption.dataset.awal;
        document.getElementById('inputAkhir').value = selectedOption.dataset.akhir;
    } else {
        document.getElementById('formTambahNilai').action = '';
        document.getElementById('inputSemester').value = '';
        document.getElementById('inputAwal').value = '';
        document.getElementById('inputAkhir').value = '';
    }
}

// Make select searchable
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('selectSiswa');
    select.addEventListener('keyup', function(e) {
        const filter = e.target.value.toLowerCase();
        const options = select.options;
        
        for (let i = 1; i < options.length; i++) {
            const option = options[i];
            const text = option.text.toLowerCase();
            option.style.display = text.includes(filter) ? '' : 'none';
        }
    });
});
</script>
@endsection
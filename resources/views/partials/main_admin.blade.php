<div class="card">
    <div class="card-header">
        Form Absen
    </div>
    <br />
    <div class="row">
        <div class="col text-center">
            <h4>Selamat Datang </h4>
            <div class="digital_clock_wrapper">
                <div id="digit_clock_time"></div>
                <div id="digit_clock_date"></div>
            </div>
        </div>
    </div>
    <form id="form-absen" action="/check-in" method="post" data-route="" enctype="multipart/form-data">
       {{csrf_field()}}
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Id Asisten </label>
                <input value="{{ $user->id }}" name="id_asisten" class="form-control mb-2 input-credit-card" type="text" readonly />
            </div>
            <div class="form-group">
                <label class="form-label">Kelas </label>
                @php 
                @endphp
                @if($kelas_value != '')
                    <input value="{{ $kelas_value }}" name="kelas" class="form-control mb-2 input-credit-card" type="text" readonly />
                @else
                    <select name="kelas" class="form-control">
                        <option disabled selected>Silahkan Dipilih</option>
                        @foreach($kelas as $kl)
                            <option value="{{ $kl->nama_kelas }}">{{ $kl->nama_kelas }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label">Materi </label>
                @if($materi_value != '')
                <input value="{{ $materi_value }}" name="materi" class="form-control mb-2 input-credit-card" type="text" readonly />
                @else
                    <select name="materi" class="form-control">
                        <option disabled selected>Silahkan Dipilih</option>
                        @foreach($materi as $mt)
                            <option value="{{ $mt->materi }}">{{ $mt->materi }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label">Peran Jaga </label>
                <select name="teaching_role" class="form-control">
                    <option disabled selected>Silahkan Dipilih</option>
                    <option value="Asisten Baris">Asisten Baris</option>
                    <option value="Ketua">Ketua</option>
                    <option value="Tutor">Tutor</option>
                </select>
            </div>
            <div class="form-group">
              <label class="form-label">Kode Absen </label>
              <input name="token" class="form-control mb-2 input-credit-card" type="text" placeholder="Ex: 87ADsds0"/>
              <a>*Silahkan minta PJ atau Staff untuk kode absennya</a>
          </div>
          <div class="row">
            @if($absen->start == null)
           <div class="col text-center">
                <button type="submit" class="btn btn-info">Absen</button>
            </div>
            @endif
        </div>
        </div>
    </form>
    @if($absen->start != null)
        <form id="form-update-absen" action="/check-out" method="post" data-route="" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="card-body">
        <div class="row">
                <div class="col text-center">
                <button type="submit" class="btn btn-warning">Clock Out</button>
                </div>
            </div>
            </div>
        </form>
    @endif
</div>
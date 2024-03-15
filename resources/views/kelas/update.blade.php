@extends('template.main')

@section('container')
    <div class="row">
        <div class="col">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                  <main class="form-registration">
                    <h1 class="h3 mb-3 fw-normal text-center">Kelas Registration Form</h1>
                    <form action="/add-kelas" method="post"> 
                      @csrf
                      <input type="hidden" name="id" id="id" value="{{ $kelas->id }}">
                      <div class="form-floating">
                        <input type="text" name="nama_kelas" class="form-control rounded-top @error('name_kelas') is-invalid @enderror" id="nama_kelas" placeholder="Nama Kelas" required value="{{ $kelas->nama_kelas }}">
                        <label for="name">Nama Kelas</label>
                        @error('nama_kelas')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="form-floating">
                        <input type="text" name="tingkat" class="form-control @error('tingkat') is-invalid @enderror" id="tingkat" placeholder="1...10" required value="{{ $kelas->tingkat }}">
                        <label for="tingkat">Tingkat</label>
                        @error('tingkat')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="form-floating">
                        <input type="text" name="fakultas" class="form-control rounded-bottom @error('fakultas') is-invalid @enderror" id="fakultas" placeholder="Fakultas" required value="{{ $kelas->fakultas }}">
                        <label for="fakultas">Fakultas</label>
                        @error('fakultas')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="form-floating">
                        <input type="text" name="jurusan" class="form-control rounded-bottom @error('jurusan') is-invalid @enderror" id="jurusan" placeholder="Jurusan" required value="{{ $kelas->jurusan }}">
                        <label for="jurusan">Jurusan</label>
                        @error('jurusan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                  
                      <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Add</button>
                    </form>
                  </main>
                </div>
              </div>
        </div>
    </div>
@endsection
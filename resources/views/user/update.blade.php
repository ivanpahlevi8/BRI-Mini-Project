@extends('template.main')

@section('container')
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center">Update User Form</h1>
            <form action="/update-user" method="post" enctype="multipart/form-data"> 
              @csrf
              <input type="hidden" name="id" id="id" value="{{ $userData->id }}">
              <div class="form-floating">
                <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Nama" required value="{{ $userData->name }}">
                <label for="name">Nama</label>
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="...@..com" required value="{{ $userData['email'] }}">
                <label for="email">Email</label>
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-floating">
                <input type="text" name="role" class="form-control rounded-bottom @error('role') is-invalid @enderror" id="role" placeholder="Admin|PJ|Asisten" required value="{{ $userData['role'] }}">
                <label for="fakultas">Role</label>
                @error('role')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <input type="file" name="image" class="form-control">
                <label for="jurusan">User Image</label>
              </div>

              <div class="form-floating">
                <input type="text" name="id_assisten" class="form-control rounded-bottom @error('id_assisten') is-invalid @enderror" id="id_assisten" placeholder="ID Asisten" required value="{{ $userData['id_assisten'] }}">
                <label for="jurusan">ID Asissten</label>
                @error('id_assisten')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
          
              <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Update</button>
            </form>
          </main>
        </div>
      </div>
@endsection
@extends('template.main')

@section('container')
<div class="row justify-content-center">
  <div class="col-lg-5">
    <main class="form-registration">
      <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
      <form action="/add-user" method="post" enctype="multipart/form-data"> 
        @csrf
        <div class="form-floating">
          <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Nama" required value="{{ old('name') }}">
          <label for="name">Nama</label>
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-floating">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="...@..com" required value="{{ old('email') }}">
          <label for="email">Email</label>
          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-floating">
          <input type="text" name="role" class="form-control rounded-bottom @error('role') is-invalid @enderror" id="role" placeholder="Admin|PJ|Asisten" required value="{{ old('role') }}">
          <label for="fakultas">Role</label>
          @error('role')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-group">
          <input type="file" name="image" class="form-control">
        </div>

        <div class="form-floating">
          <input type="text" name="id_assisten" class="form-control rounded-bottom @error('id_assisten') is-invalid @enderror" id="id_assisten" placeholder="ID Asisten" required value="{{ old('id_assisten') }}">
          <label for="jurusan">ID Asissten</label>
          @error('id_assisten')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-floating">
          <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="" required>
          <label for="jurusan">Password</label>
          @error('password')
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
@endsection
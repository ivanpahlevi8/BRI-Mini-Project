@extends('template.main')

@section('container')
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center">Update User Form</h1>
            <form action="/add-materi" method="post"> 
              @csrf
              <div class="form-floating">
                <input type="text" name="materi" class="form-control rounded-top @error('materi') is-invalid @enderror" id="materi" placeholder="Materi" required value="{{ old('materi') }}">
                <label for="name">Materi</label>
                @error('materi')
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
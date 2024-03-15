<div class="card">
    <div class="card-header">
        Buat Kode Absen
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col text-center">
                <form action="/create-code" method="POST">
                    @csrf
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Close</button>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-danger">Generate Kode Absen</button>
                </form>
            </div>
        </div>
    </div>
</div>
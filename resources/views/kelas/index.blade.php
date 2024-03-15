@extends('template.main')

@section('container')
    <div class="row">
        <div class="col">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Close</button>
            </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Close</button>
                </div>
            @endif
            <div class="card mb-grid">
                <a type="button" class="btn btn-primary" href="/add-kelas">+ Kelas Baru</a>
                <div class="table-responsive-md">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-actions table-striped table-hover mb-0 dataTable no-footer" data-table="data-table" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                    <thead>
                                        <tr role="row">
                                            <th
                                                scope="col"
                                                class="sorting_asc"
                                                tabindex="0"
                                                aria-controls="DataTables_Table_0"
                                                rowspan="1"
                                                colspan="1"
                                                aria-sort="ascending"
                                                aria-label=": activate to sort column descending"
                                                style="width: 88px;">
                                                <label class="custom-control custom-checkbox m-0 p-0">
                                                    <input type="checkbox" class="custom-control-input table-select-all" />
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </th>
                                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 320px;">
                                                Jurusan
                                            </th>
                                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 320px;">
                                                Fakultas
                                            </th>
                                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending" style="width: 311px;">
                                                Tingkat
                                            </th>
                                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Username: activate to sort column ascending" style="width: 305px;">Nama Kelas</th>
                                            <th scope="col" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 107px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($kelas as $item)
                                        <tr role="row" class="odd">
                                            
                                            <th scope="row" class="sorting_1">
                                                <label class="custom-control custom-checkbox m-0 p-0">
                                                    <input type="checkbox" class="custom-control-input table-select-row" />
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </th>
                                            <td>{{$item->jurusan}}</td>
                                            <td>{{$item->fakultas}}</td>
                                            <td>{{$item->tingkat}}</td>
                                            <td>{{$item->nama_kelas}}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="/update-kelas/{{ $item->id }}">Edit</a>
                                                <a class="btn btn-sm btn-danger" href="/delete-kelas/{{ $item->id }}">Delete</a>
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
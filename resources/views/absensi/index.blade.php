@extends('template.main')

@section('container')
    <div class="row">
        <div class="col">
            <div class="card mb-grid">
                <a type="button" class="btn btn-primary" href="/print-absen">Print Excel</a>
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
                                                User Name
                                            </th>
                                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending" style="width: 320px;">
                                                Kelas
                                            </th>
                                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending" style="width: 311px;">
                                                Materi
                                            </th>
                                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending" style="width: 311px;">
                                                Assisten
                                            </th>
                                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending" style="width: 311px;">
                                                Role
                                            </th>
                                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending" style="width: 311px;">
                                                Date
                                            </th>
                                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending" style="width: 311px;">
                                                Start
                                            </th>
                                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending" style="width: 311px;">
                                                End
                                            </th>
                                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending" style="width: 311px;">
                                                Duration
                                            </th>
                                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending" style="width: 311px;">
                                                Code
                                            </th>
                                            <th scope="col" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 107px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($absensi as $item)
                                        <tr role="row" class="odd">
                                            
                                            <th scope="row" class="sorting_1">
                                                <label class="custom-control custom-checkbox m-0 p-0">
                                                    <input type="checkbox" class="custom-control-input table-select-row" />
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </th>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->nama_kelas}}</td>
                                            <td>{{$item->materi}}</td>
                                            <td>{{$item->id_asisten}}</td>
                                            <td>{{$item->teaching_role}}</td>
                                            <td>{{$item->date}}</td>
                                            <td>{{$item->start}}</td>
                                            <td>{{$item->end}}</td>
                                            <td>{{$item->duration}}</td>
                                            <td>{{$item->code}}</td>
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
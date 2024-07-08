@extends('layouts.guest')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-white border-0 shadow-sm">

                <div class="card-body">
                  
                    <h2>{{ __('Detil Karyawan') }}</h2>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <th>Photo</th>
                                    <td><img src="{{ asset($employee->photo) }}" width="100"></td>
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $employee->employee_id }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $employee->name }}</td>
                                </tr>
                                <tr>
                                    <th>Tgl. Masuk</th>
                                    <td>{{ date('d F Y', strtotime($employee->work_start_date)) }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $employee->gender }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>{{ $employee->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $employee->email }}</td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <td>{{ $employee->position->name }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $employee->status->name }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $employee->address }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection

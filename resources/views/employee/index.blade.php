@extends('layouts.guest')

@push('styles')
<style>
    .nowrap {
        white-space: nowrap;
    }
</style>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-white border-0 shadow-sm">
                <div class="card-header">
                    <div class="float-end">
                        <div class="row">
                            <div class="col">
                                <input type="search" name="search" id="search"
                                    style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;"
                                    placeholder="Cari...">
                            </div>
                            <div class="col nowrap">
                                <div id="daterange"
                                    style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; ">
                                    <i class="fas fa-calendar"></i>&nbsp;
                                    <span></span>
                                    <i class="fas fa-caret-down"></i>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-grid gap-2">
                                    <a href="javascript:void(0);" id="btnSearch" class="btn btn-primary rounded-0"><i class="fas fa-search"></i> Search</a>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    {{-- Create --}}
                    <a href="{{ route('employee.create') }}" class="btn btn-primary mb-4"><i class="fas fa-plus"></i> Tambah</a>
                    {{-- Tabel --}}
                    <div class="table-responsive">
                        <table id="userTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr class="nowrap">
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Tgl. Masuk</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>Status</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        var start_date = moment().subtract(1, 'month');

        var end_date = moment();

        $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));

        $('#daterange').daterangepicker({
            startDate : start_date,
            endDate : end_date,
            ranges: {
            'Hari ini': [moment(), moment()],
            'Hari ini sampai sekarang': [moment(), moment().add(1, 'days')],
            'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '7 Hari': [moment().subtract(6, 'days'), moment()],
            '30 Hari': [moment().subtract(29, 'days'), moment()],
            'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
            'Bulan ini sampai sekarang': [moment().startOf('month'), moment().endOf('month').add(1, 'days')],
            'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Tahun ini': [moment().startOf('year'), moment().endOf('year')],
            'Tahun kemarin': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
        },
        }, function(start_date, end_date){
            $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));

        
        });


        $('#btnSearch').on('click', function(){
            $('#userTable').DataTable().ajax.reload();
        });

        var table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            responsive: true,
            info: false,
            autoWidth: false,
            order: [[0, 'desc']],
            ajax: {
                url: "{{ route('employee.index') }}",
                data : function(data){
                    data.from_date = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    data.to_date = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    data.search = $('input[type="search"]').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'employee_id', name: 'employee_id' },
                { data: 'name', name: 'name' },
                { data: 'work_start_date', name: 'work_start_date' },
                { data: 'gender', name: 'gender' },
                { data: 'phone', name: 'phone' },
                { data: 'email', name: 'email' },
                { data: 'position.name', name: 'position.name' },
                { data: 'status.name', name: 'status.name' },
                { data: 'address', name: 'address' },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });

</script>
@endpush
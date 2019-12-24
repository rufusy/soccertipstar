@extends('layouts.backend.index')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active"><a href="#"><i class="fa fa-soccer-ball-o"></i>Supersingles</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                          
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="supersingle-table" class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>No</th>
                                    <th>Supersingle Name</th>
                                    <th>Match Day</th>
                                    <th>Game</th>
                                    <th>Odd Type</th>
                                    <th>Outcome</th>
                                    <th>Tag</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- append datatable -->
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
    </section>
    <!-- /.Main content -->
</div>

@endsection

@section('javascript')
<script type="text/javascript">

    let supersingleTable;
    $(document).ready(function(){
        supersingleTable = $('#supersingle-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('supersingles.index') }}",
            order: [[3, 'asc']], 
            columns: [
                {
                    data:'id', 
                    name:'id', 
                    'visible':false,
                    orderable: false,
                },
                {
                    data:'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                    orderable: false,
                    searchable: false
                },
                {
                    data:'supersingleName',
                    name:'supersingleName'
                },
                {
                    data:'match_date',
                    name:'match_date'
                },
                {
                    data:'game',
                    name:'game'
                },
                {
                    data:'odd_type',
                    name:'odd_type'
                },
                {
                    data:'outcome',
                    name:'outcome'
                },
                {
                    data:'tag',
                    name:'tag'
                },
                {
                    data:'action',
                    name:'action',
                    orderable: false,
                    searchable: false
                } 
            ]
        });
    });


    /* Delete super single */
    $('body').on('click', '.delete-from-supersingle', function () {
        var match_id = $(this).data('id');
        if(confirm("Remove from supersingles?")){
            $.ajax({
                type: "POST",
                url: "{{ route('supersingle.delete') }}",
                data: {match_id:match_id},
                success: function (data) {
                    supersingleTable.draw();
                    data.success ? toastr.success(data.success) : toastr.error(data.errors);
                },
                error: function (errors) {
                    console.log('Error:', errors);
                }
            });
        }
    });

</script>
@endsection




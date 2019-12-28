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
            <li class="active"><a href="#"><i class="fa fa-soccer-ball-o"></i>Maxstake</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                             <div class="col-md-2 col-sm-2 col-lg-2">
                                <button class="btn btn-danger btn-flat btn-block" id="delete-maxstake"><i class="fa fa-trash"></i> Maxstake</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="maxstake-table" class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>No</th>
                                    <th>Maxstake Name</th>
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

    let maxstakeTable;
    $(document).ready(function(){
        maxstakeTable = $('#maxstake-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('maxstake.index') }}",
            order: [[3, 'asc']], 
            'columnDefs': [
                {
                    'targets': 0,
                    'checkboxes': {
                    'selectRow': true
                    }
                }
            ],
            'select': {
                'style': 'multi'
            },
            rowGroup: {
                dataSrc: 'maxstakeName'
            },
            columns: [
                {
                    data:'id',
                    name:'id',
                },
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
                    data:'maxstakeName',
                    name:'maxstakeName'
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


    /* Delete single match from specific maxstake */
    $('body').on('click', '.delete-from-maxstake', function () {
        var match_id = $(this).data('id');
        if(confirm("Remove from maxstake?")){
            $.ajax({
                type: "POST",
                url: "{{ route('maxstake.delete') }}",
                data: {match_id:match_id},
                success: function (data) {
                    maxstakeTable.draw();
                    data.success ? toastr.success(data.success) : toastr.error(data.errors);
                },
                error: function (errors) {
                    console.log('Error:', errors);
                }
            });
        }
    });


    /* Delete selected matches from their respective maxstake */
    $('#delete-maxstake').click(function(){

        if(confirm("Remove matche(s) from maxstake?"))
        {
            var matches = [];
            var rows_selected = maxstakeTable.column(0).checkboxes.selected();
            // Iterate over all selected checkboxes
            $.each(rows_selected, function(index, rowId){
                matches.push(rowId);
            });
            $.ajax({
                type: "POST",
                url: "{{ route('maxstake.deleteSelected') }}",
                data: {matches:matches},
                success: function (data) {
                    maxstakeTable.draw();
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

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
            <li class="active"><a href="#"><i class="fa fa-soccer-ball-o"></i>Multibets</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-lg-1">
                                <button class="btn btn-danger btn-flat btn-block" id="delete-multibet"><i class="fa fa-trash"></i> Multibets</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="multibets-table" class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>No</th>
                                    <th>Multibet Name</th>
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

    let multibetsTable;
    $(document).ready(function(){
        multibetsTable = $('#multibets-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('multibets.index') }}",
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
                dataSrc: 'multibetName'
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
                    data:'multibetName',
                    name:'multibetName'
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


    /* Delete single match from specific multibet */
    $('body').on('click', '.delete-from-multibet', function () {
        var match_id = $(this).data('id');
        if(confirm("Remove from multibet?")){
            $.ajax({
                type: "POST",
                url: "{{ route('multibet.delete') }}",
                data: {match_id:match_id},
                success: function (data) {
                    multibetsTable.draw();
                    data.success ? toastr.success(data.success) : toastr.error(data.errors);
                },
                error: function (errors) {
                    console.log('Error:', errors);
                }
            });
        }
    });


    /* Delete selected matches from their respective multibets */
    $('#delete-multibet').click(function(){
        var url = "{{route('multibet.deleteSelected')}}";

        if(confirm("Remove matche(s) from multibets?"))
        {
            var matches = [];
            var rows_selected = multibetsTable.column(0).checkboxes.selected();
            // Iterate over all selected checkboxes
            $.each(rows_selected, function(index, rowId){
                matches.push(rowId);
            });
            $.ajax({
                type: "POST",
                url: "{{ route('multibet.deleteSelected') }}",
                data: {matches:matches},
                success: function (data) {
                    multibetsTable.draw();
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

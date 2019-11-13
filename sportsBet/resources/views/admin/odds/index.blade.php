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
            <li><a href="#"><i class="fa fa-bar-chart"></i>Matches</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-xs-2">
                                <a class="btn btn-primary btn-flat" href="javascript:void(0)" id="create-new-odd">Add Odds</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="odds-table" class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
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
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
                                                                                                         
        <div class="modal fade" id="odds-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="odds-modal-heading"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="register-box-body">
                            <form action="" method="post" id="odd-form" name="odd-form">

    	                        <div class="alert alert-danger" style="display:none"></div>

                                <input type="hidden" name="odd_id" id="odd_id">

                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                        id="name">
                                </div>

                                 <div class="form-group has-feedback">
                                    <input type="text" class="form-control" placeholder="Description" name="description"
                                        id="description">
                                </div>

                                <div class="row">
                                    <div class="col-xs-8"></div>
                                    <!-- /.col -->
                                    <div class="col-xs-4">
                                        <button type="submit" id="saveBtn" value="create"
                                            class="btn btn-primary btn-block btn-flat">Save changes</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                        <!-- /.form-box -->
                    </div>
                    <!-- /.register-box -->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
    <!-- /. Main content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        var oddsTable = $('#odds-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('odds.index') }}",
            columns: [
                {
                    data:'id', 
                    name:'id', 
                    'visible':false
                },
                {
                    data:'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                    orderable: false,
                    searchable: false
                },
                {
                    data:'name',
                    name:'name'
                },
                {
                    data:'description',
                    name:'description',
                    orderable: false,
                    searchable: false
                },
                {
                    data:'action',
                    name:'action',
                    orderable: false,
                    searchable: false
                } 
            ],
            order: [[0, 'desc']]
        }); 
    });

        /* Create odds */
        $('#create-new-odd').click(function() {
            $('#saveBtn').val("create-odd");
            $('#odd_id').val('');
            $('#odd-form').trigger("reset");
            $('#odds-modal-heading').html("Add New Odd");
            $('#odds-modal').modal('show');
            $('.alert-danger').html('');
            $('.alert-danger').hide();
        });

         /* Edit Odds */
        $('body').on('click', '.editOdd', function () {
            var odd_id = $(this).data('id');         
            $.ajax({
                data: {odd_id:odd_id},
                url: "{{route('odds.edit')}}",
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    $('#odds-modal-heading').html("Edit Odd");
                    $('#saveBtn').val("edit-odd");
                    $('#odds-modal').modal('show');
                    $('.alert-danger').html('');
                    $('.alert-danger').hide();
                    $('#odd_id').val(data.id);
                    $('#name').val(data.name); 
                    $('#description').val(data.description);   
                },
                error: function (data) {
                    $('#errorDiv').append(data);
                }
            });
        });

      
        /* Save/Update odds */
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#odd-form').serialize(),
                url: "{{route('odds.store')}}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if(data.errors)
                  	{
                  		$('.alert-danger').html('');
                  		$.each(data.errors, function(key, value){
                  			$('.alert-danger').show();
                  			$('.alert-danger').append('<li>'+value+'</li>');
                  		});
                  	}
                    else
                    {
                        $('#odds-form').trigger("reset");
                        $('#odds-modal').modal('hide');
                        $('#odds-table').DataTable().draw();
                        toastr.success(data.success);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }); 

        /* Delete odds */
        $('body').on('click', '.deleteOdd', function () {
            var odd_id = $(this).data('id');
            if(confirm("This record will be lost forever! Proceed?")){
                $.ajax({
                    type: "post",
                    url: "{{ route('odds.delete') }}",
                    data: {odd_id:odd_id},
                    success: function (data) {
                        $('#odds-table').DataTable().draw();
                        if(data.success)
                  	    {
                            toastr.success(data.success);
                        }
                        if(data.errors)
                        {
                            toastr.error(data.errors);
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });
        
</script>
@endsection
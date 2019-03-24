@extends('layouts.admin.app')

@section('title','Sale Target')

@push('css')

@endpush

@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sale Target
        <small></small>
      </h1>
           
      	@include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales Target</li>
      </ol>
    </section>
          <!-- Button trigger modal -->

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add Sales target</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <tbody><tr>
                  <th>No#</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Target Amount(tk)</th>
                  <th>Status</th>
                  <th>Total Sales amount(tk)</th>
                  <th>Action</th>
                </tr>
                @if(count($saletargets))
                  @foreach($saletargets as $key => $saletarget)
                <tr>
                  <td>{{ $key+1 }}</td>

                   @php
                      $dt = new Carbon\Carbon($saletarget->start_date);
                  @endphp
                  <td>{{ $dt->toFormattedDateString() }}</td>
                   @php
                      $dt = new Carbon\Carbon($saletarget->end_date);
                  @endphp
                  <td>{{ $dt->toFormattedDateString() }}</td>


                  <td>{{ $saletarget->target_amount }}</td>
                  <td>
                      @if($saletarget->status == 1)
                      <span class="badge bg-green">Active</span>
                      @else
                      <span class="badge bg-red">Expired</span>
                      @endif
                  </td>
                  <td>
                      
                      {{\App\Http\Controllers\Admin\SaleTargetController::getTotalPaid($saletarget->start_date, $saletarget->end_date)}}

                  </td>
                  <td>
                   <a href="{{ route('saletargets.edit',$saletarget->id) }}" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <form id="delete-form-{{ $saletarget->id }}" action="{{ route('saletargets.destroy',$saletarget->id) }}" style="display: none;" method="POST">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                    </form>
                    <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="if(confirm('Are you sure? You want to delete this?')){
                        event.preventDefault();
                        document.getElementById('delete-form-{{ $saletarget->id }}').submit();
                    }else {
                        event.preventDefault();
                            }" {{ $saletarget->status == 1 ? 'disabled' : ''}}>
                            <i class="fa fa-trash-o"></i>
                    </button>   
                  </td>
                </tr>
                  @endforeach
                @else
                <p>No data found !</p>
                @endif
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <!-- Main content -->

    <!-- /.content -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Set Sales Target</h4>
          </div>
          <form action="{{route('saletargets.store')}}" method="post">
              {{csrf_field()}}
            <div class="modal-body">
            @include('backend.saletarget.addform')
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>


	
@endsection

@push('script')
<script>
  
  $('#reservation').daterangepicker({

    locale: {
      format: 'YYYY-MM-DD'
    }

  }, function(start, end, label) {
      $('#start').val(start.format('YYYY-MM-DD')); 
      $('#end').val(end.format('YYYY-MM-DD')); 
  });

  // $(function () {
    
  //   $('#EmployeeId').val("fgg");
  //   $('#EmployeeId').val("fgg");
  // })


</script>
@endpush
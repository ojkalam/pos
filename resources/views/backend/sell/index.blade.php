@extends('layouts.admin.app')
@section('title','Sales History')

@push('css')
  
@endpush

@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales History
        <small></small>
      </h1>
     
        @include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales History</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a class="btn btn-primary" href="{{ route('sells.create') }}"><i class="fa fa-plus"></i> Add Sale</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Invoice No#</th>
                  <th>Customer</th>
                  <th>Cus_ID</th>
                  <th>Sale Date</th>
                  <th>Pay_Method</th>
                  <th>Total Amount</th>
                  <th>Discount(taka)</th>
                  <th>Total Paid</th>
                  <!-- <th>Status</th> -->
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($sells))
                  @foreach($sells as $key => $sell)
                <tr>
                  <td>{{ $sell->invoice_id }}</td>
                  <td>{{ $sell->c_name }}</td>
                  <td>{{ $sell->c_id }}</td>
                  <td>{{ $sell->sale_date }}</td>
                  <td>{{ $sell->pay_method }}</td>
                  <td>{{ $sell->total_amount }}</td>
                  <td>{{ $sell->due }}</td>
                  <td>{{ $sell->paid }}</td>
                 <!--  <td>{!! $sell->pay_status == 1 ? "<label class='label label-success'>Paid</label>" : "<label class='label label-warning'>Partial paid</label>" !!}</td> -->
                  
                  <td>
                   <a href="{{ route('sells.show',$sell->id) }}" title="Show" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                   <!-- <a href="{{ route('sells.edit',$sell->id) }}" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a> -->
                    <form id="delete-form-{{ $sell->id }}" action="{{ route('sells.destroy',$sell->id) }}" style="display: none;" method="POST">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                    </form>
                    <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="if(confirm('Are you sure? You want to delete this?')){
                        event.preventDefault();
                        document.getElementById('delete-form-{{ $sell->id }}').submit();
                    }else {
                        event.preventDefault();
                            }"><i class="fa fa-trash-o"></i>
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
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->
  
@endsection

@push('script')
<script>
  $(function () {
    $('#example1').DataTable({ "ordering": false });
    
    // $('#example2').DataTable({
    //   'paging'      : true,
    //   'lengthChange': false,
    //   'searching'   : false,
    //   'ordering'    : true,
    //   'info'        : true,
    //   'autoWidth'   : false
    // })
  });
</script>
@endpush



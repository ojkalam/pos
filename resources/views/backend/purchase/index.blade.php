@extends('layouts.admin.app')
@section('title','Purchases')

@push('css')
  
@endpush

@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase History
        <small></small>
      </h1>
     
        @include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Purchase</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a class="btn btn-primary" href="{{ route('purchases.create') }}"><i class="fa fa-plus"></i> Add Purchase</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No#</th>
                  <th>Supplier</th>
                  <th>Sup_ID</th>
                  <th>Purchase Date</th>
                  <th>Product Name</th>
                  <th>Purchase Qty</th>
                  <th>Total Purchase amount</th>
                  <!-- <th>Status</th> -->
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($purchases))
                  @foreach($purchases as $key => $purchase)
                <tr>
                  <td>{{ $purchase->id }}</td>
                  <td>{{ $purchase->c_name }}</td>
                  <td>{{ $purchase->c_id }}</td>
                  <td>{{ $purchase->purchase_date }}</td>
                  <td>{{ $purchase->p_name }}</td>
                  <td>{{ $purchase->purchase_quantity }}</td>
                  <td>{{ $purchase->total_amount }}</td>
                 <!--  <td>{!! $purchase->pay_status == 1 ? "<label class='label label-success'>Paid</label>" : "<label class='label label-warning'>Partial paid</label>" !!}</td> -->
                  
                  <td>
                   <!-- <a href="{{ route('purchases.show',$purchase->id) }}" title="Show" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a> -->
                   <!-- <a href="{{ route('purchases.edit',$purchase->id) }}" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a> -->
                    <form id="delete-form-{{ $purchase->id }}" action="{{ route('purchases.destroy',$purchase->id) }}" style="display: none;" method="POST">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                    </form>
                    <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="if(confirm('Are you sure? You want to delete this?')){
                        event.preventDefault();
                        document.getElementById('delete-form-{{ $purchase->id }}').submit();
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



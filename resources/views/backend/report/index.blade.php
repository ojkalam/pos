@extends('layouts.admin.app')
@section('title','Sales History')

@section('extra_css')
   <link rel="stylesheet" href="{{ asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection
@push('css')
  
@endpush

@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales Report
        <small></small>
      </h1>
     
        @include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <form method="POST" action="{{ route('report.salesreport') }}" >  
               {{ csrf_field() }}
               <div class="box-body">
              <!-- Date -->
              <div class="form-group col-md-4">
                <label>From Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <!-- <input type="text" class="form-control valid" id="datepicker"  class="form-control" name="sale_date" placeholder="yyyy-mm-dd"> -->

                  <input type="text" name="start_date" autocomplete="off" class="form-control pull-right" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group col-md-4">
                <label>To Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="end_date" autocomplete="off" class="form-control pull-right" id="datepicker2">
                </div>
                <!-- /.input group -->
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="sdfsd">.</label>
                  <input type="submit" class="form-control btn btn-primary" name="findreport" value="view report">
                </div>
              </div>
              <!-- /.form group -->

            </div>
             </form>
            </div>
            <!-- /.box-header -->
            @if(isset($_POST['findreport']))
            @if(count($sells))
            <div class="box-body">
              <div class="col-md-6">  
                <span style="font-size:15px" class="label label-primary">Showing Sales from {{ request('start_date')}} to {{ request('end_date')}}</span>
              </div>
              <div class="col-md-6 ">  
                <form method="POST" class="form pull-right" action="{{ route('report.salesreport.pdf') }}">
                   {{ csrf_field() }}
                   <input type="hidden" name="start_date" value="{{request('start_date')}}">
                   <input type="hidden" name="end_date" value="{{request('end_date')}}">
                    <input type="submit" class="btn btn-sm btn-primary" value="Download PDF" >
                </form>
                <form method="POST" class="form pull-right" action="{{ route('report.salesreport.excel') }}">
                   {{ csrf_field() }}
                   <input type="hidden" name="start_date" value="{{request('start_date')}}">
                   <input type="hidden" name="end_date" value="{{request('end_date')}}">
                    <input type="submit" class="btn btn-sm btn-info" value="Download Excel" >
                </form>
              </div>

              <table class="table table-bordered table-hover">
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
                </tr>
                </thead>
                <tbody>
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
                </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @endif
            @endif
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->
  
@endsection

@section('extra_scripts')
<script src="{{ asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
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

      $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });

      $('#datepicker2').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });


  });
</script>
@endpush



@extends('layouts.admin.app')
@section('title','Sales History')

@section('extra_css')
   <link rel="stylesheet" href="{{ asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/bower_components/select2/dist/css/select2.min.css')}}">

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
        <li class="active">Customer Sales report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <form method="POST" action="{{ route('report.customersalesreport') }}" >  
               {{ csrf_field() }}
               <div class="box-body">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Select Customer:*</label>
                  <select class="form-control select2" name="cus_id" tabindex="-1" aria-hidden="true">
                    <option selected disabled>Choose here</option>
                     @if(count($customers))
                        @foreach( $customers as $key => $customer )
                          <option value="{{ $customer->id }}">{{ $customer->name." | ".$customer->contact_id }}</option>
                        @endforeach
                      @endif
                  </select>
                </div>
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
                <span style="font-size:15px" class="label label-primary">Showing Sales of {{ $customer_sale->name }} | ID: {{ $customer_sale->contact_id }} </span>
              </div>
              <div class="col-md-6 ">  
                <form method="POST" class="form pull-right" action="{{ route('report.customersalesreport.pdf') }}">
                   {{ csrf_field() }}
                   <input type="hidden" name="cus_id" value="{{request('cus_id')}}">
                    <input type="submit" class="btn btn-sm btn-primary" value="Download PDF" >
                </form>
                <form method="POST" class="form pull-right" action="{{ route('report.customersalesreport.excel') }}">
                   {{ csrf_field() }}
                   <input type="hidden" name="cus_id" value="{{request('cus_id')}}">
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
            @else
              <h3>No Data is Found !</h3>
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
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
@endsection
@push('script')
<script>
  $(function () {

    $('.select2').select2();

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



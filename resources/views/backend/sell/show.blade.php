@extends('layouts.admin.app')

@section('title','Show Sale Details')

@section('extra_css')

@endsection

@push('css')  
@endpush

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Sale Details
    <small></small>
  </h1>
 
    @include('layouts.admin.partials.msg')

  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">sale</li>
  </ol>
</section>

<section class="invoice">
    <div id="printInvoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header"> {{ 'Invoice Report' }}
            <small class="pull-right">{{ date('d M Y') }}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>{{ config('app.name')}}.</strong><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>{{ $sells[0]['c_name'] }}</strong><br>
            {{ $sells[0]['city'] }}, {{ $sells[0]['country'] }}<br>
            Phone: {{ $sells[0]['phone'] }}<br>
            E-mail: {{ $sells[0]['email'] }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <br><b>Invoice No</b> #{{ $sells[0]['invoice_id'] }}
          <br>
          @php
            $dt = new Carbon\Carbon($sells[0]['sale_date']);
          @endphp
          <b>Payment Date:</b> {{ $dt->toFormattedDateString() }}<br>
          <b>Total Payable:</b> {{ $sells[0]['total_amount'] }}<br>
          <b>Discount:</b> {{ $sells[0]['due'] }}<br>
          <b>Total Paid:</b>৳ {{ $sells[0]['paid'] }}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>SL</th>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Price(taka)</th>
              <th>Tax(%)</th>
              <th style="width:15%">Total Price(exc tax)</th>
              <th>Total(inc tax)(৳)</th>
            </tr>
            </thead>
            <tbody>
          @if($sell_products)

          @php $total=0; $grand_total_tax = 0; $i=1; @endphp
          
            @foreach($sell_products as $sell_product)

              @php
                $original_price = ($sell_product->default_purchase_price + ($sell_product->default_purchase_price*($sell_product->profit_percent/100)));

                $total_tax = (($sell_product->quantity*$original_price)*($sell_product->tax_id/100));

              @endphp
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $sell_product->p_name }}</td>
              <td>{{ $sell_product->quantity }}</td>
              <td>৳ {{ $original_price }}</td>
              <td>{{ $sell_product->tax_id }}</td>
              <td>৳ {{ $sell_product->quantity * $original_price }}</td>
              <td>৳  {{ $total_tax + ($sell_product->quantity * $original_price) }}</td>
            </tr>
              @php
                $total = $total + ($sell_product->quantity * $original_price);
                $grand_total_tax = $grand_total_tax + $total_tax;
              @endphp
            @endforeach
           @endif
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->

        <!-- /.col -->
        <div class="col-xs-4 pull-right">
     <!--      <p class="lead">Amount Due 2/22/2014</p> -->

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Total Without Tax: </th>
                <td>৳ {{ round($total) }}</td>
              </tr>
              <tr>
                <th>Tax: </th>
                <td>৳ {{ round($grand_total_tax) }}</td>
              </tr>
              <tr>
                <th>Total Payable: </th>
                <td>৳ {{ round($total+$grand_total_tax) }}</td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="" onclick="printInvoice()" class="btn btn-default" style="margin-right: 5px;"><i class="fa fa-print"></i> Print</a>
          <a href="{{ route('sells.index') }}" class="btn btn-danger pull-right" style="margin-left: 5px;"><i class="fa fa-credit-card"></i> Back to Sales</a>
           <a  class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal" 
                data-email="{{ $sells[0]['email'] }}"> 
                 <i class="fa fa-envelope" aria-hidden="true"></i> Send Mail Invoice
            </a>
           <!--  <a  class="btn btn-info pull-right"  style="margin-right: 5px;" data-toggle="modal" data-target="#myModalSMS" 
                data-phone="{{ $sells[0]['phone'] }}"> 
                 <i class="fa fa-envelope" aria-hidden="true"></i> Send SMS Invoice
            </a> -->
          <a href="{{ route('sells.invoice-pdf', ['id'=> $sells[0]['id']] ) }}" target = "_blank" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </a>
        </div>
      </div>
    </section>
  

    <div class="modal fade" id="myModal" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Send Invoice</h4>
        </div>
          <div class="modal-body">
            <form role="form" method="POST" action="{{ route('sells.send-invoice') }}">
            {{ csrf_field() }}
            <input type="hidden" name="sell_id" value="{{ $sells[0]['id'] }}">
              <div class="box-body">
                <div class="form-group">
                  <label >E-mail</label>
                  <input type="email" id="cus_email" class="form-control" name="email" placeholder="Customer E-mail">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Send</button>
            </div>
          </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>

    <div class="modal fade" id="myModalSMS" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Send SMS Invoice</h4>
        </div>
          <div class="modal-body">
            <form role="form" method="POST" action="{{ route('sells.send-sms-invoice') }}">
            {{ csrf_field() }}

            @php
            $dt = new Carbon\Carbon($sells[0]['sale_date']);
            @endphp

            <input type="hidden" name="sell_id" value="{{ $sells[0]['id'] }}">
            <input type="hidden" name="invoice_id" value="{{ $sells[0]['invoice_id'] }}">
            <input type="hidden" name="total_paid" value="{{ $sells[0]['total_amount'] }}">
            <input type="hidden" name="due" value="{{ $sells[0]['due'] }}">

              <div class="box-body">
                <div class="form-group">
                  <label >Phone number</label>
                  <input type="text" id="cus_phone" class="form-control" name="phone" placeholder="Customer Phone number">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Send SMS</button>
            </div>
          </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
@endsection

@section('extra_scripts')

  
@endsection

@push('script')
<script>
//print page

function printInvoice(){
  var prtContent = document.getElementById("printInvoice");
  var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
  WinPrint.document.write(prtContent.innerHTML);
  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();
  WinPrint.close();
}

$('#myModal').on('show.bs.modal', function (event) {
          var invoice = $(event.relatedTarget); // Button that triggered the modal
          var email = invoice.data('email');
        
          var modal = $(this)

          $('#cus_email').val(email);
          // modal.find('.modal-title').text('New message to ' + recipient)
          // document.getElementById('cus_email').innerHTML = email;

      });

$('#myModalSMS').on('show.bs.modal', function (event) {
          var invoice = $(event.relatedTarget); // Button that triggered the modal
          var phone = invoice.data('phone');
        
          var modal = $(this)

          $('#cus_phone').val(phone);
          // modal.find('.modal-title').text('New message to ' + recipient)
          // document.getElementById('cus_email').innerHTML = email;

      });
</script>
@endpush


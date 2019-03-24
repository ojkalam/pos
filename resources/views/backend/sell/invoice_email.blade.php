<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
  <style>
  body{
    width: 95%;
    font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    font-weight: 400;
    overflow-x: hidden;
    overflow-y: auto;
    font-family: sans-serif; 
    font-size: 16px !important;
    margin: 0 auto;
  }
  .invoice {
    margin: 30px auto;
    background: #fff;
    padding: 20px;
    display: block;
  }
  #product_list {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  #product_list td, #product_list th {
      border: 1px solid #ddd;
      padding: 8px;
  }

  #product_list tr:nth-child(even){background-color: #f2f2f2;}

  #product_list tr:hover {background-color: #ddd;}

  #product_list th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #4CAF50;
      color: white;
  }

  .row{
    width: 100%;
    display: block;
  }
  .invoice-col{
    width: 30%;
    display: block;
    padding: 10px;
    overflow: hidden;
    float: left;
  }
  </style>
</head>
<body>
<section class="invoice">
      <!-- title row -->
      <div class="row">
          <h2 style="text-align:center"> <span styl="margin-left:30px">{{ 'Invoice Report |' }}</span>
            <small >{{ date('d M Y') }}</small>
          </h2>
        </div>
        <hr>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row">
        <div class="invoice-col">
          From
          <address>
            <strong>{{ config('app.name')}}.</strong><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="invoice-col">
          To
          <address>
            <strong>{{ $sells[0]['c_name'] }}</strong><br>
            {{ $sells[0]['city'] }}, {{ $sells[0]['country'] }}<br>
            Phone: {{ $sells[0]['phone'] }}<br>
            E-mail: {{ $sells[0]['email'] }}
          </address>
        </div>
        <!-- /.col -->
        <div class="invoice-col">
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
          <table id="product_list">
            <thead>
            <tr>
              <th>SL</th>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Price(taka)</th>
              <th>Tax(%)</th>
              <th style="width:15%">Total Price(exc tax)</th>
              <th>Total(inc tax)</th>
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
              <td>{{ $original_price }}</td>
              <td>{{ $sell_product->tax_id }}</td>
              <td>{{ $sell_product->quantity * $original_price }}</td>
              <td>{{ $total_tax + ($sell_product->quantity * $original_price) }}</td>
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
        <div class="invoice-col"></div>
        <div class="invoice-col"></div>

          <div class="invoice-col">
            <table class="table">
              <tbody><tr>
                <th>Without tax:</th>
                <td>{{ round($total) }} tk</td>
              </tr>
              <tr>
                <th>Tax:</th>
                <td>{{ round($grand_total_tax) }} tk</td>
              </tr>
              <tr>
                <th>Total payable amount:</th>
                <td>{{ round($total+$grand_total_tax) }} tk</td>
              </tr>
            </tbody></table>
          </div>
        </div>
      </div>
    </section>
      
</body>
</html>



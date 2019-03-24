<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>sales report</title>
  <style>
    table, th, td, tr{
    
      border: 1px solid #000;
      border-collapse: collapse;

    }
  </style>
</head>
<body>

  <!-- Content Header (Page header) -->
    <div class="content-header">
      <h1 style="text-align:center">
        Point of Sale
      </h1>
       <h3 style="text-align:center;margin-bottom:20px;">Showing Sales of {{ $customer_sale->name }} | ID: {{ $customer_sale->contact_id }} </h3>
    </div>
    <!-- Main content -->
    <div class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

            @if(count($sells))
            <div class="box-body">
         
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </div>
    <!-- /.content -->
  
</body>
</html>
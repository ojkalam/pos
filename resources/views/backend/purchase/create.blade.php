@extends('layouts.admin.app')

@section('title','Process Sale')

@section('extra_css')
<!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
   <link rel="stylesheet" href="{{ asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/bower_components/jquery-ui/jquery-ui.min.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection
@push('css')  
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Purchase
        <small></small>
      </h1>
     
        @include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">purchase</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row"> 
        <div class="col-sm-8 col-md-offset-2">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Purchase</h3>
            </div>
            <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('purchases.store') }}" enctype="multipart/form-data" >  
          <div class="box-body">
           {{ csrf_field() }}         
                <div class="form-group">
                  <label>Select Supplier:*</label>
                  <select class="form-control select2" name="contact_id" tabindex="-1" aria-hidden="true">
                    <option selected disabled>Choose here</option>
                     @if(count($suppliers))
                        @foreach( $suppliers as $key => $purchase )
                          <option value="{{ $purchase->id }}">{{ $purchase->name." | ".$purchase->contact_id}}</option>
                        @endforeach
                      @endif
                  </select>
              </div>
               <div class="form-group">
                  <label for="transaction_date">Purchase Date:*</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" class="form-control valid" id="datepicker" autocomplete="off" class="form-control" name="purchase_date" placeholder="yyyy-mm-dd">
                  </div>
              </div>
                  
                <div class="form-group">
                  <label for="transaction_date">Choose Product:*</label>

                  <select id="product" name="product_id" class="form-control solsoSelect2 required " tabindex="-1" title="" style="width:560px;">
                  
                  <option selected="" disabled>choose product</option>
                    @if(count($products))
                      @foreach( $products as $key => $product )
                        <option value="{{ $product->id }}">{{ $product->p_name." | SKU: ".$product->sku." | purchase Price: ".$product->default_purchase_price." taka"  }}</option>
                        

                      @endforeach
                    @endif  

                  </select>
                </div> 
                 <div class="form-group">
                  <label for="transaction_date">Purchase Price:*</label>

                    <input class="form-control solsoEvent" id="purchase_price" name="price" type="number" placeholder="Purchase Price" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="transaction_date">Purchase Quantity:*</label>

                    <input class="form-control solsoEvent" id="cal_qty" name="purchase_quantity" type="number" placeholder="Purchase Quantity" autocomplete="off" required>
                </div>
                  <!-- <input type="hidden" name="price[]"> -->
              <div class="form-group">
                <label for="amount_0">Purchased amount:*</label>
                  <input type="number" class="form-control valid" autocomplete="off" id="total_purchase" class="form-control" name="total_amount" placeholder="">
              </div>
              <div class="form-group">
                   <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
             </form>
          <!-- /.box -->
          </div>
         </div>
        </div>
        </div>
        <!-- /.col -->
    </section>
    <!-- /.content -->
  
@endsection

@section('extra_scripts')
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
@endsection

@push('script')
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    //CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    //Initialize Select2 Elements

    $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });

     $('.select2').select2();
     $('.solsoSelect2').select2();

   $( document ).on('change', '.solsoSelect2', function() {
    
    // inputPrice = $(this).closest('tr').find("[name='price[]']");

    $.ajax({
       headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

      url: "{{ URL::route('ajax.productPurchasePrice') }}",
      type: 'post',
      dataType: 'json',
      data: { product: $(this).val() },
      success:function(data) {
      // console.log(data['sell_price_inc_tax']);
        $('#purchase_price').val(data['default_purchase_price']);
        // console.log(data['default_purchase_price']);
      }
    });
  });

   $( document ).on('keyup', '#cal_qty', function() {

    var purchase_price = $('#purchase_price').val();
    var purchase_quantity = $(this).val();
    var total = purchase_price*purchase_quantity;
    $('#total_purchase').val(total);

   });


  });


   
</script>
@endpush
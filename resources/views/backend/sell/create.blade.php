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
        Process Sale
        <small></small>
      </h1>
     
        @include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">sale</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-sm-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Sale</h3>
            </div>
            <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('sells.store') }}" enctype="multipart/form-data" >  
          <div class="box-body">
           {{ csrf_field() }}         
          <div class= "row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Select Customer:*</label>
                  <select class="form-control select2" name="customer_name" tabindex="-1" aria-hidden="true">
                    <option selected disabled>Choose here</option>
                     @if(count($customers))
                        @foreach( $customers as $key => $customer )
                          <option value="{{ $customer->id }}">{{ $customer->name." | ".$customer->contact_id }}</option>
                        @endforeach
                      @endif
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
               <div class="form-group">
                  <label for="transaction_date">Sale Date:*</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" class="form-control valid" id="datepicker" autocomplete="off" class="form-control" name="sale_date" placeholder="yyyy-mm-dd">
                  </div>
                </div>
              </div>
          </div>
      

      <div class="col-sm-12">
                  <!-- start product -->
        <div class="control-group">
          <label class="control-label" for="focusedInput">Add multiple products</label>
           
          <div class="controls">
            <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="col-md-1" >SL.</th>
                <th class="col-md-5">Product</th>
                <th class="col-md-1">Quantity</th>
                <th class="col-md-2">Price</th>
                <th class="col-md-2">Total</th>
                <th class="col-md-1">Action</th>
              </tr> 
            </thead>
              
            <tbody class="solsoParent"> 
              <tr class="solsoChild">
                <td class="crt">1</td>
                
                <td>
                  <select id="product" name="product_id[]" class="form-control solsoSelect2 solsoCloneSelect2 required " tabindex="-1" title="" style="width:560px;">
                  
                  <option selected="" disabled>choose product</option>
                    @if(count($products))
                      @foreach( $products as $key => $product )
                        <option value="{{ $product->id }}">{{ $product->p_name." | SKU: ".$product->sku." | Price: ৳ ".$product->sell_price_inc_tax }} | Stock: {{$product->stock_quantity}}</option>
                        

                      @endforeach
                    @endif  

                  </select> 
                  <!-- <input type="hidden" name="price[]"> -->
<!-- 
                   @if(count($products))
                      @foreach( $products as $key => $product )
                      <input type="hidden" class="form-control required solsoEvent" name="price[]" value="{{ $product->sell_price_inc_tax }}">
                      @endforeach
                    @endif   -->
                </td>
                    <td>
                    <input class="form-control solsoEvent" id="cal_qty" name="quantity[]" type="text" placeholder="Quantity" autocomplete="off" required>
                    </td>

                    <td>
                       <input type="text" name="price[]" id="inputPrice" class="form-control required solsoEvent" autocomplete="off" disabled>
                  </td>

                    <td>
                      <h4 >
                        <span class="solsoSubTotal">0.00</span>
                      </h4> 
                    </td>
                  
                  <td>
                    <button type="button" class="btn btn-sm btn-danger removeClone disabled" disabled><i class="fa fa-close"></i></button>
                  </td> 
                
                 
                </tr>
              </tbody>
            
              </table>
            </div>
          </div>
            <button type="button" class="btn btn-primary btn-sm" id="createClone">
             <i class="fa fa-plus"></i> Add row
            </button>
            <div class="pull-right" style="margin-right:60px">
              <h2>Total: <span class="solsoTotal"></span> taka</h2>

              <input type="hidden" id="solsoTotalhidden" name="total_hidden_price">
            </div>
      <!--   <div class="control-group col-md-12 text-center">
            <button type="button" class="btn btn-primary btn-lg" id="createClone">
              <i class="halflings-icon white plus"></i> Add new product
            </button>
          </div> -->
          <!-- end add product -->
        </div>
       </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Select Discount(If any):</label>
                      <select class="form-control select2" id="discount" tabindex="-1" aria-hidden="true">
                        <option selected disabled>Choose here</option>
                        <option value='0'>None</option>
                         @if(count($discounts))
                            @foreach( $discounts as $key => $discount )
                              <option value="{{ $discount->value_in_percent }}">{{ $discount->offer_name." (".$discount->value_in_percent }}%)</option>
                            @endforeach
                          @endif
                      </select>
                    </div>
                  </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Discount Price(If any):</label>
                        <input type="text" class="form-control" name="discount_price" id="discount_price">
                      </div>
                  </div>
                </div>
                <div class="row">
                <input type="hidden" class="payment_row_index" value="0">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="amount_0">Total payable amount:*</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-money"></i>
                      </span>
                      <input class="form-control payment-amount input_number" required="" id="total_amount" placeholder="Paid Amount" name="paid" type="text" aria-required="true">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="method_0">Payment Method:*</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-money"></i>
                      </span>
                      <select class="form-control col-md-12 payment_types_dropdown valid" required="" id="method_0" style="width:100%;" name="pay_method" aria-required="true" aria-invalid="false">
                        <option value="cash" selected="selected">Cash</option>
                        <option value="card">Card</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="note_0">Payment note:</label>
                    <textarea class="form-control" rows="3" id="note_0" name="notes" cols="50"></textarea>
                  </div>
                </div>
              </div>

              </div>

              </div>

               <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
             </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->
  
@endsection

@section('extra_scripts')
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('backend/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
@endsection

@push('script')
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    //CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5();
    //Initialize Select2 Elements

    $('#datepicker').datepicker({
      autoclose: true,
      dateFormat: 'yy-mm-dd'
    });


    $('.select2').select2();
    $('.solsoSelect2').select2();
    $('.solsoCloneSelect2').select2();

         /* === CLONE ROW === */
  $('#createClone').on('click', function(e) {
    //console.log();
      $( '.solsoSelect2.solsoCloneSelect2').select2('destroy');
        //console.log("testing 376");
      $( '.solsoParent' )
        .append( '<tr>' + $( 'tr.solsoChild' ).html()  + '</tr>' );
          //console.log("testing");

      $( '.crt' ).each(function( index ) {
          if (window.location.pathname.endsWith("edit"))
            $( this ).text(index);
          else
            $( this ).text(index+1);

        if (index > 0) {
          $( this ).parent().find( '.removeClone' ).removeAttr('disabled').removeClass('disabled');
        }
      });

      $( ".solsoSubTotal" ).last().text('0.00');

      $( '.solsoCloneSelect2' ).select2();

      return false;
  });

  //remove clone row
  $( document ).on('click', '.removeClone', function() {
    $(this).parents().eq(1).remove();

    $( '.crt' ).each(function( index ) {
      $( this ).text(index+1);
    });

    //subtract remove 
    var qty     = $(this).closest('tr').find("[name='quantity[]']").val();
    var price   = $(this).closest('tr').find("[name='price[]']").val();
    
    var subTotal  = 0;
    var total   = 0;

    itemQty     = parseFloat(qty)  > 0    ? parseFloat(qty).toFixed(2)    : 0;
    itemPrice   = parseFloat(price)  > 0  ? parseFloat(price).toFixed(3)    : 0;
    

    solsoValue      = itemQty * itemPrice;
    solsoPrice      = solsoValue;

    subTotal    = solsoPrice;

    $(this).closest('tr').find(".solsoSubTotal").text( subTotal.toFixed(2) );

    $( '.solsoSubTotal' ).each(function() {
      total += parseFloat($(this).text());
    });


    $( '.solsoTotal' ).text( total.toFixed(2) );
    $( '#total_amount' ).val( total.toFixed(2) );
    $('#discount_price').val(0);
    // end 

    // if ( $(this).attr('data-id').length ) {
    //   $.ajax({
    //     url: "",
    //     type: 'post',
    //     dataType: 'json',
    //     data: { id: $(this).attr('data-id') },
    //     success:function(data) {
    //     }
    //   });
    // }
  });
  /* === END CLONE ROW === */


  /* === INVOICE === */
  $( document ).on('change', '.solsoCloneSelect2', function() {
    
    inputPrice = $(this).closest('tr').find("[name='price[]']");

    $.ajax({
       headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

      url: "{{ URL::route('ajax.productPrice') }}",
      type: 'post',
      dataType: 'json',
      data: { product: $(this).val() },
      success:function(data) {
      // console.log(data['sell_price_inc_tax']);
        inputPrice.val(data['sell_price_inc_tax']);
      }
    });
  });



  $( document ).on("click change paste keyup", ".solsoEvent", function() {
    var qty     = $(this).closest('tr').find("[name='quantity[]']").val();
    var price   = $(this).closest('tr').find("[name='price[]']").val();
    
    var subTotal  = 0;
    var total   = 0;

    itemQty     = parseFloat(qty)  > 0    ? parseFloat(qty).toFixed(2)    : 0;
    itemPrice   = parseFloat(price)  > 0  ? parseFloat(price).toFixed(3)    : 0;
    

    solsoValue      = itemQty * itemPrice;
    solsoPrice      = solsoValue;

    subTotal    = solsoPrice;

    $(this).closest('tr').find(".solsoSubTotal").text( subTotal.toFixed(2) );

    $( '.solsoSubTotal' ).each(function() {
      total += parseFloat($(this).text());
    });


    $( '.solsoTotal' ).text( total.toFixed(2) );
    $( '#solsoTotalhidden' ).val( total.toFixed(2) );
    $( '#total_amount' ).val( total.toFixed(2) );

  });
  /* === END INVOICE === */


       //discount calculate
        $('#discount').on('change', function() {
        
         var discount = this.value;


         if (discount == 0) {
            var total_amount = $('#solsoTotalhidden').val();
            // console.log(discount);
            $('#total_amount').val(total_amount);
            $('#discount_price').val(0);

         }else{

           var total_amount = $('#solsoTotalhidden').val();

            var discount_price =parseFloat(total_amount*(discount/100));
            var payable = (parseFloat(total_amount)-parseFloat(discount_price));

          $('#total_amount').val(payable);
          $('#discount_price').val(parseFloat(discount_price).toFixed(2));

         } 
         
        });

  });


   
</script>
@endpush
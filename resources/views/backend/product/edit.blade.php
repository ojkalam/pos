@extends('layouts.admin.app')

@section('title','Edit Product')

@section('extra_css')
<!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/bower_components/select2/dist/css/select2.min.css')}}">

@endsection
@push('css')  
@endpush

@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product
        <small></small>
      </h1>
     
        @include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-sm-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('products.update', $product->id) }}" >  
              <div class="box-body">
               {{ csrf_field() }}
               {{ method_field('PUT') }}    
               
              <div class= "row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Product Name:*</label>
                      <input type="text" class="form-control" name="p_name" value="{{$product->p_name}}">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Select Category:*</label>
                      <select class="form-control select2" name="category_id" tabindex="-1" aria-hidden="true">
                        <option selected disabled>Choose here</option>
                         @if(count($categories))
                            @foreach( $categories as $key => $category )

                              <option value="{{ $category->id }}"
                                 @if($category->id == $product->category_id)
                                  {{'selected'}}
                                 @endif
                                >{{ $category->category_name }}</option>
                            @endforeach
                          @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>SKU (stock keeping unit)*:</label>
                      <input type="text" class="form-control" name="sku" value="{{$product->sku}}">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Stock Quantity:*</label>
                      <input type="text" class="form-control" name="stock_quantity" value="{{$product->stock_quantity}}">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Alert Quantity:*</label>
                      <input type="text" class="form-control" name="alert_quantity" value="{{$product->alert_quantity}}">
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Purchase price*:</label>
                      <input type="number" id="purchase_price" class="form-control" name="default_purchase_price" min="1" value="{{$product->default_purchase_price}}">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Profit percent(%):</label>
                      <input type="number" class="form-control" tabindex="-1" id="profit_percent" name="profit_percent" min="1" value="{{$product->profit_percent}}" disabled>
                    </div>
                  </div>
                  
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Selling price*</label>
                      <input type="text" class="form-control" min="1" id="sell_price" name="sell_price_inc_tax" value="{{$product->sell_price_inc_tax}}">
                    </div>
                  </div>
                  
                </div>
                <div class="box-footer">
                  <a href="{{ route('products.index') }}" class="btn btn-danger">Back to List</a>
                  <button type="submit" class="btn btn-primary">update</button>
                </div>
              </div>
              <!-- /.box-body -->
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
    $('.select2').select2();

    //on keyup of purchase change value sell price
     $("#purchase_price").keyup(function(){
       //get
       $('#profit_percent').removeAttr("disabled");

        var pp = $('#purchase_price').val();
       //Set
        $('#sell_price').val(pp);
      
     });
     //onkeyup of profit percent
     $("#profit_percent").keyup(function(){
       //get
        $('#tax_cal').removeAttr("disabled");

        if ($('#tax_cal').val()) {
          var tax_rate = $('#tax_cal').val();
         }else{
          var tax_rate = 0;
         }

        var profit_percent = $('#profit_percent').val();
        var purchase_price = $('#purchase_price').val();
        //var sell_price = $('#sell_price').val();

        var cal_price =parseFloat(purchase_price*(profit_percent/100));
        cal_price = (parseFloat(purchase_price)+parseFloat(cal_price));

       //Set
        $('#sell_price').val(cal_price);
      
     });

    //tax calculate
    $('#tax_cal').on('change', function() {
    
     var tax_rate = this.value;
     
      var profit_percent = $('#profit_percent').val();
      var purchase_price = $('#purchase_price').val();
      var cal_price =parseFloat(purchase_price*(profit_percent/100));
      var sell_price = (parseFloat(purchase_price)+parseFloat(cal_price));


     var inc_tax_sell = parseFloat(sell_price) + (parseFloat(sell_price) * (tax_rate/100));

    $('#sell_price').val(inc_tax_sell);

     
    });



  })
</script>
@endpush


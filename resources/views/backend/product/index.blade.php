@extends('layouts.admin.app')
@section('title','Products')

@push('css')
  
@endpush

@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Products
        <small></small>
      </h1>
     
        @include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Products</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a class="btn btn-primary" href="{{ route('products.create') }}"><i class="fa fa-plus"></i> Add product</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No#</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Brand</th>
                  <th>SKU</th>
                  <th>Stock</th>
                  <th>Purchase Price</th>
                  <th>Profit(%)</th>
                  <th>tax(%)</th>
                  <th>Sell Price</th>
                  <th>Alert Qty.</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($products))
                  @foreach($products as $key => $product)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $product->p_name }}</td>
                  <td>{{ $product->category->category_name }}</td>
                  <td>{{ isset($product->brand->brand_name) ? $product->brand->brand_name : '' }}</td>
                  <td>{{ $product->sku }}</td>
                  <td>{{ $product->stock_quantity }}</td>
                  <td>{{ $product->default_purchase_price }}</td>
                  <td>{{ $product->profit_percent }}</td>
                  <td>{{ $product->tax_id }}</td>
                  <td>{{ $product->sell_price_inc_tax }}</td>
                  <td>{{ $product->alert_quantity }}</td>
                  <td><img src="{{ asset('uploads/product/'.$product->p_image) }}" style="width:80px; height:70px;" alt="{{ $product->p_name }}"></td>
                  
                  <td>
                   <a href="{{ route('products.edit',$product->id) }}" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                    <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy',$product->id) }}" style="display: none;" method="POST">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                    </form>
                    <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="if(confirm('Are you sure? You want to delete this?')){
                        event.preventDefault();
                        document.getElementById('delete-form-{{ $product->id }}').submit();
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
    $('#example1').DataTable()
    // $('#example2').DataTable({
    //   'paging'      : true,
    //   'lengthChange': false,
    //   'searching'   : false,
    //   'ordering'    : true,
    //   'info'        : true,
    //   'autoWidth'   : false
    // })
  })
</script>
@endpush



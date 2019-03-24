@extends('layouts.admin.app')

@section('title','Product Category')

@push('css')

@endpush

@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product
        <small>Catgories</small>
      </h1>
           
      	@include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Categories</li>
      </ol>
    </section>
          <!-- Button trigger modal -->

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add New Category</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <tbody><tr>
                  <th>No#</th>
                  <th>Category Name</th>
                  <th>Short Description</th>
                  <th>Total Products</th>
                  <th>Action</th>
                </tr>
                @if(count($categories))
                  @foreach($categories as $key => $category)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $category->category_name}}</td>
                  <td>{{ $category->short_description}}</td>
                  <td><span class="badge bg-red">{{ count($category->products) }}</span></td>
                  <td>
                    <a href="{{ route('categories.edit',$category->id) }}" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                    <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy',$category->id) }}" style="display: none;" method="POST">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                    </form>
                    <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="if(confirm('Are you sure? You want to delete this?')){
                        event.preventDefault();
                        document.getElementById('delete-form-{{ $category->id }}').submit();
                    }else {
                        event.preventDefault();
                            }" {{ $category->category_name == 'uncategorized' ? 'disabled' : '' }}><i class="fa fa-trash-o"></i>
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
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <!-- Main content -->

    <!-- /.content -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">New Category</h4>
          </div>
          <form action="{{route('categories.store')}}" method="post">
              {{csrf_field()}}
            <div class="modal-body">
            @include('backend.category.form')
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
	
@endsection

@push('script')

@endpush
@extends('layouts.admin.app')

@section('title','Tax')

@push('css')

@endpush

@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tax
        <small></small>
      </h1>
           
      	@include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tax</li>
      </ol>
    </section>
          <!-- Button trigger modal -->

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New Tax</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <tbody><tr>
                  <th>No#</th>
                  <th>Tax Name</th>
                  <th>Tax Rate (%)</th>
                  <th>Action</th>
                </tr>
                @if(count($taxes))
                  @foreach($taxes as $key => $tax)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $tax->tax_name}}</td>
                  <td>{{ $tax->tax_rate}}</td>
                  <td>
                    <a href="{{ route('taxes.edit',$tax->id) }}" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                    <form id="delete-form-{{ $tax->id }}" action="{{ route('taxes.destroy',$tax->id) }}" style="display: none;" method="POST">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                    </form>
                    <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="if(confirm('Are you sure? You want to delete this?')){
                        event.preventDefault();
                        document.getElementById('delete-form-{{ $tax->id }}').submit();
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
          <form action="{{route('taxes.store')}}" method="post">
              {{csrf_field()}}
            <div class="modal-body">
            @include('backend.tax.form')
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
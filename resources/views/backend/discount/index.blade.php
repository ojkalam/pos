@extends('layouts.admin.app')

@section('title','Discount Offer')

@push('css')

@endpush

@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Discount Offer
        <small></small>
      </h1>
           
      	@include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Discount Offer</li>
      </ol>
    </section>
          <!-- Button trigger modal -->

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New Discount Offer</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <tbody><tr>
                  <th>No#</th>
                  <th>Discount Offer Name</th>
                  <th>Discount Offer Rate (%)</th>
                  <th>Action</th>
                </tr>
                @if(count($discountoffers))
                  @foreach($discountoffers as $key => $discountoffer)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $discountoffer->offer_name}}</td>
                  <td>{{ $discountoffer->value_in_percent }}</td>
                  <td>
                    <form id="delete-form-{{ $discountoffer->id }}" action="{{ route('discountoffers.destroy',$discountoffer->id) }}" style="display: none;" method="POST">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                    </form>
                    <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="if(confirm('Are you sure? You want to delete this?')){
                        event.preventDefault();
                        document.getElementById('delete-form-{{ $discountoffer->id }}').submit();
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
            <h4 class="modal-title" id="myModalLabel">New Discount Offer</h4>
          </div>
          <form action="{{route('discountoffers.store')}}" method="post">
              {{csrf_field()}}
            <div class="modal-body">
            @include('backend.discount.form')
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
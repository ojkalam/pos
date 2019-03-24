@extends('layouts.admin.app')

@section('title','Notifications')

@push('css')

@endpush

@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Notifications
        <small></small>
      </h1>
           
      	@include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Notifications</li>
      </ol>
    </section>
          <!-- Button trigger modal -->

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           <!--  <div class="box-header with-border">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New Discount Offer</button>
            </div> -->
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <tbody><tr>
                  <th>No#</th>
                  <th>Message</th>
                  <th>Time</th>
                  <!-- <th>Action</th> -->
                  @php
                    $i = 0;
                  @endphp
                  @foreach( auth()->user()->notifications as $notification)
                    
                  @if($notification->unread())
                    <tr style="background:#E4E9F1">
                      <td>{{ $i++ }}</td>
                      <td>
                        <a href="{{ route('mark_single_asread', [ 'id' => $notification->id ]) }}">
                        <i class="fa fa-warning text-yellow"></i> {{ $notification->data['product_info'] }}</a>
                      </td>
                        @php
                            $dt = new Carbon\Carbon($notification->created_at);
                        @endphp
                      <td><span style="margin-left:22px"><i class="fa fa-clock-o"></i> {{ $dt->diffForHumans() }}</span></td>
                      <td><a href="{{ route('notification.delete', [ 'id' => $notification->id ]) }}"> <span class="fa fa-trash"></span> </a></td>
                     
                    </tr>
                  @else
                    <tr style="background:#fff">
                      <td>{{ $i++ }}</td>
                      <td>
                        <a href="{{ route('mark_single_asread', [ 'id' => $notification->id ]) }}">
                        <i class="fa fa-warning text-yellow"></i> {{ $notification->data['product_info'] }}</a>
                      </td>
                        @php
                            $dt = new Carbon\Carbon($notification->created_at);
                        @endphp
                      <td><span style="margin-left:22px"><i class="fa fa-clock-o"></i> {{ $dt->diffForHumans() }}</span></td>
                      <td><a href="{{ route('notification.delete', [ 'id' => $notification->id ]) }}"> <span class="fa fa-trash"></span> </a></td>
                    </tr>
                  @endif
                   @endforeach

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
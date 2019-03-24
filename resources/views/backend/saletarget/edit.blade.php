@extends('layouts.admin.app')

@section('title','Edit Sale Target')

@section('extra_css')
@endsection
@push('css')  
@endpush

@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Sale Target
        <small></small>
      </h1>
     
        @include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sale Target</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-sm-12">
          <!-- general form elements -->
          <div class="box box-primary">
           <!--  <div class="box-header with-border">
              <h3 class="box-title">Edit Sale Target</h3>
            </div> -->
            <!-- /.box-header -->
            <!-- form start -->
            <div class="col-sm-6">
             <form action="{{route('saletargets.update', $saletarget->id )}}" method="post">
              {{csrf_field()}}
              {{ method_field('PUT') }}

                <div class="form-group">
                    <label>Date range:</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" autocomplete="off" class="form-control pull-right" value="{{ $saletarget->start_date.' - '.$saletarget->end_date }}" id="reservation">
                      <input type="hidden" name="start_date" id="start" value= "{{ $saletarget->start_date }}">
                      <input type="hidden" name="end_date"  id="end" value= "{{ $saletarget->end_date }}">
                    </div>
                    <!-- /.input group -->
                  </div>

                <div class="form-group">
                  <label for="des">Target Amount (taka)</label>
                  <input type="number" name="target_amount" value="{{ $saletarget->target_amount }}" min="1" class="form-control">
                </div>
                <div class="box-footer">
                  <a href="{{ route('saletargets.index') }}" class="btn btn-danger">Back to List</a>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
              <!-- /.box-body -->
             </form>
             </div>
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
  
@endsection

@push('script')
<script>

  $('#reservation').daterangepicker({

  locale: {
    format: 'YYYY-MM-DD'
  }

  }, function(start, end, label) {
      $('#start').val(start.format('YYYY-MM-DD')); 
      $('#end').val(end.format('YYYY-MM-DD')); 
  });


</script>
@endpush


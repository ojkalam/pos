@extends('layouts.admin.app')

@section('title','Edit Customer')

@section('extra_css')
<!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endsection
@push('css')  
@endpush

@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Customers
        <small></small>
      </h1>
     
        @include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-sm-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Customer</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('contacts.update', $contact->id ) }}" enctype="multipart/form-data" >  
              <div class="box-body">
               {{ csrf_field() }}         
               {{ method_field('PUT') }}    
                <div class="form-group">
                  <label for="contact_name">Name*</label>
                  <input type="text" class="form-control" name="contact_name" value="{{$contact->name}}">
                </div>

                <div class="form-group">
                  <label for="email">E-mail:</label>
                  <input type="email" class="form-control" name="email" value="{{$contact->email}}">
                </div>
                <div class="form-group">
                  <label for="phone">Phone:</label>
                  <input type="text" class="form-control" name="phone" value="{{$contact->phone}}">
                </div>
                <div class="form-group">
                  <label for="cont">Country:</label>
                  <input type="text" class="form-control" name="country" value="{{$contact->country}}">
                </div>
                <div class="form-group">
                  <label for="city">City:</label>
                  <input type="text" class="form-control" name="city" value="{{$contact->city}}">
                </div>

               
                  <div class="form-group">
                  <input type="submit" class="form-control btn btn-primary" value="update">
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
  
@endsection

@push('script')
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    //CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
@endpush


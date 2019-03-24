@extends('layouts.admin.app')

@section('title','Add Portfolio')

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
        Portfolios
        <small></small>
      </h1>
     
        @include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Portfolio</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-sm-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add new portfolio</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('portfolios.store') }}" enctype="multipart/form-data" >  
              <div class="box-body">
               {{ csrf_field() }}         
                <div class="form-group">
                  <label>Protfolio Name</label>
                  <input type="text" class="form-control" name="portfolio_title" placeholder="Portfolio Name">
                </div>
                <div class="form-group">
                  <label>Heading Text</label>
                  <input type="text" class="form-control" name="heading" placeholder="Heding of portfolio">
                </div>
                <div class="form-group">
                  <label>Select Category</label>
                  <select name="portfolio_category" class="form-control">
                    @if(count($categories))
                      @foreach( $categories as $key => $category )
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
                <div class="form-group">
                  <label>Description of Portfolio</label>
                  <textarea class="textarea" name="description" placeholder="Place some Description of portfolio here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Portfolio Screenshot</label>
                  <input type="file" id="exampleInputFile" name="portfolio_image">
                  <p class="help-block">Only png,   jpg are supported.</p>
                </div   
                <div class="box-footer">
                  <a href="{{ route('portfolios.index') }}" class="btn btn-danger">Back to List</a>
                  <button type="submit" class="btn btn-primary">Save</button>
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


@extends('layouts.admin.app')
@section('title', ucfirst($contact_type))

@push('css')
  
@endpush

@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       {{ucfirst($contact_type)}} List
        <small></small>
      </h1>
     
        @include('layouts.admin.partials.msg')
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> {{ucfirst($contact_type)}}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> {{'Add '.ucfirst($contact_type) }}</button>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No#</th>
                  <th>Name</th>
                  <th>{{ucfirst($contact_type)}} ID</th>
                  <th>E-mail</th>
                  <th>Phone</th>
                  <th>Country</th>
                  <th>City</th>
                  <th>Notes</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($contacts))
                  @foreach($contacts as $key => $contact)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $contact->name }}</td>
                  <td>{{ $contact->contact_id }}</td>
                  <td>{{ $contact->email }}</td>
                  <td>{{ $contact->phone }}</td>
                  <td>{{ $contact->country }}</td>
                  <td>{{ $contact->city }}</td>
                  <td>{{ $contact->notes }}</td>
                  
                  <td>
                   <a href="{{ route('contacts.edit',$contact->id) }}" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                    <form id="delete-form-{{ $contact->id }}" action="{{ route('contacts.destroy',$contact->id) }}" style="display: none;" method="POST">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                    </form>
                    <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="if(confirm('Are you sure? You want to delete this?')){
                        event.preventDefault();
                        document.getElementById('delete-form-{{ $contact->id }}').submit();
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
     <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header label-success">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add new {{ucfirst($contact_type)}}</h4>
          </div>
          <form action="{{route('contacts.store')}}" method="post">
              {{csrf_field()}}
            <div class="modal-body">
            <code >* Fields are required, other fields are optional</code>
            @include('backend.contact.form')
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Create Contact</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  
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



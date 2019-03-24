@if ($errors->any())
    <div class="alert alert-danger">
         <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
@endif

@if(session('successMsg'))
    <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
        <span><b>Success - </b> {{ session('successMsg') }}</span>
    </div>
@endif
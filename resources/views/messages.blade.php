@if($errors->any())
    <div class="alert alert-danger">
    <img src="{{ url('public/Image/error.jpg') }}" style="height: 100px; width: 150px;">
        <ul>
            @foreach($errors->all() as $error)
        <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
@if(session('danger'))
    <div class="alert alert-danger">
    
        {{session('danger')}}
    </div>
@endif


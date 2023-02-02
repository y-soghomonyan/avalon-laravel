@extends('user.layout.app')
@section('title')Files @endsection
@section('contents')



<div class="container-fluid  rounded-top bg-white pt-3 px-3">
    <div class="row">
        <div class="col-10">
            <a href="{{route('edit_'.$url, $id)}}">{{$page_title}}</a>
        </div>
        <div class="col-2 text-end">
            {{-- <button class="btn btn-light " id="add_new_account" data-toggle="modal" data-target="#open_account">New</button> --}}
            <button class="btn btn-light " data-toggle="modal" data-target="#create_files">New</button>
        </div>
    </div>
</div>
<div class="container-fluid  rounded-bottom bg-white py-3 px-3">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Owner</th>
                <th>Last Modified</th>
                <th>Created By</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as  $file)
            @php $file_data = $file->file  @endphp
            <tr >
                <td>
                    {{-- <a href="{{ route('edit_account', [$file->id]) }}">{{ $file->tytle ?? 'Untitled Note' }}</a> --}}
                    <a  class="text-primary " href="{{ $file_data->path }}" download>{{$file_data->name??"Untitled Note"}}</a>
                </td>
                <td><a href="{{route('profile')}}">{{ Auth::user()->first_name }}</a></td>
                <td>{{$file_data->updated_at}}</td>
                <td>{{ $file_data->size.' b'?? '' }}</td>
                <td>
                    <a class="" href="{{ $file_data->path }}" download>
                        <svg style="fill: #6AB559" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" fill="none">
                            <path d="M12.5 4V17M12.5 17L7 12.2105M12.5 17L18 12.2105" stroke="#6AB559" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 21H19" stroke="#6AB559" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                     </a>
                    <a class="" href="{{ route('delete_files', [$file->id]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('modals.files')



@endsection
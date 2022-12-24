@extends('user.layout.app')
@section('title')Companies @endsection
@section('contents')

    <div class="container-fluid mt-5 rounded bg-white py-3 px-3">
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2 text-end">
                <button class="btn btn-light " id="add_new_account" data-toggle="modal" data-target="#open_account">New</button>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5 rounded bg-white py-3 px-3">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Company name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Contact Owner Alias</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as  $value)

                <tr{{--id="" data-toggle="modal" data-target="#edit_account_{{$value->id}}"--}}>
                    <td><a href="{{ route('edit_contact', [$value->id]) }}">{{$value->title}}</a></td>
                    <td>{{!empty($value->parentCompany->name) ? $value->parentCompany->name : ""}}</td>
                    <td>{{$value->phone}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->ownerUser->name}}</td>
                    <td>
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">Edit</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item text-primary" href="{{ route('edit_contact', [$value->id]) }}">Edit</a>
                            <a class="dropdown-item text-danger" href="{{ route('delete_contact', [$value->id]) }}">Delete</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <div class="modal " id="open_account">

        <div class="modal-dialog mt-5 modal-xl">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h3 class="modal-title text-center">New Contact</h3>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('add_contact')}}" method="POST">
                        @csrf
                        <div class="">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Contact Information</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <label for="" class="mr-sm-2">Company Name:</label>
                                        <div>
                                            <select class="select2 select_company form-control" name="company_id">
                                                <option selected value="0">Select Company</option>
                                                @foreach($all_companies as $comp)
                                                    <option value="{{$comp->id}}"  >{{$comp->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div>
                                        <label for="" class="mr-sm-2">Contact Owner:</label>
                                        <div>
                                            <select class="select2 select_owner form-control" required name="owner_id">
                                                <option selected value="0">Select Contact Owner</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}"  >{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <label for="" class="mr-sm-2">Solution:</label>
                                    <select class=" form-control" name="solution">
                                        <option selected value="0">Select Solution</option>
                                        <option  value="Mr">Mr.</option>
                                        <option  value="Ms">Ms.</option>
                                        <option  value="Mrs">Mrs.</option>
                                        <option  value="Dr">Dr.</option>
                                        <option  value="Prof">Prof.</option>
                                    </select>

                                    <label for="personal_name" class="mr-sm-2">First Name:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="first_name" value="" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Middle Name:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="middle_name" value="" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Last Name:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="last_name" value="" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Suffix:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="suffix" value="" id="" required>


                                </div>
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2">Title:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="title" value="" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Email:</label>
                                    <input type="email" class="form-control mb-2 mr-sm-2" placeholder="" name="email" value="{{ Auth::user()->email }}" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Phone:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="phone" value="" id="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Additional Information</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2">Mobile:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mobile" value="" id="" >
                                    <label for="personal_name" class="mr-sm-2">Fax:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="fax" value="" id="" >
                                </div>
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2">Reports To:</label>
                                    <div>
                                        <select class="select2 select_reports_emails form-control" required name="reports">
                                            <option selected value="0">Select Reports address</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}"  >{{$user->email}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label for="personal_name" class="mr-sm-2">Department:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="department" value="" id="" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Address Information</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <label for="" class="mr-sm-2">Meiling address:</label>
                                        <div>
                                            <select class="select2 select_emails form-control" name="mailing_address">
                                                <option selected value="0">Select Meiling address</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}"  >{{$user->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label  class="mr-sm-2">Meiling Street:</label>
                                    <textarea  class="form-control" id="" rows="3" name="mailing_street"></textarea>
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="personal_name" class="mr-sm-2">Meiling City:</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing_city" value="" id="" >
                                        </div>
                                        <div class="col-4">
                                            <label for="personal_name" class="mr-sm-2">Meiling State:</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing_state" value="" id="" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="personal_name" class="mr-sm-2">Meiling Country:</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing_country" value="" id="" >
                                        </div>
                                        <div class="col-4">
                                            <label for="personal_name" class="mr-sm-2">Meiling Zip :</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing__zip_code" value="" id="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


@section('js')
    <script>

        $(document).ready(function() {
            $('.select2').each(function(){
                $(this).select2({
                    dropdownParent:  $(this).parent()
                });
            })
        });

    </script>
@endsection

@endsection
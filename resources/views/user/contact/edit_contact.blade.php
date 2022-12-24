@extends('user.layout.app')
@section('title')Edit Contact @endsection
@section('contents')

    <style>
        .sales_blocks {
            display: flex;
            justify-content: space-between;
            background-color: #F3F3F3;
            border:1px solid grey;
            align-items: center;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .sales_blocks button {
            background-color: white;
        }

        .sales_blocks span {
            font-weight: 700;
        }

    </style>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-3">
                <div class="col-12 rounded bg-white py-3 px-3">
                    <div style="border-bottom: 1px solid lightgrey" class="pb-2">
                        <h4>Total Enterprise</h4>
                    </div>
                    <div class="mt-3">
                        <a class="btn btn-light text-primary"  data-toggle="modal" data-target="#edit_account">Edit</a>
                        <a class="btn btn-outline-danger" href="{{ route('delete_contact', [$contact->id]) }}">Delete</a>
                    </div>
                </div>
                <div class="col-12 mt-3 rounded bg-white py-3 px-3">
                    <div class=" contact_info_btn" data-toggle="collapse" data-target="#contact_info_btn">Contact Information</div>
                    <div id="contact_info_btn" class="collapse show">
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="mr-sm-2">Company name:</label>
                            <div>@if(!empty($contact->parentCompany->id)){{$contact->parentCompany->id}}@endif</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="mr-sm-2">Contact name:</label>
                            <div>{{$contact->title}}</div>
                        </div>

                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="mr-sm-2">Contact owner:</label>
                            <div>{{$contact->ownerUser->name}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="mr-sm-2">Email:</label>
                            <div>{{$contact->email}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="mr-sm-2">Phone:</label>
                            <div>{{$contact->phone}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6  ">
                <div class="col-12 rounded bg-white py-3 px-3">
                    <ul class="nav nav-tabs  center_nav_active_style">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#menu1">Activity</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu2">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu3">Sales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu4">Marketing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu5">Service</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane container active" id="menu1">
                            <div class="col-12 mt-3 px-3">
                                <ul class="nav nav-tabs ">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#menu1_1">Email</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu2_1">Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu3_1">Sales</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu4_1">Marketing</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane container active" id="menu1_1">
                                        <form action="">
                                            <div class="row mt-3">
                                                <div class="col-9">
                                                    <input required type="email" class="form-control mb-2 mr-sm-2" placeholder="Write an email..." name="email" value="" id="">
                                                </div>
                                                <div class="col-3">
                                                    <input type="submit" class="form-control mb-2 mr-sm-2 btn btn-primary"  name="submit" value="Compose" >
                                                </div>
                                            </div>
                                        </form>
                                        <div class="col-12 mt-3 px-3">
                                            <div class=" contact_info_btn" data-toggle="collapse" data-target="#upcoming"> Upcoming & Overdue</div>
                                            <div id="upcoming" class="collapse">
                                                <div class="border-bottom mt-2 pt-1 px-2 pb-3">
                                                    <div class="text-center">No activities to show</div>
                                                    <div class="text-center">Get started by sending an email, scheduling a task, and more</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3 px-3">
                                            <div class="text-center">No past activity. Past meetings and tasks marked as done show up here</div>
                                        </div>
                                    </div>
                                    <div class="tab-pane container fade" id="menu2_1">...</div>
                                    <div class="tab-pane container fade" id="menu3_1">...</div>
                                    <div class="tab-pane container fade" id="menu4_1">...</div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu2">
                            <div class="col-12 mt-3 px-3">
                                <div class=" contact_info_btn" data-toggle="collapse" data-target="#additional_info">Additional Information</div>
                                <div id="additional_info" class="collapse show">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Mobile:</label>
                                                    <div>{{$contact->mobile}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Fax:</label>
                                                    <div>{{$contact->fax}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Reports to</label>
                                                    <div>{{$contact->reportsTo && $contact->reportsTo->email ? $contact->reportsTo->email:"" }}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Department</label>
                                                    <div>{{$contact->department}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" contact_info_btn mt-3" data-toggle="collapse" data-target="#address_info">Address Information</div>
                                <div id="address_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Meiling Address:</label>
                                                    <div>{{$contact->mailingAddress && $contact->mailingAddress->email ? $contact->mailingAddress->email : '' }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" contact_info_btn mt-3" data-toggle="collapse" data-target="#system_info">System Information</div>
                                <div id="system_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">

                                                    <div> Created By: {{ Auth::user()->name }}. {{$contact->created_at}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <div>Last Modified By: {{ Auth::user()->name }}. {{$contact->updated_at}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu3">
                            <div class="row mt-3 px-3">
                                <div class="col-12 sales_blocks">
                                    <span>Opportunities (0)</span>
                                    <div><button class="btn btn-outline-primary" >New</button></div>
                                </div>
                                <div class="col-12 sales_blocks">
                                    <span>Contacts (0)</span>
                                    <div><button class="btn btn-outline-primary" >New</button></div>
                                </div>
                                <div class="col-12 sales_blocks">
                                    <span>Orders (0)</span>
                                    <div><button class="btn btn-outline-primary" >New</button></div>
                                </div>
                                <div class="col-12 sales_blocks">
                                    <span>Partners (0)</span>
                                    <div><button class="btn btn-outline-primary" >New</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu4">
                            <div class="row mt-3 px-3">
                                <div class="col-12 sales_blocks">
                                    <span>Campaigns (0)</span>
                                </div>
                                <div class="col-12 sales_blocks">
                                    <span>Campaign influence</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu5">
                            <div class="row mt-3 px-3">
                                <div class="col-12 sales_blocks">
                                    <span>Cases (0)</span>
                                    <div>
                                        <button  class="btn btn-outline-primary" >Change Owner</button>
                                        <button class="btn btn-outline-primary" >New</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 ">
                <div class="col-12 rounded bg-white py-3 px-3">
                </div>
            </div>
        </div>
    </div>

    <div class="modal edit_account" id="edit_account">
        <div class="modal-dialog mt-5 modal-xl">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h3 class="modal-title text-center">Edit Contact</h3>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('edit_contact',[$contact->id])}}" method="POST">
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
                                        <label for="" class="mr-sm-2">Contact Name:</label>
                                        <div>
                                            <select class="select2 select_contact form-control" name="contact_id">
                                                <option  value="0">Select contact</option>
                                                @foreach($all_companies as $comp)

                                                    <option  @if(!empty($contact->parentCompany->id) && $comp->id == $contact->parentCompany->id) {{'selected'}} @else {{""}} @endif >{{$comp->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="" class="mr-sm-2">Contact Owner:</label>
                                        <div>
                                            <select class="select2 select_owner form-control" name="owner_id">
                                                <option selected value="0">Select Contact Owner</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}" @if($user->id == $contact->ownerUser->id) {{'selected'}} @else {{""}} @endif>{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label for="" class="mr-sm-2">Solution:</label>
                                    <select class=" form-control" name="solution">
                                        <option selected value="0">Select Solution</option>
                                        <option  value="Mr"  @if($contact->solution == 'Mr') {{'selected'}} @else {{""}} @endif>Mr.</option>
                                        <option  value="Ms" @if($contact->solution == 'Ms') {{'selected'}} @else {{""}} @endif>Ms.</option>
                                        <option  value="Mrs" @if($contact->solution == 'Mrs') {{'selected'}} @else {{""}} @endif>Mrs.</option>
                                        <option  value="Dr" @if($contact->solution == 'Dr') {{'selected'}} @else {{""}} @endif>Dr.</option>
                                        <option  value="Prof" @if($contact->solution == 'Prof') {{'selected'}} @else {{""}} @endif>Prof.</option>
                                    </select>

                                    <label for="personal_name" class="mr-sm-2">First Name:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="first_name" value="{{$contact->first_name}}" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Middle Name:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="middle_name" value="{{$contact->middle_name}}" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Last Name:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="last_name" value="{{$contact->last_name}}" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Suffix:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="suffix" value="{{$contact->suffix}}" id="" required>


                                </div>
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2">Title:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="title" value="{{$contact->title}}" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Email:</label>
                                    <input type="email" class="form-control mb-2 mr-sm-2" placeholder="" name="email" value="{{$contact->email}}" id="" required>
                                    <label for="personal_name" class="mr-sm-2">Phone:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="phone" value="{{$contact->phone}}" id="" required>
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
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mobile" value="{{$contact->mobile}}" id="" >
                                    <label for="personal_name" class="mr-sm-2">Fax:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="fax" value="{{$contact->fax}}" id="" >
                                </div>
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2">Reports To:</label>
                                    <div>
                                        <select class="select2 select_reports_emails form-control" name="reports">
                                            <option selected value="0">Select Reports address</option>
                                            @foreach($users as $user1)
                                                <option value="{{$user1->id}}" @if($user1->id == $contact->reports) {{'selected'}} @else {{""}} @endif>{{$user1->email}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label for="personal_name" class="mr-sm-2">Department:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="department" value="{{$contact->department}}" id="" >
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
                                                @foreach($users as $user2)
                                                    <option value="{{$user2->id}}" @if($user2->id == $contact->reports) {{'selected'}} @else {{""}} @endif>{{$user2->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label  class="mr-sm-2">Meiling Street:</label>
                                    <textarea  class="form-control" id="" rows="3" name="mailing_street">{{$contact->mailing_street}}</textarea>
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="personal_name" class="mr-sm-2">Meiling City:</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing_city" value="{{$contact->mailing_city}}" id="" >
                                        </div>
                                        <div class="col-4">
                                            <label for="personal_name" class="mr-sm-2">Meiling State:</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing_state" value="{{$contact->mailing_state}}" id="" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="personal_name" class="mr-sm-2">Meiling Country:</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing_country" value="{{$contact->mailing_country}}" id="" >
                                        </div>
                                        <div class="col-4">
                                            <label for="personal_name" class="mr-sm-2">Meiling Zip :</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing__zip_code" value="{{$contact->mailing__zip_code}}" id="" >
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
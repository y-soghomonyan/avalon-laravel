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
                        <h4>{{$company->name}}</h4>
                    </div>
                    <div class="mt-3">
                        <a class="btn btn-light text-primary"  data-toggle="modal" data-target="#edit_account">Edit</a>
                        <a class="btn btn-outline-danger" href="{{ route('destroy_company', [$company->id]) }}">Delete</a>
                    </div>
                </div>
                <div class="col-12 mt-3 rounded bg-white py-3 px-3">
                    <div class=" contact_info_btn" data-toggle="collapse" data-target="#contact_info_btn">Company Details</div>
                    <div id="contact_info_btn" class="collapse show">
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="mr-sm-2">Company name:</label>
                            <div>{{$company->name}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="mr-sm-2">Filing:</label>
                            <div>{{$company->filing}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="mr-sm-2">Filing Status:</label>
                            <div>{{$company->filing_status ? 'Active' : 'Dissolved'}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="mr-sm-2">Country:</label>
                            <div>{{$company->country->name ?? ''}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2 {{empty($company->state->name) ? 'd-none' : ''}}">
                            <label for="personal_name" class="mr-sm-2">State:</label>
                            <div>{{$company->state->name ?? ''}} </div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="mr-sm-2">Company Type:</label>
                            <div>{{$company->companyTypes->name ?? ''}} </div>
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
                                <div class=" contact_info_btn" data-toggle="collapse" data-target="#additional_info">Account Details</div>
                                <div id="additional_info" class="collapse show">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Company & Organization:</label>
                                                    <div>{{$company->parentCompany->name ?? ''}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Contact:</label>
                                                    <div>{{$company->contacts->title ?? ''}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" contact_info_btn mt-3" data-toggle="collapse" data-target="#address_info">Engagement</div>
                                <div id="address_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Type:</label>
                                                    <div>{{$company->type}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Division:</label>
                                                    <div>{{$company->division}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Status:</label>
                                                    <div>{{$company->status ? "Active" : "Dissolved"}}</div>
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

                                                    <div> Created By: {{ Auth::user()->name }}. {{$company->created_at}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <div>Last Modified By: {{ Auth::user()->name }}. {{$company->updated_at}}</div>
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
                    <h3 class="modal-title text-center">Edit Company</h3>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('update-company',[$company->id])}}" method="POST">
                        @csrf
                        <div class="">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Company Details</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2"> Name:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="name" value="{{$company->name}}" id="" required>
                                    <label for="personal_name" class="mr-sm-2"> Filing No:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="filing" value="{{$company->filing}}" id="" required>
                                </div>

                                <div class="col-6">
                                    <div>
                                        <label for="" class="mr-sm-2">Country:</label>
                                        <div>
                                            <select class="select2  form-control" name="country_id" id="countries" required>
                                                <option selected value="">Select Company</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}" {{($country->id == $company->country_id) ? 'selected' : ''}}  >{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class=" {{(empty($company->state_id)) ? 'd-none' : ''}}  " id="country_state">
                                        <label for="" class="mr-sm-2">State:</label>
                                        <div >
                                            <select class="select2  form-control" name="state_id">
                                                <option selected value="">Select State</option>
                                                @foreach($countries as $country)
                                                    @if($country->states->count())
                                                        @foreach($country->states as $state)
                                                            <option value="{{$state->id}}" {{(!empty($company->state_id) && $company->state_id == $state->id) ? 'selected' : ''}} >{{$state->name}}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="" class="mr-sm-2">Company Type:</label>
                                        <div>
                                            <select required class="select2 custom-select form-control" name="company_id">
                                                <option selected value="">Select Company Type</option>
                                                @foreach($company_types as  $company_type)
                                                    <option value="{{$company_type->id}} " {{(!empty($company->company_id) && $company->company_id == $company_type->id) ? 'selected' : ''}}>{{$company_type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="" class="mr-sm-2">Filing Status:</label>
                                        <div>
                                            <select class="select2 select_company form-control" name="filing_status">
                                                <option selected value="">Select Filing Status </option>
                                                <option value="1" {{$company->filing_status ? 'selected' : ''}} >Active</option>
                                                <option value="0" {{!$company->filing_status ? 'selected' : ''}} >Dissolved</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2 mt-3">
                                    <div class="bg-light p-3 h6">Account Details</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <label for="" class="mr-sm-2">Company & Organization:</label>
                                        <div>
                                            <select required class="select2 custom-select form-control" name="company_organization_id">
                                                <option selected value="">Select Company & Organization </option>
                                                @foreach($company_organizations as $company_organization)
                                                    <option value="{{$company_organization->id}}"  {{(!empty($company_organization->id) && $company->company_organization_id == $company_organization->id) ? 'selected' : ''}}>{{$company_organization->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2">Contact:</label>
                                    <div>
                                        <select class="select2 select_reports_emails form-control" required name="contact_id">
                                            <option selected value="">Select Contact </option>
                                            @foreach($contacts as $contact)
                                                <option value="{{$contact->id}}"  {{(!empty($contact->id) && $company->contact_id == $contact->id) ? 'selected' : ''}}>{{$contact->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Engagement</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <label for="" class="mr-sm-2">Type:</label>
                                        <div>
                                            <select class="select2 form-control" name="type">
                                                <option selected value="">Select Types</option>
                                                <option value="Client" {{(!empty($company->type) && $company->type == 'Client') ? 'selected' : ''}}>client</option>
                                                <option value="Readymade" {{(!empty($company->type) && $company->type == 'Readymade') ? 'selected' : ''}}>Readymade</option>
                                                <option value="Group" {{(!empty($company->type) && $company->type == 'Group') ? 'selected' : ''}}>Group</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="" class="mr-sm-2">Division :</label>
                                        <div>
                                            <select class="select2 form-control" name="division">
                                                <option selected value="" >Select Division</option>
                                                <option value="STM Corporate Group" {{(!empty($company->division) && $company->division == 'STM Corporate Group') ? 'selected' : ''}}>STM Corporate Group</option>
                                                <option value="Mount Bonnell Advisors" {{(!empty($company->division) && $company->division == 'Mount Bonnell Advisors') ? 'selected' : ''}}>Mount Bonnell Advisors</option>
                                                <option value="US Corporation & Trust Services" {{(!empty($company->division) && $company->division == 'US Corporation & Trust Services') ? 'selected' : ''}}>US Corporation & Trust Services</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div>
                                        <label for="" class="mr-sm-2">Status:</label>
                                        <div>
                                            <select class="select2 form-control" name="status">
                                                <option selected value="">Select Status</option>
                                                <option value="1"  {{$company->status ? 'selected' : ''}}>Active</option>
                                                <option value="0"  {{!$company->status ? 'selected' : ''}}>Dissolved</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="" class="mr-sm-2">Sub Status:</label>
                                        <div>
                                            <input type="checkbox" value="1" {{$company->sub_status ? 'checked' : ''}} name="sub_status">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Previous Names</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2"> previous name1:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name1" value="{{$company->previous_name1}}" id="" >
                                    <label for="personal_name" class="mr-sm-2"> previous name2:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name2" value="{{$company->previous_name2}}" id="" >

                                </div>
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2"> previous name3:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name3" value="{{$company->previous_name3}}" id="" >
                                    <label for="personal_name" class="mr-sm-2"> previous name4:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name4" value="{{$company->previous_name4}}" id="" >
                                    <label for="personal_name" class="mr-sm-2"> previous name5:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name5" value="{{$company->previous_name5}}" id="" >

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

        $('#countries').change(function () {
            let state = $('#country_state')
            state.val("");
            $("#country_state option:selected").prop("selected", false)
            state.addClass('d-none');
            if($(this).find(':selected').val() == 4){
                state.removeClass('d-none');
            }else{
                state.val(0);
            }
        })

    </script>
@endsection

@endsection
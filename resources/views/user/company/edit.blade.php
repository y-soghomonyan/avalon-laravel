@extends('user.layout.app')
@section('title')Edit Company @endsection
@section('contents')
    <div class="container-fluid mt-5">
        <div class="row-with-float">
            <div class="col-3 px-2 sticky-top">
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
                    <div class=" contact_info_btn collaps_show" data-toggle="collapse" data-target="#contact_info_btn">
                        <svg class="slds-icon slds-icon-text-default slds-icon_x-small  " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                        Company Details
                    </div>
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
                        @include('notifications.forms')
                        <div class="tab-pane container fade" id="menu2">
                            <div class="col-12 mt-3 px-3">
                                <div class=" contact_info_btn collaps_show" data-toggle="collapse" data-target="#additional_info">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    Account Details
                                </div>
                                <div id="additional_info" class="collapse show">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Account:</label>
                                                    <div>{{$company->parentAccount->name ?? ''}}</div>
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
                                <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#address_info">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                     Engagement
                                </div>
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
                                <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#system_info">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    System Information
                                </div>
                                <div id="system_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <div> Created By: {{ Auth::user()->first_name }}. {{$company->created_at}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <div>Last Modified By: {{ Auth::user()->first_name }}. {{$company->updated_at}}</div>
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
                                    <span>Contacts ({{$contacts_count->count()}})</span>
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
                                    <span>Companies ({{$companies_count->count()}})</span>
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
                    @include('notifications.notifications')
                </div>
            </div>
            <div class="col-3 px-2 sticky-top">
                <div class="col-12 rounded bg-white py-3 px-3">
                    <div class="row mt-3">
                        <div class="col-5  df_jsfs_amc">
                            <div  class="icon_small bg_c_tag" >
                                <img src="{{url('image/opportunity_120.png')}}" alt="">
                            </div>
                            <div class="text-info px-2">Opportunities (0)</div>
                        </div>
                        <div class="col-7  df_jsfs_amc">
                           <div  class="icon_small bg_c_quotes" >
                               <img src="{{url('image/quotes_120.png')}}" alt="">
                           </div>
                           <div class="text-info px-2">Quotes (0)</div>
                       </div>
                   </div>
                   <div class="row mt-3">
                       <div class="col-5  df_jsfs_amc">
                           <div  class="icon_small bg_c_cases" >
                               <img src="{{url('image/case_120.png')}}" alt="">
                           </div>
                           <div class="text-info px-2">Cases (0)</div>
                       </div>
                        <div class="col-7  df_jsfs_amc">
                           <div  class="icon_small bg_c_campaign" >
                               <img src="{{url('image/campaign_120.png')}}" alt="">
                           </div>
                           <div class="text-info px-2">Campaign Influence (0)</div>
                        </div>
                    </div>
                    <div class="row mt-3">
                       <div class="col-5  df_jsfs_amc">
                           <div  class="icon_small bg_c_file" >
                               <img src="{{url('image/file_120.png')}}" alt="">
                           </div>
                           <div class="text-info px-2">Files (0)</div>
                       </div>
                        <div class="col-7  df_jsfs_amc">
                            <div  class="icon_small bg_c_notes" >
                                <img src="{{url('image/note_120.png')}}" alt="">
                            </div>
                            <div class="text-info px-2">Notes (0) </div>
                        </div>
                    </div>
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
                                                <option selected value="">Select Country</option>
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
                                            <select class="select2  form-control" name="filing_status">
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
                                        <label for="" class="mr-sm-2">Account:</label>
                                        <div>
                                            <select required class="select2 custom-select form-control" name="account_id">
                                                <option selected value="">Select Account </option>
                                                @foreach($accounts as $account)
                                                    <option value="{{$account->id}}"  {{(!empty($account->id) && $company->account_id == $account->id) ? 'selected' : ''}}>{{$account->name}}</option>
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
                                    <label for="personal_name" class="mr-sm-2"> Previous name 1:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name1" value="{{$company->previous_name1}}" id="" >
                                    <label for="personal_name" class="mr-sm-2"> Previous name 2:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name2" value="{{$company->previous_name2}}" id="" >
                                </div>
                                <div class="col-6">
                                    <label for="personal_name" class="mr-sm-2"> Previous name 3:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name3" value="{{$company->previous_name3}}" id="" >
                                    <label for="personal_name" class="mr-sm-2"> Previous name 4:</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name4" value="{{$company->previous_name4}}" id="" >
                                    <label for="personal_name" class="mr-sm-2"> Previous name 5:</label>
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
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],
            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction
            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],
            ['clean']                                         // remove formatting button
        ];
        var quill = new Quill('#editor', {
            modules: {
            toolbar: toolbarOptions
            },
            theme: 'snow'
        });

        $(document).ready(function() {
            $('.select2').each(function(){
                $(this).select2({
                    dropdownParent:  $(this).parent()
                });
            })
        });

        let editor = $('#editor')
        quill.on('text-change', function(delta, source) {
            $("#hiddenArea").val($("#editor").html());
            var delta = quill.getContents();
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
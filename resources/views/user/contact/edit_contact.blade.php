@extends('user.layout.app')
@section('title')Edit Contact @endsection
@section('contents')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <div class="container-fluid mt-5">
        <div class="row-with-float">
            <div class="col-3 px-2 sticky-top">
                <div class="col-12 rounded bg-white py-3 px-3">
                    <div style="border-bottom: 1px solid lightgrey" class="pb-2">
                        <h4>{{$contact->title}}</h4>
                    </div>
                    <div class="mt-3">
                        <a class="btn btn-light text-primary"  data-toggle="modal" data-target="#edit_account">Edit</a>
                        <a class="btn btn-outline-danger" href="{{ route('delete_contact', [$contact->id]) }}">Delete</a>
                    </div>
                </div>
                <div class="col-12 mt-3 rounded bg-white py-3 px-3">
                    <div class=" contact_info_btn collaps_show" data-toggle="collapse" data-target="#contact_info_btn">
                        <svg class="slds-icon slds-icon-text-default slds-icon_x-small  " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                        Contact Information 
                    </div>
                    <div id="contact_info_btn" class="collapse show">
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="mr-sm-2">Account name:</label>
                            <div>{{$contact->parentAccount->name ?? ''}}</div>
                        </div>
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label for="personal_name" class="mr-sm-2">Contact name:</label>
                            <div>{{$contact->title}}</div>
                        </div>

                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="mr-sm-2">Contact owner:</label>
                            <div>{{$contact->ownerUser->name ?? ""}}</div>
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
            <div class="col-6 px-2">
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

                                    Additional Information 
                                </div>
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
                                                    <div>{{$contact->reportsTo->email ?? '' }}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Department</label>
                                                    <div>{{$contact->department}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#address_info">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>

                                    Address Information
                                </div>
                                <div id="address_info" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Mailing Address:</label>
                                                    <div>{{$contact->mailingAddress->email ?? ''  }}</div>
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
               
                 <div class="col-12 rounded mt-3">
                    <div class="  collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#contacts" style="cursor:pointer">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    <div  class="icon_small bg_c_contact" >
                                        <img src="{{url('image/contact_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Contacts ({{$contacts_count->count()}})</div>
                                </div>
                                <div class=" col-2 offset-2">
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#create_contact">New</button> 
                                </div>

                            </div>
                        </div>
                        <div id="contacts" class="collapse bg-white">
                            <div class=" mt-2 pt-1 px-2 pb-3">
                                @foreach($contacts_count as $contact_)
                                    <div class="mt-3 df_jssb_amc">
                                        <a href="{{ route('edit_contact', [$contact_->id]) }}">{{$contact_->title}}</a>   
                                    </div> 
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 rounded mt-3">
                    <div class="  collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#companies" style="cursor:pointer">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    <div  class="icon_small bg_c_campaign" >
                                        <img src="{{url('image/campaign_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Companies ({{$companies_count->count()}})</div>
                                </div>
                                <div class=" col-2 offset-2">
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#create_company">New</button> 
                                </div>

                            </div>
                        </div>
                        <div id="companies" class="collapse bg-white">
                            <div class="border-bottom mt-2 pt-1 px-2 pb-3">
                                @foreach($companies_count as $company)
                                    <div class="mt-3 df_jssb_amc">
                                        <a href="{{route('edit-company',  [$company->id]) }}">{{$company->name}}</a>
                                    </div> 
                                @endforeach
                            </div>
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
                                            <select class="select2 select_contact form-control" name="account_id" required>
                                                <option  value="">Select contact</option>
                                                @foreach($accounts as $account)
                                                    <option  value="{{$account->id}}" @if(isset($contact->parentAccount->id) && $account->id == $contact->parentAccount->id) {{'selected'}} @else {{""}} @endif >{{$account->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="" class="mr-sm-2">Contact Owner:</label>
                                        <div>
                                            <select class="select2 select_owner form-control" name="owner_id" required>
                                                <option selected value="">Select Contact Owner</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}" @if(!empty($contact->ownerUser->id) && $user->id == $contact->ownerUser->id) {{'selected'}} @else {{""}} @endif>{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label for="" class="mr-sm-2">Solution:</label>
                                    <select class=" form-control" name="solution">
                                        <option selected value="">Select Solution</option>
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
                                        <select class="select2 select_reports_emails form-control" name="reports" required>
                                            <option selected value="">Select Reports address</option>
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
                                        <label for="" class="mr-sm-2">Mailing address:</label>
                                        <div>
                                            <select class="select2 select_emails form-control" name="mailing_address">
                                                <option selected value="">Select Mailing address</option>
                                                @foreach($users as $user2)
                                                    <option value="{{$user2->id}}" @if(!empty($contact->reports) && $user2->id == $contact->reports) {{'selected'}} @else {{""}} @endif>{{$user2->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label  class="mr-sm-2">Mailing Street:</label>
                                    <textarea  class="form-control" id="" rows="3" name="mailing_street">{{$contact->mailing_street}}</textarea>
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="personal_name" class="mr-sm-2">Mailing City:</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing_city" value="{{$contact->mailing_city}}" id="" >
                                        </div>
                                        <div class="col-4">
                                            <label for="personal_name" class="mr-sm-2">Mailing State:</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing_state" value="{{$contact->mailing_state}}" id="" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="personal_name" class="mr-sm-2">Mailing Country:</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="mailing_country" value="{{$contact->mailing_country}}" id="" >
                                        </div>
                                        <div class="col-4">
                                            <label for="personal_name" class="mr-sm-2">Mailing Zip :</label>
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
    @include('modals.contact')

@section('js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
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
            let editor = $('#editor')
            quill.on('text-change', function(delta, source) {
                $("#hiddenArea").val($("#editor").html());
                var delta = quill.getContents();
            });

            $('.select2').each(function(){
                $(this).select2({
                    dropdownParent:  $(this).parent()
                });
            })

            $('#active_show_button').click(()=>{
                $('#active_show_button').remove();
                $("#activity_form").removeClass('d-none')
            })
        });


    </script>
@endsection

@endsection
@extends('user.layout.app')
@section('title')Edit Company @endsection
@section('contents')
    @php
        $file_1 = '';
        $file_2 = '';
        $file_3 = '';
        $file_4 = '';
        foreach ($company->companyFiles as $file) {
            if ($file->file_type == 'file_path_1') {
                $file_1 = $file->path;
            }
            if ($file->file_type == 'file_path_2') {
                $file_2 = $file->path;
            }
            if ($file->file_type == 'file_path_3') {
                $file_3 = $file->path;
            }
            if ($file->file_type == 'file_path_4') {
                $file_4 = $file->path;
            }
        }
        $company->month = $company->month ?? 1;
        $data_month = cal_days_in_month(CAL_GREGORIAN, $company->month, date("Y"));
    @endphp
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
                        <div class="border-bottom mt-2 pt-1 px-2">
                            <label  class="mr-sm-2">Incorporation date:</label>
                            <div>{{$company->incorporation_date ?? ''}} </div>
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
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Sub Status::</label>
                                                    <div><span class="{{$company->sub_status ? '' : 'd-none'}}">Disengagement Pending</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#previous_name">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    Previous Names
                                </div>
                                <div id="previous_name" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Previous name 1:</label>
                                                    <div>{{$company->previous_name1}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Previous name 2:</label>
                                                    <div>{{$company->previous_name2}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Previous name 3:</label>
                                                    <div>{{$company->previous_name3}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Previous name 4:</label>
                                                    <div>{{$company->previous_name4}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Previous name 5:</label>
                                                    <div>{{$company->previous_name5}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" contact_info_btn mt-3 collaps_show" data-toggle="collapse" data-target="#PrimaryTaxRegistration">
                                    <svg class="slds-icon slds-icon-text-default slds-icon_x-small  slds-icon_x-small_rotate" focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                                    Primary Tax Registration
                                </div>
                                <div id="PrimaryTaxRegistration" class="collapse">
                                    <div class=" mt-2 pt-1 px-2 pb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Registration Status:</label>
                                                    <div>{{$company->registration_status}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Tax ID:</label>
                                                    <div>{{$company->tax_id}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Tax Filing Code:</label>
                                                    <div>{{$company->tax_filing_code}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Tax ID Type:</label>
                                                    <div>{{$company->tax_id_type}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Status Date:</label>
                                                    <div>{{$company->status_date}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Link to Tax Registration 1:</label>
                                                    <div class="break-word">{{$file_1}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Link to Tax Registration 2:</label>
                                                    <div class="break-word">{{$file_2}}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Link to Tax Registration 3:</label>
                                                    <div class="break-word">{{$file_3}}</div>
                                                </div>
                                                <div class="border-bottom mt-2 pt-1 px-2">
                                                    <label for="personal_name" class="mr-sm-2">Link to Tax Registration 4:</label>
                                                    <div class="break-word">{{$file_4}}</div>
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
                            <div class="text-info px-2">Notes ({{$notes->count()}})</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 rounded mt-3">
                    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  cursor-pointer" data-toggle="collapse" data-target="#notes" >
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    <div  class="icon_small bg_c_notes" >
                                        <img src="{{url('image/note_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Notes ({{$notes->count()}})</div>
                                </div>
                                <div class=" col-4 text-right">
                                    <button class="btn btn-outline-primary clear_notes_form create_notes" data-toggle="modal" data-target="#create_notes">New</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="notes" class="collapse bg-white rounded-bottom" style="margin-top: -5px;">
                        <div class="pt-1 px-2 pb-3">
                            @foreach($notes as $key => $not)
                                @php if($key > 2)continue; @endphp
                                <div class="mt-3 px-2 border-bottom">
                                    <a data-toggle="modal" data-target="#create_notes"  class="text-primary notes_title_content" id="" data-name="{{$not->title??"Untitled Note"}}" data-file="{{$not->note_file}}">{{$not->title??"Untitled Note"}}</a>
                                    <p>{{$not->created_at}} by <span class="text-primary">{{Auth::user()->first_name}}</span></p>
                                    <p >{!! $not->content !!}</p>
                                    <input type="hidden" value="{{ $not->content }}" class="notes_content">
                                    <input type="hidden" value="{{route('edit_notes', [$not->id])}}" class="notes_action">
                                    <input type="hidden" value="{{ route('delete_notes', [$not->id]) }}" class="notes_delete_hreff">
                                </div> 
                            @endforeach
                        </div>
                        <div class="row text-center py-3">
                            <a href="{{ route('notes', [$url, $id]) }}" class=" text-primary">View All</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 rounded mt-3">
                    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#files" style="cursor:pointer">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    <div  class="icon_small bg_c_file" >
                                        <img src="{{url('image/file_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Files
                                         ({{$files->count()}})
                                    </div>
                                </div>
                                <div class=" col-4 text-right">
                                    <button class="btn btn-outline-primary " data-toggle="modal" data-target="#create_files">New</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="files" class="collapse bg-white rounded-bottom" style="margin-top: -5px;">
                        <div class="  pt-1 px-2 pb-3">
                            @foreach($files as $key => $file)
                                @php if($key > 2)continue; @endphp
                                @php $file_data = $file->file @endphp
                                <div class="mt-3 border-bottom">
                                    <div class="row">
                                        <div class="col-2 ">
                                        <div class="row">
                                            <div class="col-9">
                                                @if(strtok($file_data->type, '/') == 'image')
                                                    <a  data-toggle="modal" data-target="#files_show" class="show_img_full">
                                                        <img src="{{ asset("storage/public/Files/$file_data->path") }}" width="40" height="40" alt="">
                                                        <input type="hidden" class="file_path_for_download" value="{{ asset("storage/public/Files/$file_data->path") }}">
                                                    </a>
                                                @else
                                                    <a href="{{ asset("storage/public/Files/$file_data->path") }}" download>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7F8DE1" width="40" height="40" viewBox="0 0 22 22" id="memory-file"><path d="M13 1V2H14V3H15V4H16V5H17V6H18V7H19V20H18V21H4V20H3V2H4V1H13M13 4H12V8H16V7H15V6H14V5H13V4M5 3V19H17V10H11V9H10V3H5Z"/></svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-10">
                                        <div class="row">
                                            <div class="tooltipblock">
                                                <button class="copy_button">
                                                    <span class="tooltiptext myTooltip" id="myTooltip" >Copy to clipboard</span>
                                                    <p class="text-primary">{{$file_data->name}}</p>
                                                </button>
                                                <input type="hidden" class="file_link" value="{{ asset("storage/public/Files/$file_data->path") }}">
                                           </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">{{$file_data->created_at}}</div>
                                            <div class="col-4">{{$file_data->size}}/b</div>
                                            <div class="col-4">{{$file_data->type ? substr($file_data->type, ($a = strrpos($file_data->type, '/') +1)) : ""}}</div>
                                        </div>
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        </div>
                        <div class="row text-center py-3">
                            <a href="{{ route('files', [$url,$id]) }}" class=" text-primary">View All</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 rounded mt-3">
                    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#address" style="cursor:pointer">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    {{-- <div  class="icon_small " >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" style="width: 3em; height: 3em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1"><path d="M414.3 181.7l-225.8 58.1v548.8l225.8-58.1 196 116.2L836 788.6V239.8l-193.1 48.8" fill="#FFF061"/><path d="M608.8 857.4L412.7 741.2l-234.2 60.3V232l233.3-60 5 19.3-218.3 56.2v528.2l217.3-55.9 196 116.1L826 780.8V252.6l-180.6 45.7-4.9-19.4 205.5-52v569.4z" fill="#6D5346"/><path d="M571.5 510.7l-68 126-64.4-126c-53.7-24.5-93.1-80.5-93.1-140 0-84 71.6-154 157.5-154s157.5 70 157.5 154c0 59.5-35.8 115.5-89.5 140z" fill="#BBE4FF"/><path d="M503.3 658.2l-71.5-139.9c-26.7-12.9-50.6-33.7-67.6-58.9-18.4-27.2-28.1-57.9-28.1-88.7 0-43.3 17.6-84.4 49.5-115.6 31.9-31.2 73.8-48.4 118-48.4s86.1 17.2 118 48.4c31.9 31.2 49.5 72.3 49.5 115.6 0 31.1-9.1 61.7-26.2 88.5-16.5 25.8-39.3 46.2-66.1 59.1l-75.5 139.9z m0.2-431.5c-38.9 0-75.8 15.1-104 42.6-28.1 27.4-43.5 63.4-43.5 101.4 0 26.8 8.5 53.6 24.7 77.5 15.6 23.2 37.9 42.1 62.5 53.4l3.2 1.4 57.4 112.2L564.3 503l3.1-1.4c50-22.8 83.6-75.4 83.6-130.9 0-37.9-15.5-73.9-43.5-101.4-28.1-27.5-65-42.6-104-42.6z" fill="#6D5346"/><path d="M512.3 365.4m-43.8 0a43.8 43.8 0 1 0 87.6 0 43.8 43.8 0 1 0-87.6 0Z" fill="#FFF061"/><path d="M512.3 419.2c-29.6 0-53.8-24.1-53.8-53.8s24.1-53.8 53.8-53.8c29.6 0 53.7 24.1 53.7 53.8s-24.1 53.8-53.7 53.8z m0-87.5c-18.6 0-33.8 15.1-33.8 33.8s15.1 33.8 33.8 33.8S546 384 546 365.4s-15.1-33.7-33.7-33.7z" fill="#6D5346"/><path d="M608.5 846.7v-350" fill="#FFF061"/><path d="M598.5 496.7h20v350h-20z" fill="#6D5346"/><path d="M416 248.7v-67" fill="#FFF061"/><path d="M406 181.7h20v67h-20z" fill="#6D5346"/><path d="M416 724.2V496.7" fill="#FFF061"/><path d="M406 496.7h20v227.5h-20z" fill="#6D5346"/><path d="M469.5 217.7l-62.2-37" fill="#FFF061"/><path d="M402.203 189.316l10.224-17.188 62.22 37.011-10.223 17.188z" fill="#6D5346"/></svg>
                                    </div> --}}
                                    <div  class="icon_small bg_c_campaign" >
                                        <img src="{{url('image/campaign_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Address
                                         ({{$addresses->count()}})
                                    </div>
                                </div>
                                <div class=" col-4 text-right">
                                    <button class="btn btn-outline-primary " data-toggle="modal" data-target="#use_address">New</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="address" class="collapse bg-white rounded-bottom" style="margin-top: -5px;">
                        <div class="  pt-1 px-3 pb-3">
                            @foreach($addresses as $key => $address)
                                <div class="mt-3 border-bottom pb-1">
                                    <div class="row main_address cursor-pointer" data-toggle="modal" data-target="#chose_address" data-all-data="{{$address}}">
                                        <div class="col-8">{{$address->title??"Unknown name"}}</div>
                                        <div class="col-4">
                                            @foreach($address->addressRelation as $add_rel)
                                                @if($add_rel->company_id == $id && !empty($add_rel->address_type))
                                                    <span class="bg_c_quotes badge badge-success">Main Address</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        </div>
                        <div class="row text-center py-3">
                            <a href="{{ route('addresses') }}" class=" text-primary">View All</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 rounded mt-3">
                    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#corporate_appointments" style="cursor:pointer">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="df_jsfs_amc col-8">
                                    {{-- <div  class="icon_small bg_c_campaign" >
                                        <img src="{{url('image/campaign_120.png')}}" alt="">
                                    </div> --}}
                                    <div  class="icon_small bg_c_tag" >
                                        <img src="{{url('image/opportunity_120.png')}}" alt="">
                                    </div>
                                    <div class="text-info px-2">Corporate Appointments
                                         ({{$corporate_appointments->count()}})
                                    </div>
                                </div>
                                <div class=" col-4 text-right">
                                    <button class="btn btn-outline-primary " data-toggle="modal" data-target="#create_corporate_appointments">New</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="corporate_appointments" class="collapse bg-white rounded-bottom" style="margin-top: -5px;">
                        <div class="  pt-1 px-3 pb-3">
                            @foreach($corporate_appointments as $key => $cor_app)
                                <div class="mt-3 border-bottom">
                                    <div class="row pb-1">
                                        <div class="col-8 edit_corporate_appointments cursor-pointer text-primary" data-toggle="modal" data-target="#edit_corporate_appointments" data-corporate_appointments="{{$cor_app}}">{{$cor_app->title}}</div>
                                        <div class="col-2">
                                            @if(!$cor_app->status)
                                                <span class="bg-success badge badge-success">Active</span>
                                            @else
                                                <span class="bg-danger badge badge-success">Ceased</span>
                                            @endif
                                        </div>
                                        <div class="col-2 text-center">
                                            <a href="{{ route('delete_corporate_appointments', [$cor_app->id]) }}" >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal edit_account " id="edit_account">
        <div class="modal-dialog mt-5 modal-xl">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h3 class="modal-title text-center">Edit Company</h3>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('edit-company',[$company->id])}}" method="POST">
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
                                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="filing" value="{{$company->filing}}" id="" >
                                    <label for="personal_name" class="mr-sm-2">Incorporation date</label>
                                    <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="incorporation_date" value="{{$company->incorporation_date}}" id="" >
                                    <div class="row">
                                        <div class="col-12"><label for="personal_name" class="mr-sm-2">Accounting Reference Date</label></div>
                                        <div class="col-6">
                                            <div>
                                                <select class="select2  form-control  mr-sm-2" name="month" id="month">
                                                    @foreach($months as $key =>$month)
                                                        <option value="{{$key+1}}" {{$company->month == $key+1 ?"selected" : ""}}  >{{$month}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="months_day">
                                                <select class="select2 custom-select form-control" name="day">
                                                    @for($i=1; $i<= $data_month; $i++)
                                                        <option value="{{$i}}"  {{$company->day == $i ?"selected" : ""}}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <label for="" class="mr-sm-2">Country:</label>
                                        <div>
                                            <select class="select2  form-control" name="country_id" id="countries" >
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
                                                            @if($state->country_id == 4)
                                                                <option value="{{$state->id}}" {{(!empty($company->state_id) && $company->state_id == $state->id) ? 'selected' : ''}} >{{$state->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="" class="mr-sm-2">Company Type:</label>
                                        <div>
                                            <select  class="select2 custom-select form-control" name="company_id">
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
                                            <select  class="select2 custom-select form-control" name="account_id">
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
                                        <select class="select2 select_reports_emails form-control"  name="contact_id">
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
                                                <option value="Client" {{(!empty($company->type) && $company->type == 'Client') ? 'selected' : ''}}>Client</option>
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
                                                <option value="1" {{$company->status ? 'selected' : ''}}>Active</option>
                                                <option value="0" {{!$company->status ? 'selected' : ''}}>Dissolved</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="" class="mr-sm-2">Sub Status:</label>
                                        <div>
                                            <input type="checkbox" value="1" {{$company->sub_status ? 'checked' : ''}} name="sub_status" id="sub_status">
                                            <label for="sub_status">Disengagement Pending</label>
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
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <div class="bg-light p-3 h6">Primary Tax Registration</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="" class="mr-sm-2">Registration Status</label>
                                    <div>
                                        <select class="select2 form-control" name="registration_status">
                                            <option selected value="">Select Registration Status</option>
                                            <option value="0" {{(!empty($company->registration_status) && $company->registration_status == '0') ? 'selected' : ''}} >Not Registered for Tax</option>
                                            <option value="1" {{(!empty($company->registration_status) && $company->registration_status == '1') ? 'selected' : ''}}>Registered for Tax </option>
                                            <option value="2" {{(!empty($company->registration_status) && $company->registration_status == '2') ? 'selected' : ''}}>Submitted. Awaiting Tax ID </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="" class="mr-sm-2">Tax ID Type</label>
                                    <input type="text" class="tax_id_type form-control" name=""  value="{{$company->tax_id_type}}" disabled>
                                    <input type="hidden" class="tax_id_type form-control" name="tax_id_type"  value="{{$company->tax_id_type}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6"> 
                                    <label for="" class="mr-sm-2">Tax ID</label>
                                    <input  class="form-control" id="" rows="3" name="tax_id" value="{{$company->tax_id}}">
                                </div>
                                <div class="col-6">
                                    <label for="" class="mr-sm-2">Status Date</label>
                                    <input type="date" class="status_date form-control" name="status_date" value="{{substr($company->status_date,0,10)}}">
                                    <button class="btn btn-primary today_button mt-2">Today</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="" class="mr-sm-2">Tax Filing Code</label>
                                    <input  class="form-control" id="" rows="3" name="tax_filing_code" value="{{$company->tax_filing_code}}">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-6"> 
                                    <label for="" class="mr-sm-2">Link to Tax Registration 1</label>
                                    <input type="file" name="file_1" id="file_path_1" class="create_file form-control">
                                    <p class=" text-primary">Upload the file or paste the link below</p>
                                    <input name="file_path_1" class=" form-control link_file" id="" value="{{$file_1??''}}">
                                    <input type="hidden" class="file_link" value="{{ asset("storage/public/Files/$file_1") }}">
                                </div>
                                <div class="col-6"> 
                                    <label for="" class="mr-sm-2">Link to Tax Registration 2</label>
                                    <input type="file" name="file_2" id="file_path_2" class="create_file form-control">
                                    <p class=" text-primary">Upload the file or paste the link below</p>
                                    <input name="file_path_2" class=" form-control link_file" id="" value="{{$file_2??''}}">
                                    <input type="hidden" class="file_link" value="{{ asset("storage/public/Files/$file_2") }}">
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-6"> 
                                    <label for="" class="mr-sm-2">Link to Tax Registration 3</label>
                                    <input type="file" name="file_3" id="file_path_3" class="create_file form-control">
                                    <p class=" text-primary">Upload the file or paste the link below</p>
                                    <input name="file_path_3" class=" form-control link_file" id="" value="{{$file_3??''}}">
                                    <input type="hidden" class="file_link" value="{{ asset("storage/public/Files/$file_3") }}">
                                </div>
                                <div class="col-6"> 
                                    <label for="" class="mr-sm-2">Link to Tax Registration 4</label>
                                    <input type="file" name="file_4" id="file_path_4" class="create_file form-control">
                                    <p class=" text-primary">Upload the file or paste the link below</p>
                                    <input name="file_path_4" class=" form-control link_file" id="" value="{{$file_4??''}}">
                                    <input type="hidden" class="file_link" value="{{ asset("storage/public/Files/$file_4") }}">
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
    @include('modals.corporate_appointments')
    @include('modals.address')
    @include('modals.notes')
    @include('modals.files')
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

            $('#countries').change(function (e) {
                let state = $('#country_state')
                state.val("");
                $("#country_state option:selected").prop("selected", false)
                state.addClass('d-none');
                if($(this).find(':selected').val() == 4){
                    state.removeClass('d-none');
                }else{
                    state.val(0);
                }

                let selected_element = $(e.currentTarget);
                let select_val = selected_element.val();
                let tax_id_data = {4:"EIN", 5:"UTR", 6:"Tax Reference"};
                let tax_id_type = $('.tax_id_type')
                if(tax_id_data[select_val]){
                    tax_id_type.val(tax_id_data[select_val])
                }else{
                    tax_id_type.val('Other')
                }
            })


            $(document).ready(function(){

                // $('.create_file').on('change', function(){
                //     let company_id = '<?= $company->id?>';
                //     let file_data = $(this).prop("files")[0];
                //     let form_data = new FormData(); 
                //     form_data.append("file", file_data);
                //     form_data.append("file_type", $(this).attr('id'));
                //     form_data.append("company_id",company_id)

                //     $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                //     });
                //     $.ajax({
                //         type:"POST",
                //         // url:'/update_file_company',
                //         url:'/uploade_file_company',
                    
                //         cache: false,
                //         contentType: false,
                //         processData: false,
                //         data: form_data, 
                //         success: (response) => {
                //             if (response.code == 400) {
                //             }else if(response.code == 200){
                //                 let text = response.msg;
                //                 $(this).parent().find('.link_file').html(text)
                //                 // let origin = window.location.origin; 
                //                 // $(this).parent().find('.file_link').val(origin+'/storage/public/Files/'+text)
                //                 // $(this).parent().find('p').removeClass('d-none')
                //                 // $(this).parent().find('p').text(text);
                //             }
                //         }
                //     })

                // })

                const copyToClipboard = str => {
                    const el = document.createElement('textarea');
                    el.value = str;
                    document.body.appendChild(el);
                    el.select();
                    document.execCommand('copy');
                    document.body.removeChild(el);
                };
                // $('.link_file').on('click', function(){
                //     let copyText = $(this).parent().find(".file_link");
                //     copyToClipboard( copyText.val() );
                // })

                $('.today_button').on('click', function(e){
                    e.preventDefault();
                    let date = $('.status_date');
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yy = today.getFullYear();
                    today = yy + '-' + mm + '-' + dd;
                    date.val(today)
                })
            })

        </script>
    @endsection

@endsection
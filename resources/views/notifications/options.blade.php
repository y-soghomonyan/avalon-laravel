<div class="col-12 rounded bg-white py-3 px-3">
    <div class="row mt-3">
        <div class="col-5  df_jsfs_amc">
            <div  class="icon_small bg_c_contact" >
                <img src="{{url('image/contact_120.png')}}" alt="">
            </div>
            <div class="text-info px-2"><a class="text-info text_d_n" href="{{ route('contacts_by_account', [$account->id]) }}"> Contacts ({{$contacts_count->count()}})</a></div>
        </div>
        <div class="col-7  df_jsfs_amc">
            <div  class="icon_small bg_c_tag" >
                <img src="{{url('image/opportunity_120.png')}}" alt="">
            </div>
            <div class="text-info px-2">Opportunities (0)</div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-5  df_jsfs_amc">
            <div  class="icon_small " >
                <img src="{{url('image/account_partner_120.png')}}" alt="">
            </div>
            <div class="text-info px-2">Partners (0)</div>
        </div>
        <div class="col-7  df_jsfs_amc">
            <div  class="icon_small bg_c_cases" >
                <img src="{{url('image/case_120.png')}}" alt="">
            </div>
            <div class="text-info px-2">Cases (0)</div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-5  df_jsfs_amc">
            <div  class="icon_small bg_c_campaign" >
                <img src="{{url('image/campaign_120.png')}}" alt="">
            </div>
            <div class="text-info px-2"><a class="text-info text_d_n"  href="{{ route('companies_by_account', [$account->id]) }}"> Companies ({{$companies_count->count()}}) </a></div>
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
            <div  class="icon_small bg_c_notes" >
                <img src="{{url('image/note_120.png')}}" alt="">
            </div>
            <div class="text-info px-2">Notes ({{$notes->count()}}) </div>
        </div>

        <div class="col-7  df_jsfs_amc">
            <div  class="icon_small bg_c_file" >
                <img src="{{url('image/file_120.png')}}" alt="">
            </div>
            <div class="text-info px-2">Files ({{$files->count()}})</div>
        </div>
    </div>
</div>
<div class="col-12 rounded mt-3">
    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#contacts" style="cursor:pointer">
        <div class="col-12 ">
            <div class="row">
                <div class="df_jsfs_amc col-8">
                    <div  class="icon_small bg_c_contact" >
                        <img src="{{url('image/contact_120.png')}}" alt="">
                    </div>
                    <div class="text-info px-2">Contacts ({{$contacts_count->count()}})</div>
                </div>
                <div class=" col-4 text-right">
                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#create_contact">New</button> 
                </div>
            </div>
        </div>
        <div id="contacts" class="collapse bg-white">
            <div class=" mt-2 pt-1 px-2 pb-3">
                @foreach($contacts_count as $contact)
                    <div class="mt-3 df_jssb_amc">
                        <a href="{{ route('edit_contact', [$contact->id]) }}">{{$contact->title}}</a>   
                    </div> 
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="col-12 rounded mt-3">
    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#companies" style="cursor:pointer">
        <div class="col-12 ">
            <div class="row">
                <div class="df_jsfs_amc col-8">
                    <div  class="icon_small bg_c_campaign" >
                        <img src="{{url('image/campaign_120.png')}}" alt="">
                    </div>
                    <div class="text-info px-2">Companies ({{$companies_count->count()}})</div>
                </div>
                <div class=" col-4 text-right">
                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#create_company">New</button> 
                </div>
            </div>
        </div>
        <div id="companies" class="collapse bg-white">
            <div class="border-bottom mt-2 pt-1 px-2 pb-3">
                @foreach($companies_count as $company)
                    <div class="mt-3 df_jssb_amc">
                        <a href="{{route('edit_company',  [$company->id]) }}">{{$company->name}}</a>
                    </div> 
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="col-12 rounded mt-3">
    <div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#notes" style="cursor:pointer">
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
        <div class="  pt-1 px-2 pb-3">
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
            <a href="{{ route('notes', [$url,$id]) }}" class=" text-primary">View All</a>
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
                    <div class="text-info px-2">Address ({{$addresses->count()}})</div>
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
                <div class="mt-3 border-bottom">
                    <div class="row main_address cursor-pointer" data-toggle="modal" data-target="#chose_address" data-all-data="{{$address}}">
                        <div class="col-8">{{$address->title??"Unknown name"}}</div>
                        <div class="col-4">
                            @foreach($address->addressRelation as $add_rel)
                                @if($add_rel->account_id == $id && !empty($add_rel->address_type))
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
{{--<div class="col-12 rounded mt-3">--}}
    {{--<div class=" account_info_btn collaps_show rounded px-3 py-2 bg-white  " data-toggle="collapse" data-target="#corporate_appointments" style="cursor:pointer">--}}
        {{--<div class="col-12 ">--}}
            {{--<div class="row">--}}
                {{--<div class="df_jsfs_amc col-8">--}}
                    {{-- <div  class="icon_small bg_c_campaign" >--}}
                        {{--<img src="{{url('image/campaign_120.png')}}" alt="">--}}
                    {{--</div> --}}
                    {{--<div  class="icon_small bg_c_tag" >--}}
                        {{--<img src="{{url('image/opportunity_120.png')}}" alt="">--}}
                    {{--</div>--}}
                    {{--<div class="text-info px-2">Corporate Appointments ({{$corporate_appointments->count()}})</div>--}}
                {{--</div>--}}
                {{--<div class=" col-4 text-right">--}}
                    {{--<button class="btn btn-outline-primary " data-toggle="modal" data-target="#create_corporate_appointments">New</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div id="corporate_appointments" class="collapse bg-white rounded-bottom" style="margin-top: -5px;">--}}
        {{--<div class="  pt-1 px-3 pb-3">--}}
            {{--@foreach($corporate_appointments as $key => $cor_app)--}}
                {{--<div class="mt-3 border-bottom">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-9 edit_corporate_appointments cursor-pointer text-primary" data-toggle="modal" data-target="#edit_corporate_appointments" data-corporate_appointments="{{$cor_app}}">{{$cor_app->title}}</div>--}}
                        {{--<div class="col-3">--}}
                            {{--<a href="{{ route('delete_corporate_appointments', [$cor_app->id]) }}" >--}}
                                {{--<svg xmlns="http://www.w3.org/2000/svg" class="slds-delete__icon" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"/><path d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"/></svg>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div> --}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

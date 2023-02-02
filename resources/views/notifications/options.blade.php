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
                    <button class="btn btn-outline-primary clear_notes_form" data-toggle="modal" data-target="#create_notes">New</button>
                </div>
            </div>
        </div>
    </div>
    <div id="notes" class="collapse bg-white rounded-bottom" style="margin-top: -5px;">
        <div class="  pt-1 px-2 pb-3">
            @foreach($notes as $key => $not)
            @php if($key > 2)continue; @endphp
            <div class="mt-3 px-2 border-bottom">
                <a data-toggle="modal" data-target="#create_notes"  class="text-primary notes_title_content" id="">{{$not->title??"Untitled Note"}}</a>
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
                            <p class="text-primary">{{$file_data->name}}</p>
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

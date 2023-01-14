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
            <div class="text-info px-2">Notes (0) </div>
        </div>

        <div class="col-7  df_jsfs_amc">
            <div  class="icon_small bg_c_file" >
                <img src="{{url('image/file_120.png')}}" alt="">
            </div>
            <div class="text-info px-2">Files (0)</div>
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
                <div class=" col-2 offset-2">
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
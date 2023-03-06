<div class="modal" id="create_company" >
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">New Company</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('create_company')}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Company Details</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="col-12">
                                    <label for="personal_name" class=""> Name</label>
                                    <input type="text" class="form-control mb-2 " placeholder="" name="name" value="" id="" required>
                                </div>
                                <div class="col-12">
                                    <label for="personal_name" class=""> Filing No</label>
                                    <input type="text" class="form-control mb-2 " placeholder="" name="filing" value="" id="" >
                                </div>
                                <div class="col-12">
                                    <label for="personal_name" class="">Incorporation date</label>
                                    <input type="date" class="form-control mb-2 " placeholder="" name="incorporation_date" value="" id="" >
                                </div>
                                <div class="row">
                                    <div class="col-12"><label for="personal_name" class="">Accounting Reference Date</label></div>
                                    <div class="col-6">
                                        <div>
                                            <select class="select2  form-control  " name="month" id="month">
                                                @foreach($months as $key =>$month)
                                                    <option value="{{$key+1}}" {{$key == 11 ? "selected" : ""}} >{{$month}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="months_day">
                                            <select class="select2 custom-select form-control" name="day">
                                                @for($i=1; $i<= 31; $i++)
                                                    <option value="{{$i}}"   {{$i == 31 ? "selected" : ""}}>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <label for="" class="">Country</label>
                                    <div>
                                        <select class="select2  form-control  " name="country_id" id="countries">
                                            <option selected value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}"  >{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="d-none mt-2" id="country_state">
                                    <label for="" class="">State</label>
                                    <div >
                                        <select class="select2  form-control" name="state_id">
                                            <option selected value="">Select State</option>
                                            @foreach($countries as $country)
                                                @if($country->states->count())
                                                    @foreach($country->states as $state)
                                                        @if($state->country_id == 4)
                                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2 ">
                                    <label for="" class="">Company Type</label>
                                    <div>
                                        <select  class="select2 custom-select form-control  " name="company_id">
                                            <option selected value="">Select Company Type</option>
                                                @foreach($company_types as  $company_type)
                                                    <option value="{{$company_type->id}}" >{{$company_type->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2 ">
                                    <label for="" class="">Filing Status</label>
                                    <div>
                                        <select class="select2  form-control  " name="filing_status">
                                            <option selected value="">Select Filing Status </option>
                                            <option value="1">Active</option>
                                            <option value="0">Dissolved</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2 mt-3">
                                <div class="bg-light p-3 h6">Company Activity</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <textarea name="company_activity"class="form-control" ></textarea>
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
                                    <label for="" class="">Account</label>
                                    <div>
                                        <select  class="select2 custom-select form-control" name="account_id">
                                            <option selected value="">Select Account</option>
                                            @foreach($accounts as $account)
                                                <option value="{{$account->id}}">{{$account->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-6">
                                <label for="personal_name" class="">Contact</label>
                                <div>
                                    <select class="select2 select_reports_emails form-control"  name="contact_id">
                                        <option selected value="">Select Contact </option>
                                        @foreach($contacts as $contact)
                                            <option value="{{$contact->id}}"  >{{$contact->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Engagement</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <label for="" class="">Type</label>
                                    <div>
                                        <select class="select2 form-control" name="type">
                                            <option selected value="">Select Types</option>
                                            <option value="Client">Client</option>
                                            <option value="Readymade">Readymade</option>
                                            <option value="Group">Group</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label for="" class="">Division </label>
                                    <div>
                                        <select class="select2 form-control" name="division">
                                            <option selected value="">Select Division</option>
                                            <option value="STM Corporate Group">STM Corporate Group</option>
                                            <option value="Mount Bonnell Advisors">Mount Bonnell Advisors</option>
                                            <option value="US Corporation & Trust Services">US Corporation & Trust Services</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <label for="" class="">Status</label>
                                    <div>
                                        <select class="select2 form-control" name="status">
                                            <option selected value="">Select Status</option>
                                            <option value="1"  >Active</option>
                                            <option value="0"  >Dissolved</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label for="" class="">Sub Status</label>
                                    <div>
                                        <input type="checkbox" value="1" name="sub_status" id="sub_status">
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
                                <label for="personal_name" class=""> Previous name 1</label>
                                <input type="text" class="form-control mb-2 " placeholder="" name="previous_name1" value="" id="" >
                                <label for="personal_name" class=""> Previous name 2</label>
                                <input type="text" class="form-control mb-2 " placeholder="" name="previous_name2" value="" id="" >
                            </div>
                            <div class="col-6">
                                <label for="personal_name" class=""> Previous name 3</label>
                                <input type="text" class="form-control mb-2 " placeholder="" name="previous_name3" value="" id="" >
                                <label for="personal_name" class=""> Previous name 4</label>
                                <input type="text" class="form-control mb-2 " placeholder="" name="previous_name4" value="" id="" >
                                <label for="personal_name" class=""> Previous name 5</label>
                                <input type="text" class="form-control mb-2 " placeholder="" name="previous_name5" value="" id="" >
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Primary Tax Registration</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label for="" class="">Registration Status</label>
                                <div>
                                    <select class="select2 form-control" name="registration_status">
                                        <option selected value="">Select Registration Status</option>
                                        <option value="0"  >Not Registered for Tax</option>
                                        <option value="1"  >Registered for Tax </option>
                                        <option value="2"  >Submitted. Awaiting Tax ID </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="">Tax ID Type</label>
                                <input type="text" class="tax_id_type form-control" name="" disabled>
                                <input type="hidden" class="tax_id_type form-control" name="tax_id_type" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6"> 
                                <label for="" class="">Tax ID</label>
                                <input  class="form-control" id="" rows="3" name="tax_id">
                            </div>
                            <div class="col-6"> 
                                <label for="" class="">Status Date</label>
                                <input type="date" class="status_date form-control" name="status_date" >
                                <button class="btn btn-primary today_button mt-2">Today</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="" class="">Tax Filing Code</label>
                                <input  class="form-control" id="" rows="3" name="tax_filing_code">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6"> 
                                <label for="" class="">Link to Tax Registration 1</label>
                                <input type="file" name="file_1" id="file_1" class="create_file form-control">
                                <p class=" text-primary">Upload the file or paste the link below</p>
                                <input name="file_path_1" class=" form-control link_file" id="" >
                                <input type="hidden" class="file_link" value="">
                            </div>
                            <div class="col-6"> 
                                <label for="" class="">Link to Tax Registration 2</label>
                                <input type="file" name="file_2" id="file_2" class="create_file form-control">
                                <p class=" text-primary">Upload the file or paste the link below</p>
                                <input name="file_path_2" class=" form-control link_file" id="">
                                <input type="hidden" class="file_link" value="">
                            </div>
                        </div>

                        <div class="row mt-3 mb-3">
                            <div class="col-6"> 
                                <label for="" class="">Link to Tax Registration 3</label>
                                <input type="file" name="file_3" id="file_3" class="create_file form-control">
                                <p class=" text-primary">Upload the file or paste the link below</p>
                                <input name="file_path_3" class=" form-control link_file" id="">
                                <input type="hidden" class="file_link" value="">
                            </div>
                            <div class="col-6"> 
                                <label for="" class="">Link to Tax Registration 4</label>
                                <input type="file" name="file_4" id="file_4" class="create_file form-control">
                                <p class=" text-primary">Upload the file or paste the link below</p>
                                <input name="file_path_4" class=" form-control link_file" id="">
                                <input type="hidden" class="file_link" value="">
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="bg-light p-3 h6">IRS Standard Correspondence Address</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6"> 
                                <label for="" class="">Address 1</label>
                                <input type="text" name="address1" id="" class=" form-control" >
                            </div>
                            <div class="col-6"> 
                                <label for="" class="">Address 2</label>
                                <input type="text" name="address2" id="" class=" form-control" >
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6"> 
                                <label for="" class="">City</label>
                                <input type="text" name="city" id="" class=" form-control" >
                            </div>
                            <div class="col-6"> 
                                <label for="" class="">ZIP</label>
                                <input type="text" name="zip" id="" class=" form-control" >
                            </div>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-6"> 
                                <label for="" class="">State </label>
                                <textarea name="correspondence_state" class="form-control"></textarea>
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

<script>
    $(document).ready(function(){

        // $('.create_file').on('change', function(){
            
        //     var file_data = $(this).prop("files")[0];
        //     var form_data = new FormData(); 
        //     form_data.append("file", file_data) 
        //     form_data.append("file_type", $(this).attr('id')) 

        //     $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        //     });
        //     $.ajax({
        //         type:"POST",
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
        //                 // var origin = window.location.origin; 
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

        $("#countries").select2().on("select2:select", function (e) {
                let selected_element = $(e.currentTarget);
                let select_val = selected_element.val();
                let tax_id_data = {4:"EIN", 5:"UTR", 6:"Tax Reference"};
                let tax_id_type = $('.tax_id_type')
                if(tax_id_data[select_val]){
                    tax_id_type.val(tax_id_data[select_val])
                }else{
                    tax_id_type.val('Other')
                }
        });

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
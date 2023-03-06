<div class="modal " id="tax_returns_modal">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">New Tax Return</h4>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="row">
                        <div class="col-12">
                            <label  class="mr-sm-2">Select the tax year end</label>
                            <div id="tax_returns_years_block" class="mt-2">
                                @if(!empty($tax_years) && $tax_years !== 'wrong')
                                <select  class="select2 custom-select form-control" name="account_id">
                                    @foreach($tax_years as $tax_year)
                                        <option value="{{$tax_year}}"> {{$tax_year}}</option>
                                    @endforeach
                                </select>
                                @elseif($tax_years == 'wrong')
                                    <p class="text-danger">Please make sure that an incorporation date and an accounting reference date is set before creating a tax return.</p>
                                @else
                                    <p class="text-danger">There are no completed tax years. Please try again once the first tax year for the company has been completed.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="" value="{{$company->id}}"  id="company_id">
                    
                    <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary create_new_tax_returns">Save</button>
                        <button type="button" class="btn btn-danger close_modal_tax_returns" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" class="newtax_returns_modal_open" data-toggle="modal" data-target="#tax_returns_modal2">
<input type="hidden" class="company_type_for_tax_returns" value="{{$company->company_id??0}}">
<input type="hidden" class="company_country_for_tax_returns" value="{{$company->country_id??0}}">
{{-- @php
$tax_returns_due_date = '';
$UK2 = [3,4];
if(!empty($company->country_id)){
    if($company->country_id == 4){
        $tax_returns_due_date = date("Y").'-04-15';
    }elseif ($company->country_id == 5 &&  in_array($company->company_id, $UK2) ) {
        $tax_returns_due_date = date("Y").'-01-31';
    }


}

@endphp --}}

<div class="modal " id="tax_returns_modal2" style="">
    <div class="modal-dialog mt-5 modal-lg">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">New Tax Return</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline tax_return_form" action="{{route('create_tax_returns')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="company_id" id="" value="{{$id}}">
                    <input type="hidden" name="company_name" id="" value="{{$page_title}}">
                    <div class="">
                        <div class="row mb-3 mt-2 p-events-n" >
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Year Start Date</label>
                                <input type="date" class="form-control tax_returns_tax_start" value="" name="start_date" id="tax_returns_start_date" >
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Year End Date</label>
                                <input type="date" class="form-control tax_returns_tax_end" value="" name="tax_end" >
                                <input type="hidden" value="" id="tax_returns_due_date">
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Return Due Date</label>
                                <input type="date" class="form-control tax_returns_due_date" value="" name="due_date" data-addNewYear="">
                                <input type="hidden" value="" id="tax_returns_due_date">
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Return Type</label>
                                <div>
                                    <select  class="select2 custom-select form-control tax_return_type" name="tax_return_type" id=''>
                                        <option value="1" {{!empty($company->companyTypes->id) &&  $company->companyTypes->id == 1 ? "selected" :''}}>1120 (Corporation)</option>
                                        <option value="2" {{!empty($company->companyTypes->id) &&  $company->companyTypes->id == 3 ? "selected" :''}}>1120 (Foreign Disregarded Entity)</option>
                                        <option value="3" {{!empty($company->companyTypes->id) &&  $company->companyTypes->id == 4 ? "selected" :''}}>1065 (Partnership)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Return Status</label>
                                <div>
                                    <select  class="select2 custom-select form-control" name="status" id=''>
                                        <option value="1">Not Filed</option>
                                        <option value="2">Filed</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Company Status for this Tax Year</label>
                                <div>
                                    <select  class="select2 custom-select form-control" name="company_status" id=''>
                                        <option value="1">Dormant (never traded)</option>
                                        <option value="2">Non trading (but traded before)</option>
                                        <option value="3">Trading</option>
                                        <option value="4">Disregarded Entity</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12 form_7004_link"></div>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-primary generate_form_7004">Generate</button>
                                        <input type="hidden" name="generate_file" class="generate_file">
                                    </div>
                                    {{-- <div class="col-8">
                                        <input type="file" value="" name="generate_file_link" class="form-control ">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label  class="mr-sm-2">Filing Extension 7004; File Upload / Link </label>
                                <input type="file" name="filing_extension" id="" class="form-control">
                                <input type="text" name="filing_extension_link" id="" class="form-control mb-3 mt-2">
                                <div class="col-12 form_7004_link"></div>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Return Link; File Upload / Link</label>
                                <input type="file" name="file" id="" class="form-control">
                                <input type="text" name="file_link" id="" class="form-control mb-3 mt-2">
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


<div class="modal " id="show_tax_returns" style="">
    <div class="modal-dialog mt-5 modal-lg">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Tax Return</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline tax_return_form" action="{{route('edit_tax_returns')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tax_id" id="tax_id">
                    <input type="hidden" name="company_name" id="" value="{{$page_title}}">
                    <div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label class="mr-sm-2 ">Tax Year Start Date</label>
                                <input type="date" value="" name="start_date" class="form-control tax_returns_start_date_show " disabled>
                                <input type="hidden" value="" name="" class="form-control tax_returns_start_date_show tax_returns_tax_start" >
                                {{-- <p  class="form-control1 tax_returns_start_date_show" id=""></p> --}}
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2 ">Tax Year End Date</label>
                                <input type="date" value="" name="tax_end" class="form-control tax_returns_end_date_show " disabled>
                                <input type="hidden" value=""  class="form-control tax_returns_end_date_show tax_returns_tax_end" >
                                {{-- <p  class="form-control1 tax_returns_end_date_show" id=""></p> --}}

                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label class="mr-sm-2 ">Tax Return Due Date</label>
                                <input type="date" value="" name="due_date" class="form-control tax_returns_due_date_show">
                                {{-- <p class="form-control1 tax_returns_due_date_show" ></p> --}}
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Return Type</label>
                                <div>
                                    <select  class="select2 custom-select form-control tax_return_type" name="tax_return_type" id='tax_return_type'>
                                        <option value="1">1120 (Corporation)</option>
                                        <option value="2">1120 (Foreign Disregarded Entity)</option>
                                        <option value="3">1065 (Partnership)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label class="mr-sm-2 ">Tax Return Status</label>
                                <div>
                                    <select  class="select2 custom-select form-control tax_returns_status_show"  name="status" id=''>
                                        <option value="1">Not Filed</option>
                                        <option value="2">Filed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2 ">Company Status for this Tax Year</label>
                                <div>
                                    <select  class="select2 custom-select form-control tax_returns_company_status_show" name="company_status" id=''>
                                        <option value="1">Dormant (never traded)</option>
                                        <option value="2">Non trading (but traded before)</option>
                                        <option value="3">Trading</option>
                                        <option value="4">Disregarded Entity</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <div class="row">

                                    <div class="col-4">
                                        <button type="button" class="btn btn-primary generate_form_7004">Generate</button>
                                        <input type="hidden" name="generate_file" class="generate_file">
                                    </div>
                                    {{-- <div class="col-8">
                                        <input type="file" value="" name="generate_file_link" class="form-control ">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        
                        {{-- <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="text" value="" class="form-control link_of_generate">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row mb-3 mt-2">
                            <div class="col-6">
                                <label  class="mr-sm-2">Filing Extension 7004; File Upload / Link </label>
                                <input type="file" name="filing_extension" id="" class="form-control">
                                <input type="text" name="filing_extension_link" id="filing_extension" class="form-control mb-3 mt-2">
                                <div class="col-12 form_7004_link form_7004_link_edit"></div>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2 ">Tax Return Link; File Upload / Link</label>
                                <input type="file" value="" name="file" class="form-control ">
                                <input type="text" value="" name="file_link" class="form-control tax_returns_file_path_show mt-2">
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

        $('.show_tax_returns').on('click', function(){
            let data = $(this).data('tax_returns');
            // console.log(data);
            let tax_status = {'1':'Not Filed', '2':'Filed'};
            // let tax_company_status = {
            //     '1' : 'Dormant (never traded)',
            //     '2' : 'Non trading (but traded before)',
            //     '3' : 'Trading',
            //     '4' : 'Disregarded Entity',
            // };
            let tax_returns_start_date_show = $('.tax_returns_start_date_show');
            let tax_returns_end_date_show = $('.tax_returns_end_date_show');
            let tax_returns_due_date_show = $('.tax_returns_due_date_show');
            let tax_returns_status_show = $('.tax_returns_status_show');
            let tax_returns_company_status_show = $('.tax_returns_company_status_show');
            let tax_return_type = $('#tax_return_type');

            let tax_returns_file_path_show = $('.tax_returns_file_path_show');
            let tax_id = $('#tax_id');
            tax_returns_start_date_show.val('');
            tax_returns_end_date_show.val('');
            tax_returns_due_date_show.val('');
            tax_returns_file_path_show.val('');
            tax_id .val('');

            $('.link_of_generate').val('');

            tax_returns_status_show.val(1).trigger('change.select2');
            tax_returns_company_status_show.val(1).trigger('change.select2');

            if(data.status){
               tax_returns_status_show.val(data.status).trigger('change.select2');
            }

            if(data.company_status){
               tax_returns_company_status_show.val(data.company_status).trigger('change.select2');
            }

            if(data.tax_return_type){
                tax_return_type.val(data.tax_return_type).trigger('change.select2');
            }
            $('.form_7004_link_edit').empty();
            if(data.pdf_file){
                $('.link_of_generate').val(data.pdf_file.path);
            }

            tax_returns_start_date_show.val(data.tax_start);
            tax_returns_end_date_show.val(data.tax_end);
            tax_returns_due_date_show.val(data.due_date);
            tax_returns_file_path_show.val(data.file_path);

            if(data.pdf_file && data.pdf_file.path){
                $('#filing_extension').val(data.pdf_file.path)
                $('.form_7004_link_edit').append('<a href="'+data.pdf_file.path+'" target="_blank" class="text-succsess mb-2">Open File</a>');
            }
           
            tax_id .val(data.id);
        })

        $('.generate_form_7004').on('click', function(){
            let tax_end = $(this).parents('.tax_return_form').find('.tax_returns_tax_end').val()
            // console.log(tax_end);
            let tax_start = $(this).parent().parent().parent().parent().parent().parent('.tax_return_form').find('.tax_returns_tax_start').val()
            let company_id = '<?= $company->id?>';
            let tax_return_type = $(this).parent().parent().parent().parent().parent().parent('.tax_return_form').find('.tax_return_type').val()

            $(this).parent().find('.generate_file').val('');

            $(this).html('Loading ...')
            $(this).attr('disabled',true);
            $(this).parents('.tax_return_form').find('.form_7004_link').empty();

            // return ;
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type:"POST",
                url:'/edit_pdf',
                datatType : 'json',
                data: {company_id : company_id, tax_end : tax_end,tax_start:tax_start , tax_return_type: tax_return_type}, 
                success: (response) => {
                    console.log(response);
                    if (response.code == 400) {
                    }else if(response.code == 200){
                        let text = response.msg;
                        $(this).parent().find('.generate_file').val(response.msg);
                        $(this).parents('.tax_return_form').find('.form_7004_link').append('<a href="'+text+'" target="_blank" class="text-succsess mb-2">Open File</a>');
                        $(this).html('Generate')
                        $(this).attr('disabled',false);
                    }
                }
            })
        })

    })
</script>
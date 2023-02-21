<div class="modal " id="tax_returns_modal">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">New Tax Returns</h4>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="row">
                        <div class="col-12">
                            <label  class="mr-sm-2">Select the tax year end</label>
                            <div id="tax_returns_years_block" class="mt-2">
                                @if(!empty($tax_years))
                                <select  class="select2 custom-select form-control" name="account_id">
                                    @foreach($tax_years as $tax_year)
                                        <option value="{{$tax_year}}"> {{$tax_year}}</option>
                                    @endforeach
                                </select>
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
                <h3 class="modal-title text-center">New Tax Returns</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('create_tax_returns')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="company_id" id="" value="{{$id}}">
                    <div class="">
                        <div class="row mb-3 mt-2 p-events-n" >
                            <div class="col-6">
                                <label  class="mr-sm-2">Tax Year Start Date</label>
                                <input type="date" class="form-control " value="" name="start_date" id="tax_returns_start_date" >
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
                <div class="row mb-3 mt-2">
                    <div class="col-6">
                        <label class="mr-sm-2 f-w-bold">Tax Year Start Date</label>
                        <p  class="form-control1 tax_returns_start_date_show" id=""></p>
                    </div>
                    <div class="col-6">
                        <label class="mr-sm-2 f-w-bold">Tax Year End Date</label>
                        <p  class="form-control1 tax_returns_end_date_show" id=""></p>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-6">
                        <label class="mr-sm-2 f-w-bold">Tax Return Due Date</label>
                        <p class="form-control1 tax_returns_due_date_show" ></p>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-6">
                        <label class="mr-sm-2 f-w-bold">Tax Return Status</label>
                        <p class="tax_returns_status_show"> </p>
                    </div>
                    <div class="col-6">
                        <label class="mr-sm-2 f-w-bold">Company Status for this Tax Year</label>
                        <p class="tax_returns_company_status_show"></p>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-6">
                        <label  class="mr-sm-2 f-w-bold">Tax Return Link; File Upload / Link</label>
                        <p class="tax_returns_file_path_show "></p>
                        {{-- <input type="file" name="file" id="" class="form-control"> --}}
                        {{-- <input type="text"  id="" class="form-control mb-3 mt-2"> --}}
                    </div>
                </div>
                <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function(){

        $('.show_tax_returns').on('click', function(){
            let data = $(this).data('tax_returns');
            let tax_status = {'1':'Not Filed', '2':'Filed'};
            let tax_company_status = {
                '1' : 'Dormant (never traded)',
                '2' : 'Non trading (but traded before)',
                '3' : 'Trading',
                '4' : 'Disregarded Entity',

            };
            let tax_returns_start_date_show = $('.tax_returns_start_date_show');
            let tax_returns_end_date_show = $('.tax_returns_end_date_show');
            let tax_returns_due_date_show = $('.tax_returns_due_date_show');
            let tax_returns_status_show = $('.tax_returns_status_show');
            let tax_returns_company_status_show = $('.tax_returns_company_status_show');
            let tax_returns_file_path_show = $('.tax_returns_file_path_show');

            tax_returns_start_date_show.html('');
            tax_returns_end_date_show.html('');
            tax_returns_due_date_show.html('');
            tax_returns_status_show.html('');
            tax_returns_company_status_show.html('');
            tax_returns_file_path_show.html('');

            tax_returns_start_date_show.html(data.tax_start);
            tax_returns_end_date_show.html(data.tax_end);
            tax_returns_due_date_show.html(data.due_date);
            tax_returns_file_path_show.html(data.file_path);
            tax_returns_company_status_show.html(tax_company_status[data.company_status]);
            tax_returns_status_show.html(tax_status[data.status]);
            console.log(data);
        })

    })
</script>
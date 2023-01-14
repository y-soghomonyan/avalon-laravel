<div class="modal " id="create_company">

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
                                <label for="personal_name" class="mr-sm-2"> Name:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="name" value="" id="" required>
                                <label for="personal_name" class="mr-sm-2"> Filing No:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="filing" value="" id="" required>
                            </div>
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2">Country:</label>
                                    <div>
                                        <select class="select2  form-control" name="country_id" id="countries">
                                            <option selected value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}"  >{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="d-none" id="country_state">
                                    <label for="" class="mr-sm-2">State:</label>
                                    <div >
                                        <select class="select2  form-control" name="state_id">
                                            <option selected value="">Select State</option>
                                            @foreach($countries as $country)
                                                @if($country->states->count())
                                                    @foreach($country->states as $state)
                                                        <option value="{{$state->id}}">{{$state->name}}</option>
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
                                                    <option value="{{$company_type->id}}" >{{$company_type->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label for="" class="mr-sm-2">Filing Status:</label>
                                    <div>
                                        <select class="select2  form-control" name="filing_status">
                                            <option selected value="">Select Filing Status </option>
                                            <option value="1"  >Active</option>
                                            <option value="0"  >Dissolved</option>
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
                                            <option selected value="">Select Account</option>
                                            @foreach($accounts as $account)
                                                <option value="{{$account->id}}">{{$account->name}}</option>
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
                                            <option value="{{$contact->id}}"  >{{$contact->title}}</option>
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
                                            <option value="Client">client</option>
                                            <option value="Readymade">Readymade</option>
                                            <option value="Group">Group</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label for="" class="mr-sm-2">Division :</label>
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
                                    <label for="" class="mr-sm-2">Status:</label>
                                    <div>
                                        <select class="select2 form-control" name="status">
                                            <option selected value="">Select Status</option>
                                            <option value="1"  >Active</option>
                                            <option value="0"  >Dissolved</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label for="" class="mr-sm-2">Sub Status:</label>
                                    <div>
                                        <input type="checkbox" value="1" name="sub_status">
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
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name1" value="" id="" >
                                <label for="personal_name" class="mr-sm-2"> Previous name 2:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name2" value="" id="" >
                            </div>
                            <div class="col-6">
                                <label for="personal_name" class="mr-sm-2"> Previous name 3:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name3" value="" id="" >
                                <label for="personal_name" class="mr-sm-2"> Previous name 4:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name4" value="" id="" >
                                <label for="personal_name" class="mr-sm-2"> Previous name 5:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="previous_name5" value="" id="" >
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

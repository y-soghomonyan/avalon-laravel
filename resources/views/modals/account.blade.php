<div class="modal " id="open_account">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button" class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">New Account</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('add_account')}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Account Information</div>
                            </div>
                            <div class="col-6 d-lg-flex justify-content-around">
                                <div>
                                    <input required type="radio" class="account_personality_type" name="account_personality_type" value="1" id="business_account" checked>
                                    <label for="business_account" class="mr-sm-2">Business</label>
                                </div>
                                <div>
                                    <input required type="radio" class="account_personality_type" name="account_personality_type" value="0" id="personal_account">
                                    <label for="personal_account" class="mr-sm-2">Individual</label>
                                </div>
                            </div>

                            <div class="col-6 d-flex flex-column account_classification_bisnes">
                                <label for="parent_account w-100" class="mr-sm-2">Parent account:</label>
                                <select class="select2 form-control" name="parent_id">
                                    <option selected value="">Select Parent Account</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}">{{$account->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 d-flex flex-column account_classification_indevidual d-none">
                                <label for="parent_account w-100" class="mr-sm-2">Email:</label>
                                <input type="email" name="email" id="" class="form-control">
                            </div>

                            <div class="col-6 " id="business_account_name">
                                <label for="personal_name" class="mr-sm-2">Account name:</label>
                                <input required type="text" class="form-control mb-2 mr-sm-2" placeholder="Account name" name="name" value="" id="account_name">
                            </div>
                            <div class="col-6 d-none " id="personal_account_name">
                                <label for="personal_name" class="mr-sm-2">First name:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2 personal_account_name" placeholder="First name"  value="" id="first_name">
                                <label for="personal_name" class="mr-sm-2">Last name:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2 personal_account_name" placeholder="Last name"  value="" id="last_name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Account owner:</label>
                                <div>
                                    <select class="select2 custom-select form-control" name="owner_id">
                                        @if($users)
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" {{ Auth::user()->id == $user->id? 'selected': '' }} >{{$user->first_name. ' ' . $user->last_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Type:</label>
                                <div>
                                    <select class="select2 custom-select form-control" name="account_type_id">
                                        @foreach($account_types as  $account_type)
                                            <option value="{{$account_type->id}}" {{$account_type->name == 'Client' ? "selected" : ""}}>{{$account_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Phone:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="phone" value="" name="account_phone" >
                            </div>
                            <div class="col-6 account_classification_bisnes">
                                <label class="mr-sm-2">Industry:</label>
                                <div>
                                    <select class="select2 custom-select form-control" name="industry_id">
                                        @foreach($industries_types as  $industries_type)
                                            <option value="{{$industries_type->id}}" {{$industries_type->name == 'Other' ? "selected" : ""}}>{{$industries_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Website:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Website" value="" name="website" >
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Phone:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Phone" value="" name="additional_phone" >
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Description:</label>
                                <textarea class="form-control" id="" rows="3" name="description"></textarea>
                            </div>
                            <div class="col-6 account_classification_bisnes">
                                <label class="mr-sm-2">Employees:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="Employees" value="" name="employees" >
                            </div>
                        </div> --}}

                        {{-- <div class="row">
                            <div class="col-12 mb-2 mt-2">
                                <div class="bg-light p-3 h6">Address Information</div>
                            </div>
                            <div class="col-6">
                                <div class="w-100 fw-bold mb-2">Address</div>
                                <label class="mr-sm-2">Address Street:</label>
                                <textarea class="form-control" id="" rows="3" name="address_1_street"></textarea>
                            </div>
                            <div class="col-6">
                                <div class="w-100 fw-bold mb-2">Additional Address</div>
                                <label class="mr-sm-2">Additional Address Street:</label>
                                <textarea class="form-control" id="" rows="3" name="address_2_street"></textarea>
                            </div>
                        </div> --}}
                        {{-- <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Address Country:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_1_country" >
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Additional Address Country:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_2_country" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Address City:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_1_city" >
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Additional Address City:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_2_city" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Address State:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_1_state" >
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Additional Address State:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_2_state" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Address zip code:</label>
                                <input  type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_1_zip_code" >
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Additional Address zip code:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="" name="address_2_zip_code" >
                            </div> --}}
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
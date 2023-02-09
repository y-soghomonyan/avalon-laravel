<div class="modal " id="create_corporate_appointments">
    <div class="modal-dialog mt-5 modal-lg">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">New Corporate Appointments</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('add_corporate_appointments')}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-6">
                                <label  class="mr-sm-2">Title</label>
                                <input type="text" name="title" class="form-control  mr-sm-2" id="">
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Account</label>
                                <div>
                                    <select  class="select2 custom-select form-control" name="account_id">
                                      <option value=""></option>
                                      @foreach($accounts as $account)
                                        <option value="{{$account->id}}" {{$url.'_id' == 'account_id' && $id == $account->id ? "selected" : ""}}>{{$account->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label  class="mr-sm-2">Company</label>
                                <div>
                                    <select  class="select2 custom-select form-control" name="company_id">
                                      <option value=""></option>
                                      @foreach($companies as $company)
                                        <option value="{{$company->id}}" {{$url.'_id' == 'company_id' && $id == $company->id ? "selected" : ""}}>{{$company->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Contact</label>
                                <div>
                                    <select  class="select2 custom-select form-control" name="contact_id">
                                      <option value=""></option>
                                      @foreach($contacts as $contact)
                                        <option value="{{$contact->id}}">{{$contact->title}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-20 mt-3">
                            <div>
                                <input type="checkbox" name="position_1" class="" id="position_1" value="1">
                                <label for="position_1" class="mr-sm-2">Is Director</label>
                            </div>
                            <div>
                                <input type="checkbox" name="position_2" class="" id="position_2" value="1">
                                <label for="position_2" class="mr-sm-2">Is Manager</label>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <h5 class="mr-sm-2">Roles</h5>
                        </div>
                        <div class="d-flex gap-20 mt-3 mb-3">
                            @foreach($appointments_roles as $appointments_role)
                                <div>
                                    <input type="checkbox" name="role_id[]" value="{{$appointments_role->id}}" id="appointments_role_{{$appointments_role->id}}">
                                    <label for="appointments_role_{{$appointments_role->id}}" class="mr-sm-2">{{$appointments_role->title}}</label>
                                </div>
                            @endforeach
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

<div class="modal " id="edit_corporate_appointments" style="">
        <div class="modal-dialog mt-5 modal-lg">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h3 class="modal-title text-center">Edit Corporate Appointments</h3>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('update_corporate_appointments')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="corporate_appointment_id" value="">
                        <div class="">
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Title</label>
                                    <input type="text" name="title" class="form-control  mr-sm-2" id='corporate_appointment_title'>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Account</label>
                                    <div>
                                        <select  class="select2 custom-select form-control" name="account_id" id='corporate_appointment_account_id'>
                                          <option value=""></option>
                                          @foreach($accounts as $account)
                                            <option value="{{$account->id}}">{{$account->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label  class="mr-sm-2">Company</label>
                                    <div>
                                        <select  class="select2 custom-select form-control" name="company_id" id='corporate_appointment_company_id'>
                                          <option value=""></option>
                                          @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label  class="mr-sm-2">Contact</label>
                                    <div>
                                        <select  class="select2 custom-select form-control" name="contact_id" id='corporate_appointment_contact_id'>
                                          <option value=""></option>
                                          @foreach($contacts as $contact)
                                            <option value="{{$contact->id}}">{{$contact->title}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-20 mt-3">
                                <div>
                                    <input type="checkbox" name="position_1" class=""  value="1" id='corporate_appointment_position_1'>
                                    <label for="corporate_appointment_position_1" class="mr-sm-2">Is Director</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="position_2" class=""  value="1" id='corporate_appointment_position_2'>
                                    <label for="corporate_appointment_position_2" class="mr-sm-2">Is Manager</label>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <h5  class="mr-sm-2">Roles</h5>
                            </div>
                            <div class="d-flex gap-20 mt-3 mb-3">
                                
                                @foreach($appointments_roles as $appointments_role)
                                    <div>
                                        <input type="checkbox" name="role_id[]" class="appointments_role"  value="{{$appointments_role->id}}" id="cor_appointments_role_{{$appointments_role->id}}">
                                        <label for="cor_appointments_role_{{$appointments_role->id}}" class="mr-sm-2">{{$appointments_role->title}}</label>
                                    </div>
                                @endforeach
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

        $(".edit_corporate_appointments").on("click", function (e) {

            let data = $(this).data('corporate_appointments'); 
            let appointments_roles = $('.appointments_role');
            let corporate_appointment_title = $('#corporate_appointment_title').val(data.title); 
            let corporate_appointment_id = $('#corporate_appointment_id').val(data.id);

            for( let id in data.roles){
                $('#cor_appointments_role_'+ data.roles[id].id).attr('checked', 'checked');
            }

            if(data.position_1 == 1){
                $('#corporate_appointment_position_1').attr('checked', 'checked')
            }
            if(data.position_2 == 1){
                $('#corporate_appointment_position_2').attr('checked', 'checked')
            }

            let $account =  $('#corporate_appointment_account_id');
            $account.val(data.account_id).trigger('change.select2');

            let $contact =  $('#corporate_appointment_contact_id');
            $contact.val(data.contact_id).trigger('change.select2');

            let $company =  $('#corporate_appointment_company_id');
            $company.val(data.company_id).trigger('change.select2');
            
        });
    })
</script>
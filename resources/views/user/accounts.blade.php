@extends('user.config.app')
@section('title')Companies @endsection
@section('contents')


<div class="container-fluid">
    <div class="row">
        <div class="col-10"></div>
        <div class="col-2">
            <button class="btn btn-light" id="add_new_account" data-toggle="modal" data-target="#open_account">New</button>
        </div>
    </div>
</div>
<div class="container-fluid">

    <a href="#page_items" class="btn btn-primary" data-toggle="collapse">Companies</a>


    <div id="page_items" class="collapse py-3" style="padding:30px;">
        <table class="table table-hover">
            <thead>
              <tr>
                <th>Company name</th>
                <th>Paren Company</th>
                <th>Type</th>
                <th>Industry</th>
                <th>Acoount phone</th>
                <th>Additional phone</th>
                <th>Employees</th>
                <th>Website</th>
                <th>Address_1 Country</th>
                <th>Address_1 City</th>
                <th>Address_1 State</th>
                <th>Address_1 Street</th>
                <th>Address_1 zip code</th>
                <th>Address_2  Country</th>
                <th>Address_2  City</th>
                <th>Address_2  State</th>
                <th>Address_2  Street</th>
                <th>Address_2  zip code</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
                @foreach($companies as  $value) 
               
                <tr id="" data-toggle="modal" data-target="#edit_account_{{$value->id}}">
                    <td>{{$value->name}}</td>
                    <td>{{$value->parentCompany->name}}</td>
                    <td>{{$value->companyTypes->name}}</td>
                    <td>{{$value->industriesTypes->name}}</td>
                    <td>{{$value->company_phone}}</td>
                    <td>{{$value->additional_phone}}</td>
                    <td>{{$value->employees}}</td>
                    <td>{{$value->website}}</td>
                    <td>{{$value->address_1_country}}</td>
                    <td>{{$value->address_1_city}}</td>
                    <td>{{$value->address_1_state}}</td>
                    <td>{{$value->address_1_street}}</td>
                    <td>{{$value->address_1_zip_code}}</td>
                    <td>{{$value->address_2_country}}</td>
                    <td>{{$value->address_2_city}}</td>
                    <td>{{$value->address_2_state}}</td>
                    <td>{{$value->address_2_street}}</td>
                    <td>{{$value->address_2_zip_code}}</td>
                    <td>{{$value->description}}
                        <div class="modal" id="edit_account_{{$value->id}}">
                            <div class="modal-dialog">
                                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                              <div class="modal-content">
                              
                                <div class="">
                                  <h4 class="modal-title text-center">Edit Company</h4>
                                 
                                </div>
                          
                                <div class="modal-body">
                                    <div class="row">
                        
                                        <button class="btn btn-light mb-2" id="">Personal</button>
                                        <button  class="btn btn-light mb-2" id="">Bissnes</button>
                                    </div>
                                    <form class="" action="{{ route('edit_account', [$value->id]) }}" method="POST">
                                        @csrf
                                            <div class="">
                                        
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="personal_name" class="mr-sm-2">Company name:</label>
                                                    
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Company name" name="name" value="{{$value->name}}" id="">
                            
                                                        <input type="hidden" value="{{ Auth::user()->name }}" id=""  class="">
                                                    
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="parent_account" class="mr-sm-2">Parent account:</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->parentCompany->name}}"  name="parent_company" id="">
                                                        {{-- <input type="hidden"  name="parent_account" value="1"  id="parent_account_val"> --}}
                                                    </div>
                                                </div>
                            
                                            
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Account owner:</label>
                                                        <div> {{ Auth::user()->name }}</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Type:</label>
                                                        <select  class="custom-select" name="company_id">
                                                            @foreach($company_types as  $company_type) 
                                                                <option value="{{$company_type->id}}" @if($company_type->id == $value->companyTypes->id) {{'selected'}} @else {{""}} @endif>{{$company_type->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                        
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Phone:</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="phone" value="{{$value->company_phone}}" name="company_phone" >
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Industry:</label>
                                                        <select  class="custom-select" name="industry_id">
                                                            @foreach($industries_types as  $industries_type) 
                                                                <option value="{{$industries_type->id}}" @if($industries_type->id == $value->industriesTypes->id) {{'selected'}} @else {{""}} @endif>{{$industries_type->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                            
                            
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Website:</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Website" value="{{$value->website}}" name="website" >
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Phone:</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Phone" value="{{$value->additional_phone}}" name="additional_phone" >
                                                    </div>
                                                </div>
                            
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Description:</label>
                                                        <textarea class="form-control" id="" rows="3" name="description">{{$value->description}}</textarea>
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Employees:</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Employees" value="{{$value->employees}}" name="employees" >
                                                    </div>
                                                </div>
                            
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Address_1 Street:</label>
                                                        <textarea class="form-control" id="" rows="3" name="address_1_street">{{$value->address_1_street}}</textarea>
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Address_2 Street:</label>
                                                        <textarea class="form-control" id="" rows="3" name="address_2_street">{{$value->address_2_street}}</textarea>
                                                    </div>
                                                </div>
                            
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Address_1 Country:</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_1_country}}" name="address_1_country" >
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Address_2 Country:</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_2_country}}" name="address_2_country" >
                                                    </div>
                                                </div>
                            
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Address_1 City:</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_1_city}}" name="address_1_city" >
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Address_2 City:</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_2_city}}" name="address_2_city" >
                                                    </div>
                                                </div>
                            
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Address_1 State:</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_1_state}}" name="address_1_state" >
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Address_2 State:</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_2_state}}" name="address_2_state" >
                                                    </div>
                                                </div>
                                            
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Address_1 zip code:</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_1_zip_code}}" name="address_1_zip_code" >
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="mr-sm-2">Address_2 zip code:</label>
                                                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" value="{{$value->address_2_zip_code}}" name="address_2_zip_code" >
                                                    </div>
                                                </div>
                                        
                                        
                                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                    </td>
                </tr>   
              @endforeach
            </tbody>
          </table>
    </div>
</div>

 


<div class="modal" id="open_account">
    <div class="modal-dialog">
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      <div class="modal-content">
      
        <div class="">
          <h4 class="modal-title text-center">New Account</h4>
         
        </div>
  
        <div class="modal-body">
            <div class="row">

                <button class="btn btn-light mb-2" id="personal">Personal</button>
                <button  class="btn btn-light mb-2" id="bissnes">Bissnes</button>
            </div>
            <form class="form-inline" action="{{ route('add_account') }}" method="POST">
                @csrf
                <div class="container">
            
                    <div class="row">
                        <div class="col-6">
                            <label for="personal_name" class="mr-sm-2">Account name:</label>
                        
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Account name" name="name" id="personal_name">

                            <input type="hidden" value="{{ Auth::user()->name }}" id="bissnes_name"  class="">
                           
                        </div>
                        <div class="col-6">
                            <label for="parent_account" class="mr-sm-2">Parent account:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="name" value="1"  name="parent_account" id="parent_account">
                            {{-- <input type="hidden"  name="parent_account" value="1"  id="parent_account_val"> --}}
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6">
                            <label  class="mr-sm-2">Account owner:</label>
                            <div> {{ Auth::user()->name }}</div>
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Type:</label>
                            <select  class="custom-select" name="company_id">
                                @foreach($company_types as  $value) 
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>
               
                    <div class="row">
                        <div class="col-6">
                            <label  class="mr-sm-2">Phone:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="phone" name="company_phone" >
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Industry:</label>
                            <select  class="custom-select" name="industry_id">
                                @foreach($industries_types as  $value) 
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6">
                            <label  class="mr-sm-2">Website:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Website" name="website" >
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Phone:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Phone" name="additional_phone" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label  class="mr-sm-2">Description:</label>
                            <textarea class="form-control" id="" rows="3" name="description"></textarea>
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Employees:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Employees" name="employees" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label  class="mr-sm-2">Address_1 Street:</label>
                            <textarea class="form-control" id="" rows="3" name="address_1_street"></textarea>
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Address_2 Street:</label>
                            <textarea class="form-control" id="" rows="3" name="address_2_street"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label  class="mr-sm-2">Address_1 Country:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="address_1_country" >
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Address_2 Country:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="address_2_country" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label  class="mr-sm-2">Address_1 City:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="address_1_city" >
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Address_2 City:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="address_2_city" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label  class="mr-sm-2">Address_1 State:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="address_1_state" >
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Address_2 State:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="address_2_state" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label  class="mr-sm-2">Address_1 zip code:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="address_1_zip_code" >
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Address_2 zip code:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="address_2_zip_code" >
                        </div>
                    </div>
               
               
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </div>
              </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
       $('#bissnes').click(function(){
        $('#personal_name').removeAttr('name');
        $('#personal_name').hide();
        $('#bissnes_name').attr('name', 'name');
       })

       $('#personal').click(function(){
        $('#personal_name').show();
        $('#personal_name').attr('name', 'name');
        $('#bissnes_name').removeAttr('name');
       })


       $('#parent_account').on('change',function(){
      
      let parent_account = $(this).val();
      $.ajax({
            url:'get_parent_account_ajax',
            type:"post",
            datatType : 'json',
            data: {"parent_account" : parent_account, "_token": "{{ csrf_token() }}"},
           
          success: function(resonse){
          
            if(resonse !== null){
              //  console.log(resonse.length);
                for(let i = 0; i<=resonse.length; i++){
              //  console.log(resonse[i].name);
            }
            // for (let prop of resonse) {
            
            //    // for (let res  in prop) {
            //     console.log(prop.id);
            //  //   }
            // // $('#parent_account_val').val(resonse.id);
            //   }
            }
          },
       })
    })
    })
  </script>
@endsection
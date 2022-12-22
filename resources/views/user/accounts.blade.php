@extends('user.config.app')
@section('title')Accounts @endsection
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

    <a href="#page_items" class="btn btn-primary" data-toggle="collapse">Accounts</a>


    <div id="page_items" class="collapse py-3" style="padding:30px;">fhgh
    
    
    
        <table class="table table-hover">
            <thead>
              <tr>
                <th>Account name</th>
                <th>Paren account</th>
                <th>Type</th>
                <th>Industry</th>
                <th>Acoount phone</th>
                <th>Additional phone</th>
                <th>Employees</th>
                <th>Website</th>
                <th>Billing Country</th>
                <th>Billing City</th>
                <th>Billing State</th>
                <th>Billing Street</th>
                <th>Billing zip code</th>
                <th>Shipping  Country</th>
                <th>Shipping  City</th>
                <th>Shipping  State</th>
                <th>Shipping  Street</th>
                <th>Shipping  zip code</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
                @foreach($companies as  $value) 

        {{$value->companyTypes->name}}


        {{$value->parentAccount->name}}
              <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->parentAccount->name}}</td>
                <td>{{$value->companyTypes->name}}</td>
                <td>{{$value->industriesTypes->name}}</td>
                <td>{{$value->account_phone}}</td>
                <td>{{$value->additional_phone}}</td>
                <td>{{$value->employees}}</td>
                <td>{{$value->website}}</td>
                <td>{{$value->biling_country}}</td>
                <td>{{$value->biling_city}}</td>
                <td>{{$value->biling_state}}</td>
                <td>{{$value->biling_street}}</td>
                <td>{{$value->biling_zip_code}}</td>
                <td>{{$value->shipping_country}}</td>
                <td>{{$value->shipping_city}}</td>
                <td>{{$value->shipping_state}}</td>
                <td>{{$value->shipping_street}}</td>
                <td>{{$value->shipping_zip_code}}</td>
                <td>{{$value->description}}</td>
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
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="phone" name="account_phone" >
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
                            <label  class="mr-sm-2">Billing Street:</label>
                            <textarea class="form-control" id="" rows="3" name="billing_street"></textarea>
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Shipping Street:</label>
                            <textarea class="form-control" id="" rows="3" name="shipping_street"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label  class="mr-sm-2">Billing Country:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="billing_country" >
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Shipping Country:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="shipping_country" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label  class="mr-sm-2">Billing City:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="billing_city" >
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Shipping City:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="shipping_city" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label  class="mr-sm-2">Billing State:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="billing_state" >
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Shipping State:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="shipping_state" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label  class="mr-sm-2">Billing zip code:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="billing_zip_code" >
                        </div>
                        <div class="col-6">
                            <label  class="mr-sm-2">Shipping zip code:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="shipping_zip_code" >
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
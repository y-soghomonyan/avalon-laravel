<div class="modal " id="create_address">
    <div class="modal-dialog mt-5 modal-md">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h4 class="modal-title text-center">New Address</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('add_address')}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Title</label>
                                <input type="text" name="title" class="form-control  mr-sm-2" id="">
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Address Provider</label>
                                <div>
                                    <select  class="select2 custom-select form-control" name="address_provider">
                                        @foreach($address_providers as $address_provider)
                                            <option value="{{$address_provider->id}}">{{$address_provider->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Country</label>
                                <div>
                                    <select class="select2 custom-select form-control" name="country_id" id="address_countries">
                                        @foreach($countries as $counrty)
                                            <option value="{{$counrty->id}}">{{$counrty->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 d-none state_block">
                                <label class="mr-sm-2">State</label>
                                <div class="state_block_select">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">City</label>
                                <input type="text" name="city" class="form-control  mr-sm-2" id="">
                            </div>
                            <div class="col-6">
                                <label  class="mr-sm-2">Post Code / ZIP</label>
                                <input type="text" name="post_code_zip" class="form-control  mr-sm-2" id="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Address 1</label>
                                <input class="form-control" id="" rows="3" name="address_1">
                            </div>
                            <div class="col-6">
                                <label class="mr-sm-2">Address 2</label>
                                <input class="form-control" id="" rows="3" name="address_2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="mr-sm-2">Address 3</label>
                                <input class="form-control" id="" rows="3" name="address_3">
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

@if(
!Route::currentRouteNamed('addresses') && !Route::currentRouteNamed('address_by_url'))
    <div class="modal " id="chose_address">
        <div class="modal-dialog mt-5 modal-md">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h4 class="modal-title text-center">Main Address</h4>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('add_relation_address')}}" method="POST">
                        @csrf
                        <input type="hidden" name="page_url" value="{{$url}}" id="page_url">
                        <input type="hidden" name="page_id" value="{{$id}}"  id="page_id">
                        <div class="">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <label class="mr-sm-2">Address Provider</label>
                                    <div>
                                        <select class="select2 custom-select form-control" name="address_provider" id="address_provider">
                                            @foreach($address_providers as $address_provider)
                                                <option value="{{$address_provider->id}}">{{$address_provider->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label  class="mr-sm-2">Address</label>
                                    <div>
                                        <select class="select2 custom-select form-control choose_address_data" name="address_id" id="address_id">
                                          <option value=""></option>
                                          @foreach($addresses as $key => $address)
                                          <option 
                                          value="{{$address->id}}"
                                           data-address_1="{{$address->address_1?$address->address_1.", " :""}}"
                                           data-address_2="{{$address->address_2?$address->address_2.", " :""}} "
                                           data-address_3="{{$address->address_3? $address->address_3.", ":""}}"
                                           data-post_code_zip="{{$address->post_code_zip? $address->post_code_zip." ":""}}"
                                           data-city="{{$address->city? $address->city.", ":""}}"
                                           data-state="{{$address->state && $address->state->name? $address->state->name.', ':""}}"
                                           data-country="{{$address->country && $address->country->name?$address->country->name.", ":""}}"
                                           >
                                                {{$address->title??"Unknown name"}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 address_all_data_show">

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 mb-2">
                                    <input type="checkbox" name="address_type" value="1" id="main_address_type">
                                    <label class="mr-sm-2" for="main_address_type">This is the main address</label>
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

    <div class="modal " id="use_address">
        <div class="modal-dialog mt-5 modal-md">
            <div class="modal-content">
                <div class="">
                    <div class="text-end pt-3 px-3">
                        <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                    </div>
                    <h4 class="modal-title text-center">Use Address</h4>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="{{route('new_relation_address')}}" method="POST">
                        @csrf
                        <input type="hidden" name="page_url" value="{{$url}}" id="page_url">
                        <input type="hidden" name="page_id" value="{{$id}}"  id="page_id">
                        <div class="">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <label class="mr-sm-2">Address Provider</label>
                                    <div>
                                        <select class="select2 custom-select form-control" name="address_provider" id="address_provider">
                                            @foreach($address_providers as $address_provider)
                                                <option value="{{$address_provider->id}}">{{$address_provider->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label  class="mr-sm-2">Address</label>
                                    <div>
                                        <select class="select2 custom-select form-control choose_address_data" name="address_id" id="address_id">
                                          <option value=""></option>
                                          @foreach($all_addresses as $key => $all_address)
                                            <option 
                                            value="{{$all_address->id}}"
                                             data-address_1="{{$all_address->address_1?$all_address->address_1.", " :""}}"
                                             data-address_2="{{$all_address->address_2?$all_address->address_2.", " :""}} "
                                             data-address_3="{{$all_address->address_3? $all_address->address_3.", ":""}}"
                                             data-post_code_zip="{{$all_address->post_code_zip? $all_address->post_code_zip." ":""}}"
                                             data-city="{{$all_address->city? $all_address->city.", ":""}}"
                                             data-state="{{$all_address->state && $all_address->state->name? $all_address->state->name.', ':""}}"
                                             data-country="{{$all_address->country && $all_address->country->name?$all_address->country->name.", ":""}}"
                                             >
                                                {{$all_address->title??"Unknown name"}}
                                                {{-- {{$all_address->address_1?$all_address->address_1."," :""}} 

                                                {{$all_address->address_2?$all_address->address_2."," :""}} 
                                                {{$all_address->address_3? $all_address->address_3.",":""}}
                                                {{$all_address->post_code_zip? $all_address->post_code_zip." ":""}}
                                                {{$all_address->city? $all_address->city.",":""}}
                                                {{$all_address->state && $all_address->state->name? $all_address->state->name.',':""}}
                                                {{$all_address->country && $all_address->country->name?$all_address->country->name.",":""}} --}}
                                            </option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 address_all_data_show">

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <input type="checkbox" name="address_type" value="1" id="new_main_address_type">
                                    <label class="mr-sm-2" for="new_main_address_type">This is the main address</label>
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

@endif

<script>
    $(document).ready(function(){


        $('.choose_address_data').on('change', function(){
            let data_address_1  = $(this).find(':selected').attr('data-address_1');
            let data_address_2 = $(this).find(':selected').attr('data-address_2');
            let data_address_3 = $(this).find(':selected').attr('data-address_3');
            let data_post_code_zip = $(this).find(':selected').attr('data-post_code_zip');
            let data_city = $(this).find(':selected').attr('data-city');
            let data_state = $(this).find(':selected').attr('data-state');
            let data_country = $(this).find(':selected').attr('data-country');
            let data = data_address_1+" "+data_address_2+" "+data_address_3+" "+data_city+" "+data_state+" "+data_post_code_zip+" "+data_country;

            $('.address_all_data_show').empty();
            $('.address_all_data_show').append('<p>'+data+'</p>');
        })

        $('.main_address').on('click',function(){
            let data =  $(this).data('all-data');
            console.log(data);
            let page_id = $('#page_id').val();
            let page_url = $('#page_url').val()+'_id';
            let address = $('#address_id');
            let address_provider = $('#address_provider');

            address_provider.val(0).trigger('change.select2');
            address.val(0).trigger('change.select2');
            address_provider.val(data.address_provider).trigger('change.select2');
            $('#main_address_type').removeAttr('checked')

            if(data.id){
                address.val(data.id).trigger('change.select2');
            }

            if(data.address_relation){
                data.address_relation.map((v,i)=>{
                    if(v[page_url] == page_id){
                        if(v.address_type == 1){
                            $('#main_address_type').attr('checked', 'checked')
                        }
                    }
                })
            }
            let state_name = '';
            if(data.state && data.state.name){
                state_name = data.state.name+" ";
            }
            let country_name = '';
            if(data.country && data.country.name){
                country_name = data.country.name
            }

            let dataa = data.address_1+" "+data.address_2+" "+data.address_3+" "+data.city+" "+state_name+" "+data.post_code_zip+" "+country_name;
            $('.address_all_data_show').empty();
            $('.address_all_data_show').append('<p>'+dataa+'</p>');
        })

        $("#address_countries").on("change", function (e) {
            let selected_element = $(e.currentTarget);
            let select_val = selected_element.val();
            let state_items = $('.state_items');
            let state_block = $('.state_block');
            let state_block_select = $('.state_block_select')

            state_block_select.empty();
            $.ajax({
                
                url:'/get_states',
                type:"post",
                datatType : 'json',
                data: {'id':select_val,  "_token": "{{ csrf_token() }}"}, 
                datatType : 'json',
                success: (response) => {
                    if (response.code == 400) {
                    }else if(response.code == 200){
                        let states = response.msg;
                        let select = '<select  class="select2 custom-select form-control" name="state_id">';
                        states.map((v,i)=>{
                            console.log(v, i)
                            select += `<option value="${v.id}" data-id="${v.country_id}" class="state_items">${v.name}</option>`
                        })
                        select += '</select>'
                        state_block_select.append(select);
                        state_block.removeClass('d-none');
                    }
                }
            })
        });
    })
</script>
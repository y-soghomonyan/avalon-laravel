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

@if(!Route::currentRouteNamed('addresses'))
    <div class="modal " id="chose_address">
        <div class="modal-dialog mt-5 modal-sm">
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
                                        <select class="select2 custom-select form-control" name="address_id" id="address_id">
                                          <option value=""></option>
                                          @foreach($addresses as $key => $address)
                                            <option value="{{$address->id}}">{{$address->title??"Unknown name"}}</option>
                                          @endforeach
                                        </select>
                                    </div>
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
        <div class="modal-dialog mt-5 modal-sm">
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
                                        <select class="select2 custom-select form-control" name="address_id" id="address_id">
                                          <option value=""></option>
                                          @foreach($all_addresses as $key => $all_address)
                                            <option value="{{$all_address->id}}">{{$all_address->title??"Unknown name"}}</option>
                                          @endforeach
                                        </select>
                                    </div>
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


        $('.main_address').on('click',function(){
            let data =  $(this).data('all-data');
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
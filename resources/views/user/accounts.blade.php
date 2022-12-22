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
            <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php echo e($value->companyTypes->name); ?>



            <?php echo e($value->parentAccount->name); ?>

            <tr>
                <td><?php echo e($value->name); ?></td>
                <td><?php echo e($value->parentAccount->name); ?></td>
                <td><?php echo e($value->companyTypes->name); ?></td>
                <td><?php echo e($value->industriesTypes->name); ?></td>
                <td><?php echo e($value->account_phone); ?></td>
                <td><?php echo e($value->additional_phone); ?></td>
                <td><?php echo e($value->employees); ?></td>
                <td><?php echo e($value->website); ?></td>
                <td><?php echo e($value->biling_country); ?></td>
                <td><?php echo e($value->biling_city); ?></td>
                <td><?php echo e($value->biling_state); ?></td>
                <td><?php echo e($value->biling_street); ?></td>
                <td><?php echo e($value->biling_zip_code); ?></td>
                <td><?php echo e($value->shipping_country); ?></td>
                <td><?php echo e($value->shipping_city); ?></td>
                <td><?php echo e($value->shipping_state); ?></td>
                <td><?php echo e($value->shipping_street); ?></td>
                <td><?php echo e($value->shipping_zip_code); ?></td>
                <td><?php echo e($value->description); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <form class="form-inline" action="<?php echo e(route('add_account')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="container">

                        <div class="row">
                            <div class="col-12 bg-light mb-3 h5 p-1">Company Information</div>
                            <div class="col-12">
                                <button class="btn btn-light mb-2" id="personal">Individual</button>
                                <button  class="btn btn-light mb-2" id="bissnes">Business</button>
                            </div>
                            <div class="col-6 d-flex flex-row align-items-start justify-content-between w-100">
                                <label for="personal_name" class="mr-sm-2 w-25">Account name:</label>

                                <input type="text" class="form-control mb-2 w-75" placeholder="Account name" name="name" id="personal_name">

                                <input type="hidden" value="<?php echo e(Auth::user()->name); ?>" id="bissnes_name"  class="">

                            </div>
                            <div class="col-6 mb-1 d-flex flex-row align-items-start justify-content-between w-100">
                                <label for="parent_account" class="mr-sm-2 w-25">Parent account:</label>
                                <input type="text" class="form-control mb-2 w-75" placeholder="name" value="1"  name="parent_account" id="parent_account">
                                <select class="select2" name="state">
                                    <option selected>Select Parent Company</option>
                                    <option value="sadf" >Select Parent Company</option>
                                    <option value="sadf" >Select Parent Company</option>
                                    <option value="sadf">Select Parent Company</option>
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-6 mb-1 d-flex flex-row align-items-start justify-content-between w-100">
                                <label  class="mr-sm-2 w-25">Account owner:</label>
                                <div class="d-flex flex-row justify-content-start w-75"> <?php echo e(Auth::user()->name); ?></div>
                            </div>
                            <div class="col-6 mb-1 d-flex flex-row align-items-start justify-content-between w-100">
                                <label  class="mr-sm-2 w-25 d-flex align-items-start justify-content-start">Type:</label>
                                <select  class="custom-select w-75" name="company_id">
                                    <?php $__currentLoopData = $company_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-1 d-flex flex-row align-items-start justify-content-between w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-25">Phone:</label>
                                <input type="text" class="form-control mb-2 w-75    " placeholder="phone" name="account_phone" >
                            </div>
                            <div class="col-6 mb-1 d-flex flex-row align-items-start justify-content-between w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-25">Industry:</label>
                                <select  class="custom-select w-75" name="industry_id">
                                    <?php $__currentLoopData = $industries_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <!--                    <div class="bg-secondary">-->
                        <!--                        <div class="col-5">Additional Information</div>-->
                        <!--                    </div>-->

                        <div class="row">
                            <div class="col-12 bg-light mb-3 h5 p-1">Additional Information</div>
                            <div class="col-6 mb-1 d-flex flex-row align-items-start justify-content-between w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-25">Website:</label>
                                <input type="text" class="form-control mb-2 w-75" placeholder="Website" name="website" >
                            </div>
                            <div class="col-6 mb-1 d-flex flex-row align-items-start justify-content-between w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-25">Phone:</label>
                                <input type="text" class="form-control mb-2 w-75" placeholder="Phone" name="additional_phone" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-1 d-flex flex-row align-items-start justify-content-between w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-25">Description:</label>
                                <textarea class="form-control w-75" id="" rows="3" name="description"></textarea>
                            </div>
                            <div class="col-6 mb-1 d-flex flex-row align-items-start justify-content-between w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-25">Employees:</label>
                                <input type="text" class="form-control mb-2 w-75" placeholder="Employees" name="employees" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 bg-light mb-3 mt-3 h5 p-1">Address Information</div>
                            <div class="col-6 mb-1 d-flex flex-column justify-content-start w-100">
                                <div class="font-weight-bold">Address 1</div>
                                <label  class="mr-sm-2 d-flex justify-content-start w-100">Address 1 Street:</label>
                                <textarea class="form-control w-100" id="" rows="3" name="address1_street"></textarea>
                            </div>
                            <div class="col-6 mb-1 d-flex flex-column justify-content-start w-100">
                                <div class="font-weight-bold">Address 2</div>
                                <label  class="mr-sm-2 d-flex justify-content-start w-100">Address 2 Street:</label>
                                <textarea class="form-control w-100" id="" rows="3" name="address2_street"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-1 d-flex flex-column justify-content-start w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-100">Address 1 Country:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2 w-100" placeholder="" name="address1_country" >
                            </div>
                            <div class="col-6 mb-1 d-flex flex-column justify-content-start w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-100">Address 2 Country:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2 w-100" placeholder="" name="address2_country" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-1 d-flex flex-column justify-content-start w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-100">Address 1 City:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2 w-100" placeholder="" name="address1_city" >
                            </div>
                            <div class="col-6 mb-1 d-flex flex-column justify-content-start w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-100">Address 2 City:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2 w-100" placeholder="" name="address2_city" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-1 d-flex flex-column justify-content-start w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-100">Address 1 State:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2 w-100" placeholder="" name="address1_state" >
                            </div>
                            <div class="col-6 mb-1 d-flex flex-column justify-content-start w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-100">Address 2 State:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2 w-100" placeholder="" name="address2_state" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-1 d-flex flex-column justify-content-start w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-100">Billing zip code:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2 w-100" placeholder="" name="billing_zip_code" >
                            </div>
                            <div class="col-6 mb-1 d-flex flex-column justify-content-start w-100">
                                <label  class="mr-sm-2 d-flex justify-content-start w-100">Shipping zip code:</label>
                                <input type="text" class="form-control mb-2 mr-sm-2 w-100" placeholder="" name="shipping_zip_code" >
                            </div>
                        </div>

                        <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->

        </div>
    </div>
</div>
@section('js')
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
                data: {"parent_account" : parent_account, "_token": "<?php echo e(csrf_token()); ?>"},

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
    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('#open_account')
        });
    });
</script>
@endsection
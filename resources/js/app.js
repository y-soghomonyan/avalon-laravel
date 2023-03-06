require('./bootstrap');
$(document).ready(function() {

    let collaps_show = $('.collaps_show');
    collaps_show.on('click', function(){
        let data =  $(this).data('target');
        let colapsed_icon = $(this).find('svg');
        if($( data ).hasClass( "show" )){
            colapsed_icon.css({ WebkitTransform: 'rotate(' + '-90' + 'deg)'});
            colapsed_icon.css({ '-moz-transform': 'rotate(' + '-90' + 'deg)'});
        }else{
            colapsed_icon.css({ WebkitTransform: 'rotate(' + '0' + 'deg)'});
            colapsed_icon.css({ '-moz-transform': 'rotate(' + '0' + 'deg)'});
        }

    })

    if($( '.upov_max_height > div' ).length < 4){
        $('.upov_max_height_button').hide();
    }
    $('.upov_max_height_button').click(()=>{
        $('.upov_max_height_button').hide();
        $('.upov_max_height .hidden-event').removeClass('hidden-event');
    })



});

$(document).ready(function(){
 
    // image preview
    $("#profile_image").change(function(){
        let reader = new FileReader();
 
        reader.onload = (e) => {
            $("#image_preview_container").attr('src', e.target.result);
            $("#header__user_avatar").attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    })
 
    $("#profile_setup_frm").submit(function(e){
        e.preventDefault();
 
        var formData = new FormData(this);

        let password = formData.get('password');
        let con_passsword = formData.get('confirm_password')
        if(password !== con_passsword){
            $("#res").html('<span class="alert alert-danger">Passwords do not match</span>');
            $("#profile_btn").attr("disabled", false);
            $("#profile_btn").html("Save Profile");
            return ;
        }
     
    $("#res").html('');

 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#profile_btn").attr("disabled", true);
        $("#profile_btn").html("Updating...");
        $.ajax({
            type:"POST",
            url: this.action,
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.code == 400) {
                    let error = '<span class="alert alert-danger">'+response.msg+'</span>';
                    $("#res").html(error);
                    $("#profile_btn").attr("disabled", false);
                    $("#profile_btn").html("Save Profile");
                }else if(response.code == 200){
                    let success = '<span class="alert alert-success">'+response.msg+'</span>';
                    $("#res").html(success);
                    $("#profile_btn").attr("disabled", false);
                    $("#profile_btn").html("Save Profile");
                }
            }
        })
    });

    const copyToClipboard = str => {
        const el = document.createElement('textarea');
        el.value = str;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    };
    $('.copy_button').on('click', function(){
        $('.myTooltip').html('Copy to clipboard');
        let copyText = $(this).parent().find(".file_link");
        $(this).find('#myTooltip').html('Copied')

        copyToClipboard( copyText.val() );
    })

    $(".address_type_select").select2().on("select2:select", function (e) {
        let selected_element = $(e.currentTarget);
        let select_val = selected_element.val();
        let type = $(this).parent().parent().parent().parent().find('.chack_relation_address');
        type.attr("data-address-type", select_val);

        let page_id = type.data('page-id');
        let page_url = type.data('page-url');
        let address_id = type.val();
        let address_type = type.data('address-type');

        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            
            url:'/add_relation_address',
            type:"post",
            datatType : 'json',
            data: {
                "page_id":page_id,
                "page_url":page_url,
                "address_id": address_id,
                "address_type":address_type,
                "_token": _token
            }, 
            datatType : 'json',
            success: (response) => {
            }
        })
    });

    $('.chack_relation_address').on('change', function(){

        let page_id = $(this).data('page-id');
        let page_url = $(this).data('page-url');
        let address_id = $(this).val();

        let address_type = $(this).data('address-type');

        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            
            url:'/add_relation_address',
            type:"post",
            datatType : 'json',
            data: {
                "page_id":page_id,
                "page_url":page_url,
                "address_id": address_id,
                "address_type":address_type,
                "_token": _token
            }, 
            datatType : 'json',
            success: (response) => {
            }
        })
    })

    $('.create_file').on('change', function(){
        let company_id = '<?= $company->id?>';
        let file_data = $(this).prop("files")[0];
        let form_data = new FormData(); 
        form_data.append("file", file_data);
        form_data.append("file_type", $(this).attr('id'));
        form_data.append("company_id",company_id)

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type:"POST",
            // url:'/update_file_company',
            url:'/uploade_file_company',
        
            cache: false,
            contentType: false,
            processData: false,
            data: form_data, 
            success: (response) => {
                if (response.code == 400) {
                }else if(response.code == 200){
                    let text = response.msg;
                    $(this).parent().find('.link_file').val(text)
                    // let origin = window.location.origin; 
                    // $(this).parent().find('.file_link').val(origin+'/storage/public/Files/'+text)
                    // $(this).parent().find('p').removeClass('d-none')
                    // $(this).parent().find('p').text(text);
                }
            }
        })

    })

    $('#month').on('change', function () {

        $('.months_day').empty();
        let days_count = new Date( new Date().getFullYear(), $(this).val(), 0).getDate();
        let select = '<select  class="select2 custom-select form-control" name="day">';
        for (let i = 1; i <= days_count; i++) {
            select += `<option value="${i}">${i}</option>`
        }
        select += '</select>'
        $('.months_day').append(select);

    })

    $('.create_notes').on('click', function () {
        setTimeout(function (){
            $('#notes_title').focus();
        }, 200);
    })

       
    $('.create_new_tax_returns').on('click', function(){
        // let company_id = $('#company_id').val();
        let tax_end = $('#tax_returns_years_block').find('.select2').val();
        // let _token = $('meta[name="csrf-token"]').attr('content');
        let incorporation_date_for_tax = $('.incorporation_date_for_tax').val();
        let company_country_for_tax_returns = $('.company_country_for_tax_returns').val()
        let tax_returns_start_date = $('#tax_returns_start_date');

        $('.tax_returns_tax_end').val(tax_end)
       
        // $('#tax_returns_id').val(response.msg)

        let company_type =  $('.company_type_for_tax_returns').val();
        let company_types = ['2','5','6'];
        if(jQuery.inArray(company_type, company_types) !== -1 && company_country_for_tax_returns == 5){
            const date = new Date(tax_end);
            const newDateaddOneYear = addOneYear(date);
            $('.tax_returns_due_date').val(newDateaddOneYear)
        } 

  
        let tax_returns_due_date = '';
        let UK2 = [3,4];
        
        if(company_country_for_tax_returns == 4){
            tax_returns_due_date = tax_end.slice(0, 4)+'-04-15';
            $('.tax_returns_due_date').val(tax_returns_due_date)
        }else if (company_country_for_tax_returns == 5 && jQuery.inArray(company_type, UK2) !== -1) {
            tax_returns_due_date = tax_end.slice(0, 4)+'-01-31';
            $('.tax_returns_due_date').val(tax_returns_due_date)
        }



        let star_date = removeOneYear(tax_end)
        tax_returns_start_date.val(star_date)
        if(incorporation_date_for_tax > star_date){
            tax_returns_start_date.val(incorporation_date_for_tax)
        }
        $('.close_modal_tax_returns').trigger('click');
        $('.newtax_returns_modal_open').trigger('click');


        // $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        // $.ajax({
        //     type:"POST",
        //     url:'/create_tax_returns',
        //     data: {
        //         "company_id":company_id,
        //         "tax_end":tax_end,
        //         "_token": _token
        //     }, 
        //     datatType : 'json', 
        //     success: (response) => {
        //         if (response.code == 400) {
        //         }else if(response.code == 200){
        //             $('.close_modal_tax_returns').trigger('click');
        //             $('.newtax_returns_modal_open').trigger('click');
        //             $('#tax_returns_id').val(response.msg)

        //             let company_type =  $('.company_type_for_tax_returns').val();
        //             let company_types = ['2','5','6'];
        //             if(jQuery.inArray(company_type, company_types) !== -1 && company_country_for_tax_returns == 5){
        //                 const date = new Date(tax_end);
        //                 const newDateaddOneYear = addOneYear(date);
        //                 $('.tax_returns_due_date').val(newDateaddOneYear)
        //             } 

        //             let star_date = removeOneYear(tax_end)
        //             tax_returns_start_date.val(star_date)
        //             if(incorporation_date_for_tax > star_date){
        //                 tax_returns_start_date.val(incorporation_date_for_tax)
        //             }
        //         }
        //     }
        // })

    })

    function removeOneYear(date) {
        const dateCopy = new Date(date);
        dateCopy.setFullYear(dateCopy.getFullYear() - 1, dateCopy.getMonth(), dateCopy.getDate() + 1);
        return dateCopy.toISOString().slice(0, 10);
    }
   
    function addOneYear(date) {
        const dateCopy = new Date(date);
        dateCopy.setFullYear(dateCopy.getFullYear() + 1);
        return dateCopy.toISOString().slice(0, 10);
    }

})



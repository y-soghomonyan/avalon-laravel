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
     
        
    //     console.log(formData.get('password'));
    //    for (const value of formData.values()) {
    //     console.log(value);
    //   }
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
    })
})



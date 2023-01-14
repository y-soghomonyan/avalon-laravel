require('./bootstrap');
$(document).ready(function() {

    let collaps_show = $('.collaps_show');
    collaps_show.on('click', function(){
        let data =  $(this).data('target');
        let colapsed_icon = $(this).find('svg');
        console.log(data);
        if($( data ).hasClass( "show" )){
            colapsed_icon.css({ WebkitTransform: 'rotate(' + '-90' + 'deg)'});
            colapsed_icon.css({ '-moz-transform': 'rotate(' + '-90' + 'deg)'});
        }else{
            colapsed_icon.css({ WebkitTransform: 'rotate(' + '0' + 'deg)'});
            colapsed_icon.css({ '-moz-transform': 'rotate(' + '0' + 'deg)'});
        }

    })

    if($( '.upov_max_height' ).height() < 290){
        $('.upov_max_height_button').hide();
    }
    $('.upov_max_height_button').click(()=>{
        $('.upov_max_height_button').hide();
        $('.upov_max_height').removeClass('upov_max_height');
    })



});
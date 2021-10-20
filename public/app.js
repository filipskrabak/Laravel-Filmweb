$(document).ready(function() {

    var $videoSrc;  
    $('.trailer-video').click(function() {
        $videoSrc = $(this).data( "src" );
    });

    $('#trailerModal').on('shown.bs.modal', function (e) {
        
    // youtube autoplay
    $("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
    })
    
    // video stop po zavreti modalu
    $('#trailerModal').on('hide.bs.modal', function (e) {
        // a poor man's stop video
        $("#video").attr('src',$videoSrc); 
    }) 

    $('.cat-slider').slick({
        autoplay: false,
        slidesToShow: 6,
        prevArrow: '<i class="fa fa-angle-left d-none d-md-block"></i>',
        nextArrow: '<i class="fa fa-angle-right d-none d-md-block"></i>',
        responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 5
            }
            }, {
            breakpoint: 1050,
            settings: {
                slidesToShow: 4
            }
            }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 3
            }
            }, {
            breakpoint: 500,
            settings: {
            slidesToShow: 2
                }
        }]
    });

    // document ready  
    });
    
function showSearch () {
    const search = document.querySelector("#searchbar");

    if(search.classList.contains("d-none"))
    {
        $(search).removeClass('d-none');
        document.getElementById("searchtype").focus();
    }
    else   
        $(search).addClass('d-none');
}
    
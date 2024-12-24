$(document).ready(function() {
    $(".lightbox-gallery").magnificPopup({
        delegate: 'a',
        gallery:{ enabled:true },
        type:'image',
        zoom: {
            enabled: true,
            duration: 300, // don't foget to change the duration also in CSS
            opener: function(element) {
                return element.find('img');
            }
        }
    });
    var $container = $('.isotope').isotope({
        itemSelector: 'li',
        //percentPosition: true
    });
    $('#filters').on( 'click', 'button', function(){
        var filterValue = $( this ).attr('data-filter');        
        $container.isotope({ filter: filterValue });
    });
});
$(document).ready(function () {
    $(document).on('keyup', '.search', function(e) {
        var options = $('.searchable .options')
        let _v  =   $(this).val().toLowerCase()
        
        if(_v){                
            options.each(function(index, i) {                
                let _s  =   $(i).attr('data-name').toLowerCase()
                if( _s.indexOf(_v) != -1){
                    $(i).show()
                }else{
                    $(i).hide()                        
                }
            });
        }else{
            $('.options').each(function(index, i) {
                $(i).show()
            });
        }
    });
});
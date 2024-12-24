$(document).on('keyup', '.searchHeader', function(e) {
    console.log('AS Loaded')
    $( ".searchHeader" ).autocomplete({
        source: function( request, response ) {
            var url = "{{ route('productAutocomplete') }}";
            console.log('request.term', request.term, url )
            $.ajax({
                url: url,
                type: 'GET',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {
                    console.log('data', data)
                    response( data );
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown);
                    // Perform error handling here, like displaying an error message
                }
            });
        },
        select: function (event, ui) {
            $('.searchHeader').val(ui.item.label);
            window.livewire.emit('urlSelected', { data: ui.item.value });
            console.log('ui.item.value', ui.item)
            return false;
        }
    });
});

window.addEventListener('patientSelected', e => {
    $('.searchHeader').val(e.detail.data);  
});
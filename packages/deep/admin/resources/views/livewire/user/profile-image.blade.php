<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'Profile Image', 'routeName' => '', 'routeText' => '', 'link' => ''])
    <link rel="stylesheet" href="{{ asset('css/croppie.css') }}">
    <h1 class="heading">Your Profile</h1>
    <div class="row">
        <div class="col-span-12 text-center my-5">
            <input class="form-control px-3 rounded mb-5" type="file" id="image">
        </div>
        <div class="col-span-6 text-center">
            <div wire:ignore>
                <div id="upload-demo"></div>
            </div>
            <button class="bg-action text-white py-2 px-4 rounded btn-upload-image hidden">Crop Image</button>
        </div>
        <div class="col-span-6">
            <h3 class="ypi text-center py-3 font-semibold hidden">Your Profile Image</h3>
            @if($media)
                <img src="{{ $media }}" class="max-w-100" style="max-width: 100px">
            @endif
        </div>
    </div>
    <script src="{{asset('/js/croppie.js')}}"></script>
    <script type="text/javascript">
        var resize = $('#upload-demo').croppie({
            enableExif: true,
            enableOrientation: true,    
            viewport: { // Default { width: 100, height: 100, type: 'square' } 
                width: 200,
                height: 200,
                type: 'square' //circle, square
            },
            boundary: {
                width: 300,
                height: 300
            }
        });
        $('#image').on('change', function () { 
            var reader = new FileReader();
                reader.onload = function (e) {
                resize.croppie('bind',{ url: e.target.result }).then(function(){ console.log('jQuery bind complete'); });
            }
            reader.readAsDataURL(this.files[0]);
            $('.btn-upload-image').removeClass('hidden');
        });
        $('.btn-upload-image').on('click', function (ev) {
            resize.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (img) {
                $.ajax({
                    url: "{{ route('imageCropPost') }}",
                    type: "POST",
                    data: {"image":img},
                    success: function (data) {
                        if(data.success){
                            // window.addEventListener('swal:modal', event => { swal({ title: data.message }); });
                            @this.set( 'media', data.media );
                            // $('.btn-upload-image').removeClass('hidden');
                        }
                    }
                });
            });
        });
    </script>
</div>
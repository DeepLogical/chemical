<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'Testimonial ( '.$name.' )' , 'routeName' => '', 'routeText' => 'Add Video Testimonial', 'link' => 'true', 'currentRoute' => 'adminVideoTestimonials'])
    
    @if( $data )
        <div class="container pb-5">
            <style>
                details[open] summary{
                    background: #ad2e24;
                    color: #fff;
                    transition: 0.5s all;
                }
                details[open] ul{
                    padding-left: 2em;
                }
                details[open] ul li{
                    list-style: disc
                }
            </style>
            @foreach($data as $i)
                <details class="mb-4" wire:key="testimonial-{{ $loop->index }}">
                    <summary class="bg-gray-200 rounded-md py-2 px-4 hover:cursor-pointer">{{ $i->name }}</summary>
                    <div class="p-3">
                        <img src="{{ optional($i->media)->path }}" class="w-12">
                        <p>{{ $i->name }}</p>
                        <p>{{ $i->role }}</p>
                        {!! $i->testis !!}
                        <button class="editBtn" wire:click="$dispatch( 'updateVideoTestimonialModal', { id: '{{ encode( $i->id ) }}' } )">Edit</button>
                    </div>
                </details>

            @endforeach
        </div>
    @endif

    @livewire('videoTestimonialModal', [ 'model' => $model, 'model_id' => $model_id ])
</div>
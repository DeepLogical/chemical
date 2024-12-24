<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'FAQ ( '.$name.' )' , 'routeName' => '', 'routeText' => 'Add FAQ', 'link' => 'true', 'currentRoute' => 'adminFaq'])
    
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
                <details class="mb-4" wire:key="faq-{{ $loop->index }}">
                    <summary class="bg-gray-200 rounded-md py-2 px-4 hover:cursor-pointer">{{ $i->quest }}</summary>
                    <div class="p-3">
                        {!! $i->ans !!}
                        <button class="editBtn" wire:click="$dispatch( 'updateFaqModal', { id: '{{ encode( $i->id ) }}' } )">Edit</button>
                    </div>
                </details>
            @endforeach
        </div>
    @endif


    @livewire('faqModal', [ 'model' => $model, 'model_id' => $model_id ])
</div>
<div class="container py-5">
    <h1 class="heading py-3 md:py-6">{{ $heading }}</h1>
    <div class="row mt-5">
        <div class="col-span-12">
            <div class="row searchable">
                <div class="col-span-12 md:col-span-8 row">
                    @if( $data && count( $data ) )
                        @foreach($data as $key => $i)
                            @livewire('singleProductItemBlock', [ "i" => $i, key($key) ])
                        @endforeach
                    @endif
                </div>
                <div class="col-span-12 md:col-span-4">

                    @livewire('singleSidebar')
                </div>
            </div>
        </div>
    </div>
</div>
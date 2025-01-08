<div>
    <div class="container py-5">
        <h1 class="heading">{{ $heading }}</h1>
        <p class="text-center text-base">{{ $paragraph }}</p>
    </div>

    <div class="container row mt-10">
        @livewire('productSidebar', ['url' => $url])
        
        <div class="col-span-12 md:col-span-8">                
            @if( $data && count($data))
                <div class="row pb-5">
                    @foreach($data as $i)
                        @include('deep::template.single-product-item', ['i' => $i])
                    @endforeach
                </div>
            @else
                <h2 class="font-bold text-center py-5">No Products for these Filter. Narrow down your filters please.</h2>
            @endif

            <div
                x-data="{
                    observe () {
                        let observer = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting) {
                                    @this.call('loadMore')
                                }
                            })
                        }, {
                            root: null
                        })

                        observer.observe(this.$el)
                    }
                }"
                x-init="observe">
            </div>
        </div>
    </div>
</div>

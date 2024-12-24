<div>
    <div class="container py-5">
        <h1 class="heading">Welcome to {{ config('deep.brand') }}</h1>
        @if( $search ) <p class="text-center">You searched for {{ $search }}</p> @endif

        @if( $products && count($products) )
            <div class="py-5">
                <div class="flex items-center mb-5 relative">
                    <h2 class="heading text-action" style="padding: 0 20px">Products related to {{ $search }}</h2>
                    <a href="{{ route('shop') }}" class="btn text-xs absolute right-0">View All</a>
                </div>
                <div class="row">
                    @foreach($products as $key => $i) @livewire('singleProductItem', [ "i" => $i, key($key) ]) @endforeach
                </div>
            </div>
        @endif

        @if( $blogs && count($blogs) )
            <div class="py-5">
                <div class="flex items-center mb-5 relative">
                    <div class="flex items-center justify-center">
                        <div class="box"></div>
                        <h2 class="heading text-action" style="padding: 0 20px">Blogs related to {{ $search }}</h2>
                        <div class="box"></div>
                    </div>            
                    <a href="{{ route('blogs') }}" class="btn text-xs absolute right-0">View All</a>
                </div>
                <div class="row">
                    @foreach($blogs as $key => $i) @livewire('singleBlogItem', [ "i" => $i, key($key) ]) @endforeach
                </div>
            </div>
        @endif
    </div>
    @if( !count( $blogs ) && !count( $products ) )
        <div class="container">
            <h2 class="font-semibold pt-2 text-center">OOps we have nothing related to {{ $search }}</h2>
            <p class="text-center">We will surely look into it. Meanwhile do check below Products and Blogs that might interest you.</p>
        </div>
        
    @endif

    @livewire('suggestProducts')
    @livewire('suggestBlogs')
</div>

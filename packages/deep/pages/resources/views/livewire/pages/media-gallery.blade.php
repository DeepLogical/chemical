<div class="container py-5">
    <link rel="stylesheet" href="{{ asset('/css/portfolio/portfolio.css') }}">
    <h1 class="heading">Media Gallery</h1>
    <div class="flex items-center justify-center py-5" id="filters">
        <button class="btn-isotop" data-filter="*">All</button>
        @foreach($catOptions as $i)
            <button wire:key="cat-{{ $loop->index}}" class="btn-isotop" data-filter=".media-{{ $i->id}}">{{ $i->name }}</button>
        @endforeach
    </div>
    <div class="portfolio-grid">
        <ul id="da-thumbs" class="da-thumbs isotope lightbox-gallery">
            @foreach($data as $i)
                <li wire:key="data-{{ $loop->index}}" data-category="media-{{ $i->category_id}}" class="media-{{ $i->category_id}}"> 
                    <a class="image-popup-vertical-fit" href="{{ optional($i->media)->path }}"> 
                        <img src="/storage/media/{{ optional($i->media)->media }}" alt="{{ $i->name }}"/>
                        <div class="portfolio-detail-overlay">
                            <div class="middle-align-wrap">
                                <div class="middle-align-cell">
                                    <h4>{{ $i->name }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <script src="{{asset('/js/jquery-3.1.0.js')}}"></script>
    <script src="{{asset('/js/portfolio/isotope.js')}}"></script>
	<script src="{{asset('/js/portfolio/modernizer.js')}}"></script>
	<script src="{{asset('/js/portfolio/magnific-popup.js')}}"></script>
	<script src="{{asset('/js/portfolio/hoverdir.js')}}"></script>
	<script src="{{asset('/js/portfolio/portfolio.js')}}"></script>
</div>
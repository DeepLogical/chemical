<div class="container py-5">
    <link rel="stylesheet" href="{{ asset('/css/portfolio/portfolio.css') }}">
    <style>
        iframe{
            width: 100%;
            height: auto
        }
    </style>
    <h1 class="heading">Video Gallery</h1>
    <div class="flex items-center justify-center py-5" id="filters">
        <button class="btn-isotop" data-filter="*">All</button>
        @foreach($catOptions as $i)
            <button wire:key="cat-{{ $loop->index}}" class="btn-isotop" data-filter=".video-{{ $i->id}}">{{ $i->name }}</button>
        @endforeach
    </div>
    <div class="portfolio-grid">
        <ul id="da-thumbs" class="da-thumbs isotope lightbox-gallery">
            @foreach($data as $i)
                <li wire:key="data-{{ $loop->index}}" data-category="video-{{ $i->category_id}}" class="video-{{ $i->category_id}}"> 
                    <iframe src="https://www.youtube.com/embed/{{ $i->iframe }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
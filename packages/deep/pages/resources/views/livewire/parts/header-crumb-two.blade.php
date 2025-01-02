<div class="">
    <h2 class="heading text-center">{{ $heading }}</h2>
    <p class="paragraph text-center">{{ $paragraph }}</p>
    @if( $route ) <a href="{{ route( $route ) }}" class="flex item-center justify-between btn">View All</a> @endif
</div>
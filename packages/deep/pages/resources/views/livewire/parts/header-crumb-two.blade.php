<div class="flex items-center justify-between">
    <h2 class="heading text-left uppercase">{{ $heading }}</h2>
    @if( $route ) <a href="{{ route( $route ) }}" class="flex item-center justify-between btn">View All</a> @endif
</div>
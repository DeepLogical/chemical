<div class="deepShadow md:mt-5 bg-primary text-center p-6 md:p-10 md:flex justify-around items-center">
    <h3 class="text-white mb-5 md:mb-0 text-lg md:text-2xl ">{{ $text}}</h3>
    @if( $link )
        <a href="{{ route( $link ) }}" class="btn bg-white text-primary py-3 px-5 font-bold">{{ $a_text }}</a>
    @else
        <button class="openContactModal btn">Connect Today</button>
    @endif
</div>
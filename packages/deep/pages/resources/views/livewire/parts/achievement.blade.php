<section class="achieve py-5">
    <div class="row mt-5">
        @foreach( $data as $i)
            <div class="col-span-12 sm:col-span-3">
                <h3 class="text-center text-2xl md:text-5xl font-bold text-white"><span class="value" style="font-size: 50px">{{ $i->value }}</span>+ </h3>
                <p class="text-center text-white py-3 font-bold">{{ ucfirst( $i->name ) }}</p>
            </div>
        @endforeach
    </div>
    <script>document.addEventListener("DOMContentLoaded",function(){var e=document.querySelector(".achieve"),n=document.querySelectorAll(".value"),t=!1;window.addEventListener("scroll",function(){var o=window.pageYOffset||document.documentElement.scrollTop,i=window.innerHeight||document.documentElement.clientHeight,r=e.offsetTop;e.offsetHeight,r+i>=o&&r<=o+i&&!t&&(t=!0,n.forEach(function(e){var n=parseInt(e.innerText),t=0,o=setInterval(function(){t+=Math.ceil(n/60),e.innerText=t,t>=n&&clearInterval(o)},1e3/60)}))})});</script>
</section>
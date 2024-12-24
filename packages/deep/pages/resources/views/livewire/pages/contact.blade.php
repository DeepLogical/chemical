<div class="container py-6 md:py-12">
    <h1 class="heading text-center">Get in Touch</h1>
    <p class="text-center">We're here to help with your regulatory news inquiries.</p>
    <div class="row py-3 md:py-6 lg:py-12">
        <div class="col-span-12 md:col-span-4 flex items-center justify-center card rounded-xl p-2 md:p-3">
            @if( config('deep.full_address') ) <p><strong>Address:</strong> {{ config('deep.full_address') }}</p> @endif
        </div>
        <div class="col-span-12 md:col-span-4 flex items-center justify-center card rounded-xl p-2 md:p-3">
            @if( config('deep.phoneList')  && count( config('deep.phoneList') ))
                <p><strong>Phone: </strong>
                    @foreach( config('deep.phoneList')  as $key => $i) <a href="tel:{{ $i}}">{{ $i}}</a> @if($key != count( config('deep.phoneList') )-1 ) / @endif @endforeach
                </p>
            @endif
        </div>
        <div class="col-span-12 md:col-span-4 flex items-center justify-center card rounded-xl p-2 md:p-3">
            @if( config('deep.emailList')  && count( config('deep.emailList') ))
                <p><strong>Email: </strong>
                    @foreach( config('deep.emailList')  as $key => $i) <a href="mailto:{{ $i}}">{{ $i}}</a> @if($key != count( config('deep.emailList') )-1 ) / @endif @endforeach
                </p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-span-12 md:col-span-6 bg-primary flex flex-col justify-between p-2 md:p-3 lg:p-6">
            <div>
                <p class="text-sm font-bold text-white mb-1 md:mb-2">Pradeep Classes</p>
                <p class="paragraph text-white">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt, officiis ut harum at nihil eos nesciunt, dolores odit officia quam ipsam eius optio? Obcaecati commodi veniam sunt harum placeat non?</p>
            </div>
            <div class="flex flex-col items-center justify-center">
                <p class="paragraph text-white">For Business Enquiries- Reach Out To Us</p>
                <p class="paragraph text-white font-bold"><a href="">business@pradeepclasses.com</a></p>
            </div>
            @if(  config('deep.social')  && count( config('deep.social') ) )
                <div class="my-5">
                    <h3 class="subHeading text-center text-white">Follow Us</h3>
                    <div class="flex items-center justify-center">
                        @foreach( config('deep.social') as $i)
                            <a class="group flex items-center justify-center navneetShadow rounded-lg text-white relative z-50 w-20 h-20 m-2" target="_blank" href="{{$i['url']}}"><img src="/images/icons/social/{{$i['img-white']}}" alt="{{ $i['platform'] }}" class="w-4 transition duration-700 ease-in-out group-hover:scale-150" width="21" height="21"></a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <div class="col-span-12 md:col-span-6">
            @livewire('contactForm')
        </div>
        @if( config('deep.googlemap') )
            <div class="col-span-12 map py-6 md:py-12" style="min-height: 500px"> {!! config('deep.googlemap') !!} </div>
        @endif
    </div>
</div>
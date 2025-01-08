<div>
    <div class="row relative">
        <div class="col-span-12 md:col-span-12">
            <img src="images/static/banners/export-import.jpg" alt="banner1" class="w-fit">
        </div>
        <div class="bg-lightBack h-full w-full absolute top-0 left-0">
            <div class=" absolute top-0 left-0 right-0 h-full flex flex-col items-center justify-center px-12 mx-0 md:mx-12 z-50">
                <h1 class="heading text-white">chemical supply chain’s Business to Overseas
                at your place</h1>
                <p class="smallHeading pb-3 text-white">Lorem, ipsum dolor sit amet consectetur adipisicing elit. In dolorem corrupti architecto, magni deserunt itaque ratione sed est laborum ea.</p>
                <a href="/contact-us"><button class="whiteBtn">Place Enquiry Now</button></a>
            </div>
        </div>
    </div>

    <section class="container py-12">
        <h3 class="heading text-center">Our Services For overseas</h3>
        <p class="paragraph text-center pb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas, quod incidunt! Repellendus, laborum assumenda? Voluptas fugit deleniti iusto perferendis sapiente?</p>
        <div class="row container py-2">
            @foreach ($industries as $i)
                <div class="cols-span-12 md:col-span-6 p-5 border shadow-lg hover:shadow-xl rounded-md">
                    <img src="images/icons/services/{{$i['img']}}" alt="{{$i['name']}}" class="w-11 mb-2 mx-auto">
                    <p class="smallHeading text-center">{{$i['name']}}</p>
                    <p class="paragraph text-center">{{$i['text']}}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="bg-primary py-12">
        <div class="text-center">
            <h2 class="heading text-white text-center">How We Work</h2>
            <p class="paragraph text-white text-center pb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
            <a href="" class="whiteBtn mb-6">Place Enquiry Now</a>
        </div>
        <div class="h-6 bg-gray-400 rotate-1"></div>
        <div class="row container">
            <div class="col-span-12 md:col-span-4 flex flex-col justify-evenly">
                <div>
                    <h2 class="heading text-white">01.</h2>
                    <p class="paragraph text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit
                    <p class="paragraph text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit
                </div>
                <div>
                    <h2 class="heading text-white">02.</h2>
                    <p class="paragraph text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit
                    <p class="paragraph text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit
                </div>
            </div>
            <div class="col-span-12 md:col-span-4 flex items-start">
                <img src="images/static/container.png" alt="Export Import">
            </div>
            <div class="col-span-12 md:col-span-4 flex flex-col justify-evenly">
                <div>
                    <h2 class="heading text-white">01.</h2>
                    <p class="paragraph text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit
                    <p class="paragraph text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit
                </div>
                <div>
                    <h2 class="heading text-white">02.</h2>
                    <p class="paragraph text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit
                    <p class="paragraph text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit
                </div>
            </div>
        </div>
    </section>

    <section>
        <!-- @livewire ('suggestProducts') -->
    </section>

    <section>
        <div class="row container">
            <div class="col-span-12 md:col-span-4 flex flex-col justify-evenly">
                @foreach ($shiping as $i)
                    <div>
                        <div class="md:text-right">
                            <h2 class="heading text-gray-500">{{$i['num']}}</h2>
                            <strong class="text-lg">{{$i['name']}}</strong>
                        </div>
                    <p class="paragraph">{{$i['text']}}</p>
                    </div>
                @endforeach
            </div>
            <div class="col-span-12 md:col-span-4">
                <img src="images/static/ship.png" alt="Export Import">
            </div>
            <div class="col-span-12 md:col-span-4 flex flex-col justify-evenly">
                @foreach ($shiping2 as $i)
                    <div>
                            <h2 class="heading text-gray-500">{{$i['num']}}</h2>
                            <strong class="text-lg">{{$i['name']}}</strong>
                    <p class="paragraph">{{$i['text']}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="container py-12">
        <div class="row bg-primary rounded-xl overflow-hidden">
            <div class="col-span-12 md:col-span-6 flex flex-col justify-evenly p-5">
                <div>
                    <h2 class="heading text-white">Reach To Us Now</h2>
                    <p class="paragraph text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
                </div>
                <a href="/contact-us" class="whiteBtn">Contact Now</a>
            </div>
            <div class="col-span-12 md:col-span-6">
                <img src="images/static/saling.png" alt="Reach Out" class="">
            </div>
        </div>
        
    </section>

    <section>
        @livewire ('suggestBlogs')
    </section>
    @if( $data ) @livewire('faqWhite', [ 'model' => 'Page', 'model_id' => $data->id]) @endif
    @if( $data ) @livewire('testimonial', [ 'model' => 'Page', 'model_id' => $data->id ]) @endif
</div>


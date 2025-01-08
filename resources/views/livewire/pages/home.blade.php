<div>
    <div class="row relative">
        <div class="col-span-12 md:col-span-12">
            <img src="images/static/banners/banner1.jpg" alt="banner1" class="w-fit">
        </div>
        <div class="bg-lightBack h-full w-full absolute top-0 left-0">
            <div class=" absolute top-0 left-0 right-0 h-full flex flex-col items-center justify-center px-12 mx-0 md:mx-12 z-50">
                <h1 class="heading text-white">Serving the entire chemical supply chain’s distribution business</h1>
                <p class="smallHeading text-white">Lorem, ipsum dolor sit amet consectetur adipisicing elit. In dolorem corrupti architecto, magni deserunt itaque ratione sed est laborum ea.</p>
                <a href="/contact-us"><button class="whiteBtn">Place Enquiry Now</button></a>
            </div>
        </div>
    </div>

    <section>
        <div class="container py-12">
            <h2 class="heading text-center">About ADP Trading Company</h2>
            <p class="paragraph text-center pb-5">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maiores commodi sequi cumque eligendi quam architecto alias, expedita, consequuntur est error velit dolorum labore? Doloribus beatae nostrum, illum itaque perspiciatis at.</p>
            <div class="row py-2">
                @foreach ($about as $i)
                    <div class="cols-span-12 md:col-span-3 p-5 border shadow-lg hover:shadow-xl rounded-md">
                        <img src="images/static/about/{{$i['img']}}" alt="best-quality" class="w-11 mb-2">
                        <p class="smallHeading">{{$i['name']}}</p>
                        <p class="paragraph">{{$i['text']}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative">
        <img src="images/static/lab.jpg" alt="banner1" class="w-fit">
        <div class="bg-lightBack h-full w-full absolute top-0 left-0">
            <div class=" absolute top-0 left-0 right-0 h-full flex flex-col items-center justify-center px-12 mx-0 md:mx-12 z-50">
                <h1 class="heading text-white">Distributors and Marketing Agents</h1>
                <p class="smallHeading text-white pb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. In dolorem corrupti architecto, magni deserunt itaque ratione sed est laborum ea.</p>
                <a href="/contact-us"><button class="whiteBtn">Check More</button></a>
            </div>
        </div>
    </section>


    <section class="container">
        <h3 class="heading text-center">Application Industries or Markets</h3>
        <p class="paragraph text-center pb-5">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas, quod incidunt! Repellendus, laborum assumenda? Voluptas fugit deleniti iusto perferendis sapiente?</p>
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
    
    <section class="container py-12">
        <div class="row">
            <div class="col-span-12 md:col-span-6 flex flex-col justify-center ">
                <h4 class="heading">Company History, Present and the Future</h4>
                <p class="paragraph">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, aperiam modi! Consequuntur ratione aut assumenda deserunt molestias. Aut, accusamus eius? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, aperiam modi! Consequuntur ratione aut assumenda deserunt molestias. Aut, accusamus eius?</p>
            </div>
            <div class="col-span-12 md:col-span-6 border shadow-lg rounded-md overflow-hidden">
                <div class="row">
                    <div class="col-span-12 md:col-span-7 flex flex-col justify-between p-4">
                        <p class="heading text-left">We Started In Year 1980</p>
                        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, obcaecati? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, obcaecati?</p>
                        <button class="w-full flex justify-between font-bold">Read More <img src="images/icons/static/arrow.svg" alt="" class="w-7 py-2"></button>
                    </div>
                    <div class="col-span-12 md:col-span-5 relative">
                        <img src="images/static/worker.jpg" alt="">
                        <div class="tint h-full w-full absolute top-0 left-0"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-12">
            <div class="col-span-12 md:col-span-4 flex flex-col justify-between border shadow-lg rounded-md overflow-hidden p-5">
                <p class="heading text-left">We Started In Year
                1980</p>
                <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, obcaecati?</p>
                <button class="w-full flex justify-between font-bold">Read More <img src="images/icons/static/arrow.svg" alt="" class="w-7 py-2"></button>
                </div>
            <div class="col-span-12 md:col-span-8 flex flex-col justify-between p-2 rounded-md bg-primary">
                @if( $data ) @livewire('achievement', [ 'model' => 'Page', 'model_id' => $data->id ]) @endif
            </div>
        </div>
    </section>

    <section class="container">
        <h4 class="heading text-center">9 Key Tenets of ADP Trading Company</h4>
        <p class="paragraph text-center pb-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid labore facere totam minus, deserunt sed quaerat numquam laborum quisquam quo.</p>
        <div class="row">
            @foreach ($tenets as $i)
                <div class="col-span-12 md:col-span-4 relative border shadow-lg hover:shadow-xl rounded-md overflow-hidden">
                    <img src="images/static/tenets/{{$i['img']}}" alt="{{$i['name']}}">
                    <div class="bg-lightBack h-full w-full absolute top-0 left-0 flex flex-col justify-center items-center">
                        <p class="smallHeading text-white text-center">{{$i['name']}}</p>
                        <p class="paragraph text-white text-center">{{$i['text']}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    
    <section class="py-12">
        @livewire ('suggestBlogs')
    </section>
    
    <section class="container rounded-lg overflow-hidden my-12" style="background-image: url('images/static/touch.jpg'); background-size: cover; background-position: center;">
        <!-- <img src="images/static/touch.jpg" alt="contact" class="w-fit"> -->
        <div class="row bg-lightBack">
            <div class="col-span-12 md:col-span-6 flex flex-col justify-center p-5">
                <h5 class="heading text-white">Get In Touch with us about your chemical product</h5>
                <p class="paragraph text-white pb-5">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic quaerat nulla voluptatibus provident voluptates nemo, voluptatum eos impedit earum quas!</p>
                <button class="whiteBtn">Know More</button>
            </div>
            <div class="col-span-12 md:col-span-6 glass p-5 m-5">
                @livewire('contactForm')
            </div>
        </div>
    </section>
    @if( $data ) @livewire('faqWhite', [ 'model' => 'Page', 'model_id' => $data->id]) @endif
    @if( $data ) @livewire('testimonial', [ 'model' => 'Page', 'model_id' => $data->id ]) @endif
</div>

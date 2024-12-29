<div>
    <div class="row container">
        <div class="col-span-12 md:col-span-8 flex-col justify-center flex">
            <h1 class="heading text-primary text-left">Transform Your Learning Journey with Expert Coaching</h1>
            <p class="paragraph">Unlock your potential with expert coaching, personalized support, and proven strategies to help you achieve academic excellence and success.</p>
            <button class="btn my-2">Read More</button>
        </div>
        <div class="col-span-12 md:col-span-4">
        <img src="/images/static/banners/01.jpg" alt="" class="pt-2">
        </div>
    </div>
    <section class="bg-primary py-12">
        <div class="container">
            <h2 class="heading text-center text-white">Celebrating Success and Accomplishments</h2>
            <p class="text-white text-center">We proudly celebrate the achievements of our students, recognizing their hard work and dedication on the path to success.</p>

            @if( $data ) @livewire('achievement', [ 'model' => 'Page', 'model_id' => $data->id ]) @endif

        </div>
    </section>

    <div class="py-12 container text-center">
        <h2 class="heading">Educational Journeys: Inspiring Success Across Boards</h2>
        <p class="paragraph text-center">Our programs empower students to thrive across diverse educational paths, fostering critical thinking and creativity for future success.</p>
        <button class="btn">Know More</button>
    </div>
    
    <section class="pt-12">
        <div class="row container">
            <div class="col-span-12 md:col-span-6">
                <img src="/images/static/banners/01.jpg" alt="">
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col justify-center h-full">
                <h2 class="heading text-left">Unlock Knowledge in a Global Learning Community</h2>
                <p class="paragraph">Join our global learning community, where students connect, share insights, and unlock limitless knowledge for personal and academic growth.</p>
                <div class="">
                    @foreach ($learning as $i)
                    <div class="flex py-2">
                        <div class="rounded-full">
                            <img src="/images/icons/static/study/{{ $i ['img'] }}" alt="{{ $i ['name'] }}" class="w-40 my-2 ">
                        </div>
                        <div class="md:pl-3">
                            <h3 class="subHeading">{{ $i ['name'] }}</h3>
                            <p class="paragraph">{{ $i ['text'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-lightBg mb-12 py-12">
        <div class= "container text-center">
            <h2 class="heading">Unlock Your Potential with Learning</h2>
            <p class="paragraph text-center pb-5">Unlocking your potential through learning leads to growth, new opportunities, and the confidence to navigate life's challenges successfully.</p>
        </div>
        <div class="row container">
            @foreach ($benifit as $i)
            <div class="col-span-12 md:col-span-4 bg-white  group hover:bg-primary transition duration-300 ease-in-out rounded-md p-3 md:p-5">
                <img src="/images/icons/static/study/{{ $i ['img'] }}" alt="{{ $i ['name'] }}" class="w-60 rounded-full">
                <h4 class="subHeading group-hover:text-white transition duration-300 ease-in-out pt-2">{{ $i ['name'] }}</h4>
                <p class="paragraph group-hover:text-white transition duration-300 ease-in-out">{{ $i ['text'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <section class="container pt-12">
        <div class="text-center">
            <h2 class="heading">The Clear Choice for Success</h2>
            <p class="paragraph text-center">We offer the guidance, tools, and resources necessary to help you succeed. Our commitment to excellence and personalized support makes us the clear choice for anyone looking to achieve their goals with confidence.</p>
            <button class="btn my-3">Know More</button>
        </div>
        <div class="row">
            <div class="col-span-12 md:col-span-4">
                <div class="flex flex-col justify-evenly h-full">
                    @foreach ($choose as $i)
                        <div class="flex deepShadow rounded-md p-3">
                            <div class="pl-3">
                                <h5 class="subHeading">{{ $i['name'] }}</h5>
                                <p class="paragraph">{{ $i['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-span-12 md:col-span-4">
                <img src="images/static/why.jpg" alt="" class="">
            </div>
            <div class="col-span-12 md:col-span-4">
                <div class="flex flex-col justify-evenly h-full">
                    @foreach ($chooses as $i)
                        <div class="flex deepShadow rounded-md p-3">
                            <div class="pl-3">
                                <h5 class="subHeading">{{ $i['name'] }}</h5>
                                <p class="paragraph">{{ $i['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-primary py-12">
        <div class="container text-center">
            <h2 class="heading text-white">Boards</h2>
            <p class="paragraph text-center text-white pb-3">Educational boards define curricula and assessments, guiding students through structured learning pathways while fostering essential skills for academic success.</p>
        </div>
    </section>

    <section>
        <div class="row container pb-12">
            <div class="col-span-12 md:col-span-4">
                <img src="images/static/about.jpg" alt="">
            </div>
            <div class="col-span-12 md:col-span-8 flex flex-col justify-center md:pl-5">
                <h3 class="heading mb-3">Our Vision</h3>
                <p class="paragraph">We envision a world where education is not only accessible to everyone but also engaging and transformative. Our goal is to create an environment that fosters lifelong learning, allowing individuals from all backgrounds to unlock their potential. By embracing innovative teaching methods and utilizing advanced technology, we aim to inspire curiosity and passion for knowledge. We believe that education should empower learners to adapt and thrive in an ever-changing world, preparing them for future challenges and opportunities. Through our commitment to inclusivity and excellence, we strive to shape a brighter future for all.</p>
                <a href="about-us" class="btn my-5">Know All</a>
            </div>
        </div>
    </section>
    <section class="bg-lightBack">
        <div class="row container py-12">
            <div class="col-span-12 md:col-span-5">
                <img src="images/static/join.jpg" alt="" class="p-3">
            </div>
            <div class="col-span-12 md:col-span-7">
                <div class="flex flex-col justify-center h-full">
                    <h3 class="heading">Shaping the Future of Learning</h3>
                    <p class="paragraph">
                    Shaping the Future of Learning envisions an inclusive education system that fosters lifelong learning. By embracing innovative teaching methods and advanced technology, we empower individuals to adapt, thrive, and unlock their potential, creating a brighter future for all.</p>
                    <button class="btn my-3">Sign up for Free</button>
                </div>
            </div>
        </div>
    </section>

    @if( $data ) @livewire('faqWhite', [ 'model' => 'Page', 'model_id' => $data->id]) @endif
    @if( $data ) @livewire('testimonial', [ 'model' => 'Page', 'model_id' => $data->id ]) @endif
</div>

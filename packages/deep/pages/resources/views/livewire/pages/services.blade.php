<section class="portfolio pt-12">
    <div class="container pt-5">
        <h1 class="subHeading">OUR SERVICES</h1>
        <p class="text-center">We provide complete end to end digital solutions and all these are done by in house team. Delivered on time and cost, we ensure the deliverables are met earnestly.</p>
        <div class="flex grid grid-cols-12 gap-4 mt-10">
            @foreach($data as $key => $i) @livewire('parts.singleserviceitem', [ "item" => $i, key($key) ]) @endforeach
        </div>
    </div>
    @livewire('parts.writeForUsBlock')
</section>
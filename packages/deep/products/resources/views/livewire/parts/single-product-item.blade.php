<div class="col-span-12 md:col-span-6 h-full mb-5 group deepShadow rounded-md">
    <div class="overflow-hidden">
        <img src="/storage/product/small/{{ optional($i->media)->media}}" alt="{{ optional($i->media)->alt }}" class="imgExpand rounded-t-lg" loading="lazy" width="430" height="235">
    </div>
    <div class="p-3">
        <h5 class="font-semibold text-xl oneliner">{{ $i->name }}</h5>
        <p class="flex "><strong class="font-bold pr-2">Manufacturer: </strong> {{$i->manufacturer}}</p>
        <p class="flex"><strong class="font-bold pr-2">Product functions: </strong> {{$i->functions}}</p>
        <p class=""><strong class="font-bold pr-2">TDS Code: </strong>{{$i->tds}}</p>
        <p class=""><strong class="font-bold pr-2">End Applications: </strong>{{$i->end}}</p>
        <div class="py-2" x-data="{ showForm: false }">
            <Button href="" @click="showForm = !showForm" class="btn">Order</Button>
            <!-- {{ $i->url }} -->

            @livewire ('form')


    <!-- Button to toggle form -->
    <!-- <div class="text-center">
        <button @click="showForm = !showForm" class="btn">Click For More</button>
    </div> -->

    <!-- Form that is shown/hidden -->
    <!-- <div x-show="showForm" x-transition class="mt-4">
        <form action="/submit" method="POST">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required class="input">

            <label for="email" class="mt-2">Email:</label>
            <input type="email" id="email" name="email" required class="input">

            <button type="submit" class="btn mt-4">Submit</button>
        </form>
    </div> -->







        </div>
    </div>
</div>
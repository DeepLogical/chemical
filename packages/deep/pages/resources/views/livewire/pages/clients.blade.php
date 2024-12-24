<div class="container py-5">
    <div class="grid grid-cols-2 gap-4 text-center md:grid-cols-6 py-5">
        @foreach($data as $i)
            <div wire:key="clients-{{ $loop->index}}" class="flex flex-col items-center justify-center mb-3">
                <img src="/images/clients/{{ $i['src']}}" alt="logo of {{ $i['name']}}" class="block object-contain h-12" width="100" height="60" loading="lazy"/>
                <h3 class="text-center text-sm font-bold py-3">{{ $i['name']}}</h3>
            </div>
        @endforeach
    </div>
</div>
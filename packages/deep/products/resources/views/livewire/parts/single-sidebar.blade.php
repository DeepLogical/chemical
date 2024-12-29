<div class="web col-span-12 md:col-span-4 web card" style="padding: 15px; height: fit-content">
    <div class="mb-5 py-5 px-3">
        <input type="text" class="formInput" wire:model="search" placeholder="Search">
    </div>
    <div class="mb-5 py-5 px-3">
        <p class="border-b-2 text-xl font-bold mb-4 pb-3">Category</p>
        <ul>
            @foreach($category as $i)
                <li wire:key="side-cat-{{ $loop->index }}">
                    <a href="/{{ $i->type }}/{{ $i->url }}" class="flex items-center justify-between text-gray-500 py-2 text-sm group">
                        <div class="flex items-center">
                            <img src="/images/icons/static/folder.svg" alt="" class="w-5 mr-3">
                            <span class="inline-block pr-3 hover:text-action">{{ $i->name }}</span>
                        </div>
                        <div class="mr-1 rounded-full flex items-center justify-center bg-gray-200 group-hover:bg-action" style="height: 30px; width: 30px;">
                            <p class="font-bold group-hover:text-white">{{ $i->products_count }}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div>
        <p class="border-b-2 text-xl font-bold mt-10 pb-3 mb-4">Tag</p>
        <divl>
            @foreach($tag as $i)
                <a href="/{{ $i->type }}/{{ $i->url }}" wire:key="side-tag-{{ $loop->index }}" class="p-2 border-2 inline-block mr-3 mb-3 rounded-md hover:border-action hover:text-action" class=" text-gray-500 py-2 text-sm">{{ $i->name }}</a>
            @endforeach
        </div>
    </div>
</div>
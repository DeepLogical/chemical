<div class="relative">
    @if($isOpen)
        <style>
            .modalImage{
                max-width: 80vw;
                height: auto;
                max-height: 95vh;
                width: auto;
            }
        </style>
        <div style="z-index:100" class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto flex items-center justify-center" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <header class="flex items-center justify-end p-2 absolute right-0 top-0">
                <button class="focus:outline-none p-2" wire:click="closeModal()"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#fff"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </header>
            <div class="opacity-100 w-full">
                <div class="text-gray-900 z-20 w-full"
                x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
                    <div class="flex items-center w-full p-3">
                        <div class="lightbox-btn-left" wire:click="leftActive()">
                            <button class="lightbox-btn lightbox-btn--ripple">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="#fff"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                            </button>
                        </div>
                        <img src="{{ $active_image }}" class="mx-auto modalImage" loading="lazy"/>
                        <div class="lightbox-btn-left" wire:click="rightActive()">
                            <button class="lightbox-btn lightbox-btn--ripple">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="#fff"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>                                
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
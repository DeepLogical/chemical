<div class="my-5 bg-primary noise">
    @honeypot
    <h2 class="heading text-white mb-5">Subscribe To Our Newsletter</h2>
    <section class="container p-5 py-5 rounded-md overflow-hidden row" style="background: url(/images/static/connect.jpg) no-repeat bottom right; background-size: cover">
        <div class="col-span-12 md:col-span-6">
            <p class="text-center text-white">Sign up to your newsletter for all the latest news and our exclusives promotion.</p>
        </div>
        <div class="col-span-12 md:col-span-6">
            <form wire:submit.prevent="submit" method="POST" autocomplete="off" class="bg-white rounded-lg w-full flex">
                <input type="email" class="border-none focus:border-none m-1 p-2 appearance-none text-gray-700 text-sm focus:outline-none w-full" placeholder="Enter your email" required wire:model.defer="email">
                @error('name') <span class="error">{{ $message }}</span> @enderror
                <div class="text-center">
                    <button class="m-1 p-2 text-white text-sm bg-action rounded-lg font-semibold uppercase lg:w-auto" wire:loading.remove wire:click="submit">Subscribe</button>
                    <span wire:loading class="m-1 p-2 text-white text-sm bg-action rounded-lg font-semibold uppercase lg:w-auto">Submit</span>
                </div>
            </form>
        </div>
    </section>
</div>
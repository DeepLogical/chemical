<form wire:submit.prevent="submit" method="POST" autocomplete="off">
    @honeypot    
    <div class="mb-3">
        <input type="text" wire:model="name" class="formInput" placeholder="Full Name *" required>
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <input type="email" wire:model="email" class="formInput" placeholder="Email ID *">
        @error('email') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <input type="number" wire:model="phone" class="formInput" placeholder="Phone Number *">
        @error('phone') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <textarea type="text" wire:model="message" class="h-40 formInput" placeholder="Your Message *" required></textarea>
        @error('message') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="text-center">
        <button type="submit" class="btn w-full" wire:loading.remove>Submit</button>
        <span wire:loading class="btn w-full">Submit</span>
    </div>
</form>
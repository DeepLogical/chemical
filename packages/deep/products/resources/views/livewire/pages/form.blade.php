<form x-show="showForm" x-transition wire:submit.prevent="submit" method="POST" autocomplete="off" class="bg-lightBack rounded-md p-2">
    <div class="mb-3">
        <input type="text" wire:model="name" class="formInput" placeholder="Full Name *" required>
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <input type="email" wire:model="email" class="formInput" placeholder="Email ID *" required>
        @error('email') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <input type="number" wire:model="phone" class="formInput" placeholder="Phone Number *" required>
        @error('phone') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <input type="text" wire:model="company" class="formInput" placeholder="Company*" required>
        @error('company') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <input type="text" wire:model="quantity" class="formInput" placeholder="Quantity*" required>
        @error('quantity') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <input type="text" wire:model="message" class="formInput" placeholder="Message*" required>
        @error('message') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <input type="text" wire:model="location" class="formInput" placeholder="Location *" required>
        @error('location') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <select wire:model="product_id" required class="formInput">
            <option value="">Product</option>
            @foreach( $product_options as $i ) <option value="{{ $i->id }}">{{ $i->name }}</option> @endforeach
        </select>
        @error('product_id') <span class="error">{{ $message }}</span> @enderror
    </div>
    <button type="submit" class="btn w-full ">Submit</button>
</form>
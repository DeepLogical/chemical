
    <div class="popup-form glass rounded-md p-6 relative">
        <button @click="showForm = false" class="absolute top-0 right-0 p-2 text-xl text-white">X</button>
        <h3 class="heading text-center text-white">Order Form</h3>

        <!-- Livewire Form -->
        <form wire:submit.prevent="submit" method="POST" autocomplete="off">
            <div class="mb-3">
                <input type="text" wire:model="name" class="formInput w-full p-2 border" placeholder="Full Name *" required>
                @error('name') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <input type="email" wire:model="email" class="formInput w-full p-2 border" placeholder="Email ID *" required>
                @error('email') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <input type="number" wire:model="phone" class="formInput w-full p-2 border" placeholder="Phone Number *" required>
                @error('phone') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <input type="text" wire:model="company" class="formInput w-full p-2 border" placeholder="Company *" required>
                @error('company') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <input type="text" wire:model="quantity" class="formInput w-full p-2 border" placeholder="Quantity *" required>
                @error('quantity') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <input type="text" wire:model="message" class="formInput w-full p-2 border" placeholder="Message *" required>
                @error('message') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <input type="text" wire:model="location" class="formInput w-full p-2 border" placeholder="Location *" required>
                @error('location') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <select wire:model="product_id" required class="formInput w-full p-2 border">
                    <option value="">Select Product</option>
                    @foreach($product_options as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $product_id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_id') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn w-full text-white p-2 rounded-md">Submit</button>
        </form>
    </div>

<div>    
    <div class="bg-dark fixed h-full left-0 top-0 w-full z-50 @if( !$isOpen ) hidden @endif">
        <div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-1/2 overflow-y-auto right-0 w-full z-20">
            <div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
                <h2 class="font-bold w-full">{{ $heading }}</h2>
                <img src="{{ asset('/images/icons/static/cross.svg') }}" class="closeAuthModel ml-auto hover:cursor-pointer h-6 w-6" wire:click="closeModal()">
            </div>
            <div class="h-70 md:h-full p-2">
            <form wire:submit.prevent="submit" method="POST" autocomplete="off">
                        <div class="grid grid-cols-12 gap-2 md:gap-4 p-2">
                            <div class="col-span-12">
                                <label class="formLabel">Name *</label>
                                <input type="text" wire:model="name" class="formInput" placeholder="Add Name" required/>
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label class="formLabel">Email</label>
                                <input type="email" wire:model="email" class="formInput" placeholder="email"/>
                                @error('email') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label class="formLabel">Phone *</label>
                                <input type="number" wire:model="phone" class="formInput mobileNum" onkey="validateMobile()" placeholder="Phone" required/>
                                @error('phone') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label class="formLabel">Password *</label>
                                <input class="formInput" type="password" wire:model="password" required placeholder="{{ __('Password') }}"/>
                            </div>
                            <div class="col-span-12">
                                <label class="formLabel">Confirm Password *</label>
                                <input class="formInput" type="password" wire:model="password_confirmation" required placeholder="{{ __('Confirm Password') }}"/>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <label class="formLabel">Role *</label>
                                <select wire:model="role" class="formInput" required>
                                    <option value="">Select Role</option>
                                    @foreach( $role_options as $i ) <option value="{{ $i->name }}">{{ $i->name }}</option> @endforeach
                                </select>
                                @error('role') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="text-center sticky bottom-0 p-2 bg-white border-t-2">
                            <button class="btn w-full" wire:loading.remove>Submit</button>
                            <span wire:loading class="btn w-full">Submit</span>
                        </div>
                    </form>
            </div>
        </div>
    </div>    
</div>
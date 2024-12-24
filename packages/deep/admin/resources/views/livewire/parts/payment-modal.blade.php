<div>
    @if($isOpen)
        <div class="bg-dark fixed h-full left-0 top-0 w-full z-50">
            <div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-1/2 overflow-y-auto right-0 w-full z-20">
                <div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
                    <h2 class="font-bold w-full">Recharge Wallet Here</h2>
                    <img src="{{ asset('/images/icons/static/cross.svg') }}" class="closeAuthModel ml-auto hover:cursor-pointer h-6 w-6" wire:click="closeModal()">
                </div>
                <div class="h-70 md:h-full">
                    <form wire:submit.prevent="submit" method="POST" autocomplete="off" class="relative">
                        <div class="row p-2">
                            <div class="col-span-12">
                                <label class="formLabel">Name *</label>
                                <input type="test" wire:model="name" class="formInput" placeholder="Customer Name" readonly/>
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label class="formLabel">Email *</label>
                                <input type="test" wire:model="email" class="formInput" placeholder="Customer Email" readonly/>
                                @error('email') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label class="formLabel">Phone *</label>
                                <input type="test" wire:model="phone" class="formInput" placeholder="Customer Phone" readonly/>
                                @error('phone') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label class="formLabel">Amount *</label>
                                <input type="number" wire:model="amount" class="formInput" placeholder="Recharge Amount" required/>
                                @error('amount') <span class="error">{{ $message }}</span> @enderror
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
    @endif
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <script>
                window.addEventListener('makeRzpPayment', e => {
                    var options = JSON.parse(e.detail.data);
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                    e.preventDefault();
                });
            </script>
</div>
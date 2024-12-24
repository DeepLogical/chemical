<div class="container py-5 md:py-12">
    <div style="max-width: 60%; margin: 0 auto">
        <div class="mb-5">
            <a href="/"><img src="/images/logo.png" alt="{{ config('deep.brand') }}" class="" style="max-width: 150px"></a>
            <h1 class="text-action font-bold text-2xl py-3">Login</h1>
        </div>
        <form wire:submit.prevent="submit" method="POST" autocomplete="off">
            <div class="row">
                <div class="col-span-12">
                    <input type="text" wire:model="username" class="formInput" placeholder="Email / Phone*" required/>
                    @error('username') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-12">
                    <input class="formInput" type="password" wire:model="password" placeholder="{{ __('Password *') }}" required/>
                </div>
                <div class="col-span-12 text-center">
                    <button class="btn w-full" wire:loading.disable>Login</button>
                </div>
                <div class="col-span-12">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-right block mt-4 text-action font-bold" href="{{ route('password.request') }}">
                            {{ __('Forgot Password?') }}
                        </a>
                    @endif

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <p class="text-center py-5">Dont have an Account? <a href="/register" class="font-bold text-action">Register</a></p>
                </div>
            </div>
        </form>
    </div>
</div>
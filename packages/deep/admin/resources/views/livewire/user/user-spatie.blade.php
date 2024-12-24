<div>
    @livewire('adminSearch', ['page' => 'Assign Roles & Permissions', 'routeName' => '', 'routeText' => 'Add Roles & Permissions', 'link' => ''])

    <div class="container">
        <h1 class="heading">{{ optional($data->staff)->name }}</h1>
        <form wire:submit.prevent="submit" method="POST" autocomplete="off">
            <div class="row">
                <div class="col-span-12 md:col-span-4">
                    <label for="role" class="formLabel">Role</label>
                    <select wire:model="role" class="formInput" required>
                        <option value="">Select Role</option>
                        @foreach($role_options as $i)<option value="{{ $i->id }}" wire:key="role_options-{{ $loop->index }}">{{ ucfirst( $i->name ) }}</option>@endforeach
                    </select>
                    @error('role') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-12 md:col-span-4">
                    <label class="formLabel">Status</label>
                    <select wire:model="status" class="formInput" required>
                        <option value="">Select Status</option>
                        <option value="1">Show</option>
                        <option value="0">Hide</option>
                    </select>
                    @error('status') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="my-5">
                <h2 class="heading">Permissions</h2>
                <div class="row py-5">
                    @foreach($permissions as $key => $i)
                        <div wire:key="permission-{{ $i->id }}" class="col-span-6 md:col-span-3 flex items-center pb-1 options">
                            <input type="checkbox" name="permissionSelected" value="{{ $i->id }}" wire:model="permissionSelected" class="checkbox mr-3" id="permission-{{ $i->id }}" {{ in_array($i->id, $permissionSelected) ? 'checked' : '' }} >
                            <label class="checklabel hover:cursor-pointer" for="permission-{{ $i->id }}">{{ ucwords($i->name) }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
    
            <div class="text-center mt-5">
                <button class="btn">Submit</button>
            </div>
        </form>
    </div>
</div>
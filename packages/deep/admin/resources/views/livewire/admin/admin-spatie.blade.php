<div>
    @livewire('adminSearch', ['page' => 'Admin Roles & Permissions', 'routeName' => '', 'routeText' => 'Add Roles & Permissions', 'link' => 'true'])

    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Type</th>
                <th>Name</th>
                <th>Guard Name</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $i)
                <tr wire:key="roles-{{$loop->index}}">
                    <td>{{ $loop->index +1}}</td>
                    <td>Role</td>
                    <td>{{$i->name}}</td>
                    <td>{{$i->guard_name}}</td>
                    <td>{{ \Carbon\Carbon::parse($i->created_at)->isoFormat('Do MMM YYYY')}}</td>
                    <td><button class="editBtn" wire:click='edit( {{ json_encode( $i ) }}, "role" )'>Edit</button></td>
                </tr>
            @endforeach
            @foreach($permissions as $i)
                <tr wire:key="permissions-{{$loop->index}}">
                    <td>{{ $loop->index +1}}</td>
                    <td>Permission</td>
                    <td>{{$i->name}}</td>
                    <td>{{$i->guard_name}}</td>
                    <td>{{ \Carbon\Carbon::parse($i->created_at)->isoFormat('Do MMM YYYY')}}</td>
                    <td><button class="editBtn" wire:click='edit( {{ json_encode( $i ) }}, "permission" )'>Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($isOpen)
        <div class="bg-dark fixed h-full left-0 overflow-y-auto top-0 w-full z-50">
            <div class="bg-white animated fade border bottom-0 md:fixed h-70 md:h-full md:w-1/4 overflow-y-auto right-0 w-full z-20">
                <div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
                    <h2 class="font-bold w-full">Add / Update Role & Permission</h2>
                    <img src="{{ asset('/images/icons/static/cross.svg') }}" class="closeAuthModel ml-auto hover:cursor-pointer h-6 w-6" wire:click="closeModal()">
                </div>
                <div class="h-70 md:h-full p-2">
                    <form wire:submit.prevent="submit" method="POST" autocomplete="off">
                        <div class="bg-white grid grid-cols-12 gap-2 md:gap-4">
                            <div class="col-span-12">
                                <label for="type" class="formLabel">Type</label>
                                <select wire:model="type" class="formInput" required>
                                    <option value="">Select Type</option>
                                    <option value="role">Role</option>
                                    <option value="permission">Permission</option>
                                </select>
                                @error('type') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="name" class="formLabel">Name</label>
                                <input type="text" wire:model="name" class="formInput" placeholder="Add Name" required/>
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <button class="btn w-full" wire:loading.remove>Submit</button>
                            <span wire:loading class="btn w-full">Please Wait</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
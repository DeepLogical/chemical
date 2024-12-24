<div>
    @livewire('adminSearch', ['page' => 'Admin Users', 'routeName' => '', 'routeText' => 'Add Users', 'link' => ''])

    <div class="row mb-3">
        <div class="col-span-9"></div>
        <div class="col-span-12 md:col-span-3">
            <select wire:model="role" class="formInput">
                <option value="">All Roles</option>
                @foreach( $roleOptions as $i )<option value="{{ $i->name }}">{{ $i->name }}</option>@endforeach
            </select>
        </div>
    </div>
    
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>User</th>
                <th>Email Verification</th>
                <th>Wallet</th>
                <th>Role</th>
                <th>Date</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index }}" style="background: @if($i->wallet < 2000) #dbdbdb @endif">
                    <td>{{ $loop->index +1 }}</td>
                    <td>{{ $i->name }} ( {{ $i->email }} || {{ $i->phone }} )</td>
                    <td>
                        @if( $i->email_verified_at )
                            {{ \Carbon\Carbon::parse($i->email_verified_at)->isoFormat('Do MMM YYYY')}}
                        @else
                            Not Verified
                        @endif
                    </td>
                    <td>&#8377;{{ $i->wallet }}</td>
                    <td>
                        @foreach($i['roles'] as $j)
                            <span wire:key="roles-{{ $loop->index }}">{{ ucfirst( $j['name'] )}}</span>
                        @endforeach
                    </td>
                    <td>{{ \Carbon\Carbon::parse($i->created_at)->isoFormat('Do MMM YYYY') }}</td>
                    <td>
                        <div class="flex items-center">
                            <div class="threeDots">
                                <img src="/images/icons/static/action.svg">
                                <div class="dotOptions" style="display:none">
                                    <button wire:click="openModal( '{{ encode( $i->id ) }}' )">Edit</button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif

    @if($isOpen)
        <div class="bg-dark fixed h-full left-0 top-0 w-full z-50">
            <div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-1/2 overflow-y-auto right-0 w-full z-20">
                <div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
                    <h2 class="font-bold w-full">Update User</h2>
                    <img wire:click="closeModal()" src="/images/icons/static/cross.svg" class="h-6 w-6 ml-auto hover:cursor-pointer">
                </div>
                <div class="h-70 md:h-full p-2">
                    <form wire:submit.prevent="submit" method="POST" autocomplete="off">
                        <div class="row">
                            <div class="col-span-12">
                                <label for="name" class="formLabel">Name</label>
                                <input type="text" wire:model="name" class="formInput" readonly />
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="role" class="formLabel">Role</label>
                                <select wire:model="role_id" class="formInput" required>
                                    <option value="">Select Role</option>
                                    @foreach($roleOptions as $i)<option value="{{ $i->id }}" wire:key="roleOptions-{{ $loop->index }}">{{ ucfirst( $i->name ) }}</option>@endforeach
                                </select>
                                @error('role_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            @if( $remarks )
                                <div class="col-span-12">
                                    <label class="formLabel">How did you know about us?</label>
                                    <textarea type="text" wire:model="remarks" class="formInput" readonly></textarea>
                                </div>
                            @endif
                        </div>
                        <div class="text-center mt-5">
                            <button class="editBtn w-full" wire:loading.remove>Submit</button>
                            <span wire:loading class="editBtn w-full">Submit</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
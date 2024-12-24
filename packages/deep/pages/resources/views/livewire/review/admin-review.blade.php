<div>
    @livewire('adminSearch', [ 'perPage' => $perPage, 'page' => 'Admin Reviews', 'routeName' => '', 'routeText' => '', 'link' => ''])

    <table class="admin min-w-full table-auto">
        <thead>
        <tr>
            <th>Sl No.</th>
            <th>Model</th>
            <th>Model Id</th>
            <th>User</th>
            <th>Rating</th>
            <th>Review</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbod>
            @foreach($data as $i)
                <tr>
                    <td>{{ $loop->index +1}}</td>
                    <td>{{ $i->model }}</td>
                    <td>
                        @if( $i->model == 'Product' ) {{ optional($i->product)->name }} @endif
                        @if( $i->model == 'Training' ) {{ optional($i->training)->name }} @endif
                        @if( $i->model == 'Coach' ) {{ optional(optional($i->coach)->user)->name }} @endif
                    </td>
                    <td>{{ optional($i->user)->name }}</td>
                    <td>{{ $i->rating }}</td>
                    <td>{{ $i->review }}</td>
                    <td>
                        <div class="gsap">
                            <label class="switch">
                                <input type="checkbox" wire:click="changeStatus('{{encode($i->id)}}', '{{encode($i->status)}}')" @if($i->status) checked @endif/>
                                <svg viewBox="0 0 38 24" filter="url(#goo)"><circle class="default" cx="12" cy="12" r="8"/><circle class="dot" cx="26" cy="12" r="8"/></svg>
                            </label>
                        </div>
                    </td>
                    <td>
                        <button class="editBtn" wire:click="edit( '{{ encode( $i->id ) }}' )">Edit</button>
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
                    <h2 class="font-bold w-full">Update Review Here</h2>
                    <img src="{{ asset('/images/icons/static/cross.svg') }}" class="closeAuthModel ml-auto hover:cursor-pointer h-6 w-6" wire:click="closeModal()">
                </div>
                <div class="h-70 md:h-full p-2">
                    <form wire:submit.prevent="submit" method="POST">
                        <div class="bg-white">
                            <div class="row">
                                <div class="col-span-12">
                                    <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                                    <input type="text" wire:model="model" class="formInput" readonly />
                                </div>
                                <div class="col-span-12">
                                    <label for="model_name" class="block text-sm font-medium text-gray-700">Model Id</label>
                                    <input type="text" wire:model="model_name" class="formInput" readonly />
                                </div>
                                <div class="col-span-12">
                                    <label for="rating" class="block text-sm font-medium text-gray-700">Rating *</label>
                                    <select wire:model="rating" class="formInput" required>
                                        <option value="">Select Rating</option>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5">5 Star</option>
                                    </select>
                                    @error('rating') <span class="error">{{ $message }} @enderror
                                </div>
                                <div wire:ignore class="col-span-12">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                    <select wire:model="status" required class="formInput">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Not Active</option>
                                    </select>
                                </div>
                                <div class="col-span-12">
                                    <label for="review" class="block text-sm font-medium text-gray-700">Review *</label>
                                    <textarea type="text" wire:model="review" class="formInput" required placeholder="Review"></textarea>
                                    @error('review') <span class="error">{{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn w-full" wire:loading.remove>Submit</button>
                            <span wire:loading class="btn w-full">Submit</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
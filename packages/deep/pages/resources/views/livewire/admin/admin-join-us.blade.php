<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'Admin Career', 'routeName' => '', 'routeText' => 'Admin Career', 'link' => ''])

    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Applicant</th>
                <th>Subject</th>
                <th>Resume</th>
                <th>Cover</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index}}">
                    <td>{{ $loop->index +1}}</td>
                    <td>{{ $i->name }}<br/>{{ $i->email }} || {{ $i->phone }}</td>
                    <td>{{ $i->subject }}</td>
                    <td>
                        @if( $i->resume ) <span class="hover:cursor-pointer text-action" wire:click="downloadFile( 'job-resume', '{{ $i->resume }}' )">Resume</span>@endif
                    </td>
                    <td>
                        @if( $i->cover ) <span class="hover:cursor-pointer text-action" wire:click="downloadFile( 'job-cover', '{{ $i->cover }}' )">Cover</span>@endif
                    </td>
                    <td>{{ ucfirst( $i->status ) }}</td>
                    <td>{{ $i->updated_at->diffForHumans()}}</td>
                    <td><button class="editBtn" wire:click="edit('{{ encode( $i->id ) }}')">Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif

    @if($isOpen)
        <div class="bg-dark fixed h-full left-0 top-0 w-full z-50">
            <div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-1/2 overflow-y-auto right-0 w-full z-20">
                <div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
                    <h2 class="font-bold w-full">Add / Update Achievement</h2>
                    <img src="{{ asset('/images/icons/static/cross.svg') }}" class="closeAuthModel ml-auto hover:cursor-pointer h-6 w-6" wire:click="closeModal()">
                </div>
                <div class="h-70 md:h-full p-2">
                <form wire:submit.prevent="submit" method="POST"  autocomplete="off" class="card p-3">
                    <div class="row">
                        <div class="col-span-12">
                            <label for="name" class="formLabel">Name *</label>
                            <input type="text" value="{{ $entry->name }}" class="formInput" readonly>
                        </div>
                        <div class="col-span-12">
                            <label for="name" class="formLabel">Email *</label>
                            <input type="email" value="{{ $entry->email }}" class="formInput" readonly>
                            
                        </div>
                        <div class="col-span-12">
                            <label for="name" class="formLabel">Phone *</label>
                            <input type="number" value="{{ $entry->phone }}" class="formInput" readonly>
                            
                        </div>
                        <div class="col-span-12">
                            <label for="name" class="formLabel">Subject</label>
                            <input type="text" value="{{ $entry->subject }}" class="formInput" readonly>
                            
                        </div>
                        <div class="col-span-12">
                            <label for="name" class="formLabel">Message</label>
                            <textarea type="text" class="formInput" placeholder="Your Message" readonly>{{ $entry->message }}</textarea>                            
                        </div>
                        <div class="col-span-12">
                            <label class="formLabel">Status</label>
                            <select wire:model="status" class="formInput" required>
                                <option value="">Select Status</option>
                                <option value="requested">Requested</option>
                                <option value="For Furture">For Furture</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                            @error('status') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3 col-span-12">
                            <label for="name" class="formLabel">Admin Remarks</label>
                            <textarea type="text" wire:model="admin_remarks" class="h-40 formInput" placeholder="Admin Remarks"></textarea>
                            @error('admin_remarks') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-12 text-center">
                            <button type="submit" class="btn w-full" wire:loading.remove>Submit</button>
                            <span wire:loading class="btn w-full">Submit</span>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    @endif
</div>
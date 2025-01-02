<div>
    @livewire('adminSearch', ['page' => 'Admin Form', 'routeName' => '', 'link' => '', 'routeText' => '','link' => ''])
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>User</th>
                <th>Location</th>
                <th>Company</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Message</th>
                <th>Status</th>
                <th>Admin Remarks</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead> 
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index }}">
                    <td>{{ $loop->index +1 }}</td>
                    <td>{{ $i->name }}<br/>{{ $i->email }} || {{ $i->phone }}</td>
                    <td>{{ $i->location}}</td>
                    <td>{{ $i->company}}</td>
                    <td>{{ optional($i->product)->name  }}</td>
                    <td>{{ $i->quantity }}</td>
                    <td>{{ $i->message }}</td>
                    <td>{{ $i->status }}</td>
                    <td>{{ $i->admin_remarks }}</td>
                    <td>{{ \Carbon\Carbon::parse($i->updated_at)->isoFormat('Do MMM YYYY') }}</td>
                    <td><button class="editBtn" wire:click="edit( '{{ encode( $i->id ) }}' )">Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif
</div>
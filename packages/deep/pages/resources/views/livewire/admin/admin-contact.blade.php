<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'Admin Contact', 'routeName' => '', 'routeText' => 'Admin Contact', 'link' => ''])
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index}}">
                    <td>{{ $loop->index +1}}</td>
                    <td>{{ $i->name }}</td>
                    <td>{{ $i->email }}</td>
                    <td>{{ $i->phone }}</td>
                    <td>{{ $i->message }}</td>
                    <td>{{ $i->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif
</div>
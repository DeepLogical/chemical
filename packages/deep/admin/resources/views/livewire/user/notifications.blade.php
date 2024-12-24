<div>
    @livewire('adminSearch', ['page' => 'Admin Notifications', 'routeName' => '', 'routeText' => '', 'link' => ''])
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Notification</th>
                <th>Date</th>
                <th>Read On</th>
            </tr>
        </thead>
        <tbody>
            @foreach( Auth::user()->notifications as $i )
                <tr wire:key="data-{{ $loop->index }}">
                    <td>{{ $loop->index +1 }}</td>
                    <td><a href="{{ $i->data['url'] }}" target="_blank">{{ $i->data['message'] }}</a></td>
                    <td>{{date('d-m-Y', strtotime($i->created_at)) }}</td>
                    <td>{{date('d-m-Y', strtotime($i->read_at)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

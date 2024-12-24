<div>
    @livewire('adminSearch', ['page' => 'Page Scan', 'routeName' => '', 'routeText' => '', 'link' => ''])

    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Type</th>
                <th>Page</th>
                <th>URL</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index }}">
                    <td>{{ $loop->index +1 }}</td>
                    <td>Blog</td>
                    <td><a href="/{{ $i->url }}" target="_blank">{{ $i->name }}</a></td>
                    <td>{{ $i->url }}</td>
                    <td>
                        <!-- <button class="editBtn" wire:click="scan('{{ $i->url }}')">Scan</button> -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
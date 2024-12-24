<div class="py-5">
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'Payments', 'routeName' => '', 'routeText' => 'Payments', 'link' => ''])
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th># </th>
                <th>User</th>
                <th>Purpose</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index}}">
                    <td>{{ $loop->index +1 }}</td>
                    <td>
                        @if(optional($i->user)->profile)<a href="{{ optional(optional($i->user)->profile)->url }}">@endif
                            {{ optional($i->user)->name }}
                        @if(optional($i->user)->profile)</a>@endif
                    </td>
                    <td>{{ $i->for}}</td>
                    <td>&#8377;{{ $i->amount}}</td>
                    <td>{{ $i->created_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif
</div>
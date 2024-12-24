<div>
    @livewire('adminSearch', ['page' => 'Wallet Recharge History', 'routeName' => '', 'routeText' => 'Recharge Wallet', 'link' => 'false'])
    <p><strong>Current Wallet Balance : </strong>&#8377;{{ Auth::user()->wallet }}</p>
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index }}">
                    <td>{{ $loop->index +1 }}</td>
                    <td>&#8377;{{ $i->amount }}</td>
                    <td>{{ \Carbon\Carbon::parse($i->created_at)->isoFormat('Do MMM YYYY') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif

    @livewire('paymentModal')
</div>
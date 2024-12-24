<div class="mb-2">
    @if( $data && count( $data ) )
        <div class="fijb px-3 py-2 mb-3">
            <ul class="fijb justify-around w-full">
                @foreach( $data as $i ) 
                    <li class="px-3 font-bold @if( $parent && $parent == $i['link'] ) bg-action text-white rounded-md @endif"><a href="{{ route($i['link']) }}">{{ $i['name'] }}</a></li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="fijb">
        @if( $links && count( $links) )
            <div class="flex flex-wrap items-center">
                @foreach( $links as $i )
                    <a wire:key="search-{{ $loop->index }}" href="{{ route($i['link']) }}" class="border-2 border-action px-3 py-1 rounded-md mr-1 mb-3 @if( $i['link'] == $currentRoute ) editBtn @endif">{{ $i['name'] }}</a>
                @endforeach
            </div>
        @endif
        <div class="fijb">
            @if($link)<button wire:click="openModal" class="bg-action text-white py-2 px-4 rounded">{{ $routeText }}</button>@endif
            @if($routeName)<a href="{{ route($routeName) }}" class="bg-action text-white py-2 px-4 rounded">{{ $routeText }}</a>@endif
            @if( $showSearch )
                <form wire:submit.prevent="searchClicked" method="POST" autocomplete="off" class="mx-3">
                    <input type="text" class="formInput" placeholder="Search" wire:model="search" id="focusInput">
                </form>
            @endif
            <img src="/images/icons/static/search.svg" class="w-5 hover:cursor-pointer mx-3" wire:click="searchClicked()">
            <select wire:model.live="perPage" class="formInput" style="width:fit-content; padding-right: 50px">@foreach($page_options as $i)<option wire:key="page_option-{{ $loop->index }}">{{ $i}}</option>@endforeach</select>
            <!-- <img wire:click="$emit('toggleAdminSidebar')" src="/images/icons/grid-icon.svg" class="w-5 hover:cursor-pointer mx-3"> -->
        </div>
    </div>
    @push("scripts")
        <script>
            $('#dateRange').daterangepicker({
                autoUpdateInput: false,
                locale: { cancelLabel: 'Clear' }
            });

            $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
                $('#dateRange').html(picker.startDate.format('MMM Do, YYYY')+' - ' +picker.endDate.format('MMM Do, YYYY'));
                $('#dateSpecific').html("Specific Date");

                @this.emit( 'dateRangeUpdated', picker.startDate.format('YYYY-MM-DD'), picker.endDate.format('YYYY-MM-DD') )   
            });

            $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
                $('#dateRange').html("All Dates");
                @this.emit( 'dateRangeUpdated', null, null ) 
            });

            $('#dateSpecific').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false,
                locale: { cancelLabel: 'Clear' }
            });

            $('#dateSpecific').on('apply.daterangepicker', function(ev, picker) {
                $('#dateRange').html("All Dates");
                $('#dateSpecific').html(picker.startDate.format('MMM Do, YYYY'));
                @this.emit( 'specificDateSelected', picker.startDate.format('Y-M-D') )
            });

            $('#dateSpecific').on('cancel.daterangepicker', function(ev, picker) {
                $('#dateSpecific').html("Specific Date");
                @this.emit( 'specificDateSelected', null )
            });

            document.addEventListener('livewire:load', function () {
                document.getElementById('focusInput').focus();
            });
        </script>
    @endpush
</div>
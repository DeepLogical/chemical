<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'Admin Page', 'routeName' => 'addUpdatePage', 'routeText' => 'Add Page', 'link' => ''])

    <table class="admin min-w-full table-auto searchable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name || URL</th>
                <th>Meta</th>
                <th>FAQ</th>
                <th>Testimonial</th>
                <th>SSS</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr class="options" data-name="{{ $i->name }}" wire:key="data-{{ $loop->index}}">
                    <td>{{ $loop->index +1}}</td>
                    <td class="hover:cursor-pointer" onclick="window.open('{{ $i->url }}', '_blank')">
                        @if($i['media'])
                            <img src="{{ optional($i->media)->path }}" class="w-16" loading="lazy"/>
                        @endif
                        {{ $i->name }}<br/>{{ $i->url }}
                        <br/><strong>ID - {{ $i->id}}</strong>
                    </td>
                    <td>
                        @if($i->meta)
                            <span class="{{ strlen( $i->meta->title ) < 50 || strlen( $i->meta->title ) > 60 ? 'bg-action text-white px-1 py-1' : '' }}">Title: {{ $i->meta->title }} - {{ strlen( $i->meta->title ) }}</span><br/>
                            <span class="{{ strlen( $i->meta->description ) < 140 || strlen( $i->meta->description ) > 160 ? 'bg-action text-white px-1 py-1' : '' }}">Description: {{ $i->meta->description}} -  {{ strlen( $i->meta->description ) }}</span>
                        @endif
                    </td>
                    <td>{{ $i->faqTotal }}</td>
                    <td>{{ $i->testisTotal }}</td>
                    <td class="min-w-100">
                        <span class="@if($i->status==0) text-action @endif">Status - @if($i->status==0) Hide @else Show @endif<br/></span>
                        <span class="@if($i->sitemap==0) text-action @endif">Sitemap - @if($i->sitemap==0) Hide @else Show @endif<br/></span>
                        <span class="@if($i->schema==0) text-action @endif">Schema - @if($i->schema==0) Hide @else Show @endif </span>
                    </td>
                    <td>
                        <div class="flex items-center">
                            <div class="threeDots">
                                <img src="/images/icons/static/action.svg">
                                <div class="dotOptions" style="display:none">
                                    <a href="{{ route('addUpdatePage', ['id' => encode($i->id)] ) }}">Edit</a>
                                    <a href="{{ route('addUpdateFaq', [ 'model' => 'Page', 'id' => encode($i->id)] ) }}">Edit FAQ</a>
                                    <a href="{{ route('addUpdateTestimonial', [ 'model' => $i->model, 'id' => encode($i->id)] ) }}">Edit Testimonial</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
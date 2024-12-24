<div>
	<style>
		.quoteLR {
			font-size: 7rem;
			line-height: 1;
		}
		.rquote{
			right: 2.5em;
		}
        .lquote{
            top: 10px;
        }
        .tint{
            background: linear-gradient(#243b551a,#141e30a6);
        }
        h1{
            text-shadow: 3px 3px #ad2e24;
        }
        @media (max-width:767px){
            h1{
                text-shadow: 1px 1px #ad2e24;
            }
            .quoteLR {
                font-size: 3rem;
            }
        }
	</style>
    <div class="relative">
        <img src="/storage/blog/{{ $data->media->media}}" alt="@if($data->alt){{ $data->alt }}@else{{ $data->name}}@endif" class="web" width="180" height="750" loading="lazy">
        <img src="{{ $data->media->media}}" alt="@if($data->alt){{ $data->alt }}@else{{ $data->name}}@endif" class="mobile" width="450" height="188" loading="lazy">
        <div class="top-1/2 text-center left-0 right-0 absolute px-4 z-20">
            <h1 class="text-xl md:text-3xl font-bold text-white z-25">{{ $data->name}}</h1>
        </div>
        <div class="tint top-0 left-0 right-0 absolute w-full h-full"></div>
    </div>
    <div class="container pt-5">
        <div class="content">
            {!! $data->content !!}
            {!! $data->excerpt !!}
            @if($data && $data->faq && count($data->faq) ) @livewire('faq', ["data"=>$data->faq, "title"=>"Frequently asked question on $data->name"]) @endif
            @if($data->author)
                <div class="row border-t-2 my-5">
                    <div class="col-span-12 md:col-span-2">
                        <img src="{{ optional(optional($data->author)->media)->path }}" alt="{{ optional(optional($data->author)->media)->alt }}" class="rounded-md" loading="lazy" width="200" height="300">
                    </div>
                    <div class="col-span-12 md:col-span-10 p-2 md:p-5">
                        <h3 class="font-semibold mb-3">Author: {{ optional($data->author)->name }}</h3>
                        <p>{!! optional($data->author)->bio !!}</p>
                    </div>
                </div>
            @endif
            <section class="component bg-action my-3 p-5 md:p-10 rounded relative">
                <div class="text-white absolute leading-tight h-4 md:h-10 -mt-3 quoteLR lquote">“</div>
                <p class="text-white text-center pt-2 md:pt-10 pb-2">Feel free to use images in our website by simply providing a source link to the page they are taken from. </p>
                <p class="text-white text-center">-- DEEP</p>
                <div class="text-white text-right leading-tight h-4 md:h-10 -mt-3 quoteLR rquote">”</div>
            </section>
            
        </div>

        @if( count($data->services) )
            <div class="col-span-12">
                @livewire('servicesSlider', [ 'services' => $data->services ])
            </div> 
        @endif
        @livewire('singleComments', [ 'model'=> 'Blog', 'model_id' => $data->id, 'title' => $data->name ])
    </div>
        @livewire('suggestBlogs')
</div>
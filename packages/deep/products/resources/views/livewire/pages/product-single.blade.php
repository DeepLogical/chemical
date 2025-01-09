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

        @media (max-width:767px){
            h1{
                text-shadow: 1px 1px #ad2e24;
            }
            .quoteLR {
                font-size: 3rem;
            }
        }
        #stickyForm {
            width: 100%;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 500ms;
        }
	</style>
    <div class="bg-primary">
        <div class="row container py-12">
            <div class="col-span-12 md:col-span-8">
                <h5 class="font-semibold text-xl text-white">{{ $data->name }}</h5>
                <p class="flex text-white"><strong class="font-bold pr-2">Manufacturer : </strong> {{$data->manufacturer}}</p>
                <p class="flex text-white"><strong class="font-bold pr-2">Product functions: </strong> {{$data->functions}}</p>
                <p class="text-white"><strong class="font-bold pr-2">TDS Code: </strong>{{$data->tds}}</p>
                <p class="text-white"><strong class="font-bold pr-2">End Applications: </strong>{{$data->end}}</p>                
            </div>
            <div class="col-span-12 md:col-span-4">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-span-12 md:col-span-8 order-2 md:order-1">
                @livewire('singleComments', [ 'model'=> 'Product', 'model_id' => $data->id, 'title' => $data->name ])
            </div>
            <div class="col-span-12 md:col-span-4 relative order-1 md:order-2">
                <div id="stickyForm" class="deepShadow my-2">
                    <img src="/storage/Product/{{ $data->media->media}}" alt="@if($data->alt){{ $data->alt }}@else{{ $data->name}}@endif" width="180" height="750" loading="lazy">
                    @livewire('form')
                </div>
            </div>
        </div>
    </div>
    @livewire('suggestProduct')
    <script>
        function handleStickyForm() {
            var stickyForm = document.getElementById('stickyForm');
            var scrollPosition = window.scrollY || window.pageYOffset;

            if (window.innerWidth > 768) {
                if (scrollPosition > 400) {
                    stickyForm.classList.remove('absolute');
                    stickyForm.classList.add('sticky');
                    stickyForm.style.top = '0';
                } else {
                    stickyForm.classList.remove('sticky');
                    stickyForm.classList.add('absolute');
                    stickyForm.style.top = '-170px';
                }
            }   
        }
        window.addEventListener('scroll', handleStickyForm);
        window.addEventListener('load', handleStickyForm);
        window.addEventListener('resize', handleStickyForm); 

        document.addEventListener('alpine:init', () => {
            Alpine.data('readingTimeEstimator', () => ({
                readingTime: '',
                wordsPerMinute: 200,
                init() {
                    const words = document.body.innerText.split(/\s+/).filter(Boolean).length;
                    const minutes = Math.floor(words / this.wordsPerMinute);
                    const seconds = Math.round((words % this.wordsPerMinute) * 60 / this.wordsPerMinute);
                    this.readingTime = `${minutes} min & ${seconds} sec`;
                }
            }));
        });
    </script>

</div>
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
    <div class="bg-gray-700">
        <!-- <img src="/storage/Product/{{ $data->media->media}}" alt="@if($data->alt){{ $data->alt }}@else{{ $data->name}}@endif" class="web" width="180" height="750" loading="lazy">
        <img src="{{ $data->media->media}}" alt="@if($data->alt){{ $data->alt }}@else{{ $data->name}}@endif" class="mobile" width="450" height="188" loading="lazy"> -->
        <div class="row container py-12">
            <div class="col-span-12 md:col-span-8">
                <h1 class="heading text-white">{{ $data->name}}</h1>
                @if($data->instructor)
                    <div class="col-span-12 md:col-span-10">
                        <h3 class="font-semibold text-white mb-3">Instructor: {{ optional($data->instructor)->name }}</h3>
                        <p class="text-white">{!! optional($data->instructor)->bio !!}</p>
                    </div>
                @endif
                <div x-data="readingTimeEstimator()" x-init="init()" class="flex">
                    <p class="font-semibold text-white">Reading Time</p>
                    <p x-text="readingTime" class="font-semibold text-white pl-1"></p>
                </div>                
            </div>
            <div class="col-span-12 md:col-span-4">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-span-12 md:col-span-8 order-2 md:order-1">
                <div class="content">
                    <p class="paragraph"> {!! $data->short_desc !!} </p>
                    {!! $data->long_desc !!}
                    @if($data->instructor)
                        <div class="row border-t-2 my-5">
                            <div class="col-span-12 md:col-span-2">
                                <img src="{{ optional(optional($data->instructor)->media)->path }}" alt="{{ optional(optional($data->instructor)->media)->alt }}" class="" loading="lazy" width="" height="">
                            </div>
                            <div class="col-span-12 md:col-span-10">
                                <h3 class="font-semibold mb-3">Instructor: {{ optional($data->instructor)->name }}</h3>
                                <p>{!! optional($data->instructor)->bio !!}</p>
                            </div>
                        </div>
                    @endif
                </div>
                @livewire('singleComments', [ 'model'=> 'Product', 'model_id' => $data->id, 'title' => $data->name ])
            </div>
            <div class="col-span-12 md:col-span-4 relative order-1 md:order-2">
                <div id="stickyForm" class="deepShadow my-2">
                    <img src="/storage/Product/{{ $data->media->media}}" alt="@if($data->alt){{ $data->alt }}@else{{ $data->name}}@endif" width="180" height="750" loading="lazy">
                        <form action="/submit-form" method="POST" class=" bg-white p-5">
                            @csrf
                            <h2 class="subHeading text-center">Student Registration Form</h2>
                            <div class="flex justify-between">
                                <p class="font-bold">{{ $data->cost}}</p>
                                <p class="font-bold">{{ $data->sale}}</p>
                            </div>
                            <div>
                                <label for="name" class="mb-3">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ $user->name ?? old('name') }}" required class="formInput" placeholder="Enter your full name">
                            </div>
    
                            <div>
                                <label for="email" class="mb-3">Email</label>
                                <input type="email" id="email" name="email" value="{{ $user->email ?? old('email') }}" required class="formInput" placeholder="Enter your email">
                            </div>
    
                            <div>
                                <label for="mobile" class="mb-3">Mobile No</label>
                                <input type="tel" id="mobile" name="mobile" value="{{ $user->mobile ?? old('mobile') }}" required class="formInput" placeholder="Enter your mobile number">
                            </div>
    
                            <div>
                                <label for="batch" class="mb-3">Batch</label>
                                <input type="text" id="batch" name="batch" value="{{ $user->batch ?? old('batch') }}" required class="formInput" placeholder="Enter your batch">
                            </div>
    
                            <div>
                                <label for="additional_info" class="mb-3">Additional Information (Optional)</label>
                                <textarea id="additional_info" name="additional_info" class="formInput" placeholder="Enter any additional information">{{ old('additional_info') }}</textarea>
                            </div>
    
                            <div class="flex items-center justify-between">
                                <button type="submit" class="btn w-full">Submit</button>
                            </div>
                        </form> 
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
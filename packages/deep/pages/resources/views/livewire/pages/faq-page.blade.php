<div class="container py-5">
    <h1 class="heading">Frequently Asked Questions</h1>
    @if($data && count($data->faq) ) @livewire('faq', ["data"=>$data->faq]) @endif
</div>
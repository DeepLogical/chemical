<div class="container row items-center my-5 md:my-10">
    <style>
        .curve_box{
            width: 150px;
            height: 150px;
            border-radius: 100px 100px 100px 20px;
            box-shadow: 1px 1px 5px #aaa;
            transition: .5s all;    
        }
        .curve_box:hover{
            box-shadow: 0 14px 28px #bfbfbf40, 0 10px 10px #84848438;
        }
    </style>
    <div class="col-span-12 md:col-span-5 row p-4 md:p-10">
        @foreach( $data as $i )
            <div class="col-span-6 flex items-center flex-col justify-center p-3 mb-5 mx-auto curve_box" style="background: #FFF7EA;">
                <img src="/images/icons/static/{{ $i['img'] }}" alt="{{ $i['name'] }}" class="w-5 mr-5">
                <h3 class="font-bold mb-2 text-sm">{{ $i['name'] }}</h3>
            </div>
        @endforeach
    </div> 
    <div class="col-span-12 md:col-span-7">
        <h2 class="font-bold text-xl">Why To Choose Chefspoint</h2>
        <p>Explore global flavors from the comfort of your home with a few clicks at Chefspoint, where you can purchase food ingredients online and embark on a culinary journey around the world through doorstep-delivered food products. </p>
        <a href="{{ route('shop') }}" class="btn">Buy Now</a>
    </div>
</div>
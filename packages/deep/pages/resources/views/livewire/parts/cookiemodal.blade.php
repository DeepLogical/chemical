<div>
    @if($isOpen)
        <!-- <div class="fixed bottom-0 w-full p-2 bg-primary z-50 cookie border-t border-action">
            <div class="md:flex items-center justify-between">
                <p class="text-white text-sm pr-0 md:pr-4 mb-2 md:mb-0">We use cookies on this site to improve performance. By browsing this site you are agreeing to this. For more information see our <a href="/privacy-policy" class="text-florYellow">Privacy policy</a></p>
                <button class="inline-flex justify-center py-1 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-action" wire:click="setCookie()">I Agree</button>
            </div>
        </div> -->
    @endif
        <style>
            .chat .anim {
                height: 35px;
                bottom: 0;
                right: 0;
                transition: all 0.2s;
                width: 180px;
            }
            .wave .anim:nth-child(1) {
                -webkit-animation: myAnim 2s infinite;
                animation: myAnim 2s infinite;
            }
            .wave .anim:nth-child(2) {
                -webkit-animation: myAnim 2s infinite .3s;
                animation: myAnim 2s infinite .3s;
            }
            .wave .anim:nth-child(3) {
                -webkit-animation: myAnim 2s infinite .6s;
                animation: myAnim 2s infinite .6s;
            }
            .whatsapp .anim {
                width: 60px;
                height: 60px;
                bottom: 5px;
                right: unset;
                left: 5px;
                transition: all 0.2s;
                z-index: 100
            }
            .connect .anim {
                width: 60px;
                height: 60px;
                bottom: 5px;
                right: 5px;
                transition: all 0.2s;
            }
            @-webkit-keyframes myAnim {
                0% { -webkit-transform: scale(0.1); transform: scale(0.1); opacity: 0; }
                50% { opacity: .3; }
                100% { -webkit-transform: scale(2); transform: scale(2); opacity: 0; }
            }
            @keyframes myAnim {
                0% { -webkit-transform: scale(0.1); transform: scale(0.1); opacity: 0; }
                50% { opacity: .3; }
                100% { -webkit-transform: scale(2); transform: scale(2); opacity: 0; }
            }
        </style>
        @if(!Auth::check())
            <div class="wave connect hidden md:block">
                <span class="anim bg-action text-white fixed text-center flex items-center justify-center px-3 rounded-full"></span>
                <span class="anim bg-action text-white fixed text-center flex items-center justify-center px-3 rounded-full"></span>
                <span class="anim bg-action text-white fixed text-center flex items-center justify-center px-3 rounded-full"></span> 
                <a href="/contact" class="anim bg-action text-white fixed text-center flex items-center justify-center px-3 rounded-full text-xs">Connect With Us</a>
            </div>
            <div class="wave whatsapp">
                <span class="anim bg-action text-white fixed text-center flex items-center justify-center px-3 rounded-full"></span>
                <span class="anim bg-action text-white fixed text-center flex items-center justify-center px-3 rounded-full"></span>
                <span class="anim bg-action text-white fixed text-center flex items-center justify-center px-3 rounded-full"></span> 
                <a target="_blank" href="//api.whatsapp.com/send?phone=918424003840&amp;text=%20Hi,%20I%20got%20your%20number%20from%20ChefsPoint%20Website." class="anim bg-action text-white fixed text-center flex items-center justify-center px-3 rounded-full"><img src="/images/icons/whatsapp.svg" alt="Connect with ChefsPoint on Whats App" width="50" height="50" loading="lazy"></a>
            </div>
        @endif
</div>
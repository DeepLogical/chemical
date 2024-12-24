<div>
    @livewire('adminSearch', ['page' => 'Admin Meta', 'routeName' => '', 'routeText' => 'Add Meta', 'link' => 'true'])

    <div x-data="{ tab : 'tab1' }" wire:ignore>
        <div class="flex justify-between">
            <div>
                <ul class="flex itesm-center justify-center">
                    <li @click="tab = 'tab1'" class="cursor-pointer py-1 px-5 text-xs md:text-sm mt-2 mr-1 rounded-full border-2 border-action" :class="{ 'bg-action text-white' : tab === 'tab1'}">Page Sitemap</li>
                    <!-- <li @click="tab = 'tab2'" class="cursor-pointer py-1 px-5 text-xs md:text-sm mt-2 mr-1 rounded-full border-2 border-action" :class="{ 'bg-action text-white' : tab === 'tab2'}">Image Sitemap</li> -->
                </ul>
            </div>
            <div>
                <div x-show="tab === 'tab1'" class="flex items-center justify-center my-5">
                    <button onclick="CopyToClipboard('copy')" class="btn mr-5">Submit Sitemap</span></button>
                    <a href="/sitemap.xml" target="_blank" class="btn">Check Sitemap</a>
                </div>
                <!-- <div x-show="tab === 'tab2'" class="flex items-center justify-center my-5">
                    <button onclick="CopyImageToClipboard('copyTwo')" class="btn mr-5">Submit Image Sitemap</span></button>
                    <a href="/storage/sitemap-image.xml" target="_blank" class="btn">Check Image Sitemap</a>
                </div> -->
            </div>
        </div>
    
        <div x-show="tab === 'tab1'">
            <p>&lt;?xml version="1.0" encoding="UTF-8"?&gt;</p>
            <p class="ml-1">&lt;urlset</p>
            <p class="ml-1">xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"</p>
            <p class="ml-1">xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"</p>
            <p class="ml-1">xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9</p>
            <p class="ml-1">http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"&gt;</p>
            <div class="sitemap" id="copy">
                <div class="ml-2" key={index}>
                    <p class="text-sm">&lt;url&gt;&lt;loc&gt;{{ config('deep.site') }}&lt;/loc&gt;&lt;lastmod&gt;{{ date('Y-m-d') }}T10:43:29+00:00&lt;/lastmod&gt;&lt;priority&gt;1.00&lt;/priority&gt;&lt;/url&gt;</p>
                </div>
                @if( $pages && count( $pages ) )
                    @foreach($pages as $i)
                        <div class="ml-2" key={index}>
                            <p class="text-sm">&lt;url&gt;&lt;loc&gt;{{ config('deep.site') }}/{{ $i->url }}&lt;/loc&gt;&lt;lastmod&gt;{{ date('Y-m-d') }}T10:43:29+00:00&lt;/lastmod&gt;&lt;priority&gt;.90&lt;/priority&gt;&lt;/url&gt;</p>
                        </div>
                    @endforeach
                @endif
                @if( $blogs && count( $blogs ) )
                    @foreach($blogs as $i)
                        <div class="ml-2" key={index}>
                            <p class="text-sm">&lt;url&gt;&lt;loc&gt;{{ config('deep.site') }}/{{ $i->url }}&lt;/loc&gt;&lt;lastmod&gt;{{ date('Y-m-d') }}T10:43:29+00:00&lt;/lastmod&gt;&lt;priority&gt;.80&lt;/priority&gt;&lt;/url&gt;</p>
                        </div>
                    @endforeach
                @endif           
                
                @if( $blogMeta && count( $blogMeta ) )
                    @foreach($blogMeta as $i)
                        <div class="ml-2" key={index}>
                            <p class="text-sm">&lt;url&gt;&lt;loc&gt;{{ config('deep.site') }}/{{ $i->type }}/{{ $i->url }}&lt;/loc&gt;&lt;lastmod&gt;{{ date('Y-m-d') }}T10:43:29+00:00&lt;/lastmod&gt;&lt;priority&gt;.70&lt;/priority&gt;&lt;/url&gt;</p>
                        </div>
                    @endforeach
                @endif
                <p class="ml-1">&lt;/urlset&gt;</p>
            </div>
        </div>
    
        <div class="imageSitemap" x-show="tab === 'tab2'">
            <p>&lt;?xml version="1.0" encoding="UTF-8"?&gt;</p>
            <p class="ml-1">&lt;urlset</p>
            <p class="ml-1">xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"</p>
            <p class="ml-1">xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"&gt;</p>
            <div class="sitemap" id="copyTwo">
                @if( $images && count( $images ) )
                    @foreach($images as $i)
                        @if( count($i['img']) )
                            <p class="text-sm ml-2">&lt;url&gt;</p>
                                <p class="text-sm ml-3">&lt;loc&gt;{{ config('deep.site') }}{{ $i['url']}}&lt;/loc&gt;</p>
                                @foreach($i['img'] as $j)
                                    <p class="text-sm ml-4">&lt;image:image&gt;&lt;image:loc&gt;{{ config('deep.site') }}{{ $j}}&lt;/image:loc&gt;&lt;/image:image&gt;</p>
                                @endforeach 
                            <p class="text-sm ml-2">&lt;/url&gt;</p>
                        @endif
                    @endforeach
                @endif
                <p class="ml-1">&lt;/urlset&gt;</p>
            </div>
        </div>
        <script>
            function CopyToClipboard(containerid) {
                var range = document.createRange();
                var divElement = document.getElementById(containerid);
                var divText = divElement.innerHTML;
                @this.createPageSitemap(divText);
            }
            function CopyImageToClipboard(containerid) {
                var range = document.createRange();
                var divElement = document.getElementById(containerid);
                var divText = divElement.innerHTML;
                @this.createImageSitemap(divText);
            }
        </script>
    </div>
</div>
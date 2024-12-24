<div>
<script type="application/ld+json">
    {
        "@context":             "http://www.schema.org",
        "@type":                "LocalBusiness",
        "@id":                  "{{ config('deep.site') }}",
        "url":                  "{{ config('deep.site') }}",
        "name" :                "{{ config('deep.brand') }}",
        "description" :         "{{ config('deep.description') }}",
        "logo":                 "{{ config('deep.logo') }}",
        "address":
            {
                "@type" :           "PostalAddress",
                "addressCountry" :  "IN",
                "addressLocality" : "{{ config('deep.addressLocality') }}",
                "addressRegion" :   "{{ config('deep.addressRegion') }}",
                "postalCode" :      "{{ config('deep.postalCode') }}",
                "streetAddress" :   "{{ config('deep.streetAddress') }}"
            },
            "telephone" :           "{{ config('deep.phone') }}",
            "email":                "{{ config('deep.email') }}",
            "image" :               "{{ config('deep.logo') }}",
            "sameAs" :
                [
                    "https://www.facebook.com/Deep-110578507216727", 
                    "https://www.linkedin.com/in/amitkhare588/", 
                    "https://www.instagram.com/_deep_/", 
                    "https://twitter.com/AmitdoubleK"
                ],
        "priceRange" : "$10 - $300",
        "geo": {"@type": "GeoCoordinates", "latitude": "28.45", "longitude": "77.07" },
        "openingHours": "Mo,Tu,We,Th,Fr,Sa,Su 09:00-18:00" @if( isset($data) && $data ),
        "@graph":
            [
                    {
                        "@context":"http://schema.org",
                        "@type": "Product",
                        "name": "{{ $data->name }}",
                        "sku": "{{ sanitizeURL($data->name) }}",
                        "mpn": "{{ sanitizeURL($data->name) }}",
                        "productID": "{{ sanitizeURL($data->name) }}",
                        "image": {"@type": "imageObject", "url": "{{ config('deep.site') }}{{ optional($data->media)->path }}" },
                        "description": "@if( $data->text ) {{ str_replace(['<p>', '</p>'], '', preg_replace('/<a\b[^>]*>(.*?)<\/a>/', '', $data->text) ) }} @else {{ str_replace(['<p>', '</p>'], '', preg_replace('/<a\b[^>]*>(.*?)<\/a>/', '', $data->name) ) }} @endif",
                        "brand": { "@type": "Brand", "name": "{{ config('deep.brand') }}", "logo": "{{ config('deep.logo') }}" },
                        "offers": [ 
                            @for($i=0; $i<=2; $i++)
                                { 
                                    "@type": "Offer",
                                    "url": "{{ config('deep.site') }}{{ $data->url }}",
                                    "sku": "{{ sanitizeURL($data->name) }}-{{ $i +1}}", 
                                    "price": {{rand( 50, 120 ) }},
                                    "priceCurrency": "USD",
                                    "priceValidUntil": "{{ \Carbon\Carbon::now()->addMonths(6)->isoFormat('YYYY-MM-DD') }}",
                                    "availability": "InStock", 
                                    "hasMerchantReturnPolicy": "https://www.deep.com/privacy-policy",
                                    "shippingDetails": {
                                        "@type": "OfferShippingDetails",
                                        "shippingRate": "0.00",
                                        "deliveryTime": "2-5 business days",
                                        "shippingDestination": "India"
                                    },
                                    "priceSpecification": {
                                        "@type": "PriceSpecification",
                                        "price": "1.99",
                                        "priceCurrency": "USD",
                                        "valueAddedTaxIncluded": "true",
                                        "maxPrice": "2.99"
                                    },
                                    "seller" : { "@type": "Organization", "name": "{{ config('deep.brand') }}" } 
                                    @if($i==2) } @else }, @endif
                            @endfor
                        ],
                        "aggregateRating": {
                            "@type": "AggregateRating",
                            "ratingValue": "4.{{rand( 7, 9 ) }}",
                            "reviewCount": "{{rand( 90, 150 ) }}"
                        } @if( $data->testis && count( $data->testis ) ),
                            "review": [
                                @foreach( $data->testis as $key=>$j )
                                    {
                                        "@type": "Review",
                                        "itemReviewed": {
                                            "@type": "Product",
                                            "name": "{{ $data->name }}"
                                        },
                                        "author": { "@type": "Person", "name":"{{ optional($j->client)->name }}" },
                                        "datePublished": "{{ \Carbon\Carbon::parse( $j->created_at )->isoFormat('YYYY-MM-DD') }}",
                                        "reviewBody" : "{{ str_replace(['"', '&quot;', '<p>', '</p>'], '', preg_replace('/<a\b[^>]*>(.*?)<\/a>/', '', $j->testis) ) }}",
                                        "reviewRating": { "@type": "Rating", "bestRating": "5", "ratingValue": "1", "worstRating": "1" }
                                    @if( count($data->testis)-1 === $key ) } @else }, @endif
                                @endforeach
                            ]
                        @endif
                    } @if( $data->faq && count( $data->faq ) ),
                {
                    "@context":"http://schema.org",
                    "@type": "FAQPage",
                    "mainEntity": [
                        @foreach( $data->faq as $key=>$j )
                            {
                                "@type": "Question",
                                    "name": "{{ $j->quest }}",
                                    "acceptedAnswer": { "@type": "Answer", "text": "{{ str_replace(['"', '&quot;', '<p>', '</p>'], '', preg_replace('/<a\b[^>]*>(.*?)<\/a>/', '', $j->ans) ) }}" }
                            }@if( !$loop->last ) , @endif
                        @endforeach
                    ]
                }
                @endif
            ]
        @endif
    }
</script>
</div>
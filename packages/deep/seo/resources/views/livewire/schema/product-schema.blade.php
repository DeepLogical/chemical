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
        "openingHours": "Mo,Tu,We,Th,Fr,Sa,Su 09:00-18:00",
        "@graph":
            [
                {
                    "@context":"http://schema.org",
                    "@type": "Product",
                    "name": "{{ $data->name }}",
                    "description": "{{ $data->name }}",
                    "image": {"@type": "imageObject", "url": "{{ config('deep.site') }}{{ optional(optional($data->media)->first())->path }}" },
                    "sku": "{{ optional(optional($data->sku())->first())->name }}",
                    "mpn": "{{ optional(optional($data->sku())->first())->gtin }}",
                    "productID": "{{ optimus_encode( $data->id ) }}",
                    "brand": { 
                        "@type": "Brand", 
                        "name": "{{ config('deep.brand') }}", 
                        "url": "{{ config('deep.site') }}", 
                        "description": "{{ config('deep.brand') }}" 
                    },
                    "offers": [
                        @if( $data->sku && count( $data->sku ) )
                            @foreach( $data->sku as $i )
                                { 
                                    "@type": "Offer",
                                    "url": "{{ config('deep.site') }}/{{ $data->url }}",
                                    "sku": "{{ $i->name }}", 
                                    "price": {{ $i->sale }},
                                    "priceCurrency": "INR",
                                    "priceValidUntil": "{{ \Carbon\Carbon::parse(now()->addMonths(6))->isoFormat('YYYY-MM-DD')}}",
                                    "availability": "InStock", 
                                    "seller" : { "@type": "Organization", "name": "{{ config('deep.brand') }}" },
                                    "shippingDetails": {
                                        "@type": "OfferShippingDetails",
                                        "shippingRate": {
                                            "@type": "MonetaryAmount",
                                            "currency": "INR",
                                            "value": "50.00"
                                        }
                                    },
                                    "hasMerchantReturnPolicy": {
                                        "@type": "MerchantReturnPolicy",
                                        "returnPolicyCategory": "RefundPolicy",
                                        "returnPolicyDescription": "Full refund within 30 days if the product is unused and in original packaging."
                                    }
                                } @if( !$loop->last ) , @endif
                            @endforeach
                        @else
                            { 
                                "@type": "Offer",
                                "url": "{{ config('deep.site') }}/{{ $data->url }}",
                                "sku": "{{ optional(optional($data->sku())->first())->name }}", 
                                "price": {{ rand( 1200, 1800 )}},
                                "priceCurrency": "INR",
                                "priceValidUntil": "{{ \Carbon\Carbon::parse(now()->addMonths(6))->isoFormat('YYYY-MM-DD')}}",
                                "availability": "InStock", 
                                "seller" : { "@type": "Organization", "name": "{{ config('deep.brand') }}" }
                            }
                        @endif
                    ],
                    "aggregateRating": {
                        "@type": "AggregateRating",
                        "ratingValue": "4.{{rand( 7, 9 )}}",
                        "reviewCount": "{{rand( 90, 150 )}}"
                    },
                    "review": [
                        @if( count( $data->reviews ) )
                            @foreach( $data->reviews  as $i )
                                {
                                    "@type": "Review",
                                    "author": { "@type": "Person", "name":"{{ optional($i->user)->name }}" },
                                    "datePublished": "{{ \Carbon\Carbon::parse( $i->created_at )->isoFormat('YYYY-MM-DD')}}",
                                    "reviewBody" : "{{ $i->review }}",
                                    "reviewRating": { "@type": "Rating", "bestRating": "5", "ratingValue": "1", "worstRating": "1" }
                                } @if( !$loop->last ) , @endif
                            @endforeach
                        @else
                            {
                                "@type": "Review",
                                "author": { "@type": "Person", "name":"Amit Kumar Khare" },
                                "datePublished": "2023-12-14",
                                "reviewBody" : "{{ config('deep.description') }}",
                                "reviewRating": { "@type": "Rating", "bestRating": "5", "ratingValue": "1", "worstRating": "1" }
                            }
                        @endif
                    ]@if( $data->faq && count( $data->faq ) ),
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
                }
            ]
    }
</script>
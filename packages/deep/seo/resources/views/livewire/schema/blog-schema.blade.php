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
            "telephone" :           "{{ config('deep.telephone') }}",
            "email":                "{{ config('deep.email_single') }}",
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
                    "@type": "Article",
                    "image": {"@type": "imageObject", "url": "{{ config('deep.site') }}{{ optional($data->media)->path }}" },
                    "headline": "{{ $data->name }}",
                    "alternativeHeadline": "{{ $data->name }}",
                    @if( $data->category && count( $data->category ) )"genre": "{{ $data->category[0]['name'] }}",@endif
                    "keywords": "{{ $data->name }}",
                    @if( $data->excerpt )"description": "{{ $data->excerpt }}",@endif
                    "wordCount": "{{ str_word_count ( $data->content ) }}",
                    "editor": {"@type": "Person", "name":"Amit Kumar Khare" },                        
                    "dateCreated": "{{ \Carbon\Carbon::parse($data->created_at)->isoFormat('YYYY-MM-DD') }}",
                    "datePublished": "{{ \Carbon\Carbon::parse($data->updated_at)->isoFormat('YYYY-MM-DD') }}",
                    "datemodified": "{{ \Carbon\Carbon::parse($data->updated_at)->isoFormat('YYYY-MM-DD') }}",
                    "inLanguage": "English",
                    "isFamilyFriendly": "true",
                    "copyrightYear": {{ \Carbon\Carbon::parse( $data->updated_at )->isoFormat('YYYY') }},
                    "copyrightHolder": "{{ config('deep.brand') }}",
                    "author": {"@type": "Person", "name":"{{ optional($data->author)->name }}", "url" : "{{ config('deep.site') }}" },
                    "mainEntityOfPage": "True",
                    "creator": {"@type": "Organization", "name": "{{ config('deep.brand') }}", "url": "{{ config('deep.site') }}"},
                    "publisher": { "@type": "Organization", "name": "{{ config('deep.brand') }}", "url": "{{ config('deep.site') }}", "logo": { "@type": "ImageObject", "url": "{{ config('deep.logo') }}" }},
                    @if( $data->faq && count( $data->faq ) ),
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
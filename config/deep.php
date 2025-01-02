<?php
    return [
        // "mode" => "dev",
        // "site" => "http://allez.test",
        // "test_site" => "http://allez.test",
        
        "mode" => "prod",
        "site" => "https://www.allezsportz.com",
        "test_site" => "http://allez.test",
        
        "brand" => "Pradeep classes",
        "gst" => "27AABCZ6169K1ZP",
        "pan" => "27AABCZ6169K1ZP",
        "owner" => "Allez Sportz",
        "addressLocality" => "175A, Block - C1",
        "addressRegion" => "Gurugram",
        "postalCode" => "122018",
        "streetAddress" => "Sector 47",
        "phone" => "7042777821",
        "email" => "contact@allezsportz.com",
        "logo" => "https://www.allezsportz.com/images/logo.png",
        "description" => "A sports Company",
        "full_address" => "175A, Block - C1, Gurugram, Haryana 122017",
        "emailList" => [ "support@pradeep.com"],
        "phoneList" => [ "7042777821" ],
        // "googlemap" => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3508.174390130457!2d77.06368647510995!3d28.444158975768083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d193f9c30bef7%3A0xa49f27516db76e70!2sAMITKK%20Digital%20Solutions!5e0!3m2!1sen!2sin!4v1727890218862!5m2!1sen!2sin" class="w-full h-full border-none rounded" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',   
        "social" => [
            [ "url" => "https://www.facebook.com/people/Allez-Sportz/61556547368678/", "platform" => "Facebook", "img-white" => "facebook-white.svg", "img-dark" => "facebook.svg" ],
            // [ "url" => "/", "platform" => "Linkedin", "img-white" => "linkedin-white.svg", "img-dark" => "linkedin.svg" ],
            [ "url" => "https://www.instagram.com/allez_sportz/", "platform" => "Instagram", "img-white" => "instagram-white.svg", "img-dark" => "instagram.svg" ],
            // [ "url" => "/", "platform" => "Twitter", "img-white" => "twitter-white.svg", "img-dark" => "twitter.svg" ],
            // [ "url" => "/", "platform" => "Youtube", "img-white" => "youtube-white.svg", "img-dark" => "youtube.svg" ],
            // [ "url" => "https://api.whatsapp.com/send?phone=919289090881&text=%20Hi,%20I%20got%20your%20number%20from%20Allez%20Sportz%20Website.", "platform" => "Whatsapp", "img-white" => "whatsapp-white.svg", "img-dark" => "whatsapp.svg"  ],
        ],
        "share" => [
            [ "url" => "https://www.facebook.com/sharer/sharer.php?u=", "img" => "facebook.svg", "img-white" => "facebook-white.svg" ],
            [ "url" => "https://www.linkedin.com/sharing/share-offsite?mini=true&url=", "img" => "linkedin.svg", "img-white" => "linkedin-white.svg" ],
            [ "url" => "https://twitter.com/intent/tweet?text=Your+share+text+comes+here&url=", "img" => "twitter.svg", "img-white" => "twitter-white.svg" ],
            [ "url" => "https://www.linkedin.com/shareArticle?mini=true&url=", "img" => "instagram.svg", "img-white" => "instagram-white.svg" ],
            // [ "url" => "https://telegram.me/share/url?url=", "img" => "twitter.svg", "img-white" => "twitter-white.svg" ],
            [ "url" => "https://wa.me/?text=", "img" => "whatsapp.svg", "img-white" => "whatsapp-white.svg" ],
        ],

        'page_options' => [ 'Page', 'Blog' ],

        // ADMIN
            "ownerLinks" => [
                // Basic
                    [ "link" => "adminUsers", "name" => "Basic",
                        "sublinks" => [
                            [ "link" => "adminLogs", "name" => "Logs" ],
                            [ "link" => "adminUsers", "name" => "Users" ],
                            [ "link" => "adminSpatie", "name" => "Roles & Permissions" ],
                        ]
                    ],
                // Basic
            ],
            
            "seoLinks" => [        
                // Blogs
                    [ "link" => "adminBlog", "name" => "Blogs",
                        "sublinks" => [
                            [ "link" => "adminBlogmeta", "name" => "Blog Meta" ],
                            [ "link" => "adminBlog", "name" => "Blog" ],
                            [ "link" => "addUpdateBlog", "name" => "Add Blog" ],
                            [ "link" => "adminAuthor", "name" => "Author" ],
                        ]
                    ],
                // Blogs
                // Products
                    [ "link" => "adminProduct", "name" => "Products",
                        "sublinks" => [
                            [ "link" => "adminForm", "name" => "Form" ],
                            [ "link" => "adminProduct", "name" => "Product" ],
                            // [ "link" => "addUpdateProduct", "name" => "Add Product" ],
                            // [ "link" => "adminAuthor", "name" => "Author" ],
                        ]
                    ],
                // Products
        
                // Pages
                    [ "link" => "adminPages", "name" => "Pages",
                        "sublinks" => [
                            [ "link" => "adminPages", "name" => "Pages" ],
                            [ "link" => "adminFaq", "name" => "FAQ" ],
                            [ "link" => "adminTestimonials", "name" => "Testimonials" ],
                            // [ "link" => "adminVideoTestimonials", "name" => "Video Testimonials" ],
                            // [ "link" => "adminReview", "name" => "Reviews" ],
                            // [ "link" => "adminClient", "name" => "Clients" ],
                            [ "link" => "adminTeam", "name" => "Team" ],
                            [ "link" => "adminAchievement", "name" => "Achievements" ],
                            // [ "link" => "adminBannerSlider", "name" => "Banner Slider" ],
                            // [ "link" => "adminBrand", "name" => "Brand" ],
                            [ "link" => "adminComments", "name" => "Comments" ],
                        ]
                    ],
                // Pages
        
                // FORMS
                    [ "link" => "adminContact", "name" => "Forms",
                        "sublinks" => [
                            [ "parent" => "Forms", "link" => "adminContact", "name" => "Contact" ],
                            [ "link" => "adminForm", "name" => "Product enquiry" ],
                            // [ "parent" => "Forms", "link" => "adminSubscription", "name" => "Subscription" ],
                            // [ "parent" => "Forms", "link" => "adminJoinUs", "name" => "Job Applications" ],
                        ]
                    ],
                // FORMS
        
                // SEO
                    [ "link" => "adminMeta", "name" => "SEO",
                        "sublinks" => [
                            [ "link" => "adminMeta", "name" => "Meta Tags" ],
                            [ "link" => "adminSitemap", "name" => "Sitemap" ],
                            [ "link" => "adminMedia", "name" => "Media" ],
                        ]
                    ],
                // SEO
            ],

            "deepLinks" => [
                [ "link" => "adminSiteSetting", "name" => "DEEP",
                    "sublinks" => [
                        [ "link" => "adminSiteSetting", "name" => "Site" ],
                        [ "link" => "adminPaymentGateway", "name" => "Payment Gateway" ],
                    ]
                ],
            ],

            "commonLinks" => [ 
                [ "link" => "userOrders", "name"=> "Basics",
                    "sublinks" => [
                        [ "link" => "userChatHistory", "name" => "My Chats" ],
                        [ "link" => "userOrders", "name" => "My Orders" ],
                        [ "link" => "profileImage", "name" => "Profile Image" ],
                        [ "link" => "userAddress", "name" => "My Addresses" ],
                        [ "link" => "myNotifications", "name" => "Notifications" ],
                        [ "link" => "userTraining", "name" => "My Trainings" ],
                        [ "link" => "userTeam", "name" => "My Teams" ],
                        [ "link" => "userMatch", "name" => "My Matches" ],
                    ]
                ],
            ],
        // ADMIN

        "android"                       =>  "https://play.google.com/store/apps/details?id=com.allezsportz.app",
        "ios"                           =>  "https://apps.apple.com/us/app/allez-sportz/id6651839997",
    ];
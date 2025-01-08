<?php

use Illuminate\Support\Facades\Route;

use Deep\Pages\Http\Livewire\Pages\RefrenceCode;
use Deep\Pages\Http\Livewire\Pages\About;
use Deep\Pages\Http\Livewire\Pages\JoinUs;
use Deep\Pages\Http\Livewire\Pages\Clients;
use Deep\Pages\Http\Livewire\Pages\Contact;
use Deep\Pages\Http\Livewire\Pages\FourOFour;
use Deep\Pages\Http\Livewire\Pages\Privacy;
use Deep\Pages\Http\Livewire\Pages\Services;
use Deep\Pages\Http\Livewire\Pages\Sitemap;
use Deep\Pages\Http\Livewire\Pages\Thankyou;
use Deep\Pages\Http\Livewire\Pages\Tnc;
use Deep\Pages\Http\Livewire\Pages\MediaGallery;
use Deep\Pages\Http\Livewire\Pages\Awards;
use Deep\Pages\Http\Livewire\Pages\RefundPolicy;
use Deep\Pages\Http\Livewire\Pages\Search;
use Deep\Pages\Http\Livewire\Pages\ExportImport;

use Deep\Pages\Http\Livewire\Admin\AdminClient;
use Deep\Pages\Http\Livewire\Admin\AdminPages;
use Deep\Pages\Http\Livewire\Admin\AdminContact;
use Deep\Pages\Http\Livewire\Admin\AdminMedia;
use Deep\Pages\Http\Livewire\Admin\AdminSubscription;
use Deep\Pages\Http\Livewire\Admin\AdminVideos;
use Deep\Pages\Http\Livewire\Admin\AdminMediaGallery;
use Deep\Pages\Http\Livewire\Admin\AdminPayment;
use Deep\Pages\Http\Livewire\Admin\AdminAwards;
use Deep\Pages\Http\Livewire\Admin\AdminAchievement;
use Deep\Pages\Http\Livewire\Admin\AdminBanner;
use Deep\Pages\Http\Livewire\Admin\AdminBrand;
use Deep\Pages\Http\Livewire\Admin\AdminTeam;
use Deep\Pages\Http\Livewire\Admin\AddUpdatePage;
use Deep\Pages\Http\Livewire\Admin\AdminJoinUs;
use Deep\Pages\Http\Livewire\Admin\AdminComments;

use Deep\Pages\Http\Livewire\Faq\FaqPage;
use Deep\Pages\Http\Livewire\Faq\AdminFaq;
use Deep\Pages\Http\Livewire\Faq\AddUpdateFaq;

use Deep\Pages\Http\Livewire\Testimonial\AdminTestimonials;
use Deep\Pages\Http\Livewire\Testimonial\AddUpdateTestimonial;
use Deep\Pages\Http\Livewire\Testimonial\AdminVideoTestimonials;
use Deep\Pages\Http\Livewire\Testimonial\AddUpdateVideoTestimonial;

use Deep\Pages\Http\Livewire\Form\SubscribeForm;

use Deep\Pages\Http\Livewire\Review\AdminReview;

Route::middleware(['web'])->group(function () {
    // Route::get("register/{refrence}", RefrenceCode::class)->name("refrenceCode");
    Route::get("about-us", About::class)->name("about");
    Route::get("career", JoinUs::class)->name("career");
    Route::get("clients", Clients::class)->name("clients");
    Route::get("contact-us", Contact::class)->name("contact");
    Route::get("404", FourOFour::class)->name("404");
    Route::get("privacy-policy", Privacy::class)->name("privacy");
    Route::get("services", Services::class)->name("services");
    Route::get("sitemap", Sitemap::class)->name("sitemap");
    Route::get("thank-you", Thankyou::class)->name("thankyou");
    Route::get("terms-and-conditions", Tnc::class)->name("tnc");
    Route::get("media-gallery", MediaGallery::class)->name("mediagallery");
    Route::get("subscrib-form", SubscribeForm::class)->name("subscribeform");
    // Route::get("refund-policy", RefundPolicy::class)->name("refundPolicy");
    Route::get("search", Search::class)->name("search");
    Route::get("exportImport", ExportImport::class)->name("exportImport");
    // Route::get("awards", Awards::class)->name("awards");

    Route::middleware(['role:owner|admin|seo'])->prefix('admin')->group(function () {
        Route::get("comments", AdminComments::class)->name('adminComments');
        Route::get('join-us', AdminJoinUs::class)->name('adminJoinUs');
        Route::get('brand', AdminBrand::class)->name('adminBrand');
        Route::get('banners', AdminBanner::class)->name('adminBanner');
        Route::get('team', AdminTeam::class)->name('adminTeam');
        Route::get('clients', AdminClient::class)->name('adminClient');
        Route::get('pages', AdminPages::class)->name('adminPages');
        Route::get("contact", AdminContact::class)->name('adminContact');
        Route::get("media", AdminMedia::class)->name('adminMedia');
        Route::get("subscription", AdminSubscription::class)->name('adminSubscription');
        Route::get('video-gallery', AdminVideos::class)->name('adminVideos');
        Route::get('media-gallery', AdminMediaGallery::class)->name('adminMediaGallery');
        Route::get('payments', AdminPayment::class)->name('adminPayment');
        Route::get('awards', AdminAwards::class)->name('adminAwards');
        Route::get('achievements', AdminAchievement::class)->name('adminAchievement');
        Route::get("add-update-page/{id?}", AddUpdatePage::class)->name('addUpdatePage');

        Route::get("review", AdminReview::class)->name('adminReview');
        
        Route::get('faq', AdminFaq::class)->name('adminFaq');
        Route::get("update-faq/{model}/{id}", AddUpdateFaq::class)->name('addUpdateFaq');
        
        Route::get('testimonials', AdminTestimonials::class)->name('adminTestimonials');
        Route::get("add-update-testimonial/{model}/{id}", AddUpdateTestimonial::class)->name('addUpdateTestimonial');

        Route::get('video-testimonials', AdminVideoTestimonials::class)->name('adminVideoTestimonials');
        Route::get("add-update-video-testimonial/{model}/{id}", AddUpdateVideoTestimonial::class)->name('addUpdateVideoTestimonial');
    });
});
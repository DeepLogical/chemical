<?php

namespace Deep\Pages\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

use Deep\Pages\Http\Livewire\Form\SearchForm;
use Deep\Pages\Http\Livewire\Form\ContactForm;
use Deep\Pages\Http\Livewire\Form\SubscribeForm;

use Deep\Pages\Http\Livewire\Parts\TopBar;
use Deep\Pages\Http\Livewire\Parts\Cookiemodal;
use Deep\Pages\Http\Livewire\Parts\Learnmore;
use Deep\Pages\Http\Livewire\Parts\Looking;
use Deep\Pages\Http\Livewire\Parts\Portfoliomodal;
use Deep\Pages\Http\Livewire\Parts\Querymodal;
use Deep\Pages\Http\Livewire\Parts\StaticBanner;
use Deep\Pages\Http\Livewire\Parts\BannerSlider;
use Deep\Pages\Http\Livewire\Parts\BrandSlider;
use Deep\Pages\Http\Livewire\Parts\FullWidthContactForm;
use Deep\Pages\Http\Livewire\Parts\ClientSlider;
use Deep\Pages\Http\Livewire\Parts\AwardSlider;
use Deep\Pages\Http\Livewire\Parts\OneBySeven;
use Deep\Pages\Http\Livewire\Parts\DestinationSlider;
use Deep\Pages\Http\Livewire\Parts\ShareMe;
use Deep\Pages\Http\Livewire\Parts\DownloadApp;
use Deep\Pages\Http\Livewire\Parts\SearchModal;
use Deep\Pages\Http\Livewire\Parts\MediaGalleryModal;
use Deep\Pages\Http\Livewire\Parts\VideoGalleryModal;
use Deep\Pages\Http\Livewire\Parts\PrizeModal;
use Deep\Pages\Http\Livewire\Parts\SingleComments;
use Deep\Pages\Http\Livewire\Parts\Breadcrumb;
use Deep\Pages\Http\Livewire\Parts\Map;
use Deep\Pages\Http\Livewire\Parts\HeaderCrumbOne;
use Deep\Pages\Http\Livewire\Parts\HeaderCrumbTwo;

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
use Deep\Pages\Http\Livewire\Pages\VideoGallery;
use Deep\Pages\Http\Livewire\Pages\Awards;
use Deep\Pages\Http\Livewire\Pages\RefundPolicy;
use Deep\Pages\Http\Livewire\Pages\Search;
use Deep\Pages\Http\Livewire\Pages\ExportImport;

use Deep\Pages\Http\Livewire\Admin\AddUpdatePage;
use Deep\Pages\Http\Livewire\Admin\AdminClient;
use Deep\Pages\Http\Livewire\Admin\AdminPages;
use Deep\Pages\Http\Livewire\Admin\AdminContact;
use Deep\Pages\Http\Livewire\Admin\AdminMedia;
use Deep\Pages\Http\Livewire\Admin\AdminSubscription;
use Deep\Pages\Http\Livewire\Admin\AdminVideos;
use Deep\Pages\Http\Livewire\Admin\AdminMediaGallery;
use Deep\Pages\Http\Livewire\Admin\AdminPayment;
use Deep\Pages\Http\Livewire\Admin\AdminAwards;
use Deep\Pages\Http\Livewire\Admin\AdminBanner;
use Deep\Pages\Http\Livewire\Admin\AdminBrand;
use Deep\Pages\Http\Livewire\Admin\AdminTeam;
use Deep\Pages\Http\Livewire\Admin\AdminJoinUs;
use Deep\Pages\Http\Livewire\Admin\AdminComments;

use Deep\Pages\Http\Livewire\Parts\Achievement;
use Deep\Pages\Http\Livewire\Parts\AchievementModal;
use Deep\Pages\Http\Livewire\Admin\AdminAchievement;

use Deep\Pages\Http\Livewire\Testimonial\Testimonial;
use Deep\Pages\Http\Livewire\Testimonial\SingleTestimonialItem;
use Deep\Pages\Http\Livewire\Testimonial\AdminTestimonials;
use Deep\Pages\Http\Livewire\Testimonial\AddUpdateTestimonial;
use Deep\Pages\Http\Livewire\Testimonial\TestimonialModal;

use Deep\Pages\Http\Livewire\Testimonial\VideoTestimonial;
use Deep\Pages\Http\Livewire\Testimonial\SingleVideoTestimonialItem;
use Deep\Pages\Http\Livewire\Testimonial\AdminVideoTestimonials;
use Deep\Pages\Http\Livewire\Testimonial\AddUpdateVideoTestimonial;
use Deep\Pages\Http\Livewire\Testimonial\VideoTestimonialModal;

use Deep\Pages\Http\Livewire\Faq\Faq;
use Deep\Pages\Http\Livewire\Faq\FaqWhite;
use Deep\Pages\Http\Livewire\Faq\FaqModal;
use Deep\Pages\Http\Livewire\Faq\FaqPage;
use Deep\Pages\Http\Livewire\Faq\AdminFaq;
use Deep\Pages\Http\Livewire\Faq\AddUpdateFaq;

use Deep\Pages\Http\Livewire\Review\ReviewForm;
use Deep\Pages\Http\Livewire\Review\AdminReview;



use Deep\Pages\Http\Livewire\Block\WhyChooseUs;

class PagesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        $this->mergeConfigFrom( __DIR__.'/../../config/deep.php', 'deep' );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){
        $this->publishes([ __DIR__.'/../../config/deep.php' => config_path('deep.php'), ], 'config');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'deep');
        $this->publishes([ __DIR__.'/../../resources/views' => resource_path('views/vendor/deep'), ], 'views');

        Livewire::component('searchForm', SearchForm::class);
        Livewire::component('contactForm', ContactForm::class);
        Livewire::component('subscribeForm', SubscribeForm::class);

        Livewire::component('singleComments', SingleComments::class);
        Livewire::component('topBar', TopBar::class);
        Livewire::component('cookiemodal', Cookiemodal::class);
        Livewire::component('learnmore', Learnmore::class);
        Livewire::component('looking', Looking::class);
        Livewire::component('portfoliomodal', Portfoliomodal::class);
        Livewire::component('querymodal', Querymodal::class);
        Livewire::component('staticBanner', StaticBanner::class);
        Livewire::component('bannerSlider', BannerSlider::class);
        Livewire::component('brandSlider', BrandSlider::class);
        Livewire::component('fullWidthContactForm', FullWidthContactForm::class);
        Livewire::component('clientSlider', ClientSlider::class);
        Livewire::component('awardSlider', AwardSlider::class);
        Livewire::component('oneBySeven', OneBySeven::class);
        Livewire::component('destinationSlider', DestinationSlider::class);
        Livewire::component('shareMe', ShareMe::class);
        Livewire::component('downloadApp', DownloadApp::class);
        Livewire::component('searchModal', SearchModal::class);
        Livewire::component('mediaGalleryModal', MediaGalleryModal::class);
        Livewire::component('videoGalleryModal', VideoGalleryModal::class);
        Livewire::component('prizeModal', PrizeModal::class);
        Livewire::component('breadcrumb', Breadcrumb::class);
        Livewire::component('map', Map::class);
        Livewire::component('headerCrumbOne', HeaderCrumbOne::class);
        Livewire::component('headerCrumbTwo', HeaderCrumbTwo::class);
        
        Livewire::component('about', About::class);
        Livewire::component('joinUs', JoinUs::class);
        Livewire::component('clients', Clients::class);
        Livewire::component('contact', Contact::class);
        Livewire::component('404', FourOFour::class);
        Livewire::component('privacy', Privacy::class);
        Livewire::component('services', Services::class);
        Livewire::component('sitemap', Sitemap::class);
        Livewire::component('thankyou', Thankyou::class);
        Livewire::component('tnc', Tnc::class);
        Livewire::component('mediagallery', MediaGallery::class);
        Livewire::component('videogallery', VideoGallery::class);
        Livewire::component('awards', Awards::class);
        Livewire::component('refundPolicy', RefundPolicy::class);
        Livewire::component('search', Search::class);
        Livewire::component('exportImport', ExportImport::class);
        
        Livewire::component('adminClient', AdminClient::class);
        Livewire::component('adminPages', AdminPages::class);
        Livewire::component('adminContact', AdminContact::class);
        Livewire::component('adminMedia', AdminMedia::class);
        Livewire::component('adminSubscription', AdminSubscription::class);
        Livewire::component('adminVideos', AdminVideos::class);
        Livewire::component('adminMediaGallery', AdminMediaGallery::class);
        Livewire::component('adminPayment', AdminPayment::class);
        Livewire::component('adminAwards', AdminAwards::class);
        Livewire::component('adminBanner', AdminBanner::class);
        Livewire::component('adminBrand', AdminBrand::class);
        Livewire::component('adminTeam', AdminTeam::class);
        Livewire::component('addUpdatePage', AddUpdatePage::class);
        Livewire::component('adminJoinUs', AdminJoinUs::class);
        Livewire::component('adminComments', AdminComments::class);

        Livewire::component('achievement', Achievement::class);
        Livewire::component('achievementModal', AchievementModal::class);
        Livewire::component('adminAchievement', AdminAchievement::class);
        
        Livewire::component('testimonial', Testimonial::class);
        Livewire::component('singleTestimonialItem', SingleTestimonialItem::class);
        Livewire::component('adminTestimonials', AdminTestimonials::class);
        Livewire::component('addUpdateTestimonial', AddUpdateTestimonial::class);
        Livewire::component('testimonialModal', TestimonialModal::class);

        Livewire::component('videoTestimonial', VideoTestimonial::class);
        Livewire::component('singleVideoTestimonialItem', SingleVideoTestimonialItem::class);
        Livewire::component('adminVideoTestimonials', AdminVideoTestimonials::class);
        Livewire::component('addUpdateVideoTestimonial', AddUpdateVideoTestimonial::class);
        Livewire::component('videoTestimonialModal', VideoTestimonialModal::class);

        Livewire::component('faq', Faq::class);
        Livewire::component('faqWhite', FaqWhite::class);
        Livewire::component('faqModal', FaqModal::class);
        Livewire::component('faqPage', FaqPage::class);
        Livewire::component('adminFaq', AdminFaq::class);
        Livewire::component('addUpdateFaq', AddUpdateFaq::class);

        Livewire::component('reviewForm', ReviewForm::class);
        Livewire::component('adminReview', AdminReview::class);


        Livewire::component('whyChooseUs', WhyChooseUs::class);
    }
}

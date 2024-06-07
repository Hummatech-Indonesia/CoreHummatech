<?php

namespace App\Providers;

use App\Models\Branch;
use App\Models\CategoryNews;
use App\Models\EnterpriseStructure;
use App\Models\Faq;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsImage;
use App\Models\Profile;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Testimonial;
use App\Observers\EnterpriseStructureObserver;
use App\Models\SalesPackage;
use App\Models\Service;
use App\Models\SosialMedia;
use App\Models\Termscondition;
use App\Observers\FaqObserver;
use App\Observers\NewsImageObserver;
use App\Observers\NewsObserver;
use App\Observers\SaleObserver;
use App\Observers\TestimonialObserver;
use Illuminate\Auth\Events\Registered;
use App\Observers\SalesPackageObserver;
use App\Observers\TermsconditionObserve;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\View;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // News::observe(NewsObserver::class);
        // Sale::observe(SaleObserver::class);
        // EnterpriseStructure::observe(EnterpriseStructureObserver::class);
        // SalesPackage::observe(SalesPackageObserver::class);
        // Testimonial::observe(TestimonialObserver::class);
        // Faq::observe(FaqObserver::class);
        // NewsImage::observe(NewsImageObserver::class);
        // Termscondition::observe(TermsconditionObserve::class);

        // parent::boot();

        // $services = Service::all();
        // $profile = Profile::first();
        // $social = SosialMedia::all();
        // $branches = Branch::all();
        // $news = News::all();
        // $products = Product::all();

        // View::share('profile', $profile);
        // View::share('navbarNewsData', $news);
        // View::share('socmed', $social);
        // View::share('products', $products);
        // View::share('services', $services);
        // View::share('branches', $branches);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Interfaces\FaqInterface;
use App\Contracts\Interfaces\HomeInterface;
use App\Contracts\Interfaces\LogoInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Contracts\Interfaces\SaleInterface;
use App\Contracts\Interfaces\TeamInterface;
use App\Contracts\Interfaces\ForceInterface;

use App\Contracts\Interfaces\BranchInterface;
use App\Contracts\Repositories\FaqRepository;
use App\Contracts\Interfaces\GalleryInterface;
use App\Contracts\Interfaces\ProductInterface;
use App\Contracts\Interfaces\ProfileInterface;
use App\Contracts\Interfaces\SectionInterface;
use App\Contracts\Interfaces\ServiceInterface;
use App\Contracts\Interfaces\VacancyInterface;
use App\Contracts\Repositories\HomeRepository;
use App\Contracts\Repositories\LogoRepository;
use App\Contracts\Repositories\NewsRepository;
use App\Contracts\Repositories\SaleRepository;
use App\Contracts\Repositories\TeamRepository;

use App\Contracts\Interfaces\PositionInterface;
use App\Contracts\Interfaces\WorkFlowInterface;
use App\Contracts\Repositories\ForceRepository;
use App\Contracts\Interfaces\NewsImageInterface;
use App\Contracts\Interfaces\ProcedureInterface;
use App\Contracts\Interfaces\StructureInterface;
use App\Contracts\Repositories\BranchRepository;
use App\Contracts\Interfaces\BackgroundInterface;
use App\Contracts\Repositories\GalleryRepository;
use App\Contracts\Repositories\ProductRepository;
use App\Contracts\Repositories\ProfileRepository;
use App\Contracts\Repositories\SectionRepository;
use App\Contracts\Repositories\ServiceRepository;
use App\Contracts\Repositories\VacancyRepository;
use App\Contracts\Interfaces\CollabMitraInterface;
use App\Contracts\Interfaces\GaleryImageInterface;
use App\Contracts\Interfaces\MisionItemsInterface;
use App\Contracts\Interfaces\SosialMediaInterface;
use App\Contracts\Interfaces\TestimonialInterface;
use App\Contracts\Repositories\PositionRepository;
use App\Contracts\Repositories\WorkFlowRepository;
use App\Contracts\Interfaces\CategoryNewsInterface;
use App\Contracts\Interfaces\NewsCategoryInterface;
use App\Contracts\Interfaces\SalesPackageInterface;
use App\Contracts\Interfaces\ServiceMitraInterface;
use App\Contracts\Repositories\NewsImageRepository;
use App\Contracts\Repositories\ProcedureRepository;
use App\Contracts\Repositories\StructureRepository;
use App\Contracts\Repositories\BackgroundRepository;
use App\Contracts\Interfaces\CollabCategoryInterface;
use App\Contracts\Interfaces\ProductFeatureInterface;
use App\Contracts\Interfaces\TermsconditionInterface;
use App\Contracts\Repositories\CollabMitraRepository;
use App\Contracts\Repositories\GaleryImageRepository;
use App\Contracts\Repositories\MisionItemsRepository;
use App\Contracts\Repositories\SosialMediaRepository;
use App\Contracts\Repositories\TestimonialRepository;
use App\Contracts\Interfaces\CategoryProductInterface;
use App\Contracts\Interfaces\ComingSoonProductInterface;
use App\Contracts\Interfaces\ContactUsInterface;
use App\Contracts\Interfaces\VisionAndMisionInterface;
use App\Contracts\Repositories\CategoryNewsRepository;
use App\Contracts\Repositories\NewsCategoryRepository;
use App\Contracts\Repositories\SalesPackageRepository;
use App\Contracts\Repositories\ServiceMitraRepository;
use App\Contracts\Interfaces\VisitorDetectionInterface;
use App\Contracts\Repositories\CollabCategoryRepository;
use App\Contracts\Repositories\ProductFeatureRepository;
use App\Contracts\Repositories\TermsconditionRepository;
use App\Contracts\Repositories\CategoryProductRepository;
use App\Contracts\Repositories\VisionAndMisionRepository;
use App\Contracts\Interfaces\EnterpriseStructureInterface;
use App\Contracts\Interfaces\HiglightInterface;
use App\Contracts\Interfaces\JobVacancyInterface;
use App\Contracts\Interfaces\ShopInterface;
use App\Contracts\Interfaces\TitleInterface;
use App\Contracts\Interfaces\UniqueVisitorInterface;
use App\Contracts\Repositories\ComingSoonProductRepository;
use App\Contracts\Repositories\ContactUsRepository;
use App\Contracts\Repositories\VisitorDetectionRepository;
use App\Contracts\Repositories\EnterpriseStructureRepository;
use App\Contracts\Repositories\HiglightRepository;
use App\Contracts\Repositories\JobVacancyRepository;
use App\Contracts\Repositories\ShopRepository;
use App\Contracts\Repositories\TitleRepository;
use App\Contracts\Repositories\UniqueVisitorRepository;

class AppServiceProvider extends ServiceProvider
{
    private array $register = [
        CategoryNewsInterface::class => CategoryNewsRepository::class,
        BranchInterface::class => BranchRepository::class,
        CollabCategoryInterface::class => CollabCategoryRepository::class,
        SaleInterface::class => SaleRepository::class,
        ProductInterface::class => ProductRepository::class,
        SalesPackageInterface::class => SalesPackageRepository::class,
        ServiceInterface::class => ServiceRepository::class,
        NewsInterface::class => NewsRepository::class,
        CollabMitraInterface::class => CollabMitraRepository::class,
        SosialMediaInterface::class => SosialMediaRepository::class,
        SectionInterface::class => SectionRepository::class,
        PositionInterface::class => PositionRepository::class,
        TeamInterface::class => TeamRepository::class,
        TestimonialInterface::class => TestimonialRepository::class,
        VisionAndMisionInterface::class => VisionAndMisionRepository::class,
        ProfileInterface::class => ProfileRepository::class,
        EnterpriseStructureInterface::class => EnterpriseStructureRepository::class,
        FaqInterface::class => FaqRepository::class,
        NewsCategoryInterface::class => NewsCategoryRepository::class,
        NewsImageInterface::class => NewsImageRepository::class,
        TermsconditionInterface::class => TermsconditionRepository::class,
        ProcedureInterface::class => ProcedureRepository::class,
        ForceInterface::class => ForceRepository::class,
        GalleryInterface::class => GalleryRepository::class,
        VacancyInterface::class => VacancyRepository::class,
        StructureInterface::class => StructureRepository::class,
        GaleryImageInterface::class => GaleryImageRepository::class,
        WorkFlowInterface::class => WorkFlowRepository::class,
        VisitorDetectionInterface::class => VisitorDetectionRepository::class,
        UniqueVisitorInterface::class => UniqueVisitorRepository::class,
        ProductFeatureInterface::class => ProductFeatureRepository::class,
        LogoInterface::class => LogoRepository::class,
        CategoryProductInterface::class => CategoryProductRepository::class,
        BackgroundInterface::class => BackgroundRepository::class,
        ServiceMitraInterface::class => ServiceMitraRepository::class,
        HomeInterface::class => HomeRepository::class,
        MisionItemsInterface::class => MisionItemsRepository::class,
        ComingSoonProductInterface::class => ComingSoonProductRepository::class,
        ShopInterface::class => ShopRepository::class,
        TitleInterface::class => TitleRepository::class,
        HiglightInterface::class => HiglightRepository::class,
        ContactUsInterface::class => ContactUsRepository::class,
        JobVacancyInterface::class => JobVacancyRepository::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->register as $index => $value) {
            $this->app->bind($index, $value);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @see https://stackoverflow.com/questions/36777840/how-to-validate-phone-number-in-laravel-5-2 To validate phone number
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Validator::extend('phone_number', function ($attribute, $value, $parameters) {
            return preg_match('/^(?:\+?62|0)(?:\d{3,4})?(?:\d{6,7})$/', $value);
        });
    }
}

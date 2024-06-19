<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ImageUploader;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ForceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BackgroundController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\WorkflowController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\CollabMitraController;
use App\Http\Controllers\HomeProductController;
use App\Http\Controllers\HomeVacancyController;
use App\Http\Controllers\SosialMediaController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\CategoryNewsController;
use App\Http\Controllers\SalesPackageController;
use App\Http\Controllers\CollabCategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeContactController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TermsconditionController;
use App\Http\Controllers\VisionAndMisionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Autentikasi
Auth::routes();

// Administrator
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //Collab Category
    Route::get('category-collab', [CollabCategoryController::class, 'index']);
    Route::post('create/category/mitra', [CollabCategoryController::class, 'store'])->name('create.category.mitra');
    Route::put('update/category/mitra/{collabCategory}', [CollabCategoryController::class, 'update'])->name('update.category.mitra');
    Route::delete('delete/category/mitra/{collabCategory}', [CollabCategoryController::class, 'destroy'])->name('delete.category.mitra');
    //Galery

    // Galery
    Route::resource('gallery', GalleryController::class);
    Route::put('galery/update/{galeryImage}', [GalleryController::class, 'update']);
    Route::delete('galery/delete/{galeryImage}', [GalleryController::class, 'destroy']);

    // News Category
    Route::get('category-news', [CategoryNewsController::class, 'index']);
    Route::delete('delete/category/news/{model}', [CategoryNewsController::class, 'destroy'])->name('delete.category.news');
    Route::post('create/category/news', [CategoryNewsController::class, 'store'])->name('create.category.news');
    Route::put('update/category/news/{categoryNews}', [CategoryNewsController::class, 'update'])->name('update.category.news');


    //Collab Category
    Route::get('category-collab', [CollabCategoryController::class, 'index']);
    Route::post('create/category/mitra', [CollabCategoryController::class, 'store'])->name('create.category.mitra');
    Route::put('update/category/mitra/{collabCategory}', [CollabCategoryController::class, 'update'])->name('update.category.mitra');
    Route::delete('delete/category/mitra/{collabCategory}', [CollabCategoryController::class, 'destroy'])->name('delete.category.mitra');

    // Sale
    Route::resource('sale', SaleController::class);
    Route::get('showpdf/{sale}', [SaleController::class, 'showpdf']);

    // Service
    Route::resource('service', ServiceController::class);
    Route::post('create/service', [ServiceController::class, 'store'])->name('create.service');
    Route::get('detail/service/{service}', [ServiceController::class, 'show'])->name('detail.service');

    // Product
    Route::resource('admin/product', ProductController::class);
    Route::delete('product/feature/{ProductFeature}', [ProductController::class, 'feature'])->name('product.feature');
    Route::post('product-company/store', [ProductController::class, 'storeCompany'])->name('productCompany.store');
    Route::get('product-company/{product}/edit', [ProductController::class, 'editCompany'])->name('productCompany.edit');
    Route::put('product-company/{product}/update', [ProductController::class, 'updateCompany'])->name('productCompany.update');

    // Branch
    Route::get('branch', [BranchController::class, 'index']);
    Route::post('branch/create', [BranchController::class, 'store']);
    Route::put('branch/update/{branch}', [BranchController::class, 'update']);
    Route::delete('brach/delete/{branch}', [BranchController::class, 'destroy']);

    // Angkatan / Generasi Anak Magang
    Route::resource('force', ForceController::class);

    // Sosial Media
    Route::get('social-media', [SosialMediaController::class, 'index']);
    Route::post('create/social/media/', [SosialMediaController::class, 'store'])->name('create.social.media');
    Route::delete('delete/social/media/{sosialMedia}', [SosialMediaController::class, 'destroy'])->name('delete.social.media');
    Route::put('update/social/media/{sosialMedia}', [SosialMediaController::class, 'update'])->name('update.social.media');

    // Procedure
    Route::resource('procedure', ProcedureController::class);

    // Faq
    Route::resource('faq', FaqController::class);

    // Terms Condition
    Route::resource('terms_condition', TermsconditionController::class);

    // Slider
    Route::get('hero-section', [SectionController::class, 'index'])->name('hero.section');
    Route::get('hero-section/create', [SectionController::class, 'create']);
    Route::post('create/section', [SectionController::class, 'store'])->name('create.section');
    Route::get('edit/section/{section}', [SectionController::class, 'edit'])->name('hero.edit');
    Route::put('edit/section/{section}', [SectionController::class, 'update'])->name('hero.update');
    Route::delete('delete/section/{section}', [SectionController::class, 'destroy'])->name('hero.delete');

    // Penjualan
    Route::resource('sales-package', SalesPackageController::class);

    // News
    // Route::get('news/index', [NewsController::class, 'index'])->name('news.index');
    Route::resource('admin/news', NewsController::class);

    // Position
    Route::get('setting/departement', [PositionController::class, 'index'])->name('setting.departement');
    Route::post('create/position', [PositionController::class, 'store'])->name('create.position');
    Route::put('update/position/{position}', [PositionController::class, 'update'])->name('update.position');
    Route::delete('delete/position/{position}', [PositionController::class, 'destroy'])->name('delete.position');

    // Team
    Route::get('setting/teams', [TeamController::class, 'index'])->name('setting.teams');
    Route::post('create/team', [TeamController::class, 'store'])->name('create.team');
    Route::put('update/team/{team}', [TeamController::class, 'update'])->name('update.team');
    Route::delete('delete/team/{team}', [TeamController::class, 'destroy'])->name('delete.team');

    // Profile
    Route::get('setting/profile', [ProfileController::class, 'index']);
    Route::post('store/profile', [ProfileController::class, 'store'])->name('store.profile');
    Route::put('update/profile/{profile}', [ProfileController::class, 'update'])->name('update.profile');

    // Visi dan Misi
    Route::get('vision-mision', [VisionAndMisionController::class, 'index'])->name('vision.mision');
    Route::post('create/vision/mision/', [VisionAndMisionController::class, 'store'])->name('create.vision.mision');
    Route::put('update/vision/mision/{visionAndMision}', [VisionAndMisionController::class, 'update'])->name('update.vision.mision');
    Route::put('update/mision/mision/{misionItems}', [VisionAndMisionController::class, 'updatemision'])->name('update.mision.mision');
    Route::delete('delete/vision/mision/{visionAndMision}', [VisionAndMisionController::class, 'destroy'])->name('destroy.vision.mision');
    Route::delete('delete/mision/mision/{misionItems}', [VisionAndMisionController::class, 'destroymision'])->name('destroy.mision.mision');

    // Testimonial
    Route::resource('testimonial', TestimonialController::class);
    Route::post('testimonial/store', [TestimonialController::class, 'storeProduct'])->name('testimonialProduct.store');
    Route::put('testimonial/product/{testimonial}', [TestimonialController::class, 'updateProduct'])->name('testimonialProduct.update');

    // Pesan
    Route::get('message-approval', function () {
        return view('admin.pages.message-approval.index');
    });

    // Struktur Perusahaan
    Route::prefix('setting')->name('company.')->group(function () {
        Route::get('company', [\App\Http\Controllers\EnterpriseStructureController::class, 'index'])->name('index');
        Route::post('company/store', [\App\Http\Controllers\EnterpriseStructureController::class, 'store'])->name('store');
        Route::put('company/{enterpriseStructure}', [\App\Http\Controllers\EnterpriseStructureController::class, 'update'])->name('update');
        Route::delete('company/{enterpriseStructure}', [\App\Http\Controllers\EnterpriseStructureController::class, 'destroy'])->name('destroy');
        Route::get('structure', [StructureController::class, 'index'])->name('structure.index');
        Route::post('structure/create', [StructureController::class, 'store'])->name('structure.create');
    });
    Route::delete('setting/structure/delete/{structure}', [StructureController::class, 'destroy']);
    Route::put('setting/structure/update/{structure}', [StructureController::class, 'update']);

    // Lowker
    Route::controller(VacancyController::class)->name('vacancy.')->prefix('/vacancy')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::put('/{vacancy}/update', 'update')->name('update');
    });

    // Filosofis
    Route::get('/setting/philosophy', [LogoController::class, 'index'])->name('philosophy');
    Route::post('/setting/philosophy/store', [LogoController::class, 'store'])->name('philosophy.store');
    Route::put('/setting/philosophy/update/{logo}', [LogoController::class, 'update'])->name('philosophy.update');
    // Mitra
    Route::get('collab', [CollabMitraController::class, 'index']);
    Route::post('create/collab/mitra', [CollabMitraController::class, 'store']);
    Route::put('update/collab/mitra/{collabMitra}', [CollabMitraController::class, 'update']);
    Route::delete('delete/collab/mitra/{collabMitra}', [CollabMitraController::class, 'destroy']);

    //workflow
    Route::get('workflow', [WorkflowController::class, 'index']);
    Route::put('vacancy/workflow/update/{workflow}', [WorkflowController::class, 'update'])->name('update.workflow');
    Route::post('store/workflow', [WorkflowController::class, 'store'])->name('store.workflow');
    Route::delete('vacancy/workflow/delete/{workflow}', [WorkflowController::class, 'destroy'])->name('delete.vacancy.workflow');
});

// Beranda
Route::get('/', [HomePageController::class, 'index']);

// Tentang Kami
// Route::get('about-us', [AboutUsController::class, 'index']);
Route::get('about/profile', [AboutUsController::class, 'profile']);
Route::get('about/vision-mision', [AboutUsController::class, 'vision_mision']);
Route::get('about/organizational-structure', [AboutUsController::class, 'structure_organisation']);
Route::get('about/company-structure', [AboutUsController::class, 'structure_office']);
Route::get('about/logo', [AboutUsController::class,'logo']);
Route::get('about/team', [AboutUsController::class,'team']);
Route::get('detail/profile', [AboutUsController::class, 'showPdf']);

// Berita
Route::get('news', [NewsController::class, 'news']);
Route::get('news/category/{category:slug}', [NewsController::class, 'newsCategory'])->name('news.category');
Route::get('news/{slugnews}', [NewsController::class, 'showNews'])->name('news.view');

//showService
Route::get('services/{slugService}', [ServiceController::class, 'ShowService']);

//portofolio
Route::get('/portfolio', [HomeProductController::class, 'portfolio']);


Route::get('/product', [HomeProductController::class, 'index']);
Route::get('data/product/kategori/{category:slug}',[HomeProductController::class,'productCategory']);

// Detail Product
Route::get('product/{product:slug}', [ProductController::class, 'showproduct'])->name('detail.product');
Route::get('portfolio/{product:slug}', [ProductController::class, 'showproduct'])->name('detail.portfolio');
Route::get('product/coming-soon/{ComingSoonProduct:slug}', [ProductController::class, 'showproductcommingsoon'])->name('detail.comming-soon');

// Contact Us With Controller
Route::controller(ContactUsController::class)->name('contact.')->group(function() {
    Route::get('contact', 'index')->name('index');
    Route::post('contact/store', 'store')->name('store');
});


Route::get('mitra',  [HomePageController::class , 'mitra']);

//alumni-detail
Route::get('alumni-detail', function () {
    return view('landing.service.alumni-detail');
});
//vacancy
Route::get('job-vacancy', HomeVacancyController::class);
Route::get('job-vacancy/{jobVacancy:slug}', [HomeVacancyController::class, 'show'])->name('vacancy.detail');
//gatau
Route::post('image-uploader', ImageUploader::class)->name('image-uploader');

Route::post('background/store' , [BackgroundController::class , 'store']);

Route::get('/sitemap.xml', SitemapController::class);

Route::get('admin/job-vacancy', [JobVacancyController::class, 'index'])->name('job-vacancy.index');
Route::get('admin/job-vacancy/create', [JobVacancyController::class, 'create'])->name('job-vacancy.create');
Route::post('admin/job-vacancy/store', [JobVacancyController::class, 'store'])->name('job-vacancy.store');
Route::put('admin/job-vacancy/{jobVacancy}', [JobVacancyController::class, 'update'])->name('job-vacancy.update');
Route::get('admin/job-vacancy/{jobVacancy}', [JobVacancyController::class, 'edit'])->name('job-vacancy.edit');
Route::delete('admin/job-vacancy/{jobVacancy}', [JobVacancyController::class, 'destroy'])->name('job-vacancy.destroy');

require_once __DIR__ . '/kader.php';
require_once __DIR__ . '/farah.php';
require_once __DIR__ . '/nesa.php';
require_once __DIR__ . '/adi.php';
require_once __DIR__ . '/rendi.php';

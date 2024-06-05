<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\BackgroundInterface;
use App\Contracts\Interfaces\CollabMitraInterface;
use App\Contracts\Interfaces\FaqInterface;
use App\Contracts\Interfaces\GaleryImageInterface;
use App\Contracts\Interfaces\GalleryInterface;
use App\Contracts\Interfaces\MisionItemsInterface;
use App\Contracts\Interfaces\ProcedureInterface;
use App\Contracts\Interfaces\ProductInterface;
use App\Contracts\Interfaces\ProfileInterface;
use App\Contracts\Interfaces\SaleInterface;
use App\Contracts\Interfaces\ServiceInterface;
use App\Contracts\Interfaces\ServiceMitraInterface;
use App\Contracts\Interfaces\SosialMediaInterface;
use App\Contracts\Interfaces\TestimonialInterface;
use App\Contracts\Repositories\FaqRepository;
use App\Contracts\Repositories\ProductRepository;
use App\Contracts\Repositories\TestimonialRepository;
use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Gallery;
use App\Models\MisionItems;
use App\Models\Product;
use App\Models\Termscondition;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private ServiceInterface $service;
    private ServiceService $serviceService;
    private Termscondition $termscondition;
    private TestimonialInterface $testimonial;
    private TestimonialRepository $testimoni;
    private ProductInterface $product;
    private FaqInterface $faq;
    private ProcedureInterface $procedure;
    private SaleInterface $sale;
    private ProfileInterface $profile;
    private CollabMitraInterface $mitras;
    private GaleryImageInterface $galleryImage;
    private GalleryInterface $galery;
    private BackgroundInterface $background;
    private ServiceMitraInterface $serviceMitra;
    private  MisionItemsInterface $misionItems;
    private  SosialMediaInterface $sosmed;


    public function __construct( SosialMediaInterface $sosmed, GaleryImageInterface $galleryImage, GalleryInterface $galery, ServiceInterface $service, ServiceService $serviceService, Termscondition $termscondition, TestimonialInterface $testimonial, FaqInterface $faq, ProductInterface $product, ProcedureInterface $procedure, SaleInterface $sale, ProfileInterface $profile, CollabMitraInterface $mitras, BackgroundInterface $background, ServiceMitraInterface $serviceMitra, MisionItemsInterface $misionItems)
    {
        $this->mitras = $mitras;
        $this->galleryImage = $galleryImage;
        $this->galery = $galery;
        $this->procedure = $procedure;
        $this->service = $service;
        $this->termscondition = $termscondition;
        $this->serviceService = $serviceService;
        $this->testimonial = $testimonial;
        $this->faq = $faq;
        $this->product = $product;
        $this->sale = $sale;
        $this->profile = $profile;
        $this->background = $background;
        $this->serviceMitra = $serviceMitra;
        $this->misionItems = $misionItems;
        $this->sosmed = $sosmed;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->name;
        $services = $this->service->search($request)->get();
        $drafts = $this->service->draf();
        return view('admin.pages.service.index', compact('services' , 'search', 'drafts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $this->serviceService->store($request);
        $this->service->store($data);
        return back()->with('success', 'Layanan berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $services = $this->service->show($service->id);
        $products = $this->product->getByServiceId($service->id);
        $termsconditions = $this->termscondition->where('service_id', $service->id)->get();
        $testimonials = $this->testimonial->get()->where('service_id', $service->id);
        $mision = $this->misionItems->where($service->id)->get();
        $faqs = $this->faq->get()->where('service_id', $service->id);
        $serviceMitras = $this->serviceMitra->getByServiceId($service->id);
        $galleries = $this->galery->ServiceProductShow('service_id', $service->id)->get();


        return view('admin.pages.service.detail', compact('services', 'products', 'termsconditions', 'testimonials', 'mision', 'faqs', 'serviceMitras', 'galleries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }
    public function ShowService($slug, Service $service)
    {
        $slugs = $this->service->slug($slug);
        $services = $this->service->get();
        $products = $this->product->getByServiceId($slugs->id);
        $testimonials = $this->testimonial->getByServiceId($slugs->id);
        $faqs = $this->faq->ServiceProductShow('service_id', $slugs->id);
        $procedures = $this->procedure->getByServiceId($slugs->id);
        $sales = $this->sale->get();
        $profile = $this->profile->First();
        $mitras = $this->mitras->get();
        $servicemitras = $this->serviceMitra->where($slugs->id)->whereIn('mitra_id',$mitras->pluck('id'))->get();
        $galerys = $this->galery->ServiceProductShow('service_id', $slugs->id)->get();
        $background = $this->background->getByServiceId($slugs->id);
        $galeries = $this->galleryImage->whereIn('gallery_id',$galerys->pluck('id'))->get();
        $instagram = $this->sosmed->instagram();
        return view('landing.service.service-detail', compact('instagram', 'servicemitras','slugs', 'services', 'products', 'testimonials', 'faqs', 'procedures', 'sales', 'profile', 'galeries', 'background'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $this->serviceService->update($service, $request);
        $this->service->update($service->id, $data);

        return back()->with('success', 'Layanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $findDraft = $this->service->findDraft($id);

        $findDraft->forceDelete();
        $this->serviceService->delete($findDraft);
        return back()->with('success', 'Layanan Berhasil Di Hapus');
    }

    public function draft(Service $service)
    {
        $this->service->delete($service->id);
        return back()->with('success', 'Berhasil menyimpan di draf');
    }

    public function publish($id)
    {
        $findDraft = $this->service->findDraft($id);
        if($findDraft->trashed()){
            $findDraft->restore();
            return redirect()->back()->with('success', 'Draf berhasil di publish');
        } else {
            return redirect()->back()->with('warning', 'Draf tidak ditemukan');
        }
    }

}

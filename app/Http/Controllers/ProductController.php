<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\CategoryProductInterface;
use App\Contracts\Interfaces\ComingSoonProductInterface;
use App\Contracts\Interfaces\FaqInterface;
use App\Contracts\Interfaces\ProductFeatureInterface;
use App\Models\Product;
use App\Models\ProductFeature;
use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Contracts\Interfaces\ProductInterface;
use App\Contracts\Interfaces\ServiceInterface;
use App\Contracts\Interfaces\TestimonialInterface;
use App\Enums\ProductEnum;
use App\Http\Requests\StoreComingSoonProductRequest;
use App\Http\Requests\StoreProductCompanyRequest;
use App\Http\Requests\UpdateComingSoonProductRequest;
use App\Http\Requests\UpdateProductCompanyRequest;
use App\Models\ComingSoonProduct;
use App\Services\ComingSoonProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductInterface $product;
    private ProductService $productService;
    private ServiceInterface $service;
    private TestimonialInterface $testimonial;
    private FaqInterface $faq;
    private ProductFeatureInterface $productFeature;
    private CategoryProductInterface $categoryProduct;
    private ComingSoonProductInterface $comingProduct;

    public function __construct(ProductInterface $product, CategoryProductInterface $categoryProduct, ProductFeatureInterface $productFeature, ProductService $productService, ServiceInterface $service, TestimonialInterface $testimonial, FaqInterface $faq, private ComingSoonProductInterface $model, ComingSoonProductInterface $comingProduct)
    {
        $this->product = $product;
        $this->testimonial = $testimonial;
        $this->productService = $productService;
        $this->service = $service;
        $this->faq = $faq;
        $this->productFeature = $productFeature;
        $this->categoryProduct = $categoryProduct;
        $this->comingProduct = $comingProduct;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->product->search($request);
        $services = $this->service->get();
        $comingProducts = $this->comingProduct->get();
        $drafts = $this->product->draf('!=', ProductEnum::PORTFOLIO->value);
        $comingProductdrafts = $this->comingProduct->draf();
        return view('admin.pages.products.index', compact('products', 'services', 'comingProducts', 'drafts', 'comingProductdrafts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = $this->service->get();
        $categories = $this->categoryProduct->get();
        // dd($services);
        return view('admin.pages.products.create', compact('services', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // dd($request->all());
        $data = $this->productService->store($request);
        $product_id = $this->product->store($data);
        $this->productService->storefeature($request, $product_id);
        return to_route('product.index')->with('success', 'Produk berhasil di tambahkan');
    }

    public function storeCompany(StoreProductCompanyRequest $request)
    {
        // dd($request->all());
        $data = $this->productService->storeCompany($request);
        $product_id = $this->product->store($data);
        $this->productService->storefeaturecompany($request, $product_id);
        return to_route('product.index')->with('success', 'Produk berhasil di tambahkan');
    }

    public function storeComing(StoreComingSoonProductRequest $request)
    {
        $data = $this->productService->storeComing($request);
        $this->comingProduct->store($data);
        return to_route('product.index')->with('success', 'Produk berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $products = $this->product->show($product->id);
        return view('admin.pages.products.detail', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function editCompany(Product $product)
    {
        $categories = $this->categoryProduct->get();
        $services = $this->service->get();
        $productfeatureFirst = $this->productFeature->getByServiceId($product->id)->First();
        $productfeatures = $this->productFeature->getByServiceId($product->id);

        return view('admin.pages.products.editCompany', compact( 'services', 'productfeatures', 'product', 'productfeatureFirst', 'categories'));
    }

    public function edit(Product $product)
    {
        $categories = $this->categoryProduct->get();
        $services = $this->service->get();
        $productfeatureFirst = $this->productFeature->getByServiceId($product->id)->First();
        $productfeatures = $this->productFeature->getByServiceId($product->id);
        // dd($productfeature);

        return view('admin.pages.products.edit', compact('services', 'productfeatures', 'product', 'productfeatureFirst', 'categories'));
    }

    public function editComing(ComingSoonProduct $comingSoonProduct)
    {
        $categories = $this->categoryProduct->get();

        return view('admin.pages.products.editComingProduct', compact('comingSoonProduct', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // dd($request->all());
        $data = $this->productService->update($product, $request);
        $this->product->update($product->id, $data);
        $this->productService->updatefeature($request, $product);
        return to_route('product.index')->with('success', 'Produk Berhasil Di Update');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCompany(UpdateProductCompanyRequest $request, Product $product)
    {
        // dd($request->all());
        $data = $this->productService->updateCompany($product, $request);
        $this->product->update($product->id, $data);
        $this->productService->updatefeaturecompany($request, $product);
        return to_route('product.index')->with('success', 'Produk Berhasil Di Update');
    }

    public function updateComing(UpdateComingSoonProductRequest $request, ComingSoonProduct $comingSoonProduct)
    {
        $data = $this->productService->updateComing($comingSoonProduct, $request);
        $this->comingProduct->update($comingSoonProduct->id , $data);
        return to_route('product.index')->with('success', 'Produk Berhasil Di Update');
    }

    public function feature(ProductFeature $ProductFeature)
    {
        // dd($ProductFeature);
        $ProductFeature->delete();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function draft(Product $product)
    {
        $this->product->delete($product->id);
        return back()->with('success', 'Berhasil menyimpan di draf');
    }
    public function comingDraft(ComingSoonProduct $comingSoonProduct)
    {
        $this->comingProduct->delete($comingSoonProduct->id);
        return back()->with('success', 'Berhasil menyimpan di draf');
    }

    public function destroy($id)
    {
        $findDraft = $this->product->findDraft($id);

        $findDraft->forceDelete();
        $this->productService->delete($findDraft);
        return redirect()->back()->with('success', 'Berhasil menghapus produk');
    }

    public function destroyComing($id)
    {
        $findDraft = $this->comingProduct->findDraft($id);

        $findDraft->forceDelete();
        $this->productService->deleteComing($findDraft);
        return redirect()->back()->with('success', 'Berhasil menghapus produk');
    }

    public function publishProduct($id)
    {
        $findDraft = $this->product->findDraft($id);
        if($findDraft->trashed()){
            $findDraft->restore();
            return redirect()->back()->with('success', 'Draf berhasil di publish');
        } else {
            return redirect()->back()->with('warning', 'Draf tidak ditemukan');
        }
    }

    public function publishProductComing($id)
    {
        $findDraft = $this->comingProduct->findDraft($id);
        if($findDraft->trashed()){
            $findDraft->restore();
            return redirect()->back()->with('success', 'Draf berhasil di publish');
        } else {
            return redirect()->back()->with('warning', 'Draf tidak ditemukan');
        }
    }

    public function showproduct(Product $product)
    {
        $testimonial = $this->testimonial->get();
        $id  = $product->id;
        $faqs = $this->faq->ServiceProductShow('product_id', $id);

        return view('landing.product.product-detail', compact('product', 'testimonial', 'faqs'));
    }

    public function showproductcommingsoon(ComingSoonProduct $ComingSoonProduct)
    {
        $testimonial = $this->testimonial->get();
        $id  = $ComingSoonProduct->id;
        $faqs = $this->faq->ServiceProductShow('product_id', $id);


        return view('landing.product.product-detail-coming-soon', compact('ComingSoonProduct', 'testimonial', 'faqs'));
    }
}

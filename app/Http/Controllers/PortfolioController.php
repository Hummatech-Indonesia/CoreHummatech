<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\CategoryProductInterface;
use App\Contracts\Interfaces\ProductInterface;
use App\Enums\ProductEnum;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Models\Product;
use App\Services\PortfolioService;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    private ProductInterface $model;
    private PortfolioService $service;
    private CategoryProductInterface $category;

    public function __construct(ProductInterface $model, CategoryProductInterface $category, PortfolioService $service)
    {
        $this->model = $model;
        $this->service = $service;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = $this->model->getByType('portfolio');
        $categories = $this->category->get();
        $drafts = $this->model->draf('=', ProductEnum::PORTFOLIO->value);
        return view('admin.pages.portfolio.index', compact('portfolios', 'categories', 'drafts'));
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
    public function store(StorePortfolioRequest $request)
    {
        $data = $this->service->store($request);
        $this->model->store($data);
        return redirect()->back()->with('success', 'Portfolio berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortfolioRequest $request, Product $product)
    {
        // dd($product);
        $data = $this->service->update($product, $request);
        $this->model->update($product->id, $data);
        return redirect()->back()->with('success', 'Portfolio berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $findDraft = $this->model->findDraft($id);

        $findDraft->forceDelete();
        $this->service->delete($findDraft);
        return back()->with('success', 'Portfolio Berhasil Di Hapus');
    }
}

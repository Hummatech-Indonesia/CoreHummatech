<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\BackgroundInterface;
use App\Contracts\Interfaces\CategoryNewsInterface;
use App\Contracts\Interfaces\NewsCategoryInterface;
use App\Contracts\Interfaces\NewsImageInterface;
use App\Contracts\Interfaces\NewsInterface;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\CategoryNews;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsImage;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private NewsInterface $news;
    private NewsService $newsService;
    private CategoryNewsInterface $category;
    private NewsCategoryInterface $newsCategory;
    private BackgroundInterface $background;
    private NewsImageInterface $newsImage;

    public function __construct(NewsImageInterface $newsImage, NewsInterface $news, NewsService $newsService, CategoryNewsInterface $category, NewsCategoryInterface $newsCategoryInterface, BackgroundInterface $background)
    {
        $this->newsCategory = $newsCategoryInterface;
        $this->news = $news;
        $this->newsService = $newsService;
        $this->category = $category;
        $this->background = $background;
        $this->newsImage = $newsImage;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $news = $this->news->customPaginate($request, 12);
        $news = $this->news->search($request);

        return view('admin.pages.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->get();
        return view('admin.pages.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @see https://laravel.com/docs/10.x/collections#method-map
     */
    public function store(StoreNewsRequest $request)
    {
        $data = $this->newsService->store($request);
        $newsId = $this->news->store($data)->id;

        collect($data['category'])->map(function ($ctgr) use ($newsId) {
            return $this->newsCategory->store([
                'news_id' => $newsId,
                'category_id' => $ctgr,
            ]);
        });

        return redirect()->route('news.index')->with('success','Data Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        $categories = $this->newsCategory->whereNews($news->id);
        $newsImages = $this->newsImage->whereNews($news->id);
        return view('admin.pages.news.show', compact('news', 'newsImages', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = $this->category->get();
        return view('admin.pages.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @see https://laravel.com/docs/10.x/collections#method-map
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $data = $this->newsService->update($news, $request);
        $newsId = $news->id;

        $this->news->update($news->id, $data);

        collect($data['category'])->map(function ($ctgr) use ($newsId) {
            return $this->newsCategory->store([
                'news_id' => $newsId,
                'category_id' => $ctgr,
            ]);
        });

        return redirect()->route('news.index')->with('success','Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $this->news->delete($news->id);
        return back()->with('success','Data Berhasil di Hapus');
    }

    /**
     * News Data List homepage
     *
     * @package hummatech.com
     * @author @Kader2637
     */
    public function news(Request $request)
    {
        $newsCategories = $this->category->get();
        $newses = $this->news->customPaginate($request, 12);
        $background = $this->background->getByType('Berita');

        return view('landing.news.index', compact('newses', 'newsCategories', 'background'));
    }

    /**
     * News Data by Category List on Homepage
     *
     * @package hummatech.com
     * @author @cakadi190
     */
    public function newsCategory(Request $request, CategoryNews $category)
    {
        $newses = $this->newsCategory->where($category->id);
        $newsCategories = $this->category->get();
        $background = $this->background->getByType('Berita');

        return view('landing.news.index', compact('newses' ,'newsCategories', 'background'));
    }

    /**
     * Show the News Data
     *
     * @package hummatech.com
     * @author @13Farahamalia
     */
    public function showNews($slugnews)
    {
        $otherNews = $this->news->latest(5, [['news.slug', '!=', $slugnews]]);
        $news = $this->news->slug($slugnews);
        $background = $this->background->getByType('Berita');

        return view('landing.news.detail', compact('news', 'otherNews', 'background'));
    }
}

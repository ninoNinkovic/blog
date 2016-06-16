<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Models\Subject;
use App\Models\Tag;
use Illuminate\Database\QueryException as Exception;
use Carbon\Carbon;
use Session;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $articles = Article::paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $subjects = Subject::orderBy('name')->pluck('name', 'id');
        return view('admin.articles.create')->with('subjects', $subjects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(ArticleRequest $request)
    {
        try {
            $data = $request->only(['subject_id', 'title', 'sub_title', 'summary', 'details', 'display']);
            $data['user_id'] = $request->user()->id;
            $data['slug'] = $this->get_slug($data['title']);
            $article = Article::create($data);

            Session::flash('flash_message', 'Article added!');
            return redirect('admin/articles');
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Article $article
     *
     * @return void
     */
    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Article $article
     *
     * @return void
     */
    public function edit(Article $article)
    {
        $subjects = Subject::lists('name', 'id');
        return view('admin.articles.edit', compact('article', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Article $article
     *
     * @return void
     */
    public function update(Article $article, ArticleRequest $request)
    {
        try {
            $data = $request->only(['subject_id', 'title', 'sub_title', 'summary', 'details', 'display']);
            $article->update($data);
            Session::flash('flash_message', 'Article updated!');
            return redirect('admin/articles');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $article
     *
     * @return void
     */
    public function destroy(Article $article)
    {
        try {
            $article->delete();
            Session::flash('flash_message', 'Article deleted!');
            return redirect('admin/articles');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $article
     *
     * @return void
     */
    private function get_slug($str, $delimiter = '-')
    {
        $string = strtolower(trim($str, '-'));
        $special_chars  = array('&#39;');
        $replace = array('');
        $filter_special_chars = str_replace($special_chars, $replace, $string);
        $search  = array('&', '#', ':', ',', '.', '?');
        $replace = array('and', ' ', ' ', ' ', ' ', '');
        $filter_chars = str_replace($search, $replace, $filter_special_chars);
        $slug = preg_replace("/[\/_|+ -]+/", $delimiter, trim($filter_chars));

        return $slug;
    }
}

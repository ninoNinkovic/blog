<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;

use App\Models\Tag;
use Illuminate\Database\QueryException as Exception;
use Carbon\Carbon;
use Session;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $tags = Tag::paginate(15);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(TagRequest $request)
    {
        try {
            $data = $request->only('name');
            Tag::create($data);
            Session::flash('flash_message', 'Tag added!');
            return redirect('admin/tags');
        } catch (Exception $e) {

            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tag  $tag
     *
     * @return void
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Tag  $tag
     *
     * @return void
     */
    public function update(Tag $tag, TagRequest $request)
    {
        try {
            $data = $request->only('name');
            $tag->update($data);
            Session::flash('flash_message', 'Tag updated!');
            return redirect('admin/tags');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tag  $tag
     *
     * @return void
     */
    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            Session::flash('flash_message', 'Subject deleted!');
            return redirect('admin/tags');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }
}

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
        $tags = Tag::all();
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
            Session::flash('message', 'Tag added!');
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
            Session::flash('message', 'Tag updated!');
            return redirect('admin/tags');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Temporarily Remove the specified resource from storage.
     *
     * @param  Tag  $tag
     *
     * @return void
     */
    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            $name = $tag->name;
            Session::flash('message', $name . ' deleted!');
            return redirect('admin/tags');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }

    /**
     * Display a listing of the trash resource.
     *
     * @return void
     */
    public function trash()
    {
        $tags = Tag::onlyTrashed()->get();
        return view('admin.tags.trash', compact('tags'));
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function restore($id)
    {
        $tag = Tag::withTrashed()->where('id', $id)->firstOrFail();
        try {
            $name = $tag->name;
            $tag->restore();
            Session::flash('message', $name . ' restored!');
            return redirect('admin/tags/trash');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }

    /**
     * Permanently Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function clean($id)
    {
        $tag = Tag::withTrashed()->where('id', $id)->firstOrFail();
        try {
            $name = $tag->name;
            $tag->forceDelete();
            Session::flash('message', $name . ' deleted!');
            return redirect('admin/tags/trash');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }
}

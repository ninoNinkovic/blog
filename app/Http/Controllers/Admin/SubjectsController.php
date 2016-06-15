<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\SubjectRequest;
use App\Http\Controllers\Controller;

use App\Models\Subject;
use Illuminate\Database\QueryException as Exception;
use Carbon\Carbon;
use Session;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $subjects = Subject::paginate(15);
        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(SubjectRequest $request)
    {
        try {
            $data = $request->only(['name', 'description']);
            Subject::create($data);
            Session::flash('flash_message', 'Subject added!');
            return redirect('admin/subjects');
        } catch (Exception $e) {

            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Subject $subject
     *
     * @return void
     */
    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Subject $subject
     *
     * @return void
     */
    public function update(Subject $subject, SubjectRequest $request)
    {
        try {
            $data = $request->only(['name', 'description']);
            $subject->update($data);
            Session::flash('flash_message', 'Subject updated!');
            return redirect('admin/subjects');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Subject $subject
     *
     * @return void
     */
    public function destroy(Subject $subject)
    {
        try {
            $subject->delete();
            Session::flash('flash_message', 'Subject deleted!');
            return redirect('admin/subjects');

        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }
}

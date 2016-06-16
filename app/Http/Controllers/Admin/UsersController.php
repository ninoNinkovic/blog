<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\QueryException as Exception;
use Carbon\Carbon;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $users = User::where('id', '>', 1)->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $user_types = UserType::where('id', '>', 1)->lists('type', 'id');
        return view('admin.users.create', compact('user_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(UserRequest $request)
    {
        try {
            $data = $request->only(['name', 'email', 'user_type_id']);
            //----------Set a default password----------------------
            $default_password = '123456';
            $data['password'] = bcrypt($default_password);
            $data['remember_token'] = str_random(10);
            User::create($data);
            Session::flash('flash_message', $data['name'] . ' is added. Default Password: ' . $default_password);
            return redirect('admin/users');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     *
     * @return void
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     *
     * @return void
     */
    public function edit(User $user)
    {
        $user_types = UserType::where('id', '>', 1)->lists('type', 'id');
        return view('admin.users.edit', compact('user', 'user_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  User $user
     *
     * @return void
     */
    public function update(User $user, UserRequest $request)
    {
        try {
            $data = $request->only(['name', 'email', 'user_type_id']);
            $user->update($data);
            Session::flash('flash_message', 'User updated!');
            return redirect('admin/users');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     *
     * @return void
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            Session::flash('flash_message', 'User deleted!');
            return redirect('admin/users');

        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }
}

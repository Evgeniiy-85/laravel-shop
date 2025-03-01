<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UsersRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends AdminController {

    public function index() {
        return view('admin.users.index', [
            'users' => User::all(),
        ]);
    }

    public function add() {
        return view('admin.users.add', [
            'statuses' => User::getStatuses(),
            'roles' => User::getRoles(),
            'sexes' => User::getSexes(),
        ]);
    }


    public function edit($id) {
        $user = User::find($id);
        if (is_null($user)) {
            return view('admin.errors.404');
        }

        return view('admin.users.edit', [
            'user' => $user,
            'statuses' => User::getStatuses(),
            'roles' => User::getRoles(),
            'sexes' => User::getSexes(),
        ]);
    }

    /**
     * @param UsersRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UsersRequest $request) {
        $user = new User();
        $user->fill($request->all());
        $user->user_password = Hash::make($request->input('password'));

        $user->save();

        return redirect()->route('admin.users')->with('success', 'Успешно');
    }

    /**
     * @param $id
     * @param UsersRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UsersRequest $request) {
        $user = User::findOrFail($id);
        $user->fill($request->all());
        $user->user_password = Hash::make($request->input('user_password'));
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Успешно');
    }


    /*
    * Delete category
    */
    public function delete($id) {
        $user = User::find($id);
        if (is_null($user)) {
            return view('admin.errors.404');
        }

        $user->delete();

        return redirect()->route('admin.categories')->with('success', 'Успешно');
    }
}

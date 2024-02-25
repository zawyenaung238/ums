<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        if ($user && $user->role) {
            $permissions = $user->role->permissions()->pluck('name')->toArray();

            if (in_array('read', $permissions) || $user->role->id == 1) {
                $roles = Role::all();
                return view('roles.index', compact('roles'));
            } else {
                return abort(403);
            }
        } else {
            return abort(403);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = Auth::user();

        if ($user && $user->role) {
            $permissions = $user->role->permissions()->pluck('name')->toArray();

            if (in_array('create', $permissions) || $user->role->id == 1) {
                $permissions = Permission::all();
                $features = Feature::all();
                return view('roles.create', compact('permissions','features'));
            } else {
                return abort(403);
            }
        } else {
            return abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();

        if ($user && $user->role) {
            $permissions = $user->role->permissions()->pluck('name')->toArray();

            if (in_array('create', $permissions) || $user->role->id == 1) {
                $role = new Role();
                $role->name = $request->name;
                $role->save();

                $role->permissions()->sync($request->permissions);

                return redirect()->route('role.index')->with('create','Role is successfully created.');
            } else {
                return abort(403);
            }
        } else {
            return abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = Auth::user();

        if ($user && $user->role) {
            $permissions = $user->role->permissions()->pluck('name')->toArray();

            if (in_array('update', $permissions) || $user->role->id == 1) {
                $role = Role::find($id);
                $permissions = Permission::all();
                $features = Feature::all();
                $old_permission = $role->permissions->pluck('id')->toArray();
                return view('roles.edit', compact('role', 'permissions', 'features', 'old_permission'));
            } else {
                return abort(403);
            }
        } else {
            return abort(403);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = Auth::user();

        if ($user && $user->role) {
            $permissions = $user->role->permissions()->pluck('name')->toArray();

            if (in_array('update', $permissions) || $user->role->id == 1) {
                $role = Role::find($id);
                $role->name = $request->name;
                $role->update();

                $role->permissions()->sync($request->permissions);

                return redirect()->route('role.index')->with('update','Role successfully updated.');
            } else {
                return abort(403);
            }
        } else {
            return abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {

        $user = Auth::user();

        if ($user && $user->role) {
            $permissions = $user->role->permissions()->pluck('name')->toArray();

            if (in_array('update', $permissions) || $user->role->id == 1) {
                $role = Role::find($id);
                $role->delete();

                $role->permissions()->sync($request->permissions);

                return 'success';
            } else {
                return abort(403);
            }
        } else {
            return abort(403);
        }
    }
}

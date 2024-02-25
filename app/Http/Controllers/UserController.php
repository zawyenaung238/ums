<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index(){

        $user = auth()->user();
        $role = $user->role;
        if ($role && $role->hasPermission('read') || $user->role_id == '1') {
            return view('user.index');
        } else {
            return abort(404);
        }

    }

    public function ssd(){
        $users = User::with('role');
        return DataTables::of($users)
            ->filterColumn('name', function($query, $keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->filterColumn('email', function($query, $keyword) {
                $query->where('email', 'like', "%{$keyword}%");
            })
            ->filterColumn('phone', function($query, $keyword) {
                $query->where('phone', 'like', "%{$keyword}%");
            })
            ->filterColumn('role', function($query, $keyword) {
                $query->whereHas('role', function($query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                });
            })
            ->addColumn('name', function ($each){
                return $each->name;
            })
            ->addColumn('email', function ($each){
                return $each->email;
            })
            ->addColumn('phone', function ($each){
                return $each->phone;
            })
            ->addColumn('role', function ($each){
                return $each->role->name;
            })
            ->addColumn('status', function ($each){
                if($each->is_active == '0'){
                    return '<span class="badge bg-success-light shadow-sm">Active</span>';
                }else{
                    return '<span class="badge bg-danger-light shadow-sm">Inactive</span>';
                }
            })
            ->addColumn('action', function ($each){
                $edit = '';
                // $info = '';
                $delete = '';

                if(auth()->user()->role->hasPermission('update') || auth()->user()->role_id == '1'){
                    $edit = '<a href="'.route('user.edit',$each->id).'" class="btn btn-sm btn-outline-warning rounded"><i class="fas fa-edit fa-fw"></i></a>';
                }
                // if(auth()->user()->role->hasPermission('read') || auth()->user()->role_id == '1'){
                //     $info = '<a href="'.route('user.show',$each->id).'" class="btn btn-sm btn-outline-info rounded m-1"><i class="fas fa-info-circle fa-fw"></i></a>';
                // }
                if(auth()->user()->role->hasPermission('delete') || auth()->user()->role_id == '1'){
                    $delete = '<a href="#" class="btn btn-sm btn-outline-danger rounded delete" data-id="'.$each->id.'"><i class="fas fa-trash-alt fa-fw"></i></a>';
                }

                return '<div>'.$edit.$delete.'</div>';
            })
            ->rawColumns(['name','email','phone','role','status','action'])
            ->make(true);
    }

    public function create(){

        $user = auth()->user();
        $role = $user->role;

        $roles = Role::all();

        if ($role && $role->hasPermission('create') || $user->role_id == '1') {
            return view('user.create', compact('roles'));
        } else {
            return abort(404);
        }

    }

    public function store(Request $request){

        $user = auth()->user();
        $role = $user->role;

        if ($role && $role->hasPermission('create') || $user->role_id == '1') {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->role_id = $request->role_id;
            $user->is_active = $request->is_active;
            $user->address = $request->address;
            $user->save();

            return redirect()->route('user.index')->with('create', 'User Created');
        } else {
            return abort(404);
        }

    }

    public function edit($id){

        $user = auth()->user();
        $role = $user->role;

        $user = User::find($id);
        $roles = Role::all();

        if ($role && $role->hasPermission('update') || $user->role_id == '1') {
            return view('user.edit', compact('user','roles'));
        } else {
            return abort(404);
        }

    }

    public function update(Request $request, $id){

        $user = auth()->user();
        $role = $user->role;

        if ($role && $role->hasPermission('update') || $user->role_id == '1') {
            $user = User::find($id);

            $user->name = $request->name;
            $user->email = $request->email;

            $password = $request->password == $user->password ? $request->password : Hash::make($request->password);
            $user->password = $password;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->role_id = $request->role_id;
            $user->is_active = $request->is_active;
            $user->address = $request->address;
            $user->update();

            return redirect()->route('user.index')->with('update', 'User Updated');
        } else {
            return abort(404);
        }
    }

    public function destroy($id){

        $user = auth()->user();
        $role = $user->role;

        if ($role && $role->hasPermission('delete') || $user->role_id == '1') {
            $user = User::findOrFail($id);
            $user->delete();
            return 'success';
        } else {
            return abort(404);
        }
    }
}

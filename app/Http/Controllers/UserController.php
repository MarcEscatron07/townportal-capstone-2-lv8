<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($request->hasFile('image')) {
            $directory_path = 'images/profile/';
            $image = $request->file('image');
            $image_path = $directory_path.$image->getClientOriginalName();

            $image->move($directory_path, $image_path);
        } else {
            $image_path = 'images/profile/profile-default.png';
        }
        $data['image'] = $image_path;
        // dd($data);
        $new = new User($data);

        if($new->save()) {
            return redirect()->route('users.create')
            ->with('success', 'Successfully added new user!');
        } else {
            return redirect()->route('users.create')
            ->with('failed', 'Unable to add new user...');
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
        $user = User::findOrFail($id);
        return view('users.show', compact('id', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();
        return view('users.edit', compact('id', 'user', 'roles'));
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
        $user = User::findOrFail($id);
        // dd($user);
        $data = $request->all();
        // dd($data);

        $user->role_id = $data['role_id'] ?? null;
        $user->fname = $data['fname'] ?? null;
        $user->mname = $data['mname'] ?? null;
        $user->lname = $data['lname'] ?? null;
        $user->username = $data['username'] ?? null;
        $user->email = $data['email'] ?? null;
        $user->password = $data['password'] ?? null;
        $user->image = $data['image'] ?? null;

        if($user->save()) {
            return redirect()->route('users.edit', $user->id)
            ->with('success', 'Successfully updated user!');
        } else {
            return redirect()->route('users.edit', $user->id)
            ->with('failed', 'Unable to update user...');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success','Deleted successfully');
    }

    public function data(Request $request) {
        if($request->ajax()) {
            $data = User::get();

            return DataTables::of($data)
                ->addColumn('action', function(User $user){
                    $showUrl = route('users.show', $user->id);
                    $editUrl = route('users.edit', $user->id);
                    $delUrl = route('users.destroy', $user->id);

                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <a href="'.$showUrl.'" class="btn btn-info rounded mx-1" title="Show"><i class="fa fa-eye"></i></a>
                              <a href="'.$editUrl.'" class="btn btn-warning rounded mx-1" title="Edit"><i class="fa fa-edit"></i></a>
                              <a href="'.$delUrl.'" class="btn btn-danger rounded mx-1 btn-delete" title="Delete"><i class="fa fa-trash"></i></a>
                              <form action="'.$delUrl.'" method="POST" style="display: none;" class="form-delete">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>
                            </div>';
                })->editColumn('role_id', function(User $user){
                    return $user->formattedRole();
                })
                ->rawColumns(['action'])->make(true);
        }
    }
}

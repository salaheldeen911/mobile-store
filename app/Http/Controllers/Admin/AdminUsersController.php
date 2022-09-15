<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAdminRequest;
use App\Models\Cart;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    public function showAllUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $btns = '<a href="users/' . $row->id . '/edit ">
                                <span class="jsgrid-button jsgrid-edit-button ti-pencil" type="button" title="Edit"></span>

                            </a>';

                    if ($row->id !== auth()->user()->id) {
                        $btns .= '<form action="users/' . $row->id . '" method="POST" style="display:inline-block">
                                    ' . csrf_field() . '
                                    ' . method_field("DELETE") . '
                                    <a onclick="return confirm(\'Are You Sure Want to Delete?\')" type="submit">
                                        <span class="jsgrid-button jsgrid-delete-button ti-trash" type="button" title="Delete"></span>
                                    </a>
                                </form>';
                    }
                    return $btns;
                })->editColumn('role', function ($data) {
                    if ($data->role == 0) return 'User';
                    if ($data->role == 1) return 'Admin';
                })
                ->setRowId(function ($user) {
                    return $user->id;
                })
                ->setRowAttr([
                    'align' => "center",
                ])
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddAdminRequest $request)
    {

        $user = User::create([
            "name" => $request->input(('name')),
            "email" => $request->input(('email')),
            "password" => Hash::make($request->input(('password'))),
            "role" => $request->input(('role')),
        ]);


        switch ($request->input('role')) {
            case 0:
                $user->roles()->detach();
                Cart::create([
                    'user_id' => $user->id,
                ]);
                break;
            case 1:
                $user->assignRole('admin');
                break;
        }

        return redirect()->route('admin.users.index');
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
    public function edit(User $user)
    {
        return view("admin.users.edit")->with("user", $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddAdminRequest $request, $id)
    {

        $user = User::where('id', $id)->first();

        $user->update([
            "name" => $request->input(('name')),
            "email" => $request->input(('email')),
            "password" => Hash::make($request->input(('password'))),
            "role" => $request->input(('role')),
        ]);


        switch ($request->input('role')) {
            case 0:
                $user->roles()->detach();
                break;
            case 1:
                $user->syncRoles(['admin']);
                break;
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}

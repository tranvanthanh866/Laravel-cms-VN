<?php

namespace Modules\Core\Admin;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Core\Requests\Admin\StorePermissionsRequest;
use Modules\Core\Requests\Admin\UpdatePermissionsRequest;

class PermissionsController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'permission:'.config('const.permissions.USERS_MANAGE')]);
    }

    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();

        return view('Core::admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Core::admin.permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionsRequest $request)
    {
        Permission::create($request->all());

        return redirect()->route('admin.permissions.index');
    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {

        return view('Core::admin.permissions.edit', compact('permission'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionsRequest $request, Permission $permission)
    {

        $permission->update($request->all());

        return redirect()->route('admin.permissions.index');
    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {

        $permission->delete();

        return redirect()->route('admin.permissions.index');
    }

    public function show(Permission $permission)
    {

        return view('Core::admin.permissions.show', compact('permission'));
    }

    /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}

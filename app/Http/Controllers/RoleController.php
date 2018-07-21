<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('created_at', 'DESC')->paginate(10);

        return view('roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50'
        ]);

        $roles = Role::firstOrCreate(['name' => $request->name]);

        return redirect()->back()->with(['success' => 'Role: <strong>' . $roles->name . '</strong> has been submitted.']);
    }

    public function destroy($id)
    {
        $roles = Role::findOrFail($id);
        
        $roles->delete();

        return redirect()->back()->with(['success' => 'Role: <strong>' . $roles->name . '</strong> was deleted.']);
    }
}
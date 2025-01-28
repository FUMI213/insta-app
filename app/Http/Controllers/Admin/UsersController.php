<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct(User $user){
        $this->user = $user;
    }

    public function index(){
        //get all users; ordered by name
        $all_users = $this->user->orderBy('name')->withTrashed()->paginate(10);
        //paginate(n) -- show n rows per page
        //withTrashed() -- show all records including Soft-Deleted ones

        return view('admin.users.index')->with('all_users', $all_users);

    }

    public function deactivate($id){
        $this->user->destroy($id);
        return redirect()->back();
    }

    public function activate($id){
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        //restore() -- restores a soft-deleted record
        //onlyTrashed() -- get only soft-deleted records
        return redirect()->back();
    }
}

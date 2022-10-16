<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::where('isDeleted', false)->with('user')->paginate(20);
        return view('interfaces.admin.authors', compact('authors'));
    }

    public function add()
    {
        request()->request->remove('id');
        request()->isActiveCheck ? request()->request->add(['userId' => session()->get('admin')->id, 'isActive' => true]) : request()->request->add(['userId' => session()->get('admin')->id]);
        request()->request->remove('isActiveCheck');
        Author::create(request()->all());
        return redirect()->back()->with('msg', __('locale.msg.insert.success'));
    }

    public function update()
    {
        request()->isActiveCheck ? request()->request->add(['isActive' => true]) : request()->request->add(['isActive' => false]);
        $id = request()->id;
        request()->request->remove('id');
        request()->request->remove('_token');
        request()->request->remove('isActiveCheck');
        Author::where('id', $id)->update(request()->all());
        return redirect()->back()->with('msg', __('locale.msg.update.success'));
    }

    public function delete($id)
    {
        Author::where('id', $id)->update([ 'isDeleted' => true ]);
        return redirect()->back()->with('msg', __('locale.msg.delete.success'));
    }
}

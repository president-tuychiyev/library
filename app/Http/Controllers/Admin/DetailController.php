<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use Illuminate\Http\Request;

class DetailController extends Controller
{

    public function __construct()
    {
        $this->lang = app()->getLocale();
    }

    public function detailBook()
    {
        $docTypes = Detail::where('type', 1)->where('isDeleted', false)->with('user')->paginate(10,['*'],'docTypes');
        $docLangs = Detail::where('type', 2)->where('isDeleted', false)->with('user')->paginate(10,['*'],'docLangs');
        $textTypes = Detail::where('type', 3)->where('isDeleted', false)->with('user')->paginate(10,['*'],'textTypes');
        $docFormats = Detail::where('type', 4)->where('isDeleted', false)->with('user')->paginate(10,['*'],'docFormats');
        $fileTypes = Detail::where('type', 5)->where('isDeleted', false)->with('user')->paginate(10,['*'],'fileTypes');
        $directs = Detail::where('type', 6)->where('isDeleted', false)->with('user')->paginate(10,['*'],'directs');

        return view('interfaces.admin.detail', compact('docTypes', 'docLangs', 'textTypes', 'docFormats', 'fileTypes', 'directs'));
    }

    public function detailBookAdd()
    {
        $validate = request()->validate([
            'type' => 'required|numeric|min:1|max:12',
            'nameuz' => 'required|string',
            'nameru' => 'required|string',
            'nameen' => 'required|string'
        ]);
        request()->request->remove('id');
        request()->isActiveCheck ? request()->request->add(['userId' => session()->get('user')->id, 'isActive' => true]) : request()->request->add(['userId' => session()->get('user')->id]);
        request()->request->remove('isActiveCheck');

        Detail::create(request()->all());

        return redirect()->back()->with('msg', __('lang.adding.success'));
    }

    public function detailBookUpdate()
    {
        $validate = request()->validate([
            'type' => 'required|numeric|min:1|max:12',
            'nameuz' => 'required|string',
            'nameru' => 'required|string',
            'nameen' => 'required|string'
        ]);

        request()->isActiveCheck ? request()->request->add(['isActive' => true]) : request()->request->add(['isActive' => false]);
        $id = request()->id;
        request()->request->remove('id');
        request()->request->remove('_token');
        request()->request->remove('type');
        request()->request->remove('isActiveCheck');

        Detail::where('id', $id)->update(request()->all());

        return redirect()->back()->with('msg', __('lang.update.success'));
    }

    public function detailBookDelete($id)
    {
        Detail::where('id', $id)->update([ 'isDeleted' => true ]);

        return redirect()->back()->with('msg', __('lang.delete.success'));
    }
}

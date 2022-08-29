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
        $docTypes = Detail::where('type', 1)
            ->join('users', 'users.id', '=', 'details.userId')
            ->select('details.id', "details.name{$this->lang} as name", 'details.isActive', 'details.created_at', 'users.name as username')
            ->paginate($perPage = '10', $pageName = 'docTypes');

        $docLangs = Detail::where('type', 2)
            ->join('users', 'users.id', '=', 'details.userId')
            ->select('details.id', "details.name{$this->lang} as name", 'details.isActive', 'details.created_at', 'users.name as username')
            ->paginate($perPage = '10', $pageName = 'docLangs');

        $textTypes = Detail::where('type', 3)
            ->join('users', 'users.id', '=', 'details.userId')
            ->select('details.id', "details.name{$this->lang} as name", 'details.isActive', 'details.created_at', 'users.name as username')
            ->select('details.id', "details.name{$this->lang} as name", 'details.isActive', 'details.created_at')->paginate($perPage = '10', $pageName = 'textTypes');

        $docFormats = Detail::where('type', 4)
            ->join('users', 'users.id', '=', 'details.userId')
            ->select('details.id', "details.name{$this->lang} as name", 'details.isActive', 'details.created_at', 'users.name as username')
            ->select('details.id', "details.name{$this->lang} as name", 'details.isActive', 'details.created_at')->paginate($perPage = '10', $pageName = 'docFormats');

        $fileTypes = Detail::where('type', 5)
            ->join('users', 'users.id', '=', 'details.userId')
            ->select('details.id', "details.name{$this->lang} as name", 'details.isActive', 'details.created_at', 'users.name as username')
            ->select('details.id', "details.name{$this->lang} as name", 'details.isActive', 'details.created_at')->paginate($perPage = '10', $pageName = 'fileTypes');

        $directs = Detail::where('type', 6)
            ->join('users', 'users.id', '=', 'details.userId')
            ->select('details.id', "details.name{$this->lang} as name", 'details.isActive', 'details.created_at', 'users.name as username')
            ->select('details.id', "details.name{$this->lang} as name", 'details.isActive', 'details.created_at')->paginate($perPage = '10', $pageName = 'directs');

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

        request()->isActiveCheck ? request()->request->add(['userId' => session()->get('user')->id, 'isActive' => true]) : request()->request->add(['userId' => session()->get('user')->id]);

        Detail::create(request()->all());

        return redirect()->back()->with('msg', "Qo'shildi");
    }
}

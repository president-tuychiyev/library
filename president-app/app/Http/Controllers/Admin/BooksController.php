<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Detail;
use App\Models\Media;
use App\Models\Order;
use App\Models\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{

    public function __construct()
    {
        $this->lang = app()->getLocale();
    }

    public function index()
    {
        $books = Book::where('isDeleted', false)
            ->with('user')->paginate(20);

        return view('interfaces.admin.books', compact('books'));
    }

    public function add()
    {
        $details = Detail::where('isDeleted', false)->select('details.id', 'details.type', "details.name{$this->lang} as name")->get();
        $authors = Author::where('isDeleted', false)->where('isActive', true)->get();
        return view('interfaces.admin.books-create-update', compact('details', 'authors'));
    }

    public function insert()
    {
        $validate = request()->validate([
            'docTypeId' => 'required|numeric|max:11',
            'docLangId' => 'required|numeric|max:11',
            'textTypeId' => 'required|numeric|max:11',
            'docFormatId' => 'required|numeric|max:11',
            'fileTypeId' => 'required|numeric|max:11',
            'directId' => 'required|numeric|max:11',
            'name' => 'required|string|max:255',
            'authorId' => 'required|numeric|max:11',
            'cityPublication' => 'sometimes|string|max:255',
            'publisher' => 'sometimes|string|max:255',
            'isbn' => 'sometimes|string|max:255',
            'udk' => 'sometimes|string|max:255',
            'annontation' => 'sometimes|max:1000',
            'datePublication' => 'required',
            'numPage' => 'required|max:11',
            'price' => 'required|max:11',
            'isActive' => 'sometimes',
            'comeFrom' => 'required|numeric|max:11',
            'forWhom' => 'required|numeric|max:11',
        ]);

        if (request()->hasFile('coverMedia')):
            $coverMedia = Storage::disk('upload')->put('upload/covers', request()->file('coverMedia'));
            $pathInfo = pathinfo($coverMedia);
            $media = Media::create([
                'baseName' => $pathInfo['basename'],
                'fullPath' => $coverMedia,
                'type' => $pathInfo['extension'],
            ]);
            request()->request->add(['coverMediaId' => $media->id]);
        endif;

        if (request()->hasFile('docMedia')):
            $coverMedia = Storage::disk('upload')->put('upload/documents', request()->file('docMedia'));
            $pathInfo = pathinfo($coverMedia);
            $media = Media::create([
                'baseName' => $pathInfo['basename'],
                'fullPath' => $coverMedia,
                'type' => $pathInfo['extension'],
            ]);
            request()->request->add(['docMediaId' => $media->id]);
        endif;

        request()->request->add(['userId' => session()->get('user')->id]);

        Book::create(request()->except(['docMedia', 'coverMedia']));

        return redirect()->back()->with('msg', __('lang.adding.success'));
    }

    public function select($id)
    {
        $details = Detail::select('details.id', 'details.type', "details.name{$this->lang} as name")->get();
        $authors = Author::where('isDeleted', false)->where('isActive', true)->get();
        $book = Book::where('id', $id)->where('isDeleted', false)->first();
        return view('interfaces.admin.books-create-update', compact('details', 'authors', 'book'));
    }

    public function update()
    {
        $book = Book::where('books.id', request()->id)->with('cover')->with('doc')->first();
        $validate = request()->validate([
            'docTypeId' => 'required|numeric|max:11',
            'docLangId' => 'required|numeric|max:11',
            'textTypeId' => 'required|numeric|max:11',
            'docFormatId' => 'required|numeric|max:11',
            'fileTypeId' => 'required|numeric|max:11',
            'directId' => 'required|numeric|max:11',
            'name' => 'required|string|max:255',
            'authorId' => 'required|numeric|max:11',
            'cityPublication' => 'sometimes|string|max:255',
            'publisher' => 'sometimes|string|max:255',
            'isbn' => 'sometimes|string|max:255',
            'udk' => 'sometimes|string|max:255',
            'annontation' => 'sometimes|max:1000',
            'datePublication' => 'required',
            'numPage' => 'required|max:11',
            'price' => 'required|max:11',
            'isActive' => 'sometimes',
            'comeFrom' => 'required|numeric|max:11',
            'forWhom' => 'required|numeric|max:11',
        ]);

        if (request()->hasFile('coverMedia')):
            $coverMedia = Storage::disk('upload')->put('upload/covers', request()->file('coverMedia'));
            $pathInfo = pathinfo($coverMedia);
            if ($book->coverMediaId != 1):
                Storage::disk('upload')->delete($book->cover->fullPath);
                Media::where('id', $book->coverMediaId)->update([
                    'baseName' => $pathInfo['basename'],
                    'fullPath' => $coverMedia,
                    'type' => $pathInfo['extension'],
                ]);
            else:
                $media = Media::create([
                    'baseName' => $pathInfo['basename'],
                    'fullPath' => $coverMedia,
                    'type' => $pathInfo['extension'],
                ]);
                request()->request->add(['coverMediaId' => $media->id]);
            endif;

        endif;

        if (request()->hasFile('docMedia')):
            $coverMedia = Storage::disk('upload')->put('upload/documents', request()->file('docMedia'));
            $pathInfo = pathinfo($coverMedia);
            if ($book->dicMediaId != 1):
                Storage::disk('upload')->delete($book->doc->fullPath);
                Media::where('id',$book->docMediaId)->update([
                    'baseName' => $pathInfo['basename'],
                    'fullPath' => $coverMedia,
                    'type' => $pathInfo['extension'],
                ]);
            else:
                $media = Media::create([
                    'baseName' => $pathInfo['basename'],
                    'fullPath' => $coverMedia,
                    'type' => $pathInfo['extension'],
                ]);
                request()->request->add(['docMediaId' => $media->id]);
            endif;
        endif;

        request()->request->add(['userId' => session()->get('user')->id]);

        Book::where('id', request()->id)->update(request()->except(['docMedia', 'coverMedia', '_token']));

        return redirect()->route('admin.books')->with('msg', __('lang.update.success'));
    }

    public function delete($id)
    {
        Book::where('id', $id)->update(['isDeleted' => true]);
        return redirect()->back()->with('msg', __('lang.delete.success'));
    }

    public function qrcode()
    {
        $books = Book::where('isDeleted', false)->paginate(20);
        $qr = "Hi!";
        return view('interfaces.admin.books-qr', compact('books', 'qr'));
    }

    public function view($id)
    {
        $groups = System::all();
        $book = Book::with(['user', 'type', 'lang', 'text', 'format', 'file', 'direct', 'author', 'cover', 'doc'])->find($id);
        return view('interfaces.admin.book-view', compact('book', 'groups'));
    }

    public function give()
    {
        request()->request->add(['systemId' => request()->group, 'getBack' => Carbon::parse(request()->issued)->addDays(request()->day), 'userId' => session()->get('user')->id]);
        request()->request->remove('group');
        Order::create(request()->all());
        return redirect()->back()->with('msg', __('lang.update.success'));
    }
}

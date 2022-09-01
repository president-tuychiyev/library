<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Detail;
use App\Models\Media;
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
        $authors = Author::where('book', true)->get();
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
            'nameuz' => 'required|string|max:255',
            'nameru' => 'required|string|max:255',
            'nameen' => 'required|string|max:255',
            'authorId' => 'required|numeric|max:11',
            'cityPublication' => 'sometimes|string|max:255',
            'publisher' => 'sometimes|string|max:255',
            'isbn' => 'sometimes|string|max:255',
            'udk' => 'sometimes|string|max:255',
            'annouz' => 'sometimes|string',
            'annoru' => 'sometimes|string',
            'annoen' => 'sometimes|string',
            'datePublication' => 'required',
            'numPage' => 'required|numeric|max:11',
            'price' => 'required|numeric|max:11|max:11',
            'isActive' => 'sometimes',
            'comeFrom' => 'required|numeric|max:11',
            'forWhom' => 'required|numeric|max:11',
        ]);

        if (request()->hasFile('coverMedia')) :
            $coverMedia = Storage::disk('upload')->put('covers', request()->file('coverMedia'));
            $pathInfo = pathinfo($coverMedia);
            $media = Media::create([
                'baseName' => $pathInfo['basename'],
                'fullPath' => $coverMedia,
                'type' => $pathInfo['extension']
            ]);
            request()->request->add(['coverMediaId' => $media->id]);
        else :
            request()->request->add(['coverMediaId' => 1]);
        endif;

        request()->request->remove('coverMedia');

        if (request()->hasFile('docMedia')) :
            $coverMedia = Storage::disk('upload')->put('covers', request()->file('docMedia'));
            $pathInfo = pathinfo($coverMedia);
            $media = Media::create([
                'baseName' => $pathInfo['basename'],
                'fullPath' => $coverMedia,
                'type' => $pathInfo['extension']
            ]);
            request()->request->add(['docMediaId' => $media->id]);
        else :
            request()->request->add(['docMediaId' => 1]);
        endif;

        request()->request->remove('docMedia');

        request()->request->add(['userId' => session()->get('user')->id]);

        Book::create(request()->all());

        return redirect()->back()->with('msg', __('lang.adding.success'));
    }

    public function select($id)
    {
        $details = Detail::select('details.id', 'details.type', "details.name{$this->lang} as name")->get();
        $authors = Author::where('book', true)->get();
        $book = Book::where('id', $id)->where('isDeleted', false)->first();
        return view('interfaces.admin.books-create-update', compact('details', 'authors', 'book'));
    }

    public function update()
    {
        $validate = request()->validate([
            'docTypeId' => 'required|numeric|max:11',
            'docLangId' => 'required|numeric|max:11',
            'textTypeId' => 'required|numeric|max:11',
            'docFormatId' => 'required|numeric|max:11',
            'fileTypeId' => 'required|numeric|max:11',
            'directId' => 'required|numeric|max:11',
            'nameuz' => 'required|string|max:255',
            'nameru' => 'required|string|max:255',
            'nameen' => 'required|string|max:255',
            'authorId' => 'required|numeric|max:11',
            'cityPublication' => 'sometimes|string|max:255',
            'publisher' => 'sometimes|string|max:255',
            'isbn' => 'sometimes|string|max:255',
            'udk' => 'sometimes|string|max:255',
            'datePublication' => 'required',
            'numPage' => 'required|numeric|max:11',
            'price' => 'required|numeric|max:11',
            'isActive' => 'sometimes',
            'comeFrom' => 'required|numeric|max:11',
            'forWhom' => 'required|numeric|max:11',
        ]);

        if (request()->hasFile('coverMedia')) :
            $coverMedia = Storage::disk('upload')->put('covers', request()->file('coverMedia'));
            $pathInfo = pathinfo($coverMedia);
            Media::where('id', Book::where('id', request()->id)->first()->coverMediaId)->update([
                'baseName' => $pathInfo['basename'],
                'fullPath' => $coverMedia,
                'type' => $pathInfo['extension']
            ]);
        endif;

        request()->request->remove('coverMedia');
        request()->request->remove('_token');

        if (request()->hasFile('docMedia')) :
            $coverMedia = Storage::disk('upload')->put('covers', request()->file('docMedia'));
            $pathInfo = pathinfo($coverMedia);
            Media::where('id', Book::where('id', request()->id)->first()->docMediaId)->update([
                'baseName' => $pathInfo['basename'],
                'fullPath' => $coverMedia,
                'type' => $pathInfo['extension']
            ]);
        endif;

        request()->request->remove('docMedia');

        request()->request->add(['userId' => session()->get('user')->id]);

        Book::where('id', request()->id)->update(request()->all());

        return redirect()->route('admin.books')->with('msg', __('lang.update.success'));
    }

    public function delete($id)
    {
        Book::where('id', $id)->update([ 'isDeleted' => true ]);
        return redirect()->back()->with('msg', __('lang.delete.success'));
    }

    public function qrcode()
    {
        $books = Book::where('isDeleted', false)->paginate(20);
        $qr = "Hi!";
        return view('interfaces.admin.books-qr', compact('books', 'qr'));
    }
}

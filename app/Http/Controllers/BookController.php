<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\Book as BookRequest;
use Illuminate\View\View;
use Illuminate\Http\{Request, RedirectResponse};

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->paginate(10);
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return RedirectResponse
     */
    public function store(BookRequest $request)
    {
        $book = new Book();
        $book->name = $request->name;
        $book->year_of_writing = $request->year_of_writing;
        $book->number_of_pages = $request->number_of_pages;
        $book->save();

        return redirect()->route('books.index')->with('success', __('Book was added successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Book $book
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param Book $book
     * @return RedirectResponse
     */
    public function update(BookRequest $request, Book $book)
    {
        $book->name = $request->name;
        $book->year_of_writing = $request->year_of_writing;
        $book->number_of_pages = $request->number_of_pages;
        $book->save();

        return redirect()->route('books.index')->with('success', 'Данные по книге #' . $book->id . ' были изменены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', __('Book was deleted successfully'));
    }
}

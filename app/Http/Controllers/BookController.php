<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store()
    {
        Book::create($this->makeValidate());
    }

    public function update(Book $book)
    {
        $book->update($this->makeValidate());
    }

    public function makeValidate()
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
    }
}

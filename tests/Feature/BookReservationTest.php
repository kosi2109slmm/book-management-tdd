<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_book_can_be_added_to_the_libary()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->post('/books', [
            'title' => 'New Title',
            'author' => 'Si Thu Htet'
        ]);

        $response->assertOk();

        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required()
    {        
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Si Thu Htet'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required()
    {        
        $response = $this->post('/books', [
            'title' => 'Cool Title',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {    
        $this->withoutExceptionHandling();
    
        $this->post('/books', [
            'title' => 'Cool Title',
            'author' => 'Victor'
        ]);

        $book = Book::first();

        $this->patch('/books/' . $book->id, [
            'title' => 'New Title',
            'author' => 'New Author'
        ]);

        $this->assertEquals('New Title', Book::find($book->id)->title);
        $this->assertEquals('New Author', Book::find($book->id)->author);
    }
}

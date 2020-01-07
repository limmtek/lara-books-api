<?php

namespace Tests\Feature\Books;

use App\Book;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function testCheckStatusForGuest()
    {
        $response = $this->call('GET', '/books/create');

        $this->assertEquals(302, $response->status());
    }

    public function testCheckStatusForAuthUser()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->call('GET', '/books/create');

        $this->assertEquals(200, $response->status());
    }

    public function testSaveBook()
    {
        $user = factory(User::class)->create();
        $book = factory(Book::class)->make();

        $this->actingAs($user)
            ->visit('/books/create')
            ->type($book->name, 'name')
            ->type($book->year_of_writing, 'year_of_writing')
            ->type($book->number_of_pages, 'number_of_pages')
            ->press('Сохранить')
            ->seePageIs('/books')
            ->see('Книга добавлена');

        $this->seeInDatabase('books', [
            'name' => $book->name,
            'year_of_writing' => $book->year_of_writing,
            'number_of_pages' => $book->number_of_pages,
        ]);
    }
}

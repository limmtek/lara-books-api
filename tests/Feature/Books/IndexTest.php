<?php

namespace Tests\Feature\Books;

use App\Book;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testCheckStatusForGuest()
    {
        $response = $this->call('GET', '/books');

        $this->assertEquals(200, $response->status());
    }

    public function testCheckStatusForAuthUser()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->call('GET', '/books');

        $this->assertEquals(200, $response->status());
    }

    public function testActionLinksForGuest()
    {
        factory(Book::class, 100)->create();

        $this->visit('/books')
            ->dontSee('Добавить новую книгу')
            ->dontSee('Действия')
            ->dontSee('Изменить')
            ->dontSee('Удалить');
    }

    public function testActionLinksForAuthUser()
    {
        $user = factory(User::class)->create();

        factory(Book::class, 100)->create();

        $this->actingAs($user)->visit('/books')
            ->see('Добавить новую книгу')
            ->see('Действия')
            ->see('Изменить')
            ->see('Удалить');
    }

    public function testCheckCreateLink()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/books')
            ->click('Добавить новую книгу')
            ->seePageIs('/books/create');
    }
}

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
            ->dontSee(__('Add a new book'))
            ->dontSee(__('Actions'))
            ->dontSee(__('Edit'))
            ->dontSee(__('Delete'));
    }

    public function testActionLinksForAuthUser()
    {
        $user = factory(User::class)->create();

        factory(Book::class, 100)->create();

        $this->actingAs($user)->visit('/books')
            ->see(__('Add a new book'))
            ->see(__('Actions'))
            ->see(__('Edit'))
            ->see(__('Delete'));
    }

    public function testCheckCreateLink()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/books')
            ->click(__('Add a new book'))
            ->seePageIs('/books/create');
    }
}

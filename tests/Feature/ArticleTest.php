<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function user_can_see_all_articles()
    {
        $response = $this->get('/articles');
        $response->assertSee('Judul Blog');
        $response->assertViewIs('article.index');

        $response->assertStatus(200);
    }
}
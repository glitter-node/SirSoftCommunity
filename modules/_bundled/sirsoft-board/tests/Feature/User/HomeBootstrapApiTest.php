<?php

namespace Modules\Sirsoft\Board\Tests\Feature\User;

require_once __DIR__.'/../../ModuleTestCase.php';

use Illuminate\Support\Facades\Cache;
use Modules\Sirsoft\Board\Models\Board;
use Modules\Sirsoft\Board\Tests\ModuleTestCase;

class HomeBootstrapApiTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Board::where('is_active', true)->update(['is_active' => false]);
        Cache::flush();
    }

    public function test_home_bootstrap_returns_the_public_home_payload(): void
    {
        $response = $this->getJson(
            '/api/modules/sirsoft-board/boards/home-bootstrap'
            .'?recent_posts_limit=5&popular_boards_limit=4&home_board_posts_limit=3'
        );

        $response->assertOk()->assertJsonStructure([
            'success',
            'data' => [
                'stats' => ['users', 'posts', 'comments', 'boards'],
                'recent_posts',
                'popular_boards',
                'home_boards',
            ],
        ]);
    }

    public function test_home_bootstrap_rejects_negative_limits(): void
    {
        $this->getJson('/api/modules/sirsoft-board/boards/home-bootstrap?recent_posts_limit=-1')
            ->assertUnprocessable();
    }
}

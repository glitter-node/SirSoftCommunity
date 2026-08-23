<?php

namespace Modules\Sirsoft\Board\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class HomeBootstrapRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, array<int, string>> */
    public function rules(): array
    {
        return [
            'recent_posts_limit' => ['nullable', 'integer', 'min:0', 'max:20'],
            'popular_boards_limit' => ['nullable', 'integer', 'min:0', 'max:20'],
            'home_board_posts_limit' => ['nullable', 'integer', 'min:0', 'max:10'],
        ];
    }

    public function recentPostsLimit(): int
    {
        return (int) $this->validated('recent_posts_limit', 5);
    }

    public function popularBoardsLimit(): int
    {
        return (int) $this->validated('popular_boards_limit', 4);
    }

    public function homeBoardPostsLimit(): int
    {
        return (int) $this->validated('home_board_posts_limit', 3);
    }
}

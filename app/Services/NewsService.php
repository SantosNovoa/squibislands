<?php

namespace App\Services;

use App\Models\News;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class NewsService extends Service {
    /*
    |--------------------------------------------------------------------------
    | News Service
    |--------------------------------------------------------------------------
    |
    | Handles the creation and editing of news posts.
    |
    */

    /**
     * Creates a news post.
     *
     * @param array $data
     * @param User  $user
     *
     * @return bool|News
     */
    public function createNews($data, $user) {
        DB::beginTransaction();

        try {
            $data['parsed_text'] = parse($data['text']);
            $data['user_id'] = $user->id;
            if (!isset($data['is_visible'])) {
                $data['is_visible'] = 0;
            }

            $news = News::create($data);

            if ($news->is_visible) {
                $this->alertUsers();
                $this->notifyDiscord($news);
            }

            return $this->commitReturn($news);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Updates a news post.
     *
     * @param News  $news
     * @param array $data
     * @param User  $user
     *
     * @return bool|News
     */
    public function updateNews($news, $data, $user) {
        DB::beginTransaction();

        try {
            $data['parsed_text'] = parse($data['text']);
            $data['user_id'] = $user->id;
            if (!isset($data['is_visible'])) {
                $data['is_visible'] = 0;
            }

            $wasVisible = $news->is_visible;
            $isBump = isset($data['bump']) && $data['is_visible'] == 1 && $data['bump'] == 1;
            $isNewlyVisible = !$wasVisible && $data['is_visible'] == 1;


            if ($isBump || $isNewlyVisible) {
                $this->alertUsers();
                $this->notifyDiscord($news);
            }


            // if (isset($data['bump']) && $data['is_visible'] == 1 && $data['bump'] == 1) {
            //     $this->alertUsers();
            // }

            $news->update($data);

            return $this->commitReturn($news);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Deletes a news post.
     *
     * @param News $news
     *
     * @return bool
     */
    public function deleteNews($news) {
        DB::beginTransaction();

        try {
            $news->delete();

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Updates queued news posts to be visible and alert users when
     * they should be posted.
     *
     * @return bool
     */
    public function updateQueue() {
        $count = News::shouldBeVisible()->count();
        if ($count) {
            DB::beginTransaction();

            try {
                $queued = News::shouldBeVisible()->get();
                News::shouldBeVisible()->update(['is_visible' => 1]);
                $this->alertUsers();
                $queued->each(fn($news) => $this->notifyDiscord($news));

                return $this->commitReturn(true);
            } catch (\Exception $e) {
                $this->setError('error', $e->getMessage());
            }

            return $this->rollbackReturn(false);
        }
    }

    /**
     * Updates the unread news flag for all users so that
     * the new news notification is displayed.
     *
     * @return bool
     */
    private function alertUsers() {
        User::query()->update(['is_news_unread' => 1]);

        return true;
    }

    /**
     * Sends a Discord webhook notification when a news post goes live.
     *
     * @param News $news
     * @return void
     */
    private function notifyDiscord($news) {
        $webhookUrl = config('app.discord_webhook_url');
        if (!$webhookUrl) return;

        try {
        Http::post($webhookUrl, [
            'embeds' => [[
                'title'       => $news->title,
                'url'         => $news->url,
                'description' => strip_tags(Str::limit($news->parsed_text, 300)),
                'color'       => 0x2179e0,
                'author'      => [
                    'name' => $news->user->name,
                ],
                'timestamp'   => $news->created_at->toIso8601String(),
            ]],
        ]);
        } catch (\Exception $e) {
            // Log it but don't let a Discord failure break news posting
            Log::warning('Discord webhook failed: ' . $e->getMessage());
        }
    }
}

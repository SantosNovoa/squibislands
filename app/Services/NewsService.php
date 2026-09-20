<<<<<<< HEAD
<?php

namespace App\Services;

use App\Models\News;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class NewsService extends Service {
=======
<?php namespace App\Services;

use App\Services\Service;

use DB;
use Config;

use App\Models\User\User;
use App\Models\News;

class NewsService extends Service
{
>>>>>>> Cylunny/extension/polls-and-forms
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
<<<<<<< HEAD
     * @param array $data
     * @param User  $user
     *
     * @return bool|News
     */
    public function createNews($data, $user) {
=======
     * @param  array                  $data
     * @param  \App\Models\User\User  $user
     * @return bool|\App\Models\News
     */
    public function createNews($data, $user)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            $data['parsed_text'] = parse($data['text']);
            $data['user_id'] = $user->id;
<<<<<<< HEAD
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

=======
            if(!isset($data['is_visible'])) $data['is_visible'] = 0;

            $news = News::create($data);

            if($news->is_visible) $this->alertUsers();

            return $this->commitReturn($news);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->rollbackReturn(false);
    }

    /**
     * Updates a news post.
     *
<<<<<<< HEAD
     * @param News  $news
     * @param array $data
     * @param User  $user
     *
     * @return bool|News
     */
    public function updateNews($news, $data, $user) {
=======
     * @param  \App\Models\News       $news
     * @param  array                  $data 
     * @param  \App\Models\User\User  $user
     * @return bool|\App\Models\News
     */
    public function updateNews($news, $data, $user)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            $data['parsed_text'] = parse($data['text']);
            $data['user_id'] = $user->id;
<<<<<<< HEAD
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
=======
            if(!isset($data['is_visible'])) $data['is_visible'] = 0;
            if(isset($data['bump']) && $data['is_visible'] == 1 && $data['bump'] == 1) $this->alertUsers();
>>>>>>> Cylunny/extension/polls-and-forms

            $news->update($data);

            return $this->commitReturn($news);
<<<<<<< HEAD
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

=======
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->rollbackReturn(false);
    }

    /**
     * Deletes a news post.
     *
<<<<<<< HEAD
     * @param News $news
     *
     * @return bool
     */
    public function deleteNews($news) {
=======
     * @param  \App\Models\News  $news
     * @return bool
     */
    public function deleteNews($news)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            $news->delete();

            return $this->commitReturn(true);
<<<<<<< HEAD
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

=======
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->rollbackReturn(false);
    }

    /**
     * Updates queued news posts to be visible and alert users when
     * they should be posted.
     *
     * @return bool
     */
<<<<<<< HEAD
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

=======
    public function updateQueue()
    {
        $count = News::shouldBeVisible()->count();
        if($count) {
            DB::beginTransaction();

            try {
                News::shouldBeVisible()->update(['is_visible' => 1]);
                $this->alertUsers();

                return $this->commitReturn(true);
            } catch(\Exception $e) { 
                $this->setError('error', $e->getMessage());
            }
>>>>>>> Cylunny/extension/polls-and-forms
            return $this->rollbackReturn(false);
        }
    }

    /**
     * Updates the unread news flag for all users so that
     * the new news notification is displayed.
     *
     * @return bool
     */
<<<<<<< HEAD
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
                'description' => strip_tags(Str::limit($news->parsed_text, 2000)),
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
=======
    private function alertUsers()
    {
        User::query()->update(['is_news_unread' => 1]);
        return true;
    }
}
>>>>>>> Cylunny/extension/polls-and-forms

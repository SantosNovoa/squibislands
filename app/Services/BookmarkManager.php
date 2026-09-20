<<<<<<< HEAD
<?php

namespace App\Services;

use App\Models\Character\Character;
use App\Models\Character\CharacterBookmark;
use Illuminate\Support\Facades\DB;

class BookmarkManager extends Service {
=======
<?php namespace App\Services;

use DB;

use App\Services\Service;
use App\Models\Character\CharacterBookmark;
use App\Models\Character\Character;

class BookmarkManager extends Service
{
>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | Bookmark Manager
    |--------------------------------------------------------------------------
    |
    | Handles creation, modification and usage of character bookmarks.
    |
    */
<<<<<<< HEAD

    /**
     * Create a bookmark.
     *
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return bool|CharacterBookmark
     */
    public function createBookmark($data, $user) {
        DB::beginTransaction();

        try {
            if (!isset($data['character_id'])) {
                throw new \Exception('Invalid character selected.');
            }

            $character = Character::where('id', $data['character_id'])->visible()->first();
            if (!$character) {
                throw new \Exception('Invalid character selected.');
            }

            if ($user->hasBookmarked($character)) {
                throw new \Exception('You have already bookmarked this character.');
            }

            $bookmark = CharacterBookmark::create([
                'character_id'                  => $character->id,
                'user_id'                       => $user->id,
                'sort'                          => 0,
                'notify_on_trade_status'        => $data['notify_on_trade_status'] ?? 0,
                'notify_on_gift_art_status'     => $data['notify_on_gift_art_status'] ?? 0,
                'notify_on_gift_writing_status' => $data['notify_on_gift_writing_status'] ?? 0,
                'notify_on_transfer'            => $data['notify_on_transfer'] ?? 0,
                'notify_on_image'               => $data['notify_on_image'] ?? 0,
                'comment'                       => $data['comment'],
            ]);

            return $this->commitReturn($bookmark);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Update a bookmark.
     *
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return bool|CharacterBookmark
     */
    public function updateBookmark($data, $user) {
        DB::beginTransaction();

        try {
            if (!isset($data['bookmark_id'])) {
                throw new \Exception('Invalid bookmark selected.');
            }
            $bookmark = CharacterBookmark::with('character')->where('id', $data['bookmark_id'])->visible()->where('user_id', $user->id)->first();
            if (!$bookmark || !$bookmark->character->is_visible) {
                throw new \Exception('Invalid bookmark selected.');
            }

            $bookmark->update([
                'notify_on_trade_status'        => $data['notify_on_trade_status'] ?? 0,
                'notify_on_gift_art_status'     => $data['notify_on_gift_art_status'] ?? 0,
                'notify_on_gift_writing_status' => $data['notify_on_gift_writing_status'] ?? 0,
                'notify_on_transfer'            => $data['notify_on_transfer'] ?? 0,
                'notify_on_image'               => $data['notify_on_image'] ?? 0,
                'comment'                       => $data['comment'],
            ]);

            return $this->commitReturn($bookmark);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Delete a bookmark.
     *
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return bool
     */
    public function deleteBookmark($data, $user) {
        DB::beginTransaction();

        try {
            if (!isset($data['bookmark_id'])) {
                throw new \Exception('Invalid bookmark selected.');
            }
            $bookmark = CharacterBookmark::with('character')->where('id', $data['bookmark_id'])->visible()->where('user_id', $user->id)->first();
            if (!$bookmark || !$bookmark->character->is_visible) {
                throw new \Exception('Invalid bookmark selected.');
            }
=======
    
    /**
     * Create a bookmark.
     *
     * @param  array                 $data
     * @param  \App\Models\User\User $user
     * @return \App\Models\Character\CharacterBookmark|bool
     */
    public function createBookmark($data, $user)
    {
        DB::beginTransaction();

        try {
            if(!isset($data['character_id'])) throw new \Exception("Invalid character selected.");

            $character = Character::where('id', $data['character_id'])->visible()->first();
            if(!$character) throw new \Exception("Invalid character selected.");

            if($user->hasBookmarked($character)) throw new \Exception("You have already bookmarked this character.");
            
            $bookmark = CharacterBookmark::create([
                'character_id' => $character->id,
                'user_id' => $user->id,
                'sort' => 0,
                'notify_on_trade_status' => isset($data['notify_on_trade_status']) ? $data['notify_on_trade_status'] : 0, 
                'notify_on_gift_art_status' => isset($data['notify_on_gift_art_status']) ? $data['notify_on_gift_art_status'] : 0,
                'notify_on_gift_writing_status' => isset($data['notify_on_gift_writing_status']) ? $data['notify_on_gift_writing_status'] : 0, 
                'notify_on_transfer' => isset($data['notify_on_transfer']) ? $data['notify_on_transfer'] : 0, 
                'notify_on_image' => isset($data['notify_on_image']) ? $data['notify_on_image'] : 0, 
                'comment' => $data['comment']
            ]);

            return $this->commitReturn($bookmark);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }
    
    /**
     * Update a bookmark.
     *
     * @param  array                 $data
     * @param  \App\Models\User\User $user
     * @return \App\Models\Character\CharacterBookmark|bool
     */
    public function updateBookmark($data, $user)
    {
        DB::beginTransaction();

        try {
            if(!isset($data['bookmark_id'])) throw new \Exception("Invalid bookmark selected.");
            $bookmark = CharacterBookmark::with('character')->where('id', $data['bookmark_id'])->visible()->where('user_id', $user->id)->first();
            if(!$bookmark || !$bookmark->character->is_visible) throw new \Exception("Invalid bookmark selected.");

            $bookmark->update([
                'notify_on_trade_status' => isset($data['notify_on_trade_status']) ? $data['notify_on_trade_status'] : 0, 
                'notify_on_gift_art_status' => isset($data['notify_on_gift_art_status']) ? $data['notify_on_gift_art_status'] : 0,
                'notify_on_gift_writing_status' => isset($data['notify_on_gift_writing_status']) ? $data['notify_on_gift_writing_status'] : 0, 
                'notify_on_transfer' => isset($data['notify_on_transfer']) ? $data['notify_on_transfer'] : 0,
                'notify_on_image' => isset($data['notify_on_image']) ? $data['notify_on_image'] : 0,  
                'comment' => $data['comment']
            ]);

            return $this->commitReturn($bookmark);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }
    
    /**
     * Delete a bookmark.
     *
     * @param  array                 $data
     * @param  \App\Models\User\User $user
     * @return bool
     */
    public function deleteBookmark($data, $user)
    {
        DB::beginTransaction();

        try {
            if(!isset($data['bookmark_id'])) throw new \Exception("Invalid bookmark selected.");
            $bookmark = CharacterBookmark::with('character')->where('id', $data['bookmark_id'])->visible()->where('user_id', $user->id)->first();
            if(!$bookmark || !$bookmark->character->is_visible) throw new \Exception("Invalid bookmark selected.");
>>>>>>> Cylunny/extension/polls-and-forms

            $bookmark->delete();

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
     * Deletes bookmarks associated with a character.
     * For use when a character is deleted.
     *
<<<<<<< HEAD
     * @param Character $character
     *
     * @return bool
     */
    public function deleteBookmarks($character) {
=======
     * @param  \App\Models\Character\Character $character
     * @return bool
     */
    public function deleteBookmarks($character)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            CharacterBookmark::where('character_id', $character->id)->delete();

            return $this->commitReturn(true);
<<<<<<< HEAD
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }
}
=======
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }
}
>>>>>>> Cylunny/extension/polls-and-forms

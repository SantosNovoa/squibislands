<<<<<<< HEAD
<?php

namespace App\Services;

use App\Models\SitePage;
use Illuminate\Support\Facades\DB;
=======
<?php namespace App\Services;

use App\Services\Service;

use DB;
use Config;

use App\Models\SitePage;
>>>>>>> Cylunny/extension/polls-and-forms

class PageService extends Service
{
    /*
    |--------------------------------------------------------------------------
    | Page Service
    |--------------------------------------------------------------------------
    |
    | Handles the creation and editing of site pages.
    |
    */

    /**
     * Creates a site page.
     *
<<<<<<< HEAD
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return bool|SitePage
=======
     * @param  array                  $data
     * @param  \App\Models\User\User  $user
     * @return bool|\App\Models\SitePage
>>>>>>> Cylunny/extension/polls-and-forms
     */
    public function createPage($data, $user)
    {
        DB::beginTransaction();

        try {
<<<<<<< HEAD
            if (isset($data['text']) && $data['text']) {
                $data['parsed_text'] = parse($data['text']);
            }
            $data['user_id'] = $user->id;
            if (!isset($data['is_visible'])) {
                $data['is_visible'] = 0;
            }
            if (!isset($data['can_comment'])) {
                $data['can_comment'] = 0;
                $data['allow_dislikes'] = 0;
            }

            $page = SitePage::create($data);

            $this->logAdminAction($user, 'Created Page', 'Created page ' . $page->title);


            return $this->commitReturn($page);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

=======
            if(isset($data['text']) && $data['text']) $data['parsed_text'] = parse($data['text']);
            $data['user_id'] = $user->id;
            if(!isset($data['is_visible'])) $data['is_visible'] = 0;
            if(!isset($data['can_comment'])) $data['can_comment'] = 0;

            $page = SitePage::create($data);

            return $this->commitReturn($page);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->rollbackReturn(false);
    }

    /**
     * Updates a site page.
     *
<<<<<<< HEAD
     * @param array                 $data
     * @param \App\Models\User\User $user
     * @param mixed                 $page
     *
     * @return bool|SitePage
=======
     * @param  \App\Models\SitePage   $news
     * @param  array                  $data 
     * @param  \App\Models\User\User  $user
     * @return bool|\App\Models\SitePage
>>>>>>> Cylunny/extension/polls-and-forms
     */
    public function updatePage($page, $data, $user)
    {
        DB::beginTransaction();

        try {
            // More specific validation
<<<<<<< HEAD
            if (SitePage::where('key', $data['key'])->where('id', '!=', $page->id)->exists()) {
                throw new \Exception('The key has already been taken.');
            }

            if (isset($data['text']) && $data['text']) {
                $data['parsed_text'] = parse($data['text']);
            }
            $data['user_id'] = $user->id;
            if (!isset($data['is_visible'])) {
                $data['is_visible'] = 0;
            }
            if (!isset($data['can_comment'])) {
                $data['can_comment'] = 0;
                $data['allow_dislikes'] = 0;
            }

            $page->update($data);

            $this->logAdminAction($user, 'Updated Page', 'Updated page ' . $page->title);


            return $this->commitReturn($page);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

=======
            if(SitePage::where('key', $data['key'])->where('id', '!=', $page->id)->exists()) throw new \Exception("The key has already been taken.");

            if(isset($data['text']) && $data['text']) $data['parsed_text'] = parse($data['text']);
            $data['user_id'] = $user->id;
            if(!isset($data['is_visible'])) $data['is_visible'] = 0;
            if(!isset($data['can_comment'])) $data['can_comment'] = 0;

            $page->update($data);

            return $this->commitReturn($page);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->rollbackReturn(false);
    }

    /**
     * Deletes a site page.
     *
<<<<<<< HEAD
     * @param mixed $page
     *
=======
     * @param  \App\Models\SitePage  $news
>>>>>>> Cylunny/extension/polls-and-forms
     * @return bool
     */
    public function deletePage($page)
    {
        DB::beginTransaction();

        try {
            // Specific pages such as the TOS/privacy policy cannot be deleted from the admin panel.
<<<<<<< HEAD
            if (config('lorekeeper.text_pages.' . $page->key)) {
                throw new \Exception('You cannot delete this page.');
            }

            $title = $page->title;
            $id = $page->id;

            $page->delete();

            $this->logAdminAction($this->user(), 'Deleted Page', 'Deleted page ' . $title);


            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }
}
=======
            if(Config::get('lorekeeper.text_pages.'.$page->key)) throw new \Exception("You cannot delete this page.");

            $page->delete();

            return $this->commitReturn(true);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }
}
>>>>>>> Cylunny/extension/polls-and-forms

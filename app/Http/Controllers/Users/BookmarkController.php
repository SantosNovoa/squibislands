<?php

namespace App\Http\Controllers\Users;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Models\Character\CharacterBookmark;
use App\Services\BookmarkManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller {
=======
use Auth;

use Illuminate\Http\Request;

use App\Services\BookmarkManager;
use App\Models\Character\CharacterBookmark;

use App\Http\Controllers\Controller;

class BookmarkController extends Controller
{
>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | Bookmark Controller
    |--------------------------------------------------------------------------
    |
    | Handles the user's character bookmarks.
    |
    */

    /**
     * Shows the bookmarks page.
     *
<<<<<<< HEAD
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getBookmarks(Request $request) {
        $query = CharacterBookmark::join('characters', 'character_bookmarks.character_id', '=', 'characters.id')
            ->join('character_images', 'characters.character_image_id', '=', 'character_images.id')
            ->with('character.image')->with('character.user')->visible()
            ->where('character_bookmarks.user_id', Auth::user()->id);

        switch ($request->get('sort')) {
=======
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getBookmarks(Request $request)
    {
        $query = CharacterBookmark::join('characters', 'character_bookmarks.character_id', '=', 'characters.id')
        ->join('character_images', 'characters.character_image_id', '=', 'character_images.id')
        ->with('character.image')->with('character.user')->visible()
        ->where('character_bookmarks.user_id', Auth::user()->id);

        switch($request->get('sort')) {
>>>>>>> Cylunny/extension/polls-and-forms
            case 'number_desc':
                $query->orderBy('characters.number', 'DESC');
                break;
            case 'number_asc':
                $query->orderBy('characters.number', 'ASC');
                break;
            case 'id_desc':
                $query->orderBy('characters.id', 'DESC');
                break;
            case 'id_asc':
                $query->orderBy('characters.id', 'ASC');
                break;
            case 'sale_value_desc':
                $query->orderBy('characters.sale_value', 'DESC');
                break;
            case 'sale_value_asc':
                $query->orderBy('characters.sale_value', 'ASC');
                break;
            case 'species_asc':
                $query->orderBy('character_images.species_id', 'ASC');
                break;
            case 'species_desc':
                $query->orderBy('character_images.species_id', 'DESC');
                break;
            case 'trade_asc':
                $query->orderBy('characters.is_trading', 'ASC');
                break;
            case 'trade_desc':
                $query->orderBy('characters.is_trading', 'DESC');
                break;
            case 'gift_art_asc':
                $query->orderBy('characters.is_gift_art_allowed', 'ASC');
                break;
            case 'gift_art_desc':
                $query->orderBy('characters.is_gift_art_allowed', 'DESC');
                break;
            case 'gift_write_asc':
                $query->orderBy('characters.is_gift_writing_allowed', 'ASC');
                break;
            case 'gift_write_desc':
                $query->orderBy('characters.is_gift_writing_allowed', 'DESC');
                break;
            default:
                $query->orderBy('characters.number', 'DESC');
        }

        return view('account.bookmarks', [
<<<<<<< HEAD
            'bookmarks' => $query->paginate(20)->appends($request->query()),
=======
            'bookmarks' => $query->paginate(20)->appends($request->query())
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Gets the bookmark creation modal.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
<<<<<<< HEAD
    public function getCreateBookmark() {
=======
    public function getCreateBookmark()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return view('account.bookmarks._create_edit_bookmark', [
            'bookmark' => new CharacterBookmark,
        ]);
    }

    /**
     * Gets the bookmark editing modal.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditBookmark($id) {
        $bookmark = CharacterBookmark::with('character')->where('id', $id)->where('user_id', Auth::user()->id)->first();
        if (!$bookmark) {
            abort(404);
        }

=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditBookmark($id)
    {
        $bookmark = CharacterBookmark::with('character')->where('id', $id)->where('user_id', Auth::user()->id)->first();
        if(!$bookmark) abort(404);
>>>>>>> Cylunny/extension/polls-and-forms
        return view('account.bookmarks._create_edit_bookmark', [
            'bookmark' => $bookmark,
        ]);
    }

    /**
     * Creates or edits a bookmark.
     *
<<<<<<< HEAD
     * @param App\Services\BookmarkManager $service
     * @param int|null                     $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditBookmark(Request $request, BookmarkManager $service, $id = null) {
        $id ? $request->validate(CharacterBookmark::$updateRules) : $request->validate(CharacterBookmark::$createRules);
        $data = $request->only([
            'character_id', 'notify_on_trade_status', 'notify_on_gift_art_status', 'notify_on_gift_writing_status', 'notify_on_transfer', 'notify_on_image', 'comment',
        ]);
        if ($id && $service->updateBookmark($data + ['bookmark_id' => $id], Auth::user())) {
            flash('Bookmark updated successfully.')->success();
        } elseif (!$id && $bookmark = $service->createBookmark($data, Auth::user())) {
            flash('Bookmark created successfully.')->success();

            return redirect()->back();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  \Illuminate\Http\Request      $request
     * @param  App\Services\BookmarkManager  $service
     * @param  int|null                      $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditBookmark(Request $request, BookmarkManager $service, $id = null)
    {
        $id ? $request->validate(CharacterBookmark::$updateRules) : $request->validate(CharacterBookmark::$createRules);
        $data = $request->only([
            'character_id', 'notify_on_trade_status', 'notify_on_gift_art_status', 'notify_on_gift_writing_status', 'notify_on_transfer', 'notify_on_image', 'comment'
        ]);
        if($id && $service->updateBookmark($data + ['bookmark_id' => $id], Auth::user())) {
            flash('Bookmark updated successfully.')->success();
        }
        else if (!$id && $bookmark = $service->createBookmark($data, Auth::user())) {
            flash('Bookmark created successfully.')->success();
            return redirect()->back();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Gets the bookmark deletion modal.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDeleteBookmark($id) {
        $bookmark = CharacterBookmark::with('character')->where('id', $id)->where('user_id', Auth::user()->id)->first();
        if (!$bookmark) {
            abort(404);
        }

=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDeleteBookmark($id)
    {
        $bookmark = CharacterBookmark::with('character')->where('id', $id)->where('user_id', Auth::user()->id)->first();
        if(!$bookmark) abort(404);
>>>>>>> Cylunny/extension/polls-and-forms
        return view('account.bookmarks._delete_bookmark', [
            'bookmark' => $bookmark,
        ]);
    }

    /**
     * Deletes a bookmark.
     *
<<<<<<< HEAD
     * @param App\Services\BookmarkManager $service
     * @param int                          $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteBookmark(Request $request, BookmarkManager $service, $id) {
        if ($id && $service->deleteBookmark(['bookmark_id' => $id], Auth::user())) {
            flash('Bookmark deleted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  \Illuminate\Http\Request      $request
     * @param  App\Services\BookmarkManager  $service
     * @param  int                           $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteBookmark(Request $request, BookmarkManager $service, $id)
    {
        if($id && $service->deleteBookmark(['bookmark_id' => $id], Auth::user())) {
            flash('Bookmark deleted successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }
}

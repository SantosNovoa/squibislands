<?php

namespace App\Http\Controllers\Admin;

<<<<<<< HEAD
use Config;
use App\Models\Item\ItemCategory;
use App\Models\Recipe\Recipe;
use Carbon\Carbon;
use App\Models\Prompt\Prompt;
use App\Http\Controllers\Controller;
use App\Models\Award\Award;
use App\Models\Character\Character;
use App\Models\Currency\Currency;
use App\Models\Element\Element;
use App\Models\Item\Item;
use App\Models\Loot\LootTable;
use App\Models\Prompt\PromptCategory;
use App\Models\Raffle\Raffle;
use App\Models\Skill\Skill;
use App\Models\Submission\Submission;
use App\Services\SubmissionManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller {
    /**
     * Shows the submission index page.
     *
     * @param string $status
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getSubmissionIndex(Request $request, $status = null) {
        $submissions = Submission::with('prompt')->where('status', $status ? ucfirst($status) : 'Pending')->whereNotNull('prompt_id');
        $data = $request->only(['prompt_category_id', 'sort']);
        if (isset($data['prompt_category_id']) && $data['prompt_category_id'] != 'none') {
            $submissions->whereHas('prompt', function ($query) use ($data) {
                $query->where('prompt_category_id', $data['prompt_category_id']);
            });
        }
        if (isset($data['sort'])) {
            switch ($data['sort']) {
=======
use Auth;
use Config;
use Illuminate\Http\Request;

use App\Models\Prompt\PromptCategory;
use App\Models\Submission\Submission;
use App\Models\Item\Item;
use App\Models\Item\ItemCategory;
use App\Models\Currency\Currency;
use App\Models\Loot\LootTable;
use App\Models\Raffle\Raffle;

use App\Services\SubmissionManager;

use App\Http\Controllers\Controller;

class SubmissionController extends Controller
{
    /**
     * Shows the submission index page.
     *
     * @param  string  $status
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getSubmissionIndex(Request $request, $status = null)
    {
        $submissions = Submission::with('prompt')->where('status', $status ? ucfirst($status) : 'Pending')->whereNotNull('prompt_id');
        $data = $request->only(['prompt_category_id', 'sort']);
        if(isset($data['prompt_category_id']) && $data['prompt_category_id'] != 'none')
            $submissions->whereHas('prompt', function($query) use ($data) {
                $query->where('prompt_category_id', $data['prompt_category_id']);
            });
        if(isset($data['sort']))
        {
            switch($data['sort']) {
>>>>>>> Cylunny/extension/polls-and-forms
                case 'newest':
                    $submissions->sortNewest();
                    break;
                case 'oldest':
                    $submissions->sortOldest();
                    break;
            }
<<<<<<< HEAD
        } else {
            $submissions->sortOldest();
        }

        return view('admin.submissions.index', [
            'submissions' => $submissions->paginate(30)->appends($request->query()),
            'categories'  => ['none' => 'Any Category'] + PromptCategory::orderBy('sort', 'DESC')->pluck('name', 'id')->toArray(),
            'isClaims'    => false,
=======
        }
        else $submissions->sortOldest();
        return view('admin.submissions.index', [
            'submissions' => $submissions->paginate(30)->appends($request->query()),
            'categories' => ['none' => 'Any Category'] + PromptCategory::orderBy('sort', 'DESC')->pluck('name', 'id')->toArray(),
            'isClaims' => false
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Shows the submission detail page.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getSubmission($id) {
        $submission = Submission::whereNotNull('prompt_id')->where('id', $id)->where('status', '!=', 'Draft')->first();
        $inventory = isset($submission->data['user']) ? parseAssetData($submission->data['user']) : null;
        if (!$submission) {
            abort(404);
        }

        $prompt = $submission->prompt;
        $limit = null;
        
        if ($prompt && $prompt->limit) {
            if ($prompt->limit_character) {
                $limit = $prompt->limit * Character::visible()->where('is_myo_slot', 0)->where('user_id', $submission->user_id)->count();
            } else {
                $limit = $prompt->limit;
            }
        }

        return view('admin.submissions.submission', [
            'submission'       => $submission,
            'inventory'        => $inventory,
            'rewardsData'      => isset($submission->data['rewards']) ? parseAssetData($submission->data['rewards']) : null,
            'itemsrow'         => Item::all()->keyBy('id'),
            'page'             => 'submission',
            'expanded_rewards' => config('lorekeeper.extensions.character_reward_expansion.expanded'),
            'characters'       => Character::visible(Auth::check() ? Auth::user() : null)->myo(0)->orderBy('slug', 'DESC')->get()->pluck('fullName', 'slug')->toArray(),
            'awardsrow'        => Award::all()->keyBy('id'),
            'skills'           => Skill::pluck('name', 'id')->toArray(),
        ] + ($submission->status == 'Pending' ? [
            'characterCurrencies' => Currency::where('is_character_owned', 1)->orderBy('sort_character', 'DESC')->pluck('name', 'id'),
            'items'               => Item::orderBy('name')->pluck('name', 'id'),
            'currencies'          => Currency::where('is_user_owned', 1)->orderBy('name')->pluck('name', 'id'),
            'tables'              => LootTable::orderBy('name')->pluck('name', 'id'),
            'raffles'             => Raffle::where('rolled_at', null)->where('is_active', 1)->orderBy('name')->pluck('name', 'id'),
            'recipes'             => Recipe::orderBy('name')->pluck('name', 'id'),
            'count' => [
                'all'   => Submission::where('prompt_id', $submission->prompt_id)->where('status', 'Approved')->where('user_id', $submission->user_id)->count(),
                'Hour'  => Submission::where('prompt_id', $submission->prompt_id)->where('status', 'Approved')->where('user_id', $submission->user_id)->where('created_at', '>=', now()->startOfHour())->count(),
                'Day'   => Submission::where('prompt_id', $submission->prompt_id)->where('status', 'Approved')->where('user_id', $submission->user_id)->where('created_at', '>=', now()->startOfDay())->count(),
                'Week'  => Submission::where('prompt_id', $submission->prompt_id)->where('status', 'Approved')->where('user_id', $submission->user_id)->where('created_at', '>=', now()->startOfWeek())->count(),
                'Month' => Submission::where('prompt_id', $submission->prompt_id)->where('status', 'Approved')->where('user_id', $submission->user_id)->where('created_at', '>=', now()->startOfMonth())->count(),
                'Year'  => Submission::where('prompt_id', $submission->prompt_id)->where('status', 'Approved')->where('user_id', $submission->user_id)->where('created_at', '>=', now()->startOfYear())->count(),
            ],
            'awards'              => Award::orderBy('name')->released()->where('is_user_owned', 1)->pluck('name', 'id'),
            'characterAwards'     => Award::orderBy('name')->released()->where('is_character_owned', 1)->pluck('name', 'id'),
            'elements'            => Element::orderBy('name')->pluck('name', 'id'),
            'prompt'              => $prompt,
            'limit'               => $limit
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getSubmission($id)
    {
        $submission = Submission::whereNotNull('prompt_id')->where('id', $id)->first();
        $inventory = isset($submission->data['user']) ? parseAssetData($submission->data['user']) : null;
        if(!$submission) abort(404);
        return view('admin.submissions.submission', [
            'submission' => $submission,
            'inventory' => $inventory,
            'rewardsData' => isset($submission->data['rewards']) ? parseAssetData($submission->data['rewards']) : null,
            'itemsrow' => Item::all()->keyBy('id'),
            'page' => 'submission',
            'expanded_rewards' => Config::get('lorekeeper.extensions.character_reward_expansion.expanded'),
        ] + ($submission->status == 'Pending' ? [
            'characterCurrencies' => Currency::where('is_character_owned', 1)->orderBy('sort_character', 'DESC')->pluck('name', 'id'),
            'items' => Item::orderBy('name')->pluck('name', 'id'),
            'currencies' => Currency::where('is_user_owned', 1)->orderBy('name')->pluck('name', 'id'),
            'tables' => LootTable::orderBy('name')->pluck('name', 'id'),
            'raffles' => Raffle::where('rolled_at', null)->where('is_active', 1)->orderBy('name')->pluck('name', 'id'),
            'count' => Submission::where('prompt_id', $submission->prompt_id)->where('status', 'Approved')->where('user_id', $submission->user_id)->count()
>>>>>>> Cylunny/extension/polls-and-forms
        ] : []));
    }

    /**
     * Shows the claim index page.
     *
<<<<<<< HEAD
     * @param string $status
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getClaimIndex(Request $request, $status = null) {
        $submissions = Submission::where('status', $status ? ucfirst($status) : 'Pending')->whereNull('prompt_id');
        $data = $request->only(['sort']);
        if (isset($data['sort'])) {
            switch ($data['sort']) {
=======
     * @param  string  $status
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getClaimIndex(Request $request, $status = null)
    {
        $submissions = Submission::where('status', $status ? ucfirst($status) : 'Pending')->whereNull('prompt_id');
        $data = $request->only(['sort']);
        if(isset($data['sort']))
        {
            switch($data['sort']) {
>>>>>>> Cylunny/extension/polls-and-forms
                case 'newest':
                    $submissions->sortNewest();
                    break;
                case 'oldest':
                    $submissions->sortOldest();
                    break;
            }
<<<<<<< HEAD
        } else {
            $submissions->sortOldest();
        }

        return view('admin.submissions.index', [
            'submissions' => $submissions->paginate(30),
            'isClaims'    => true,
=======
        }
        else $submissions->sortOldest();
        return view('admin.submissions.index', [
            'submissions' => $submissions->paginate(30),
            'isClaims' => true
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Shows the claim detail page.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getClaim($id) {
        $submission = Submission::whereNull('prompt_id')->where('id', $id)->where('status', '!=', 'Draft')->first();
        $inventory = isset($submission->data['user']) ? parseAssetData($submission->data['user']) : null;
        if (!$submission) {
            abort(404);
        }

        return view('admin.submissions.submission', [
            'submission'       => $submission,
            'inventory'        => $inventory,
            'itemsrow'         => Item::all()->keyBy('id'),
            'expanded_rewards' => config('lorekeeper.extensions.character_reward_expansion.expanded'),
            'characters'       => Character::visible(Auth::check() ? Auth::user() : null)->myo(0)->orderBy('slug', 'DESC')->get()->pluck('fullName', 'slug')->toArray(),
            'awardsrow'        => Award::all()->keyBy('id'),
            'skills'           => Skill::pluck('name', 'id')->toArray(),
        ] + ($submission->status == 'Pending' ? [
            'characterCurrencies' => Currency::where('is_character_owned', 1)->orderBy('sort_character', 'DESC')->pluck('name', 'id'),
            'items'               => Item::orderBy('name')->pluck('name', 'id'),
            'currencies'          => Currency::where('is_user_owned', 1)->orderBy('name')->pluck('name', 'id'),
            'tables'              => LootTable::orderBy('name')->pluck('name', 'id'),
            'raffles'             => Raffle::where('rolled_at', null)->where('is_active', 1)->orderBy('name')->pluck('name', 'id'),
            'recipes'             => Recipe::orderBy('name')->pluck('name', 'id'),
            'count'               => Submission::where('prompt_id', $id)->where('status', 'Approved')->where('user_id', $submission->user_id)->count(),
            'rewardsData'         => isset($submission->data['rewards']) ? parseAssetData($submission->data['rewards']) : null,
            'awards'              => Award::orderBy('name')->released()->where('is_user_owned', 1)->pluck('name', 'id'),
            'characterAwards'     => Award::orderBy('name')->released()->where('is_character_owned', 1)->pluck('name', 'id'),
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getClaim($id)
    {
        $submission = Submission::whereNull('prompt_id')->where('id', $id)->first();
        $inventory = isset($submission->data['user']) ? parseAssetData($submission->data['user']) : null;
        if(!$submission) abort(404);
        return view('admin.submissions.submission', [
            'submission' => $submission,
            'inventory' => $inventory,
            'itemsrow' => Item::all()->keyBy('id'),
            'expanded_rewards' => Config::get('lorekeeper.extensions.character_reward_expansion.expanded'),
        ] + ($submission->status == 'Pending' ? [
            'characterCurrencies' => Currency::where('is_character_owned', 1)->orderBy('sort_character', 'DESC')->pluck('name', 'id'),
            'items' => Item::orderBy('name')->pluck('name', 'id'),
            'currencies' => Currency::where('is_user_owned', 1)->orderBy('name')->pluck('name', 'id'),
            'tables' => LootTable::orderBy('name')->pluck('name', 'id'),
            'raffles' => Raffle::where('rolled_at', null)->where('is_active', 1)->orderBy('name')->pluck('name', 'id'),
            'count' => Submission::where('prompt_id', $id)->where('status', 'Approved')->where('user_id', $submission->user_id)->count(),
            'rewardsData' => isset($submission->data['rewards']) ? parseAssetData($submission->data['rewards']) : null
>>>>>>> Cylunny/extension/polls-and-forms
        ] : []));
    }

    /**
     * Creates a new submission.
     *
<<<<<<< HEAD
     * @param App\Services\SubmissionManager $service
     * @param int                            $id
     * @param string                         $action
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSubmission(Request $request, SubmissionManager $service, $id, $action) {
        $data = $request->only(['slug',  'character_rewardable_quantity', 'character_rewardable_id',  'character_rewardable_type', 'character_currency_id', 'rewardable_type', 'rewardable_id', 'quantity', 'staff_comments', 
        'criterion', 'character_is_focus', 'skill_id', 'skill_quantity',]);
        if ($action == 'reject' && $service->rejectSubmission($request->only(['staff_comments']) + ['id' => $id], Auth::user())) {
            flash('Submission rejected successfully.')->success();
        } elseif ($action == 'cancel' && $service->cancelSubmission($request->only(['staff_comments']) + ['id' => $id], Auth::user())) {
            flash('Submission canceled successfully.')->success();

            return redirect()->to('admin/submissions');
        } elseif ($action == 'approve' && $service->approveSubmission($data + ['id' => $id], Auth::user())) {
            flash('Submission approved successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  \Illuminate\Http\Request        $request
     * @param  App\Services\SubmissionManager  $service
     * @param  int                             $id
     * @param  string                          $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSubmission(Request $request, SubmissionManager $service, $id, $action)
    {
        $data = $request->only(['slug',  'character_rewardable_quantity', 'character_rewardable_id',  'character_rewardable_type', 'character_currency_id', 'rewardable_type', 'rewardable_id', 'quantity', 'staff_comments' ]);
        if($action == 'reject' && $service->rejectSubmission($request->only(['staff_comments']) + ['id' => $id], Auth::user())) {
            flash('Submission rejected successfully.')->success();
        }
        elseif($action == 'approve' && $service->approveSubmission($data + ['id' => $id], Auth::user())) {
            flash('Submission approved successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }
}

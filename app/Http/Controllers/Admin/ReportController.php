<?php

namespace App\Http\Controllers\Admin;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Models\Report\Report;
use App\Services\ReportManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller {
    /**
     * Shows the report index page.
     *
     * @param string $status
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getReportIndex(Request $request, $status = null) {
        if ($status == 'assigned-to-me') {
            $reports = Report::assignedToMe(Auth::user());
        } else {
            $reports = Report::where('status', $status ? ucfirst($status) : 'Pending');
        }
        $data = $request->only(['sort']);
        if (isset($data['sort'])) {
            switch ($data['sort']) {
                case 'newest':
                    $reports->sortNewest();
                    break;
                case 'oldest':
                    $reports->sortOldest();
                    break;
                case 'bug':
                    $reports->whereNotNull('error_type');
                    break;
            }
        } else {
            $reports->sortOldest();
        }
=======
use Auth;
use Config;
use Illuminate\Http\Request;

use App\Models\Prompt\PromptCategory;
use App\Models\Report\Report;
use App\Models\Item\Item;
use App\Models\Currency\Currency;
use App\Models\Loot\LootTable;

use App\Services\ReportManager;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Shows the report index page.
     *
     * @param  string  $status
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getReportIndex(Request $request, $status = null)
    {
        if($status == 'assigned-to-me') $reports = Report::assignedToMe(Auth::user()); 
        else $reports = Report::where('status', $status ? ucfirst($status) : 'Pending');
>>>>>>> Cylunny/extension/polls-and-forms

        return view('admin.reports.index', [
            'reports' => $reports->orderBy('id', 'DESC')->paginate(30)->appends($request->query()),
        ]);
    }
<<<<<<< HEAD

    /**
     * Shows the report detail page.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getReport($id) {
        $report = Report::where('id', $id)->first();
        if (!$report) {
            abort(404);
        }

        return view('admin.reports.report', [
            'report' => $report,
        ]);
    }
=======
    
    /**
     * Shows the report detail page.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getReport($id)
    {
        $report = Report::where('id', $id)->first();
        if(!$report) abort(404);
        return view('admin.reports.report', [
            'report' => $report,
        ]);
    }    
>>>>>>> Cylunny/extension/polls-and-forms

    /**
     * Creates a new report.
     *
<<<<<<< HEAD
     * @param App\Services\ReportManager $service
     * @param int                        $id
     * @param string                     $action
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postReport(Request $request, ReportManager $service, $id, $action) {
        $data = $request->only(['staff_comments']);
        if ($action == 'assign' && $service->assignReport($request->only(['staff_comments']) + ['id' => $id], Auth::user())) {
            flash('Report assigned successfully.')->success();
        } elseif ($action == 'close' && $service->closeReport($data + ['id' => $id], Auth::user())) {
            flash('Report closed successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  \Illuminate\Http\Request        $request
     * @param  App\Services\ReportManager  $service
     * @param  int                             $id
     * @param  string                          $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postReport(Request $request, ReportManager $service, $id, $action)
    {
        $data = $request->only(['staff_comments']);
        if($action == 'assign' && $service->assignReport($request->only(['staff_comments']) + ['id' => $id], Auth::user())) {
            flash('Report assigned successfully.')->success();
        }
        elseif($action == 'close' && $service->closeReport($data + ['id' => $id], Auth::user())) {
            flash('Report closed successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }
}

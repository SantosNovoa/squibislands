<?php

namespace App\Http\Controllers\Users;

<<<<<<< HEAD
use App\Facades\Settings;
use App\Http\Controllers\Controller;
use App\Models\Report\Report;
use App\Models\User\User;
use App\Services\ReportManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller {
=======
use Illuminate\Http\Request;

use DB;
use Auth;
use Settings;
use App\Models\User\User;
use App\Models\Character\Character;
use App\Models\Item\Item;
use App\Models\Currency\Currency;
use App\Models\Report\Report;
use App\Models\Prompt\Prompt;

use App\Services\ReportManager;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**********************************************************************************************

        REPORTS

    **********************************************************************************************/

    /**
     * Shows the user's report log.
     *
<<<<<<< HEAD
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getReportsIndex(Request $request) {
        $reports = Report::where('user_id', Auth::user()->id);
        $type = $request->get('type');
        if (!$type) {
            $type = 'Pending';
        }
=======
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getReportsIndex(Request $request)
    {
        $reports = Report::where('user_id', Auth::user()->id);
        $type = $request->get('type');
        if(!$type) $type = 'Pending';
>>>>>>> Cylunny/extension/polls-and-forms

        $reports = $reports->where('status', ucfirst($type));

        return view('home.reports', [
            'reports' => $reports->orderBy('id', 'DESC')->paginate(20)->appends($request->query()),
        ]);
    }

    /**
     * Shows the bug report log.
     *
<<<<<<< HEAD
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getBugIndex(Request $request) {
=======
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getBugIndex(Request $request)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $reports = Report::where('is_br', 1);

        $data = $request->only(['url']);

<<<<<<< HEAD
        if (isset($data['url'])) {
            $reports->where('url', 'LIKE', '%'.$data['url'].'%');
        }
=======
        if(isset($data['url']))
            $reports->where('url', 'LIKE', '%'.$data['url'].'%');
>>>>>>> Cylunny/extension/polls-and-forms

        return view('home.bug_report_index', [
            'reports' => $reports->orderBy('id', 'DESC')->paginate(20)->appends($request->query()),
        ]);
    }

    /**
     * Shows the report page.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getReport($id) {
        $report = Report::viewable(Auth::user() ?? null)->where('id', $id)->first();
        if (!$report) {
            abort(404);
        }

        return view('home.report', [
            'report' => $report,
            'user'   => $report->user,
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getReport($id)
    {
        $report = Report::viewable(Auth::check() ? Auth::user() : null)->where('id', $id)->first();
        if(!$report) abort(404);
        return view('home.report', [
            'report' => $report,
            'user' => $report->user
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Shows the submit report page.
     *
<<<<<<< HEAD
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getNewReport(Request $request) {
        $closed = !Settings::get('is_reports_open');

=======
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getNewReport(Request $request)
    {
        $closed = !Settings::get('is_reports_open');
>>>>>>> Cylunny/extension/polls-and-forms
        return view('home.create_report', [
            'closed' => $closed,
        ]);
    }

    /**
     * Creates a new report.
     *
<<<<<<< HEAD
     * @param App\Services\ReportManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNewReport(Request $request, ReportManager $service) {
        $request->validate(Report::$createRules);
        $request['url'] = strip_tags($request['url']);

        if ($service->createReport($request->only(['url', 'comments', 'is_br', 'error']), Auth::user(), true)) {
            flash('Report submitted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  \Illuminate\Http\Request        $request
     * @param  App\Services\ReportManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNewReport(Request $request, ReportManager $service)
    {
        $request->validate(Report::$createRules);
        $request['url'] = strip_tags($request['url']);

        if($service->createReport($request->only(['url', 'comments', 'is_br', 'error']), Auth::user(), true)) {
            flash('Report submitted successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->to('reports');
    }
}

<?php

namespace App\Http\Controllers\Admin;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Services\InvitationService;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller {
=======
use Illuminate\Http\Request;

use Auth;
use App\Models\Invitation;
use App\Services\InvitationService;

use App\Http\Controllers\Controller;

class InvitationController extends Controller
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Shows the invitation key index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
<<<<<<< HEAD
    public function getIndex() {
        return view('admin.invitations.invitations', [
            'invitations' => Invitation::orderBy('id', 'DESC')->paginate(20),
=======
    public function getIndex()
    {
        return view('admin.invitations.invitations', [
            'invitations' => Invitation::orderBy('id', 'DESC')->paginate(20)
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Generates a new invitation key.
     *
<<<<<<< HEAD
     * @param App\Services\InvitationService $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postGenerateKey(InvitationService $service) {
        if ($service->generateInvitation(Auth::user())) {
            flash('Generated invitation successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  App\Services\InvitationService  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postGenerateKey(InvitationService $service)
    {
        if($service->generateInvitation(Auth::user())) {
            flash('Generated invitation successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Generates a new invitation key.
     *
<<<<<<< HEAD
     * @param App\Services\InvitationService $service
     * @param int                            $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteKey(InvitationService $service, $id) {
        $invitation = Invitation::find($id);
        if ($invitation && $service->deleteInvitation($invitation)) {
            flash('Deleted invitation key successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  App\Services\InvitationService  $service
     * @param  int                             $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteKey(InvitationService $service, $id)
    {
        $invitation = Invitation::find($id);
        if($invitation && $service->deleteInvitation($invitation)) {
            flash('Deleted invitation key successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }
}

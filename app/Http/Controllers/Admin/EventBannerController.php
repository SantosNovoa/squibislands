<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventBanner;
use App\Services\EventBannerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventBannerController extends Controller {
    /**
     * Banner list + global toggle.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex() {
        return view('admin.event_banners.index', [
            'banners'   => EventBanner::sorted()->get(),
            'enabled'   => EventBanner::isEnabled(),
            'shortcuts' => EventBanner::dashboardShortcuts(false),
        ]);
    }

    /**
     * Save which dashboard shortcuts are shown.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postShortcuts(Request $request, EventBannerService $service) {
        $service->updateShortcuts($request->input('shortcuts', []));
        flash('Dashboard shortcuts updated.')->success();

        return redirect()->back();
    }

    /**
     * Flip the global dashboard toggle.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postToggle(EventBannerService $service) {
        $enabled = $service->toggleEnabled();
        flash('Event banner is now '.($enabled ? 'shown' : 'hidden').' on the dashboard.')->success();

        return redirect()->back();
    }

    /**
     * Create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCreateBanner() {
        return view('admin.event_banners.create_edit', [
            'banner' => new EventBanner(['is_active' => 1, 'show_name' => 1, 'sort' => 0]),
        ]);
    }

    /**
     * Edit page.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditBanner($id) {
        $banner = EventBanner::find($id);
        if (!$banner) {
            abort(404);
        }

        return view('admin.event_banners.create_edit', [
            'banner' => $banner,
        ]);
    }

    /**
     * Create or update.
     *
     * @param int|null $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditBanner(Request $request, EventBannerService $service, $id = null) {
        $id ? $request->validate(EventBanner::$updateRules) : $request->validate(EventBanner::$createRules);

        $data = $request->only(['name', 'link', 'show_name', 'is_active', 'sort', 'image']);

        if ($id) {
            $banner = EventBanner::find($id);
            if (!$banner) {
                abort(404);
            }

            if ($service->updateBanner($banner, $data, Auth::user())) {
                flash('Banner updated successfully.')->success();
            } else {
                foreach ($service->errors()->getMessages()['error'] as $error) {
                    flash($error)->error();
                }

                return redirect()->back()->withInput();
            }
        } else {
            if ($banner = $service->createBanner($data, Auth::user())) {
                flash('Banner created successfully.')->success();

                return redirect()->to('admin/event-banners/edit/'.$banner->id);
            } else {
                foreach ($service->errors()->getMessages()['error'] as $error) {
                    flash($error)->error();
                }

                return redirect()->back()->withInput();
            }
        }

        return redirect()->back();
    }

    /**
     * Delete.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteBanner(EventBannerService $service, $id) {
        $banner = EventBanner::find($id);
        if (!$banner) {
            abort(404);
        }

        if ($service->deleteBanner($banner)) {
            flash('Banner deleted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }

            return redirect()->back();
        }

        return redirect()->to('admin/event-banners');
    }
}

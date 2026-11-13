<?php

namespace App\Services;

use App\Models\EventBanner;
use Illuminate\Support\Facades\DB;

class EventBannerService extends Service {
    /*
    |--------------------------------------------------------------------------
    | Event Banner Service
    |--------------------------------------------------------------------------
    |
    | Handles creation, editing and deletion of dashboard event banners.
    |
    */

    /**
     * Creates a banner.
     *
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return \App\Models\EventBanner|bool
     */
    public function createBanner($data, $user) {
        DB::beginTransaction();

        try {
            $image = $data['image'] ?? null;
            unset($data['image']);

            if (!$image) {
                throw new \Exception('Please upload a banner image.');
            }

            $data = $this->populateData($data);
            $data['hash'] = bin2hex(random_bytes(5));
            $data['extension'] = $this->getExtension($image);

            $banner = EventBanner::create($data);
            $this->saveImage($image, $banner);

            return $this->commitReturn($banner);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Updates a banner.
     *
     * @param \App\Models\EventBanner $banner
     * @param array                   $data
     * @param \App\Models\User\User   $user
     *
     * @return \App\Models\EventBanner|bool
     */
    public function updateBanner($banner, $data, $user) {
        DB::beginTransaction();

        try {
            $image = $data['image'] ?? null;
            unset($data['image']);

            $data = $this->populateData($data);

            if ($image) {
                $oldFileName = $banner->imageFileName;

                $data['hash'] = bin2hex(random_bytes(5));
                $data['extension'] = $this->getExtension($image);
                $banner->update($data);

                $this->saveImage($image, $banner);
                $this->removeImage($banner->imagePath, $oldFileName);
            } else {
                $banner->update($data);
            }

            return $this->commitReturn($banner);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Deletes a banner and its image.
     *
     * @param \App\Models\EventBanner $banner
     *
     * @return bool
     */
    public function deleteBanner($banner) {
        DB::beginTransaction();

        try {
            $this->removeImage($banner->imagePath, $banner->imageFileName);
            $banner->delete();

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Flips the global dashboard toggle.
     *
     * @return bool the new state
     */
    public function toggleEnabled() {
        $new = EventBanner::isEnabled() ? 0 : 1;
        DB::table('site_settings')->where('key', 'event_banner_enabled')->update(['value' => $new]);

        return (bool) $new;
    }

    /**
     * Normalises form data. Unchecked checkboxes aren't submitted, so missing = false.
     *
     * @param array $data
     *
     * @return array
     */
    private function populateData($data) {
        $data['show_name'] = !empty($data['show_name']);
        $data['is_active'] = !empty($data['is_active']);
        $data['sort'] = isset($data['sort']) && $data['sort'] !== '' ? (int) $data['sort'] : 0;
        $data['link'] = isset($data['link']) && trim($data['link']) !== '' ? trim($data['link']) : null;

        return $data;
    }

    /**
     * @param \Illuminate\Http\UploadedFile $image
     *
     * @return string
     */
    private function getExtension($image) {
        $ext = strtolower($image->guessExtension() ?: $image->getClientOriginalExtension());

        return $ext === 'jpeg' ? 'jpg' : $ext;
    }

    /**
     * @param \Illuminate\Http\UploadedFile $image
     * @param \App\Models\EventBanner       $banner
     */
    private function saveImage($image, $banner) {
        if (!file_exists($banner->imagePath)) {
            mkdir($banner->imagePath, 0755, true);
        }

        $image->move($banner->imagePath, $banner->imageFileName);
    }

    /**
     * @param string      $dir
     * @param string|null $fileName
     */
    private function removeImage($dir, $fileName) {
        if ($fileName && file_exists($dir.'/'.$fileName)) {
            unlink($dir.'/'.$fileName);
        }
    }
}

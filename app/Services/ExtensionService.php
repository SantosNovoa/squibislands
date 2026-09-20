<<<<<<< HEAD
<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class ExtensionService extends Service {
=======
<?php namespace App\Services;

use App\Services\Service;

use DB;
use Config;

use App\Models\Notification;

class ExtensionService extends Service
{
>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | Extension Service
    |--------------------------------------------------------------------------
    |
    | Handles functions relating to extensions.
    |
    */

    /**
     * Updates existing notifications in the database.
     * Part of the project to move each author's works to
     * using a distinct notifications prefix.
     * Should be called with a command instructing it
     * in what notifications to move where.
     *
<<<<<<< HEAD
     * @param mixed $source
     * @param mixed $destination
     *
     * @return bool
     */
    public function updateNotifications($source, $destination) {
        $count = Notification::where('notification_type_id', $source)->count();
        if ($count && isset($destination)) {
=======
     * @param  $data
     * @return bool
     */
    public function updateNotifications($source, $destination)
    {
        $count = Notification::where('notification_type_id', $source)->count();
        if($count && isset($destination)) {
>>>>>>> Cylunny/extension/polls-and-forms
            DB::beginTransaction();
            try {
                Notification::where('notification_type_id', $source)->update(['notification_type_id' => $destination]);

                return $this->commitReturn(true);
<<<<<<< HEAD
            } catch (\Exception $e) {
                $this->setError('error', $e->getMessage());
            }

            return $this->rollbackReturn(false);
        }
    }
}
=======
            } catch(\Exception $e) { 
                $this->setError('error', $e->getMessage());
            }
            return $this->rollbackReturn(false);
        }
    }
}
>>>>>>> Cylunny/extension/polls-and-forms

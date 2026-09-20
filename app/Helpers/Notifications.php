<?php

namespace App\Helpers;

<<<<<<< HEAD
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class Notifications {
=======
use DB;
use App\Models\Notification;

class Notifications {

>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    |
    | Creates user notifications.
    |
    */

    /**
     * Creates a new notification.
     *
<<<<<<< HEAD
     * @param string                $type
     * @param \App\Models\User\User $user
     * @param array                 $data
     *
     * @return bool
     */
    public function create($type, $user, $data) {
=======
     * @param  string                 $type
     * @param  \App\Models\User\User  $user
     * @param  array                  $data
     * @return bool
     */
    public function create($type, $user, $data)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            $notification = Notification::create([
                'user_id'               => $user->id,
                'notification_type_id'  => Notification::getNotificationId($type),
                'data'                  => json_encode($data),
<<<<<<< HEAD
                'is_unread'             => 1,
=======
                'is_unread'             => 1
>>>>>>> Cylunny/extension/polls-and-forms
            ]);

            $user->notifications_unread++;
            $user->save();
<<<<<<< HEAD

            DB::commit();

            return true;
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        DB::rollback();

        return false;
    }
}
=======
            
            DB::commit();
            return true;
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
        DB::rollback();
        return false;
    }
}
>>>>>>> Cylunny/extension/polls-and-forms

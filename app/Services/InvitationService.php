<<<<<<< HEAD
<?php

namespace App\Services;

use App\Models\Invitation;
use Illuminate\Support\Facades\DB;

class InvitationService extends Service {
=======
<?php namespace App\Services;

use DB;
use App\Services\Service;

use App\Models\Invitation;

class InvitationService extends Service
{
>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | Invitation Service
    |--------------------------------------------------------------------------
    |
    | Handles creation and usage of site registration invitation codes.
    |
    */

    /**
     * Generates an invitation code, saving the user who generated it.
     *
<<<<<<< HEAD
     * @param \App\Models\User\User $user
     *
     * @return bool|Invitation
     */
    public function generateInvitation($user) {
=======
     * @param  \App\Models\User\User $user
     * @return \App\Models\Invitation|bool
     */
    public function generateInvitation($user)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            $invitation = Invitation::create([
<<<<<<< HEAD
                'code'    => $this->generateCode(),
                'user_id' => $user->id,
            ]);

            return $this->commitReturn($invitation);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

=======
                'code' => $this->generateCode(),
                'user_id' => $user->id
            ]);

            return $this->commitReturn($invitation);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->rollbackReturn(false);
    }

    /**
     * Marks an invitation code as used, saving the user who used it.
     *
<<<<<<< HEAD
     * @param \App\Models\User\User $user
     * @param mixed                 $invitation
     *
     * @return bool|Invitation
     */
    public function useInvitation($invitation, $user) {
=======
     * @param  \App\Models\User\User $user
     * @return \App\Models\Invitation|bool
     */
    public function useInvitation($invitation, $user)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            // More specific validation
<<<<<<< HEAD
            if ($invitation->recipient_id) {
                throw new \Exception('This invitation key has already been used.');
            }

=======
            if($invitation->recipient_id) throw new \Exception("This invitation key has already been used.");
            
>>>>>>> Cylunny/extension/polls-and-forms
            $invitation->recipient_id = $user->id;
            $invitation->save();

            return $this->commitReturn($invitation);
<<<<<<< HEAD
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

=======
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->rollbackReturn(false);
    }

    /**
     * Deletes an unused invitation code.
     *
<<<<<<< HEAD
     * @param Invitation $invitation
     *
     * @return bool
     */
    public function deleteInvitation($invitation) {
=======
     * @param  \App\Models\Invitation $invitation
     * @return bool
     */
    public function deleteInvitation($invitation)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            // Check first if the invitation has been used
<<<<<<< HEAD
            if ($invitation->recipient_id) {
                throw new \Exception('This invitation has already been used.');
            }
            $invitation->delete();

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

=======
            if($invitation->recipient_id) throw new \Exception("This invitation has already been used."); 
            $invitation->delete();

            return $this->commitReturn(true);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Generates a string for an invitation code.
     *
     * @return string
     */
<<<<<<< HEAD
    private function generateCode() {
        return randomString(10);
    }
}
=======
    private function generateCode()
    {
        return randomString(10);
    }
}
>>>>>>> Cylunny/extension/polls-and-forms

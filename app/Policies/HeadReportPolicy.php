<?php

namespace App\Policies;

use App\Models\HeadReport;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HeadReportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HeadReport  $headReport
     * @return mixed
     */
    public function view(User $user, HeadReport $headReport)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HeadReport  $headReport
     * @return mixed
     */
    public function update(User $user, HeadReport $headReport)
    {
        foreach ($headReport->experts as $expert) {
            if ($user->expert_id == $expert->expert_id) {
                return $user->expert_id === $expert->expert_id;
            }
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HeadReport  $headReport
     * @return mixed
     */
    public function delete(User $user, HeadReport $headReport)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HeadReport  $headReport
     * @return mixed
     */
    public function restore(User $user, HeadReport $headReport)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HeadReport  $headReport
     * @return mixed
     */
    public function forceDelete(User $user, HeadReport $headReport)
    {
        //
    }
}

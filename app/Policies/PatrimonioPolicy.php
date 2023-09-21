<?php

namespace App\Policies;

use App\Models\Patrimonio;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class PatrimonioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patrimonio  $patrimonio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Patrimonio $patrimonio)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patrimonio  $patrimonio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Patrimonio $patrimonio)
    {
        // bens próprios ou se o usuário está alterando o responsável
        $ret = ($user->codpes == $patrimonio->codpes || $user->codpes == $patrimonio->getOriginal('codpes')) ? true : false;

        // se no replicado consta como sendo do usuário
        $ret = ($user->codpes == $patrimonio->replicado['codpes']) ? true : $ret;

        // gerente do setor
        $ret = (Gate::check('manager') && strpos($user->setores, $patrimonio->setor) !== false) ? true : $ret;

        return $ret;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patrimonio  $patrimonio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Patrimonio $patrimonio)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patrimonio  $patrimonio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Patrimonio $patrimonio)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patrimonio  $patrimonio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Patrimonio $patrimonio)
    {
        //
    }
}

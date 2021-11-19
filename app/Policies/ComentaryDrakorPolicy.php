<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\ComentaryDrakor;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComentaryDrakorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Author $author)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Author  $author
     * @param  \App\Models\ComentaryDrakor  $comentaryDrakor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Author $author, ComentaryDrakor $comentaryDrakor)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Author $author)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Author  $author
     * @param  \App\Models\ComentaryDrakor  $comentaryDrakor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Author $author, ComentaryDrakor $comentaryDrakor)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Author  $author
     * @param  \App\Models\ComentaryDrakor  $comentaryDrakor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Author $author, ComentaryDrakor $comentaryDrakor)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Author  $author
     * @param  \App\Models\ComentaryDrakor  $comentaryDrakor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Author $author, ComentaryDrakor $comentaryDrakor)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Author  $author
     * @param  \App\Models\ComentaryDrakor  $comentaryDrakor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Author $author, ComentaryDrakor $comentaryDrakor)
    {
        //
    }
}

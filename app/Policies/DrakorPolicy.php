<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\Drakor;
use Illuminate\Auth\Access\HandlesAuthorization;

class DrakorPolicy
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
     * @param  \App\Models\Drakor  $drakor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Author $author, Drakor $drakor)
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
     * @param  \App\Models\Drakor  $drakor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Author $author, Drakor $drakor)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Author  $author
     * @param  \App\Models\Drakor  $drakor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Author $author, Drakor $drakor)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Author  $author
     * @param  \App\Models\Drakor  $drakor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Author $author, Drakor $drakor)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Author  $author
     * @param  \App\Models\Drakor  $drakor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Author $author, Drakor $drakor)
    {
        //
    }
}

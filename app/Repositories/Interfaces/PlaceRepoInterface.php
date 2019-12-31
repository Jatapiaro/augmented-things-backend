<?php
namespace App\Repositories\Interfaces;

interface PlaceRepoInterface extends RepoInterface
{
    /**
     * Returns all the items on this repo
     *
     * @return collection
     */
    public function adminAll();
}

<?php
namespace App\Repositories\Interfaces;

interface DeviceRepoInterface extends RepoInterface
{
    /**
     * Returns all the items on this repo
     *
     * @return collection
     */
    public function adminAll();
}

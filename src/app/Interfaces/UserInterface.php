<?php

namespace App\Interfaces;

interface UserInterface
{
    public function findUsers(array $filter);

    public function findAUserById(string $id);
}

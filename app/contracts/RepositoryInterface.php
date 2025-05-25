<?php

namespace App\Contracts;

interface RepositoryInterface
{
    public function index(array $filters = [], $perPage = 15);

    public function store(array $data);

    public function show($id);

    public function update($id, array $data);

    public function delete($id);
}

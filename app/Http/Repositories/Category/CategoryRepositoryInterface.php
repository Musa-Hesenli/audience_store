<?php

namespace App\Http\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function create( array $fields );
    public function update( array $where, array $fields );
    public function delete( int $id );
    public function show( int $id );
    public function list();

}

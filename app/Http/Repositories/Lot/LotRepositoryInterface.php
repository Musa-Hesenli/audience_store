<?php

namespace App\Http\Repositories\Lot;

interface LotRepositoryInterface
{
    public function create( array $fields );
    public function edit( array $where, array $fields );
    public function show( array $fields );
    public function list( array $filters = [] );
    public function delete( array $where );
}

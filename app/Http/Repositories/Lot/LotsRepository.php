<?php

namespace App\Http\Repositories\Lot;

use App\Models\Category;
use App\Models\Lot;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class LotsRepository implements LotRepositoryInterface
{
    public function create(array $fields)
    {
        if ( ! empty( $fields[ 'categories' ] ) )
        {
            $isCategoriesValid = Category::whereIn( 'id', $fields[ 'categories' ] )->count() === count( $fields[ 'categories' ] );
            abort_if( ! $isCategoriesValid, 400, "Categories are not valid" );
        }

        $lot = new Lot();
        $lot->setAttribute( 'title', $fields[ 'name' ] );
        $lot->setAttribute( 'description', $fields[ 'description' ] );
        $lot->save();
        $lot->categories()->sync( $fields[ 'categories' ] );

        return true;
    }

    public function edit(array $where, array $fields)
    {
        $lot = Lot::where( $where )->first();
        if ( empty( $lot ) )
        {
            throw new \Exception( "Lot not found" );
        }

        if ( ! empty( $fields[ 'categories' ] ) )
        {
            $lot->categories()->sync( $fields[ 'categories' ] );
        }

        return $lot->update( [
            'title'       => $fields[ 'name' ],
            'description' => $fields[ 'description' ]
        ] );
    }

    public function show(array $fields)
    {
        return Lot::where( $fields )->with( 'categories' )->firstOrFail();
    }

    public function list(array $filters = [])
    {
        $lots = Lot::when(! empty( $filters[ 'categories' ] ), function ( $query ) use ( $filters ) {
            $query->whereHas( 'categories', function ( $subQuery ) use ( $filters ) {
                $subQuery->whereIn( 'category_id', $filters[ 'categories' ] );
            } );
        } )->with( 'categories' )->get();
        return $lots;
    }

    public function delete(array $where)
    {
        return Lot::where( $where )->delete();
    }

}

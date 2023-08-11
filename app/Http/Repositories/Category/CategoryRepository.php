<?php

namespace App\Http\Repositories\Category;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    /**
     * @throws \Exception
     */
    public function create(array $fields )
    {
        if ( isset( $fields[ 'name' ] ) && Category::where( 'name', $fields[ 'name' ] )->exists() )
        {
            throw new \Exception( 'Category already exists with the same name' );
        }

        return Category::create( $fields );
    }

    public function update( array $where, array $fields )
    {
        $category = Category::where( $where )->first();
        if ( empty( $category ) )
        {
            throw new \Exception( 'Category not found' );
        }

        if ( isset( $where[ 'id' ] ) )
        {
            $categoryExists = Category::where( 'id', '!=', $where[ 'id' ] )->where( 'name', $fields[ 'name' ] )->exists();
            if ( $categoryExists )
            {
                throw new \Exception( "Category already exists with the same name" );
            }
        }

        return $category->update( $fields );
    }

    public function delete( int $id )
    {
        return Category::whereId( $id )->delete();
    }

    public function show( int $id )
    {
        return Category::findOrFail( $id );
    }

    public function list(): \Illuminate\Database\Eloquent\Collection
    {
        return Category::all();
    }
}

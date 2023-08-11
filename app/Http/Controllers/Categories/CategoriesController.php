<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Http\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Requests\Categories\CreateAndUpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;
    public function __construct( CategoryRepositoryInterface $categoryRepository )
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            return ResponseHelper::ok( $this->categoryRepository->list() );
        }
        catch ( \Exception $exception )
        {
            return ResponseHelper::error( $exception->getMessage(), 500 );
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store( CreateAndUpdateCategoryRequest $request )
    {
        try {
            $this->categoryRepository->create( [ 'name' => $request->post( 'name' ) ] );
            return ResponseHelper::ok( 'Created successfully', 201 );
        }
        catch ( \Exception $exception )
        {
            return ResponseHelper::error( $exception->getMessage(), 500 );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( string $id )
    {
        try {
            return ResponseHelper::ok( $this->categoryRepository->show( $id ) );
        }
        catch ( \Exception $exception )
        {
            return ResponseHelper::error( $exception->getMessage() );
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update( CreateAndUpdateCategoryRequest $request, string $id )
    {
        try {
            $this->categoryRepository->update(
                [ 'id'   => $id ],
                [ 'name' => $request->post( 'name' )  ]
            );
            return ResponseHelper::ok( 'Updated successfully' );
        }
        catch ( \Exception $exception )
        {
            return ResponseHelper::error( $exception->getMessage() );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id )
    {
        try {
            if ( $this->categoryRepository->delete( $id ) )
            {
                return ResponseHelper::ok( 'Deleted successfully' );
            }
            else
            {
                return ResponseHelper::error( 'Something went wrong' );
            }
        }
        catch ( \Exception $exception )
        {
            return ResponseHelper::error( $exception->getMessage() );
        }
    }
}

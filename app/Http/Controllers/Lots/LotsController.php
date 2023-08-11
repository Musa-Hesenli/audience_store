<?php

namespace App\Http\Controllers\Lots;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Http\Repositories\Lot\LotRepositoryInterface;
use App\Http\Requests\Lot\CreateAndUpdateLotRequest;
use App\Http\Requests\Lot\ListLotsRequest;
use Illuminate\Http\Request;

class LotsController extends Controller
{

    private LotRepositoryInterface $lotRepository;

    public function __construct( LotRepositoryInterface $lotRepository )
    {
        $this->lotRepository = $lotRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index( ListLotsRequest $request )
    {
        try {
            return ResponseHelper::ok( $this->lotRepository->list( $request->validated() ) );
        }
        catch ( \Exception $exception )
        {
            return ResponseHelper::error( $exception->getMessage() );
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store( CreateAndUpdateLotRequest $request )
    {
        try {
            $this->lotRepository->create( [
                'name'        => $request->post( 'name' ),
                'description' => $request->post( 'description' ),
                'categories'  => $request->post( 'categories', [] )
            ] );
            return ResponseHelper::ok( 'Created successfully', 201 );
        }
        catch ( \Exception $exception )
        {
            return ResponseHelper::error( $exception->getMessage(), 500 );
        }
    }

    public function show( string $id )
    {
        try {
            return ResponseHelper::ok( $this->lotRepository->show( [ 'id' => $id ] ) );
        }
        catch ( \Exception $exception )
        {
            return ResponseHelper::error( $exception->getMessage() );
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update( CreateAndUpdateLotRequest $request, string $id )
    {
        try {
            $this->lotRepository->edit(
                [ 'id' => $id ],
                [
                    'name'        => $request->post( 'name' ),
                    'description' => $request->post( 'description' ),
                    'categories'  => $request->post( 'categories', [] )
                ]
            );
            return ResponseHelper::ok( 'Successful operation' );
        }
        catch ( \Exception $exception )
        {
            return ResponseHelper::error( $exception->getMessage() );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->lotRepository->delete( [ 'id' => $id ] );
            return ResponseHelper::ok( 'Deleted successfully' );
        }
        catch ( \Exception $exception )
        {
            return ResponseHelper::error( $exception->getMessage() );
        }
    }
}

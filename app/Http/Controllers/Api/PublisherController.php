<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\PublisherService;
use Illuminate\Http\Request;
use App\Http\Requests\PublisherRequest;

class PublisherController extends Controller
{
    public function __construct(PublisherService $publisherService)
    {
        $this->middleware('auth:api');
        $this->publisherService = $publisherService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = ['status' => 200];

        try {
            $result = $this->publisherService->getAllPublisher();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }   
        
        return $result;   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PublisherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublisherRequest $request)
    {
        $result = ['status' => 200];

        try {
            $result = $this->publisherService->save($request);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }   
        
        return $result;   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $result = ['status' => 200];

        try {
            $result = $this->publisherService->detail($request->id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }      

        return $result;   
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  PublisherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(PublisherRequest $request)
    {
        $result = ['status' => 200];

        try {
            $result = $this->publisherService->update($request, $request->id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }      

        return $result; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = ['status' => 200];

        try {
            $result = $this->publisherService->delete($request->id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }      

        return $result;     
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    private $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->middleware('auth:api');
        $this->authorService = $authorService;
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
            $result = $this->authorService->getAuthor();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = ['status' => 200];

        try {
            $result = $this->authorService->save($request);
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
            $result = $this->authorService->detail($request->id);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $result = ['status' => 200];

        try {
            $result = $this->authorService->update($request, $request->id);
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
            $result = $this->authorService->delete($request->id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }      

        return $result;     
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\BookService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{

    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->middleware('auth:api');
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = ['status' => 200];

        try {
            $result = $this->bookService->getNewBook($request);
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
     * @param  BookRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $result = ['status' => 200];

        try {
            $result = $this->bookService->save($request);
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
            $result = $this->bookService->detail($request->id);
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
     * @param  BookRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request)
    {
        $result = ['status' => 200];

        try {
        
            $result = $this->bookService->update($request, $request->id);
        
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
            $result = $this->bookService->delete($request->id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }      

        return $result;     
    }
}

<?php

namespace App\Http\Services;

use App\Http\Repositories\BookRepository;
use DB;
use Illuminate\Http\Request;

Class BookService 
{

    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Store newly created book transaction into storage.
     * 
     * @param \BookRequest
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request) {

        DB::beginTransaction();
        try {
            $data = $request->only([
                'book_name',
                'date_release',
                'number_of_page',
                'description',
                'publisher_id',
                'author_id',
            ]);
    
            $res = $this->bookRepository->storeBook($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'message' => 'Success creating new book']);
    }

    /**
     * Retrieving all book from storage.
     * 
     * @param \lluminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getNewBook(Request $request) {
        try {
            $data = $this->bookRepository->getAllBook($request);

            if ($data->isEmpty()) {
                $data = ['message' => 'data not found'];
            }

        } catch(Exception $e) {
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'data' => $data]);
    }

    /**
     * Retrieving detail book from storage.
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id) {
        try {
            $data = $this->bookRepository->getById($id);

            if ($data->isEmpty()) {
                $data = ['message' => 'book is not found'];
            }

        } catch(Exception $e) {
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'data' => $data]);
    }

    /**
     * Update created book transaction into storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) 
    {    
        DB::beginTransaction();
        try {
            $data = $request->only([
                'book_name',
                'date_release',
                'number_of_page',
                'description',
                'publisher_id',
                'author_id',
            ]);
    
            $res = $this->bookRepository->updateBook($data, $id);
            DB::commit();
             
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'message' => 'Success updating book']);
    }

    /**
     * delete book from storage.
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        DB::beginTransaction();
        try {
            $data = $this->bookRepository->getById($id);
    
            if (isset($data)) {
                $data = ['message' => 'book not found'];
            }

            $res = $this->bookRepository->removeBook($id);
            DB::commit();
             
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'message' => 'Success deleting book']);
    }
}
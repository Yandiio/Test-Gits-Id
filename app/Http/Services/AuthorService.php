<?php

namespace App\Http\Services;

use App\Http\Repositories\AuthorRepository;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;

Class AuthorService {

    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * Store newly created author transaction into storage.
     * 
     * @param \AuthorRequest
     * @return \Illuminate\Http\Response
     */
    public function save(AuthorRequest $request) {

        DB::beginTransaction();
        try {
            $data = $request->validated();
    
            $res = $this->authorRepository->storeAuthor($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'message' => 'Success creating new author']);
    }

    /**
     * Retrieving all author from storage.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getAuthor() {
        try {
            $data = $this->authorRepository->getAllAuthor();

            if ($data->isEmpty()) {
                $data = ['message' => 'data not found'];
            }

        } catch(Exception $e) {
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'data' => $data]);
    }

    /**
     * Retrieving detail author from storage.
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id) {
        try {
            $data = $this->authorRepository->getById($id);

            if ($data->isEmpty()) {
                $data = ['message' => 'author is not found'];
            }

        } catch(Exception $e) {
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'data' => $data]);
    }

    /**
     * Update created author transaction into storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorRequest $request, $id) 
    {    
        DB::beginTransaction();
        try {
            $data = $request->validated();
    
            $res = $this->authorRepository->updateAuthor($data, $id);
            DB::commit();
             
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'message' => 'Success updating author']);
    }

    /**
     * delete author from storage.
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        DB::beginTransaction();
        try {
            $data = $this->authorRepository->getById($id);
    
            if (isset($data)) {
                $data = ['message' => 'author not found'];
            }

            $res = $this->authorRepository->removeAuthor($id);
            DB::commit();
             
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'message' => 'Success deleting author']);
    }
}
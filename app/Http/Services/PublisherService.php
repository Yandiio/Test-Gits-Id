<?php

namespace App\Http\Services;

use App\Http\Repositories\PublisherRepository;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\PublisherRequest;

Class PublisherService {

    private $publisherRepository;

    public function __construct(PublisherRepository $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    /**
     * Store newly created publisher transaction into storage.
     * 
     * @param \PublisherRequest
     * @return \Illuminate\Http\Response
     */
    public function save(PublisherRequest $request) {

        DB::beginTransaction();
        try {
            $data = $request->validated();
    
            $res = $this->publisherRepository->storePublisher($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'message' => 'Success creating new Publisher']);
    }

    /**
     * Retrieving all publisher from storage.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getAllPublisher() {
        try {
            $data = $this->publisherRepository->getAllPublisher();

            if ($data->isEmpty()) {
                $data = ['message' => 'data not found'];
            }

        } catch(Exception $e) {
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'data' => $data]);
    }

    /**
     * Retrieving detail publisher from storage.
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id) {
        try {
            $data = $this->publisherRepository->getById($id);

            if ($data->isEmpty()) {
                return response()->json(['code' => 404, 'message' => 'publisher is not found'], 404);
            }

        } catch(Exception $e) {
            return response()->json(['code' => 500, 'error' => $e->getMessage], 500);
        }

        return response()->json(['code' => 200, 'data' => $data]);
    }

    /**
     * Update created publisher transaction into storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublisherRequest $request, $id) 
    {    
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $dataExist = $this->publisherRepository->getById($id);
    
            if ($dataExist->isEmpty()) {
                return response()->json(['code' => 404, 'message' => 'publisher is not found'], 404);
            }
    
            $res = $this->publisherRepository->updatePublisher($data, $id);
            DB::commit();
             
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'message' => 'Success updating publisher']);
    }

    /**
     * delete publisher from storage.
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        DB::beginTransaction();
        try {
            $data = $this->publisherRepository->getById($id);
    
            if (isset($data)) {
                return response()->json(['code' => 404, 'message' => 'publisher is not found'], 404);
            }

            $res = $this->publisherRepository->removePublisher($id);
            DB::commit();
             
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['code' => 500, 'error' => $e->getMessage]);
        }

        return response()->json(['code' => 200, 'message' => 'Success deleting publisher']);
    }
}
<?php

namespace App\Http\Repositories;

use App\Models\Publisher;


Class PublisherRepository {
    
    /**
     * Get publisher by id from db.
     *
     * @param $id
     * @return Publisher
     */
    public function getById($id) {
        $data = Publisher::where('id', '=', $id)->get();

        return $data;
    }
    
    /**
     * Get all publisher from db.
     *
     * @return Publisher
     */
    public function getAllPublisher() {
        $data = Publisher::all();

        return $data;
    }

    /**
     * Store publisher into db.
     *
     * @param $data
     * @return Publisher
     */
    public function storePublisher($data) {
        $publisher = new Publisher();

        $publisher->publisher_name = $data['publisher_name'];
        $publisher->phone_number = $data['phone_number'];
        $publisher->city = $data['city'];
        $publisher->state = $data['state'];
        $publisher->address = $data['address'];
        $publisher->zip = $data['zip'];
        $publisher->created_at =  \Carbon\Carbon::now();

        $publisher->save();

        return $publisher;
    }

    /**
     * Update publisher from db.
     *
     * @param $data
     * @param $id
     * @return Response
     */
    public function updatePublisher($data, $id) {
        $dataExist = Publisher::findOrFail($id);

        $dataExist->publisher_name = $data['publisher_name'];
        $dataExist->phone_number = $data['phone_number'];
        $dataExist->city = $data['city'];
        $dataExist->state = $data['state'];
        $dataExist->address = $data['address'];
        $dataExist->zip = $data['zip'];
        $dataExist->updated_at =  \Carbon\Carbon::now();

        $dataExist->update();

        return $data;
    }

    /**
     * Delete publisher from db.
     *
     * @param $id
     * @return Response
     */
    public function removePublisher($id) {
        $data = Publisher::findOrFail($id);
        $data->delete();

        return response()->json(['message' => 'data berhasil dihapus']);
    }
}
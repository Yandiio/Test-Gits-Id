<?php

namespace App\Http\Repositories;

use App\Models\Author;

Class AuthorRepository 
{
    /**
     * Get book by id from db.
     *
     * @param $id
     * @return Author
     */
    public function getById($id) {
        $data = Author::where('id', '=', $id)->get();

        return $data;
    }
    
    /**
     * Get all book from db.
     *
     * @return Author
     */
    public function getAllAuthor() {
        $data = Author::all();

        return $data;
    }

    /**
     * Store book into db.
     *
     * @param $data
     * @return Author
     */
    public function storeAuthor($data) {
        $author = new Author();

        $author->author_name = $data['author_name'];
        $author->phone = $data['phone'];
        $author->city = $data['city'];
        $author->state = $data['state'];
        $author->address = $data['address'];
        $author->created_at =  \Carbon\Carbon::now();

        $author->save();

        return $author;
    }

    /**
     * Update book from db.
     *
     * @param $data
     * @param $id
     * @return Response
     */
    public function updateAuthor($data, $id) {
        $dataExist = Author::find($id);

        $dataExist->author_name = $data['author_name'];
        $dataExist->phone = $data['phone'];
        $dataExist->city = $data['city'];
        $dataExist->state = $data['state'];
        $dataExist->address = $data['address'];
        $dataExist->updated_at =  \Carbon\Carbon::now();

        $dataExist->update();

        return $data;
    }

    /**
     * Delete book from db.
     *
     * @param $id
     * @return Response
     */
    public function removeAuthor($id) {
        $data = Author::find($id);
        $data->delete();

        return response()->json(['message' => 'data berhasil dihapus']);
    }
}
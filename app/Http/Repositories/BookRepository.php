<?php

namespace App\Http\Repositories;

use App\Models\Book;
use App\Models\BookAuthor;
use Illuminate\Http\Request;


Class BookRepository {

    /**
     * Get book by id from db.
     *
     * @param $id
     * @return Book
     */
    public function getById($id) {
        $data = Book::where('id', '=', $id)->get();

        foreach ($data as $val) {
            // remove author id & publisher id from response
            unset($val['author_id']);   
            unset($val['publisher_id']);   

            $val['author'] = $val->author;   
            $val['publisher'] = $val->publisher;   
        }


        return $data;
    }
    
    /**
     * Get all book from db.
     *
     * @return Book
     */
    public function getAllBook(Request $request) {
        
        $data = Book::all();
        $limit = $request->limit;
        $page = ($limit * $request->page) - $limit;


        if ($limit != null || $page != null) {
            $data = Book::skip($page)
                    ->take($limit)
                    ->get();
        }

        foreach ($data as $val) {
            // remove author id & publisher id from response
            unset($val['author_id']);   
            unset($val['publisher_id']);   

            $val['author'] = $val->author;   
            $val['publisher'] = $val->publisher;   
        }

        return $data;
    }

    /**
     * Store book into db.
     *
     * @param $data
     * @return Book
     */
    public function storeBook($data) {
        $book = new Book();

        $book->book_name = $data['book_name'];
        $book->date_release = $data['date_release'];
        $book->author_id = $data['author_id'];
        $book->description = $data['description'];
        $book->number_of_page = $data['number_of_page'];
        $book->publisher_id = $data['publisher_id'];
        $book->created_at =  \Carbon\Carbon::now();

        $res = $book->save();

        if ($res) {
            $book_author = new BookAuthor();
            $book_author->author_id = $data['author_id'];
            $book_author->book_id = $book->id;
            
            $book_author->save();
        }

        return $book;
    }

    /**
     * Update book from db.
     *
     * @param $data
     * @param $id
     * @return Response
     */
    public function updateBook($data, $id) {
        $dataExist = Book::findOrFail($id);

        $dataExist->book_name = $data['book_name'];
        $dataExist->date_release = $data['date_release'];
        $dataExist->author_id = $data['author_id'];
        $dataExist->description = $data['description'];
        $dataExist->number_of_page = $data['number_of_page'];
        $dataExist->publisher_id = $data['publisher_id'];
        $dataExist->updated_at =  \Carbon\Carbon::now();

        $dataExist->update();

        return $dataExist;
    }

    /**
     * Delete book from db.
     *
     * @param $id
     * @return Response
     */
    public function removeBook($id) {
        $data = Book::findOrFail($id);
        $data->delete();

        return response()->json(['message' => 'data berhasil dihapus']);
    }
}
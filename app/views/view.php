<?php

class View {

    public function showListBooks($books) {
        require_once  './templates/book_list.phtml';
    }

    public function showBookDetail($book) {
        require_once './templates/book_detail.phtml';
    }

    public function showListEditorials($editorials) {
        require_once  './templates/editorial_list.phtml';
    }

    public function showBooksByEditorial($books) {
        require_once  './templates/books_by_editorial.phtml';
    }
}




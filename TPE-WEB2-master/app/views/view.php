<?php

class View {

    public function showListBooks($books) {
        require_once  './templates/book_list.phtml';
    }

    public function showBookDetail($book, $editorial) {
        require_once './templates/book_detail.phtml';
    }

    public function showListEditorials($editorials) {
        require_once  './templates/editorial_list.phtml';
    }

    public function showBooksByEditorial($books) {
        require_once  './templates/books_by_editorial.phtml';
    }

    public function showAddBookForm($editorials) {
        require './templates/add_book.phtml'; 
    }

    public function showEditBookForm ($book, $editorials){
        require './templates/edit_book.phtml';
    }

    public function showLogin($error=NULL){
        require 'templates/form_login.phtml';
    }

    public function showAddEditorialForm(){
        require 'templates/add_editorial.phtml';
    }

    public function showEditEditorialForm ($editorial){
        require './templates/edit_editorial.phtml';
    }


}




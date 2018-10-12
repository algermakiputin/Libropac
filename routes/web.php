<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AppController@index');

Route::get('books','BooksController@index');
Route::post('books/data','BooksController@data');

Route::get('multimedia','MediaController@opac');
Route::post('media/opac','MediaController@publicData');

Route::get('ask','FaqsController@ask');
Route::post('ask/store','FaqsController@store');
Route::get('faqs','FaqsController@faqs');
Route::get('faqs/paginate','FaqsController@faqsPaginate');

//admin
Route::group(['middleware' => ['auth']],function() {

	Route::get('admin','AppController@admin');
	Route::get('admin/librarians/add', 'LibrarianController@add');
	Route::post('admin/librarian/store','LibrarianController@store');
	Route::get('admin/librarians','LibrarianController@index');
	Route::post('admin/librarians/data','LibrarianController@data');
	Route::delete('admin/librarians/destroy','LibrarianController@destroy');
	Route::post('admin/librarians/find','LibrarianController@find');
	Route::post('admin/librarians/update','LibrarianController@update');
	
	Route::post('books/selectData','BooksController@selectData');
	Route::post('admin/books/data','BooksController@admin_data');
	Route::delete('admin/books/delete','BooksController@destroy');
	Route::get('admin/books/edit','BooksController@edit');

	Route::get('admin/faqs', 'FaqsController@index');
	Route::post('admin/faqs/data','FaqsController@data');
	Route::post('admin/faqs/find','FaqsController@find');
	Route::patch('admin/faqs/answer','FaqsController@answer');
	Route::delete('admin/faqs/destroy','FaqsController@destroy');
	Route::patch('admin/faqs/approve','FaqsController@approve');
	Route::patch('admin/faqs/disapprove','FaqsController@disapprove');

	// Books
	Route::get('admin/books','BooksController@adminIndex');
	Route::get('admin/books/add', 'BooksController@add');
	Route::post('admin/books/insert','BooksController@insert');
	Route::patch('admin/books/update','BooksController@update');

	// Media
	Route::post('admin/media/adminData','MediaController@adminData');
	Route::post('admin/media/selectData','MediaController@selectData');
	Route::get('admin/media','MediaController@index');
	Route::get('admin/media/add','MediaController@add');
	Route::post('admin/media/insert','MediaController@insert');
	Route::post('admin/media/edit','MediaController@edit');
	Route::patch('admin/media/update','MediaController@update');
	Route::delete('admin/media/delete','MediaController@destroy');
	// End MEdia

	// Transactions
	Route::get('admin/transactions/new', 'TransactionsController@new');
	Route::get('admin/transactions/member', 'TransactionsController@member');
	Route::post('admin/member/find', 'MembersController@find');
	Route::post('admin/transactions/insert','TransactionsController@insert');
	Route::get('admin/transactions','TransactionsController@index');
	Route::post('admin/transactions/data','TransactionsController@data'); 
	Route::post('admin/return/update','TransactionsController@returnUpdate'); 
	Route::post('admin/lost/update','TransactionsController@lostUpdate');
	// End Transactions

	// Students
	Route::get('admin/students', 'StudentsController@index');
	Route::post('admin/students/data','StudentsController@data');
	Route::patch('admin/students/update','StudentsController@update');
	Route::post('admin/students/find', 'StudentsController@find');
	Route::delete('admin/students/destroy', 'StudentsController@destroy');
	// End students
	// Faculties
	Route::get('admin/faculties', 'FacultiesController@index');
	Route::post('admin/faculties/data','FacultiesController@data');
	Route::patch('admin/faculties/update','FacultiesController@update');
	Route::post('admin/faculties/find', 'FacultiesController@find');
	Route::delete('admin/faculties/destroy', 'FacultiesController@destroy');
	// End Faculties

	// Settings
	Route::get('admin/settings/about','SettingsController@about');
	Route::POST('admin/settings/about-store','SettingsController@storeAbout');
	// End Settings

	// Notice

	Route::get('admin/notices', 'NoticesController@index');
	Route::post('admin/notices/data','NoticesController@data');
	Route::patch('admin/notices/update','NoticesController@update');
	Route::post('admin/notices/find', 'NoticesController@find');
	Route::delete('admin/notices/destroy', 'NoticesController@destroy');
	Route::get('admin/notices/new','NoticesController@new');
	Route::post('admin/notices/store','NoticesController@store');
	// End Notice

	Route::get('admin/users', 'UsersController@index');
	Route::post('admin/users/data','UsersController@data');
	Route::post('admin/users/store','UsersController@store');
	Route::post('admin/users/find','UsersController@find');
	Route::post('admin/users/updateRole','UsersController@updateRole');
	Route::delete('admin/users/destroy','UsersController@destroy');
	Route::post('admin/user/profile','UsersController@profile');
	Route::post('admin/users/update','UsersController@update');
});


Auth::routes();
 

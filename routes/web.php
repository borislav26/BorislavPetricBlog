<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('Front')->prefix('/')->group(function() {
    Route::get('/', 'IndexController@index')->name('front.index.index');
    Route::prefix('/contact')->group(function() {
        Route::get('/', 'ContactController@index')->name('front.contact.index');
        Route::post('/send-email', 'ContactController@sendEmail')->name('front.contact.send_email');
    });

    Route::prefix('/posts')->group(function() {
        Route::get('/', 'PostsController@index')->name('front.posts.index');
        Route::get('/single/{post}/{postName?}', 'PostsController@single')->name('front.posts.single');
        Route::get('/comments-content/{post}', 'PostsController@comments')->name('front.posts.comments');
        Route::get('/category/{category}', 'PostsController@category')->name('front.posts.category');
        Route::get('/search', 'PostsController@search')->name('front.posts.search');
        Route::get('/tag/{tag}', 'PostsController@tag')->name('front.posts.tag');
        Route::get('/author/{author}', 'PostsController@author')->name('front.posts.author');
        Route::post('/leave-comment', 'PostsController@leaveComment')->name('front.posts.leave_comment');
    });
});
Auth::routes();

Route::middleware('auth')->namespace('Admin')->prefix('/admin')->group(function() {
    Route::get('/', 'IndexController@index')->name('admin.index.index');
    Route::prefix('/posts')->group(function() {
        Route::get('/', 'PostsController@index')->name('admin.posts.index');
        Route::get('/add', 'PostsController@add')->name('admin.posts.add');
        Route::get('/edit/{post}', 'PostsController@edit')->name('admin.posts.edit');
        Route::post('/insert/', 'PostsController@insert')->name('admin.posts.insert');
    });
    Route::prefix('/post-categories')->group(function() {
        Route::get('/', 'PostCategoriesController@index')->name('admin.post_categories.index');
        Route::get('/add', 'PostCategoriesController@add')->name('admin.post_categories.add');
        Route::get('/edit/{category}', 'PostCategoriesController@edit')->name('admin.post_categories.edit');
        Route::post('/insert', 'PostCategoriesController@insert')->name('admin.post_categories.insert');
        Route::post('/update/{category}', 'PostCategoriesController@update')->name('admin.post_categories.update');
        Route::post('/delete', 'PostCategoriesController@delete')->name('admin.post_categories.delete');
        Route::get('/table-content', 'PostCategoriesController@tableContent')->name('admin.post_categories.table_content');
        Route::post('/change-priority', 'PostCategoriesController@changePriority')->name('admin.post_categories.change_priority');
    });
    Route::prefix('/post-tags')->group(function() {
        Route::get('/', 'PostTagsController@index')->name('admin.post_tags.index');
        Route::get('/add', 'PostTagsController@add')->name('admin.post_tags.add');
        Route::get('/edit/{tag}', 'PostTagsController@edit')->name('admin.post_tags.edit');
        Route::post('/insert', 'PostTagsController@insert')->name('admin.post_tags.insert');
        Route::post('/update/{tag}', 'PostTagsController@update')->name('admin.post_tags.update');
        Route::post('/delete', 'PostTagsController@delete')->name('admin.post_tags.delete');
        Route::get('/table-content', 'PostTagsController@tableContent')->name('admin.post_tags.table_content');
    });
    Route::prefix('/comments')->group(function() {
        Route::get('/', 'CommentsController@index')->name('admin.comments.index');
        Route::post('/enable', 'CommentsController@enable')->name('admin.comments.enable');
        Route::post('/table-content', 'CommentsController@tableContent')->name('admin.comments.table_content');
    });
    Route::prefix('/slider-items')->group(function() {
        Route::get('/', 'SliderItemsController@index')->name('admin.slider_items.index');
        Route::get('/add', 'SliderItemsController@add')->name('admin.slider_items.add');
        Route::get('/edit/{sliderItem}', 'SliderItemsController@edit')->name('admin.slider_items.edit');
        Route::post('/insert', 'SliderItemsController@insert')->name('admin.slider_items.insert');
        Route::post('/update/{sliderItem}', 'SliderItemsController@update')->name('admin.slider_items.update');
        Route::post('/change-order', 'SliderItemsController@changeOrder')->name('admin.slider_items.change_order');
    });
    Route::prefix('/authors')->group(function() {
        Route::get('/', 'UsersController@index')->name('admin.authors.index');
        Route::get('/add', 'UsersController@add')->name('admin.authors.add');
        Route::get('/edit/{author}', 'UsersController@edit')->name('admin.authors.edit');
        Route::post('/insert', 'UsersController@insert')->name('admin.authors.insert');
        Route::post('/update/{author}', 'UsersController@update')->name('admin.authors.update');
    });
    Route::prefix('/user-profile')->group(function() {
        Route::get('/{userName?}', 'UserProfileController@index')->name('admin.user_profile.index');
        Route::get('/add', 'UsersController@add')->name('admin.users.add');
        Route::get('/edit/{user}', 'UsersController@edit')->name('admin.users.edit');
        Route::post('/insert/', 'UsersController@insert')->name('admin.users.insert');
        Route::post('/update/{user}', 'UsersController@update')->name('admin.users.update');
        Route::post('/delete', 'UsersController@delete')->name('admin.users.delete');
        Route::post('/delete-photo/{user}', 'UsersController@deletePhoto')->name('admin.users.delete_photo');
        Route::post('/remove-from-index-page', 'UsersController@removeFromIndexPage')->name('admin.users.remove_from_index_page');
        Route::post('/put-on-index-page', 'UsersController@putOnIndexPage')->name('admin.users.put_on_index_page');
        Route::post('/datatable-content', 'UsersController@datatableContent')->name('admin.users.datatable_content');
    });
});

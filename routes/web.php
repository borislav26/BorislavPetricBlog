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
        Route::get('/search', 'PostsController@search')->name('front.posts.search');
        Route::post('/leave-comment', 'PostsController@leaveComment')->name('front.posts.leave_comment');
        Route::post('/increment-views', 'PostsController@incrementViews')->name('front.posts.increment_views');
        Route::get('/comments-content/{post}', 'PostsController@comments')->name('front.posts.comments');
        Route::get('/{post}/{name?}', 'PostsController@single')->name('front.posts.single');
        Route::get('/category/{category}/{name?}/{description?}', 'PostsController@category')->name('front.posts.category');
        Route::get('/tag/{tag}/{name?}', 'PostsController@tag')->name('front.posts.tag');
        Route::get('/author/{author}/{name?}', 'PostsController@author')->name('front.posts.author');
    });
});
Auth::routes();

Route::middleware('auth')->namespace('Admin')->prefix('/admin')->group(function() {
    Route::get('/', 'IndexController@index')->name('admin.index.index');
    Route::prefix('/posts')->group(function() {
        Route::get('/', 'PostsController@index')->name('admin.posts.index');
        Route::get('/add', 'PostsController@add')->name('admin.posts.add');
        Route::get('/edit/{post}', 'PostsController@edit')->name('admin.posts.edit');
        Route::post('/update/{post}', 'PostsController@update')->name('admin.posts.update');
        Route::post('/insert', 'PostsController@insert')->name('admin.posts.insert');
        Route::post('/delete', 'PostsController@delete')->name('admin.posts.delete');
        Route::post('/table-content', 'PostsController@tableContent')->name('admin.posts.table_content');
        Route::post('/enable', 'PostsController@enable')->name('admin.posts.enable');
        Route::post('/disable', 'PostsController@disable')->name('admin.posts.disable');
        Route::post('/important', 'PostsController@important')->name('admin.posts.important');
        Route::post('/not-important', 'PostsController@notImportant')->name('admin.posts.not_important');
    });
    Route::prefix('/post-categories')->middleware('admin')->group(function() {
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
        Route::post('/table-content', 'PostTagsController@tableContent')->name('admin.post_tags.table_content');
    });
    Route::prefix('/comments')->middleware('admin')->group(function() {
        Route::get('/', 'CommentsController@index')->name('admin.comments.index');
        Route::post('/enable', 'CommentsController@enable')->name('admin.comments.enable');
        Route::post('/disable', 'CommentsController@disable')->name('admin.comments.disable');
        Route::post('/table-content', 'CommentsController@tableContent')->name('admin.comments.table_content');
    });
    Route::prefix('/slider-items')->middleware('admin_editor')->group(function() {
        Route::get('/', 'SliderItemsController@index')->name('admin.slider_items.index');
        Route::get('/table-content', 'SliderItemsController@tableContent')->name('admin.slider_items.table_content');
        Route::get('/add', 'SliderItemsController@add')->name('admin.slider_items.add');
        Route::get('/edit/{sliderItem}', 'SliderItemsController@edit')->name('admin.slider_items.edit');
        Route::post('/insert', 'SliderItemsController@insert')->name('admin.slider_items.insert');
        Route::post('/update/{sliderItem}', 'SliderItemsController@update')->name('admin.slider_items.update');
        Route::post('/delete', 'SliderItemsController@delete')->name('admin.slider_items.delete');
        Route::post('/change-order', 'SliderItemsController@changeOrder')->name('admin.slider_items.change_order');
        Route::post('/enable', 'SliderItemsController@enable')->name('admin.slider_items.enable');
        Route::post('/disable', 'SliderItemsController@disable')->name('admin.slider_items.disable');
    });
    Route::prefix('/authors')->middleware('admin')->group(function() {
        Route::get('/', 'UsersController@index')->name('admin.authors.index');
        Route::get('/add', 'UsersController@add')->name('admin.authors.add');
        Route::get('/edit/{author}', 'UsersController@edit')->name('admin.authors.edit');
        Route::post('/insert', 'UsersController@insert')->name('admin.authors.insert');
        Route::post('/update/{author}', 'UsersController@update')->name('admin.authors.update');
        Route::post('/delete', 'UsersController@delete')->name('admin.authors.delete');
        Route::post('/table-content', 'UsersController@tableContent')->name('admin.authors.table_content');
        Route::post('/ban', 'UsersController@ban')->name('admin.authors.ban');
        Route::post('/not-ban', 'UsersController@notBan')->name('admin.authors.not_ban');
    });
    Route::prefix('/user-profile')->group(function() {
        Route::get('/{userName?}', 'UserProfileController@index')->name('admin.user_profile.index');
        Route::post('/{userName?}/change-profile', 'UserProfileController@changeProfile')->name('admin.user_profile.change_profile');
    });
    Route::prefix('/chat')->group(function() {
        Route::get('/', 'ChatController@index')->name('admin.chat.index');
        Route::post('/messages-content', 'ChatController@messages')->name('admin.chat.messages_content');
        Route::post('/messages-send', 'ChatController@sendMessage')->name('admin.chat.send_message');
        Route::post('/reload-table', 'ChatController@reloadTable')->name('admin.chat.reload_table');
    });
});

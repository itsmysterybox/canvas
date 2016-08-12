<?php
/*
|--------------------------------------------------------------------------
| Blog Routes
|--------------------------------------------------------------------------
*/
Route::get('/', 'Frontend\BlogController@index');
Route::get('blog', 'Frontend\BlogController@index');
Route::get('blog/{slug}', 'Frontend\BlogController@showPost');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::get('admin', function () {
    return redirect('/admin/post');
});
$router->group([
    'namespace'  => 'Backend',
    'middleware' => 'auth',
], function () {
    Route::resource('admin/post', 'PostController', ['except' => 'show']);
    Route::resource('admin/tag', 'TagController', ['except' => 'show']);
    Route::get('admin/upload', 'UploadController@index')->name('admin/upload');
    Route::post('admin/upload/file', 'UploadController@uploadFile');
    Route::delete('admin/upload/file', 'UploadController@deleteFile');
    Route::post('admin/upload/folder', 'UploadController@createFolder');
    Route::delete('admin/upload/folder', 'UploadController@deleteFolder');
    Route::get('admin/profile/privacy', 'ProfileController@editPrivacy')->name('admin.profile.privacy');
    Route::resource('admin/profile', 'ProfileController');
    Route::resource('admin/search', 'SearchController');
    Route::get('admin/tools', 'ToolsController@index');
    Route::post('admin/tools/reset_index', 'ToolsController@resetIndex');
    Route::get('admin/tools/cache_clear', 'ToolsController@clearCache');
    Route::get('admin/tools/download_archive', 'ToolsController@handleDownload');
    Route::get('admin/tools/enable_maintenance_mode', 'ToolsController@enableMaintenanceMode');
    Route::get('admin/tools/disable_maintenance_mode', 'ToolsController@disableMaintenanceMode');
});

/*
|--------------------------------------------------------------------------
| Logging In/Out Routes
|--------------------------------------------------------------------------
*/
$router->group([
    'namespace' => 'Auth',
    'prefix'    => 'auth',
], function () {
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@getLogout');
    Route::post('password', 'PasswordController@updatePassword');
});

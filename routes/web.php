<?php
use Illuminate\Support\Facades\Artisan;

Route::get('/cache', function() {
    Artisan::call('cache:clear');
    echo 'cache:clear<br>';
    Artisan::call('view:clear');
    echo 'view:clear<br>';
    return 'all cache cleared';
});

if(env('QUERY_LOG')){
	DB::enableQueryLog();
	\Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
		echo "<b>{$query->time}ms</b> | {$query->sql}<br>";
	});
}

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('register', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', 'SiteController@index');
Route::get('/{path}-3425{id}', 'SiteController@post')->where(['id' => '[0-9]+', 'path' => '(.*)']);
Route::post('/{path}-3425{id}', 'SiteController@post')->where(['id' => '[0-9]+', 'path' => '(.*)']);
Route::get('/{path}-2523{id}', 'SiteController@category')->where(['id' => '[0-9]+', 'path' => '(.*)']);
Route::post('/{path}-2523{id}', 'SiteController@category')->where(['id' => '[0-9]+', 'path' => '(.*)']);
Route::get('/tim-kiem', 'SiteController@search');
Route::post('/tim-kiem', 'SiteController@search');
Route::post('/w/updateDataElement', 'SiteController@updateDataElement');
Route::get('/thanh-cong', 'SiteController@thanhcong');
Route::get('/sitemap.xml', 'SiteController@sitemap');
Route::get('/rss', 'SiteController@rss');


Route::any('/admin', 'AdminController@index');
Route::get('/admin/adSetting', 'AdminController@adSetting');
Route::get('/admin/adOrder', 'AdminController@adOrder');
Route::get('/admin/adCustomer', 'AdminController@adCustomer');
Route::get('/admin/adFaq', 'AdminController@adFaq');
Route::get('/admin/adComment', 'AdminController@adComment');
Route::get('/admin/adFileExplorer', 'AdminController@adFileExplorer');
Route::get('/admin/adStatistic', 'AdminController@adStatistic');
Route::get('/admin/adUser', 'AdminController@adUser');
Route::get('/admin/adUploadExcel', 'AdminController@adUploadExcel');
Route::post('/admin/adUploadExcelAjax', 'AdminController@adUploadExcelAjax');


Route::get('/admin/c{id}', 'AdminController@adCategory')->where(['id' => '[0-9]+']);
Route::get('/admin/p{catId}', 'AdminController@adPost')->where(['catId' => '[0-9]+']);
Route::get('/admin/p{catId}-edit{id}', 'AdminController@adPostEdit')->where(['catId' => '[0-9]+','id' => '[0-9]+']);

Route::post('/admin/updateDataFrontEnd', 'AdminController@updateDataFrontEnd');
Route::post('/admin/updateDataElement', 'AdminController@updateDataElement');

Route::get('/changePassword','AdminController@showChangePasswordForm');
Route::post('/changePassword','AdminController@changePassword')->name('changePassword');

Route::get('/{slug}', 'SiteController@findBySlug')->where(['slug' => '(.*)']);
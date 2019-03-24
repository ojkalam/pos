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
use Illuminate\Support\Facades\Auth;

//auth routes
Auth::routes();

Route::get('/', function () {
	if (Auth::guard()->check()) {
		return redirect('/admin');
	}else{
		return view('auth.login');
	}
});

Route::get('/test', function (){

	return "Test Data";

})->name('test');

//Admin Dashboard Routes...

Route::group(['prefix'=>'admin', 'middleware'=>'auth', 'namespace'=>'Admin'], function(){

    Route::get('/', 'DashboardController@index')->name('admin.dashboard');

	Route::resource('categories', 'CategoryController');

	Route::resource('products', 'ProductController');

	Route::resource('taxes', 'TaxController');
	
	Route::resource('brands', 'BrandController');

	Route::resource('contacts', 'ContactController');

	Route::resource('sells', 'SellController');

	Route::post('/sells/send-invoice', 'SellController@sendInvoice')->name('sells.send-invoice');
	Route::post('/sells/send-sms-invoice', 'SellController@sendSmsInvoice')->name('sells.send-sms-invoice');

	Route::get('/sells/{id}/invoice-pdf', 'SellController@pdfInvoice')->name('sells.invoice-pdf');

	//new features
	Route::resource('saletargets', 'SaleTargetController');

	Route::resource('discountoffers', 'DiscountOfferController');
	Route::resource('purchases', 'PurchaseController');

	Route::resource('users', 'UserController');


	//notification routes
	Route::get('markasread', function() {
	    auth()->user()->unreadNotifications->markAsRead();
	    return redirect()->back();

	})->name('markasread');

	Route::get('markasread/{id}', function($id) {
		
	    auth()->user()->unreadNotifications()->where('id',$id)->first()->markAsRead();
	    return redirect()->back();

	})->name('mark_single_asread');

	//show notification
		Route::get('/delnotification', function() {
			return view('backend.notification.index');
		})->name('delnotification');


	//delete notification
	Route::get('delnotification/{id}', function($id) {
		// dd(request('id'));
	    $nt = auth()->user()->notifications()->where('id',$id)->delete();
	    // $nt->delete();
	    return redirect()->back()->with("successMsg", "Notification deleted!");

	})->name('notification.delete');

	//end notification

	//report for all sales
	Route::get('/report/salesreport', 'AjaxController@salesReportView')->name('report.salesreport');

	Route::post('/report/salesreport', 'AjaxController@salesReport')->name('report.salesreport');

	Route::post('/report/salesreport/pdf', 'AjaxController@generateSalesPdf')->name('report.salesreport.pdf');
	Route::post('/report/salesreport/excel', 'AjaxController@generateSalesExcel')->name('report.salesreport.excel');

	//route for customer sales report
	Route::get('/report/customersalesreport', 'AjaxController@customersalesReportView')->name('report.customersalesreport');

	Route::post('/report/customersalesreport', 'AjaxController@customersalesReport')->name('report.customersalesreport');

	Route::post('/report/customersalesreport/pdf', 'AjaxController@customergenerateSalesPdf')->name('report.customersalesreport.pdf');
	Route::post('/report/customersalesreport/excel', 'AjaxController@customergenerateSalesExcel')->name('report.customersalesreport.excel');
	//end customer sales report

	//Ajax request route;
	Route::get('/sells/list', 'AjaxController@getProducts')->name('ps');

	Route::post('/ajax/productPrice', 'AjaxController@productPrice')->name('ajax.productPrice');
	Route::post('/ajax/productPurchasePrice', 'AjaxController@productPurchasePrice')->name('ajax.productPurchasePrice');
	
	Route::get('/sms', 'AjaxController@sendSMS');


});



// Route::get('/home', 'HomeController@index')->name('home');


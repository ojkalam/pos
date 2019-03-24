<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Product;
use App\Category;
use App\CashRegister;
use App\Brand;
use App\Tax;
use App\SaleTarget;
use App\Sell;
use App\SellProduct;
use App\Purchase;
use App\PurchaseProduct;
use App\Contact;

class DashboardController extends Controller
{
    //dashboard view
    //index
    public function index ()
    {
    	$product = Product::all();
    	$category = Category::all();
    	$brand = Brand::all();
    	$total_purchase = Purchase::all()->sum('total_amount');
    	$sale_count = Sell::all();
    	$total_sale = Sell::all()->sum('paid');
    	$customer = Contact::where('type', 'customer')->get();
    	$supplier = Contact::where('type', 'supplier')->get();
    	//send total sales on active target
    	$target = SaleTarget::where('status', 1)->first();

    	$total_sales = 0;
    	$target_amount = 0;
    	$start_date = null;
    	$end_date = null;
    	if ($target) {
    		$total_sales = $this->getTotalPaid($target->start_date, $target->end_date);
    	}
    	
    	$target_data = [
    		'total_sales' => $total_sales,
    		'target_amount' => $target->target_amount,
    		'start_date' => $target->start_date,
    		'end_date' => $target->end_date
    	];
    	// end sales target

        $first_day_of_the_current_month = Carbon::today()->startOfMonth();
    	// $first_day_of_the_current_month = Carbon::create(2018,10,03)->startOfMonth();
		$last_day_of_the_current_month = $first_day_of_the_current_month->copy()->endOfMonth();
		//previsous month
		$first_day_of_month_1 = $first_day_of_the_current_month->copy()->subMonth();
		$last_day_of_month_1 = $first_day_of_month_1->copy()->endOfMonth();
		// end previsous month

		// 2 month prvious
		$first_day_of_month_2 = $first_day_of_the_current_month->copy()->subMonths(2);
		$last_day_of_month_2 = $first_day_of_month_2->copy()->endOfMonth();
		// end 2 month previous

		// 3 month prvious
		$first_day_of_month_3 = $first_day_of_the_current_month->copy()->subMonths(3);
		$last_day_of_month_3 = $first_day_of_month_3->copy()->endOfMonth();
		// end 3 month previous

    	$previous_months = [
            'first_day_of_the_current_month' => $first_day_of_the_current_month,
            'last_day_of_the_current_month' => $last_day_of_the_current_month,
            
    		'first_day_of_month_1' => $first_day_of_month_1,
    		'last_day_of_month_1' => $last_day_of_month_1,

    		'first_day_of_month_2' => $first_day_of_month_2,
    		'last_day_of_month_2' => $last_day_of_month_2,

    		'first_day_of_month_3' => $first_day_of_month_3,
    		'last_day_of_month_3' => $last_day_of_month_3,
 
    	];

    	$forecast = $this->saleForecast($previous_months);
       // return $forecast;
    	//return statement

    	return view('backend.dashboard', compact(['product', 'category', 'brand', 'total_sale', 'sale_count', 'customer', 'supplier','total_purchase','target_data','forecast', 'previous_months' ]));
    }

    //do sales forecast by calculating average value of previous three month
    //
    public function saleForecast (array $previous_months)
    {	
        $dt = Carbon::now();

    	$three_months_data = [
            'thisMonth' => $this->getTotalPaid($previous_months['first_day_of_the_current_month'],  $previous_months['last_day_of_the_current_month']),

    		'one' => $this->getTotalPaid($previous_months['first_day_of_month_1'],  $previous_months['last_day_of_month_1']),
    		'two' => $this->getTotalPaid($previous_months['first_day_of_month_2'],  $previous_months['last_day_of_month_2']),
            'three' => $this->getTotalPaid($previous_months['first_day_of_month_3'],  $previous_months['last_day_of_month_3']),

    		'today_sales' => $this->getTodayPaid($dt->toDateString())
    	]; 

    	return $three_months_data;
    	
    }

    //calculate total sales amount
    public static function getTotalPaid ($startdate, $enddate)
    {
        $total_sale = Sell::whereBetween('created_at', [$startdate, $enddate])->sum('paid');
        return round($total_sale);
    }

    public static function getTodayPaid ($today)
    {
        $total_sale = Sell::where('sale_date', $today)->sum('paid');
        return round($total_sale);
    }


}

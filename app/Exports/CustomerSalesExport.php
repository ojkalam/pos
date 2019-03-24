<?php

namespace App\Exports;
use App\Sell;
use App\Contact;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerSalesExport implements  FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
    	$customer_sale = Contact::find(request('cus_id'));

    	$sells = Sell::leftJoin('contacts as c', 'c.id', '=', 'sells.contact_id')->select('c.name as c_name','c.contact_id as c_id','sells.*')->where('c.id', request('cus_id'))->orderBy('sells.id','desc')->get();

        return view('backend.report.customersalespdf', compact('sells','customer_sale'));
        
    }
}
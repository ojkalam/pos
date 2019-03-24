<?php

namespace App\Exports;
use App\Sell;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesExport implements  FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
    	 $sells = Sell::leftJoin('contacts as c', 'c.id', '=', 'sells.contact_id')->select('c.name as c_name','c.contact_id as c_id','sells.*')->whereBetween('sells.created_at', [request('start_date'), request('end_date')])->orderBy('sells.id','desc')->get();

        $from = request('start_date');
        $to = request('end_date');
        return view('backend.report.salespdf', compact('sells','from','to'));
        
    }
}
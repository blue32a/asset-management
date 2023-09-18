<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SummaryController extends Controller
{
    public function index()
    {
        $cashes = DB::table('cash_holding')
            ->join('asset_holding', 'cash_holding.id', '=', 'asset_holding.holdable_id')
            ->join('custodian', 'cash_holding.custodian_id', '=', 'custodian.id')
            ->join('currency', 'cash_holding.currency_id', '=', 'currency.id')
            ->join('cash_type', 'cash_holding.cash_type_id', '=', 'cash_type.id')
            ->select('cash_holding.custodian_id', 'custodian.name as custodian_name', 'currency.name as currency_name')
            ->selectRaw('SUM(asset_holding.amount) as total_amount')
            ->where('asset_holding.holdable_type', 'CashHolding')
            ->groupBy('cash_holding.currency_id', 'cash_holding.custodian_id')
            ->get();
//        dd($cashes);

        $instruments = DB::table('instrument_holding')
            ->join('asset_holding', 'instrument_holding.id', '=', 'asset_holding.holdable_id')
            ->join('custodian', 'instrument_holding.custodian_id', '=', 'custodian.id')
            ->join('instrument', 'instrument_holding.instrument_id', '=', 'instrument.id')
            ->join('currency', 'instrument.currency_id', '=', 'currency.id')
            ->select('instrument_holding.custodian_id', 'custodian.name as custodian_name', 'currency.name as currency_name')
            ->selectRaw('SUM(asset_holding.amount) as total_amount')
            ->where('asset_holding.holdable_type', 'InstrumentHolding')
            ->groupBy('instrument.currency_id', 'instrument_holding.custodian_id')
            ->get();
//        dd($instruments);

        return view('summary', [
            'cashes' => $cashes,
            'instruments' => $instruments,
        ]);
    }
}

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
        $cashTotalAmount = array_sum(array_column($cashes->toArray(), 'total_amount'));

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
        $instrumentTotalAmount = array_sum(array_column($instruments->toArray(), 'total_amount'));

        $totalAmount = $cashTotalAmount + $instrumentTotalAmount;

        $summaryAsset = [];
        $summaryAsset['現金'] = $cashTotalAmount;
        $summaryAsset['金融商品'] = $instrumentTotalAmount;
        arsort($summaryAsset);

        $chartAsset = [
            'labels' => array_keys($summaryAsset),
            'data' => array_map(fn($amount) => $amount / $totalAmount * 100, array_values($summaryAsset)),
        ];

        $currencyNames = array_column($cashes->toArray(), 'currency_name')
            + array_column($instruments->toArray(), 'currency_name');
        $uniqueCurrencyNames = array_unique($currencyNames);
        $summaryCurrency = array_fill_keys($uniqueCurrencyNames, 0);
        foreach ($cashes as $cash) {
            $summaryCurrency[$cash->currency_name] += $cash->total_amount;
        }
        foreach ($instruments as $instrument) {
            $summaryCurrency[$instrument->currency_name] += $instrument->total_amount;
        }
        arsort($summaryCurrency);
        $chartCurrency = [
            'labels' => array_keys($summaryCurrency),
            'data' => array_map(fn($amount) => $amount / $totalAmount * 100, array_values($summaryCurrency)),
        ];

        return view('summary', compact('cashes', 'cashTotalAmount', 'instruments', 'instrumentTotalAmount', 'totalAmount', 'chartAsset', 'chartCurrency'));
    }
}

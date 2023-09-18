@extends('layouts.main')

@section('content')
<section class="content-header">
    <h1>Summary</h1>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">現金</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>通貨</th>
                            <th>保有</th>
                            <th>金額（円）</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cashes as $cash)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $cash->currency_name }}</td>
                            <td>{{ $cash->custodian_name }}</td>
                            <td>{{ number_format($cash->total_amount) }} 円</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">金融商品</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>通貨</th>
                        <th>保有</th>
                        <th>金額（円）</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($instruments as $instrument)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $instrument->currency_name }}</td>
                            <td>{{ $instrument->custodian_name }}</td>
                            <td>{{ number_format($instrument->total_amount) }} 円</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('layouts.main')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
$(function () {
    new Chart(
        document.getElementById('chart-asset'),
        {
            type: 'pie',
            data: {
                labels: {{ Js::from($chartAsset['labels']) }},
                datasets: [{
                    label: '割合(%)',
                    data: {{ Js::from(array_map(fn($d) => round($d, 1), $chartAsset['data'])) }},
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    title: {
                        text: '資産別割合',
                        display: true
                    }
                }
            }
        }
    );
    new Chart(
        document.getElementById('chart-currency'),
        {
            type: 'pie',
            data: {
                labels: {{ Js::from($chartCurrency['labels']) }},
                datasets: [{
                    label: '割合(%)',
                    data: {{ Js::from(array_map(fn($d) => round($d, 1), $chartCurrency['data'])) }},
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    title: {
                        text: '通貨別割合',
                        display: true
                    }
                }
            }
        }
    );
});
</script>
@endpush

@section('content')
<section class="content-header">
    <h1>Summary</h1>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa-solid fa-cubes-stacked"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">資産総額</span>
                        <span class="info-box-number">{{ number_format($totalAmount) }} 円</span>
                    </div>
                </div>
            </div>
        </div>

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
            <div class="card-footer text-right">
                小計：{{ number_format($cashTotalAmount) }} 円
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
            <div class="card-footer text-right">
                小計：{{ number_format($instrumentTotalAmount) }} 円
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <canvas id="chart-asset"></canvas>
                    </div>
                    <div class="col">
                        <canvas id="chart-currency"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

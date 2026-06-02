@extends('admins.layouts.master')
@section('pageTitle', 'Dashboard')
@section('main-content')
    <div class="w-full flex mb-4 justify-between">
        <h1>Dashboard</h1>
    </div>
    @php
        use App\Models\Order;
        use App\Models\Subproduct;
        use Carbon\Carbon;
        use Illuminate\Support\Facades\DB;

        $statuses = [
            -1 => ['text' => 'Cancelled', 'color' => 'text-red-500'],
            0 => ['text' => 'Pending', 'color' => 'text-yellow-500'],
            1 => ['text' => 'Confirmed', 'color' => 'text-green-500'],
            2 => ['text' => 'Shipping', 'color' => 'text-blue-500'],
            3 => ['text' => 'Delivered', 'color' => 'text-green-500'],
            4 => ['text' => 'Completed', 'color' => 'text-green-500'],
        ];

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $currentDay = Carbon::now()->day;

        $revenueByMonth = Order::select(DB::raw('sum(total_price) as total'), DB::raw('MONTH(created_at) as month'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $monthlyData = [];
        $monthsLabel = [];
        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        for ($i = 1; $i <= $currentMonth; $i++) {
            $monthlyData[] = $revenueByMonth[$i] ?? 0;
            $monthsLabel[] = $monthNames[$i - 1];
        }

        $revenueByDay = Order::select(DB::raw('sum(total_price) as total'), DB::raw('DAY(created_at) as day'))
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->groupBy('day')
            ->pluck('total', 'day')
            ->toArray();

        $dailyData = [];
        $daysLabel = [];
        for ($i = 1; $i <= $currentDay; $i++) {
            $dailyData[] = $revenueByDay[$i] ?? 0;
            $daysLabel[] = $i;
        }

        $bestSelling = Subproduct::withSum('orderdetails', 'quantity')
            ->orderByDesc('orderdetails_sum_quantity')
            ->take(5)
            ->get();

        $lowStock = Subproduct::where('stock', '<', 10)->orderBy('stock', 'asc')->take(10)->get();

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $totalSalesThisWeek = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_price');
        $totalUnconfirmedOrders = Order::where('status', 0)->count();
        $totalSubproducts = Subproduct::where('stock', '>', 0)->count();
        $totalLowQuantity = Subproduct::where('stock', '<', 10)->count();

        $recentOrders = Order::orderBy('created_at', 'desc')->limit(10)->get();
    @endphp

    <div class="dashboard grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <div class="item">
            <div class="flex justify-center items-center" style="height:100%">
                <i class="fa-solid fa-money-bill-1 fa-fw" style="font-size: 32px"></i>
            </div>
            <div class="right">
                <div class="title">Total sales this week:</div>
                <div class="value">{{ number_format($totalSalesThisWeek, 0, ',', '.') }}đ </div>
            </div>
        </div>
        <div class="item">
            <div class="flex justify-center items-center" style="height:100%">
                <i class="fa-solid fa-print fa-fw" style="font-size: 32px"></i>
            </div>
            <div class="right">
                <div class="title">Orders left:</div>
                <div class="value">{{ $totalUnconfirmedOrders }} </div>
            </div>
        </div>
        <div class="item">
            <div class="flex justify-center items-center" style="height:100%">
                <i class="fa-solid fa-bag-shopping fa-fw" style="font-size: 32px"></i>
            </div>
            <div class="right">
                <div class="title">Products on-sale:</div>
                <div class="value">{{ $totalSubproducts }} </div>
            </div>
        </div>
        <div class="item">
            <div class="flex justify-center items-center" style="height:100%">
                <i class="fa-solid fa-arrow-trend-down fa-fw" style="font-size: 32px"></i>
            </div>
            <div class="right">
                <div class="title">Low stock products:</div>
                <div class="value">{{ $totalLowQuantity }} </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
        <div class="bg-neutral-primary-soft p-4 rounded-base shadow-sm border border-default col-span-3">
            <h3 class="text-lg font-bold mb-4 text-heading">This month...</h3>
            <div id="dailyChart"></div>
        </div>
        <div class="bg-neutral-primary-soft p-4 rounded-base shadow-sm border border-default col-span-2">
            <h3 class="text-lg font-bold mb-4 text-heading">Bestselling</h3>
            <table class="table-auto w-full text-left text-sm text-body">
                <thead class="bg-neutral-secondary border-b border-default">
                    <tr>
                        <th class="px-4 py-2 long">Name</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Sold</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bestSelling as $product)
                        <tr class="border-b border-default">
                            <td class="px-4 py-2 flex items-center gap-2">
                                @if ($product->thumbnail_path)
                                    <img src="{{ asset('storage/' . $product->thumbnail_path) }}"
                                        class="w-10 h-10 object-cover border border-default">
                                @endif
                                <span class="font-medium text-black">{{ $product->name() }}</span>
                            </td>
                            <td class="px-4 py-2 text-black">{{ number_format($product->price, 0, ',', '.') }}đ</td>
                            <td class="px-4 py-2 font-bold text-green-600">
                                {{ $product->orderdetails_sum_quantity ?? 0 }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center">No data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-neutral-primary-soft p-4 rounded-base shadow-sm border border-default col-span-2">
            <h3 class="text-lg font-bold mb-4 text-heading">Low quantity</h3>
            <table class="table-auto w-full text-left text-sm text-body">
                <thead class="bg-neutral-secondary border-b border-default">
                    <tr>
                        <th class="px-4 py-2 long">Name</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowStock as $product)
                        <tr class="border-b border-default">
                            <td class="px-4 py-2 flex items-center gap-2">
                                @if ($product->thumbnail_path)
                                    <img src="{{ asset('storage/' . $product->thumbnail_path) }}"
                                        class="w-10 h-10 object-cover border border-default">
                                @endif
                                <span class="font-medium text-black">{{ $product->name() }}</span>
                            </td>
                            <td class="px-4 py-2 text-black">{{ number_format($product->price, 0, ',', '.') }}đ
                            </td>
                            <td class="px-4 py-2 font-bold text-red-600">{{ $product->stock }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center">No products are low on stock.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-neutral-primary-soft p-4 rounded-base shadow-sm border border-default col-span-3">
            <h3 class="text-lg font-bold mb-4 text-heading">This year...</h3>
            <div id="monthlyChart"></div>
        </div>
    </div>
    <div class="main-container my-3">
        <h3 class="text-lg font-bold mb-4 text-heading">Recent orders</h3>
        <table class="table-auto w-full text-left rtl:text-right text-body">
            <thead class="border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                    <th scope="col" class="px-6 py-3 font-medium">Receiver</th>
                    <th scope="col" class="px-6 py-3 font-medium">Phone</th>
                    <th scope="col" class="px-6 py-3 font-medium">Items</th>
                    <th scope="col" class="px-6 py-3 font-medium">Total</th>
                    <th scope="col" class="px-6 py-3 font-medium">Status</th>
                    <th scope="col" class="px-6 py-3 font-medium">Created at</th>
                    <th scope="col" class="px-6 py-3 font-medium">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($recentOrders) > 0)
                    @foreach ($recentOrders as $order)
                        <tr scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <th class="px-6 py-4">
                                {{ $loop->index + 1 }}
                            </th>
                            <td class="px-6 py-4 long" style="color: black">
                                {{ $order->receiver }}
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ $order->phone }}
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ count($order->orderdetails) }}
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ number_format($order->total_price, 0, ',', '.') }}đ
                            </td>
                            <td class="px-6 py-4">
                                <span class="{{ $statuses[$order->status]['color'] }}">
                                    {{ $statuses[$order->status]['text'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                {{ $order->created_at }}
                            </td>
                            <td class="px-6 py-4" style="color: black">
                                <a class="btn edit icon-only" href="{{ route('orders.show', $order->id) }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center">No order found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dailyOptions = {
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Revenue',
                    data: @json($dailyData)
                }],
                xaxis: {
                    categories: @json($daysLabel),
                    title: {
                        text: 'Day of Month'
                    },
                    labels: {
                        show: false
                    },
                },
                yaxis: {
                    title: {
                        text: 'Revenue (VND)'
                    },
                    labels: {
                        formatter: (value) => {
                            return new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(value);
                        }
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                colors: ['#3b82f6'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                }
            };
            var dailyChart = new ApexCharts(document.querySelector("#dailyChart"), dailyOptions);
            dailyChart.render();

            var monthlyOptions = {
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Revenue',
                    data: @json($monthlyData)
                }],
                xaxis: {
                    categories: @json($monthsLabel)
                },
                yaxis: {
                    title: {
                        text: 'Revenue (VND)'
                    },
                    labels: {
                        formatter: (value) => {
                            return new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(value);
                        }
                    }
                },
                colors: ['#10b981'],
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: false
                    }
                },
                dataLabels: {
                    enabled: false
                }
            };
            var monthlyChart = new ApexCharts(document.querySelector("#monthlyChart"), monthlyOptions);
            monthlyChart.render();
        });
    </script>
@endsection

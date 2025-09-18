<x-app-layout>
    <div class="card shadow-lg border-0">
        <div class="card-header text-center bg-primary text-white">
            <h3 class="fw-bold m-0" style="font-family: sans-serif;">
                پورسانت و فروش - {{ $user->name }}
            </h3>
        </div>

        <div class="card-body">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>محصول</th>
                        <th>تعداد شرط</th>
                        <th>درصد پورسانت</th>
                        <th>تعداد فروش من</th>
                        <th>پورسانت نهایی</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userProducts as $up)
                        <tr>
                            <td class="fw-semibold">{{ $up->product->name }}</td>
                            <td>{{ number_format($up->product->condition) }}</td>
                            <td class="text-success fw-bold">{{ $up->product->percent * 100 }}%</td>
                            <td class="text-danger">{{ number_format($up->sales) }}</td>
                            <td class="text-danger fw-bold">{{ number_format($up->commission) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

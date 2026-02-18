<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">ایجاد مشتری جدید</h2>
    </x-slot>

    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.customersCreate.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">نام مشتری</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">شماره تماس</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" required>
                        @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">استان</label>
                        <select name="province" id="province" class="form-select">
                            <option value="">در حال بارگذاری...</option>
                        </select>
                        @error('province') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">شهر</label>
                        <select name="city" id="city" class="form-select" disabled>
                            <option value="">ابتدا استان را انتخاب کنید</option>
                        </select>
                        @error('city') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">آدرس (اختیاری)</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                        @error('address') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">نحوه آشنایی</label>
                        <select name="reference_type_id" class="form-select">
                            <option value="">-- --</option>
                            @foreach($refrenses as $refrense)
                                <option value="{{ $refrense->id }}" {{ old('reference_type_id') == $refrense->id ? 'selected' : '' }}>
                                    {{ $refrense->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('reference_type_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">بازاریاب</label>

                        @if($isAdmin)
                            <select name="user_id" class="form-select">
                                <option value="">-- بدون بازاریاب --</option>
                                @foreach($marketers as $marketer)
                                    <option value="{{ $marketer->id }}" {{ old('user_id') == $marketer->id ? 'selected' : '' }}>
                                        {{ $marketer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id') <div class="text-danger small">{{ $message }}</div> @enderror
                        @else
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.customersAdmin.index') }}" class="btn btn-secondary">بازگشت</a>
                        <button type="submit" class="btn btn-success">ثبت مشتری</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

<script>
    const oldProvince = @json(old('province'));
    const oldCity = @json(old('city'));

    document.addEventListener('DOMContentLoaded', async () => {
        const provinceSelect = document.getElementById('province');
        const citySelect = document.getElementById('city');
        let provinces = [];

        const setCities = (provinceName) => {
            citySelect.innerHTML = '<option value="">انتخاب شهر</option>';
            const province = provinces.find((item) => (item.name ?? '').trim() === provinceName);
            const cities = province?.cities ?? [];

            cities.forEach((item) => {
                const option = document.createElement('option');
                option.value = (item.name ?? '').trim();
                option.textContent = (item.name ?? '').trim();
                if (oldCity && option.value === oldCity) {
                    option.selected = true;
                }
                citySelect.appendChild(option);
            });

            citySelect.disabled = cities.length === 0;
        };

        try {
            const response = await fetch('https://api.ariyajanebi.ir/v1/front/area?version=new2', {
                headers: { Accept: 'application/json' }
            });
            const data = await response.json();
            provinces = data?.data?.provinces ?? [];

            provinceSelect.innerHTML = '<option value="">انتخاب استان</option>';

            provinces.forEach((item) => {
                const option = document.createElement('option');
                option.value = (item.name ?? '').trim();
                option.textContent = (item.name ?? '').trim();
                if (oldProvince && option.value === oldProvince) {
                    option.selected = true;
                }
                provinceSelect.appendChild(option);
            });

            if (oldProvince) {
                setCities(oldProvince);
            }
        } catch (error) {
            provinceSelect.innerHTML = '<option value="">خطا در دریافت لیست استان‌ها</option>';
            citySelect.innerHTML = '<option value="">خطا در دریافت لیست شهرها</option>';
            citySelect.disabled = true;
        }

        provinceSelect.addEventListener('change', (event) => {
            setCities(event.target.value);
        });
    });
</script>

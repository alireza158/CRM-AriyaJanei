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
                        <label class="form-label">آدرس</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="form-control" >
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

                        @error('refrense_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">بازاریاب</label>
                        <select name="user_id" class="form-select">
                            <option value="">-- بدون بازاریاب --</option>
                            @foreach($marketers as $marketer)
                                <option value="{{ $marketer->id }}" {{ old('user_id') == $marketer->id ? 'selected' : '' }}>
                                    {{ $marketer->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('user_id') <div class="text-danger small">{{ $message }}</div> @enderror
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
<html lang="fa" dir="rtl">

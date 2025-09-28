<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            ایجاد مشتری جدید
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6" dir="rtl">
                <form action="{{ route('admin.marketers.customers.store', ['marketer' => $marketer->id] ) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">نام مشتری</label>
                        <input type="text" name="name" value="{{ old('name', $customer->name) }}" class="form-control" required>
                        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">شماره تماس</label>
                        <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" class="form-control" required>
                        @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">آدرس</label>
                        <input type="text" name="address" value="{{ old('address', $customer->address) }}" class="form-control" required>
                        @error('address') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

 <div class="mb-3">
                        <label class="form-label">نحوه آشنایی</label>
                        <select name="reference_type_id" class="form-select">
                            <option value="">-- --</option>
                            @foreach($refrenses as $refrense)
                                <option value="{{ $refrense->id }}" {{ old('customer->reference_type_id',$customer->reference_type_id) == $refrense->id ? 'selected' : '' }}>
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
                                @if(\App\Models\User::where('id', $marketer->id)->exists())
                                    <option value="{{ $marketer->id }}" {{ old('user_id', $customer->user_id) == $marketer->id ? 'selected' : '' }}>
                                        {{ $marketer->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>

                        @error('user_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.customersAdmin.index') }}" class="btn btn-secondary">بازگشت</a>
                        <button type="submit" class="btn btn-primary">بروزرسانی</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

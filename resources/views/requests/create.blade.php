<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight" dir="rtl">ثبت درخواست جدید</h2>
</x-slot>


<div class="py-6 max-w-3xl mx-auto">
<div class="bg-white shadow-sm rounded-lg p-6" dir="rtl">
<form action="{{ route('requests.store') }}" method="POST">
@csrf


@if(session('success'))
<div class="alert alert-success mt-4 text-center">{{ session('success') }}</div>
@endif


@if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))
<div class="mb-4">
<label for="user_id" class="block font-medium text-gray-700">انتخاب کاربر</label>
<select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded-md">
@foreach(($users ?? []) as $user)
<option value="{{ $user->id }}">{{ $user->name }}</option>
@endforeach
</select>
@error('user_id')
<span class="text-red-600 text-sm">{{ $message }}</span>
@enderror
</div>
@endif


<div class="mb-4">
<label for="title" class="block font-medium text-gray-700">عنوان درخواست</label>
<input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('title') }}" required>
@error('title')
<span class="text-red-600 text-sm">{{ $message }}</span>
@enderror
</div>


<div class="mb-4">
<label for="description" class="block font-medium text-gray-700">توضیحات</label>
<textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description') }}</textarea>
@error('description')
<span class="text-red-600 text-sm">{{ $message }}</span>
@enderror
</div>


<div class="flex justify-start gap-4 mt-6">
<a href="{{ route('requests.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">بازگشت</a>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">ثبت درخواست</button>
</div>
</form>
</div>
</div>
</x-app-layout>
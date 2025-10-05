{{-- resources/views/evaluations/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark" dir="rtl">
            فرم ارزیابی {{ $target->name }}
        </h2>
    </x-slot>

    <div class="py-4 container" dir="rtl">
        {{-- پیام موفقیت --}}
        @if (session('success'))
            <div class="alert alert-success small mb-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- پیام خطای کلی --}}
        @if ($errors->any())
            <div class="alert alert-danger small mb-3">
                لطفاً همهٔ گزینه‌های خالی را تکمیل کنید.
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form id="evaluation-form" action="{{ route('evaluations.store', $target) }}" method="POST">
                    @csrf

                    @if ($form->questions->isEmpty())
                        <div class="text-center text-muted py-5">
                            هیچ سؤالی برای این فرم ثبت نشده است.
                        </div>
                    @else
                        @foreach($form->questions as $i => $q)
                            @php
                                $fieldName = "answers.$q->id";
                                $hasError  = $errors->has($fieldName);
                                $errorId   = "error-$q->id";
                                $selectId  = "answer-$q->id";
                            @endphp

                            <div class="card mb-3 border-0 border-start @if($hasError) border-danger @else border-success-subtle @endif border-3">
                                <div class="card-body py-3">
                                    <div class="row g-3 align-items-start">
                                        {{-- شماره سؤال (Badge) --}}
                                        <div class="col-12 col-md-1 d-flex">
                                            <span class="badge bg-secondary-subtle text-dark fw-normal me-auto ms-0">
                                                سؤال {{ $i+1 }}
                                            </span>
                                        </div>

                                        {{-- عنوان --}}
                                        <div class="col-12 col-md-5">
                                            <h6 class="mb-1">{{ $q->title }}</h6>
                                            @if(!empty($q->description))
                                                <p class="text-muted small mb-0">{{ $q->description }}</p>
                                            @endif
                                        </div>

                                        {{-- انتخاب امتیاز --}}
                                        <div class="col-12 col-md-3">
                                            <label for="{{ $selectId }}" class="form-label small mb-1">امتیاز (۱ تا ۵)</label>
                                            <select
                                                id="{{ $selectId }}"
                                                name="answers[{{ $q->id }}]"
                                                class="form-select @if($hasError) is-invalid @endif"
                                                required
                                                aria-invalid="{{ $hasError ? 'true' : 'false' }}"
                                                aria-describedby="{{ $hasError ? $errorId : '' }}"
                                            >
                                                <option value="">انتخاب...</option>
                                                @for($s=1; $s<=5; $s++)
                                                    <option value="{{ $s }}" @selected((string)old("answers.$q->id") === (string)$s)>
                                                        {{ $s }}
                                                    </option>
                                                @endfor
                                            </select>
                                            @error($fieldName)
                                                <div id="{{ $errorId }}" class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- توضیحات (در صورت خالی بودن خط تیره) --}}
                                       
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="d-flex gap-2 mt-4">
                        <button id="submit-btn" type="submit" class="btn btn-success px-4">
                            ثبت ارزیابی
                        </button>
                        <small class="text-muted d-none d-sm-inline">
                            همهٔ سؤالات الزامی هستند. امتیاز بین ۱ تا ۵ را انتخاب کنید.
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- جلوگیری از دوباره‌ارسال (اختیاری ولی مفید) --}}
    <script>
      (function () {
        const form = document.getElementById('evaluation-form');
        const btn  = document.getElementById('submit-btn');
        form.addEventListener('submit', function () {
          btn.disabled = true;
          btn.innerText = 'در حال ثبت...';
        }, { once: true });
      })();
    </script>
</x-app-layout>

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">

            @if ($errors->has('error'))
                <li>{{ $errors->first('error') }}</li>
            @else
                
                @if ($errors->has('name'))
                    <li>{{ $errors->first('name') }}</li>
                @endif

                @if ($errors->has('phone'))
                    <li>{{ $errors->first('phone') }}</li>
                @endif

                @if ($errors->has('email'))
                    <li>{{ $errors->first('email') }}</li>
                @endif

                @if ($errors->has('student_id'))
                    <li>{{ $errors->first('student_id') }}</li>
                @endif

                @if ($errors->has('password'))
                    <li>{{ $errors->first('password') }}</li>
                @endif
            @endif
        </ul>
    </div>
@endif

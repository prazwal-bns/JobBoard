<div>
    @if ($allOption)
        <label for="{{ $name }}" class="flex items-center mb-1">
            <input type="radio" name="{{ $name }}" value="" @checked(!request($name)) />
            <span class="ml-2">All</span>
        </label>
    @endif

    @foreach ($optionsWithLabels as $label => $option)
        <label for="{{ $name }}" class="flex items-center mb-1">
            <input type="radio" name="{{ $name }}" value="{{ $option }}" @checked($option === ($value ?? request($name))) />
            <span class="ml-2">{{ $label }}</span>

            {{-- <span class="ml-2">{{ ucfirst(trans($option)) }}</span> --}}
        </label>
    @endforeach

    @error($name)
        <div class="mt-1 text-xs text-red-500">
            {{ $message }}
        </div>
    @enderror

</div>

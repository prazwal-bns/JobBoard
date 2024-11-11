<x-card class="p-4 mb-4">
    <div class="flex justify-between mb-4">
        <h2 class="text-lg font-medium">{{ $job->title }}</h2>
        <div class="text-slate-500">
            ${{ number_format($job->salary) }}
        </div>
    </div>

    <div class="flex items-center justify-between mb-4 text-sm text-slate-500">
        <div class="flex space-x-4">
            <div class="font-semibold text-red-500">{{ $job->employer->company_name }}</div>
            <div>{{ $job->location }}</div>
        </div>
        <div class="flex space-x-1 text-xs text-blue-600">
            <x-tag>
                <a href="{{ route('jobs.index', ['experience'=> $job->experience]) }}">
                    {{ Str::ucFirst($job->experience) }}
                </a>
            </x-tag>
            <x-tag>
                <a href="{{ route('jobs.index', ['category'=> $job->category]) }}">
                    {{ $job->category }}
                </a>
            </x-tag>
        </div>


    </div>


    {{ $slot }}

</x-card>

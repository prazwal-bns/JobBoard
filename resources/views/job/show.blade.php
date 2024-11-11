<x-layout>
    <x-bread-crumbs class="mb-4"
    :links="['Jobs' => route('jobs.index'), $job->title => '#']" />
    <x-job-card :$job>
        <p class="mb-4 text-sm text-slate-500">
            {!! nl2br(e($job->description)) !!}
        </p>


        @can('apply', $job)
            <x-link-button :href="route('job.application.create',$job)">
                Apply
            </x-link-button>
        @else
            <div class="p-3 text-sm font-medium text-center text-red-500 shadow-sm hover:bg-slate-200">
                You've Already Applied for this Job
            </div>
        @endcan

    </x-job-card>

    <x-card class="p-4 mb-4">
        <h2 class="mb-4 text-lg font-medium">
            More <span class="font-semibold text-blue-700">{{ $job->employer->company_name }}</span> Jobs
        </h2>

        <div class="text-sm text-slate-500">
            @foreach ($job->employer->jobs as $otherJob)
                <div class="flex justify-between mb-4">
                    <div>
                        <div class="font-semibold text-red-500">
                            <a href="{{ route('jobs.show',$otherJob) }}">
                                {{ $otherJob->title }}
                            </a>
                        </div>

                        <div class="text-xs">
                            {{ $otherJob->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <div class="text-xs">
                        ${{ number_format($otherJob->salary) }}
                    </div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>

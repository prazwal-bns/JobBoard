<x-layout>
    <x-bread-crumbs class="mb-4"
        :links="[
            'Jobs' => route('jobs.index'),
            $job->title => route('jobs.show',$job),
            'Apply' => '#',
        ]"
    />

    <x-job-card :$job/>

    <x-card class="p-4">
        <h2 class="mb-4 text-lg font-medium">
            Your Job Application
        </h2>

        <form action="{{ route('job.application.store',$job) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                {{-- <label for="expected_salary" class="block mb-2 text-sm font-medium text-slate-900">Expected Salary:</label> --}}
                <x-label for="expected_salary" :required="true">Expected Salary:</x-label>
                <x-text-input name="expected_salary" type="number" placeholder="Expected Salary"/>
            </div>

            <div class="mb-4">
                {{-- <label for="" class="block mb-2 text-sm font-medium text-slate-900">Upload CV</label> --}}
                <x-label for="cv" :required="true">Upload CV</x-label>
                <x-text-input type="file" name="cv"></x-text-input>
            </div>
            <x-button class="w-full">Apply</x-button>
        </form>
    </x-card>

</x-layout>

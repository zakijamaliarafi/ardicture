<x-layout>
    <div class="">
        <h1 class="text-6xl font-bold m-6">Reports</h1>
        @php
            $i = 1;
        @endphp
        <table class="border table-fixed border-collapse border-black ms-6">
            <thead>
                <tr>
                    <th class="border border-slate-600 py-1 px-2">No.</th>
                    <th class="border border-slate-600 py-1 px-2">Report Description</th>
                    <th class="border border-slate-600 py-1 px-2">Reported By</th>
                    <th class="border border-slate-600 py-1 px-2">Reported Post</th>

                </tr>
                @foreach ($reports as $report)
                    <tr>
                        <td class="border border-slate-600 py-1 px-2">{{ $i }}</td>
                        <td class="border border-slate-600 py-1 px-2">{{ $report->report_description }}</td>
                        <td class="border border-slate-600 py-1 px-2">{{ $report->user->name }}</td>
                        <td class="border border-slate-600 py-1 px-2">
                            <button class="bg-red-500 text-white px-2 py-1 rounded-md">
                                <a href="{{ route('posts.show', $report->post->id) }}">View Post</a>
                            </button>
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach

            </thead>
        </table>
    </div>
</x-layout>

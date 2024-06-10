<x-layout>
    <h1 class="text-6xl font-bold m-6">Reports</h1>
    @php
        $i = 1;
    @endphp
    <table class="table-fixed border-collapse ms-6 w-[400px] md:w-[750px] lg:w-[1000px]">
        <thead class="bg-gray-300">
            <tr class="">
                <th class="py-4 px-2 w-1/12">No</th>
                <th class="py-1 px-2 w-1/6">Description</th>
                <th class="py-1 px-2 w-1/6">Reported By</th>
                <th class="py-1 w-7/12">Action</th>
        </thead>
        </tr>
        @foreach ($reports as $report)
            <tr>
                <td class="py-4 px-2 text-center text-orange-600">{{ $i }}</td>
                <td class="py-4 px-2 text-center text-orange-600">{{ $report->report_description }}</td>
                <td class="py-4 px-2 text-center text-orange-600">{{ $report->user->name }}</td>
                <td class="py-4 px-10 flex items-center justify-between">
                    <button
                        class="text-orange-600 px-5 py-1 mr-2 rounded-md border hover:bg-orange-600 hover:text-white border-orange-600">
                        <a href="{{ route('posts.show', $report->post->id) }}">View Post</a>
                    </button>

                    <form action="/reports/destroy/{{ $report->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-black text-white px-6 py-1 mr-2 hover:bg-slate-700 rounded-md">Delete
                            Report</button>
                    </form>

                    <form action="{{ route('posts.destroy', $report->post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 text-white hover:bg-red-700 px-4 py-1 rounded-md">Delete
                            Post</button>
                    </form>
                </td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach


    </table>

    <x-footer />
</x-layout>

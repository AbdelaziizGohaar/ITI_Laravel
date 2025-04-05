<x-layout>

    <body class="bg-gray-100 font-sans leading-normal tracking-normal">

        <!-- Main Container -->
        <div class="max-w-3xl mx-auto mt-6">

            <!-- Post Info Card -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-4">
                <h2 class="text-lg font-semibold border-b pb-2 mb-4">Post Info</h2>
                <p><strong>Title</strong> {{ $post['title'] }}</p>
                <p class="mt-2"><strong>Description</strong> :-</p>
                <p class="text-gray-600">{{ $post['description'] }}</p>
            </div>

            <!-- Post Creator Info Card -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-semibold border-b pb-2 mb-4">Post Creator Info</h2>
                <p><strong>Name</strong> {{ $post['posted_by'] }}</p>
                <p><strong>Created At</strong> {{ $post['created_at'] }}</p>
            </div>

        </div>

    </body>

    </html>
</x-layout>
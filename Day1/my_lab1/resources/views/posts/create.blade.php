<x-layout>

    <body class="bg-gray-100 font-sans leading-normal tracking-normal">


        <!-- Form Container -->
        <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg mt-6 p-6">
            <form method="post" action="{{ route('posts.store') }}">
                <!-- Title Input -->
                @csrf
                <h2 class="text-lg font-semibold border-b pb-2 mb-4">Create New Post</h2>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Title</label>
                    <input type="text" name="title"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Description Input -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Description</label>
                    <textarea name="description"
                        class="w-full px-4 py-2 border rounded-lg h-24 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <!-- Post Creator Dropdown -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Post Creator</label>
                    <textarea name="creator"
                        class="w-full px-4 py-2 border rounded-lg h-24 focus:outline-none focus:ring-2 focus:ring-blue-500">
             </textarea>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                        Create
                    </button>
                </div>
            </form>
        </div>

    </body>

    </html>

</x-layout>
<x-layout>
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg mt-6 p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Post</h1>

        <form method="POST" action="{{ route('posts.update', $post['id']) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" name="title" value="{{ $post['title'] }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea name="description"
                    class="w-full px-4 py-2 border rounded-lg h-24 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $post['description'] }}</textarea>
            </div>

            <!-- Post Creator Select -->
            <div class="mb-6">
                <label for="creator" class="block text-sm font-medium text-gray-700 mb-1">Post Creator</label>
                <select name="post_creator" id="creator"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border bg-white">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{$user->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="flex justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Update Post
                </button>
                <a href="{{ route('posts.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    Cancel
                </a>
            </div>
        </form>
    </div>
    </body>

    </html>
</x-layout>
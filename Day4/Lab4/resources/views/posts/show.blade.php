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
                <p><strong>Name</strong> {{$post->user ? $post->user->name : 'Not Found'}}</p>
                <p><strong>Created At</strong> {{ $post->created_at->format('l, F jS Y \a\t h:i A') }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Post Image</label>
                {{-- <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg"> --}}
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                @isset($post->image_url)
                    <div class="mt-2">
                        <img src="{{ $post->image_url }}" alt="Current post image" class="h-32">
                        <p class="text-sm text-gray-500 mt-1">Current image</p>
                    </div>
                @endisset
            </div>

            <!-- Comments Section -->
            <div class="bg-white dark:bg-gray-800 rounded border p-4 mt-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Comments</h3>

                <form action="{{ route('comments.store') }}" method="POST" class="mb-6">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Comment Creator</label>
                        <select name="creator" class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:text-white">
                            @foreach(App\Models\User::all() as $user) <!-- Fetch users directly here -->
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <textarea name="comment" rows="3" class="w-full p-2 border rounded"
                        placeholder="Add your comment..." required></textarea>

                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Submit
                    </button>
                </form>

                @foreach ($post->comments as $comment)
                    <div class="border-t pt-2 mt-2">
                        <p class="text-gray-700 dark:text-gray-300">{{ $comment->comment }}</p>
                        <small class="text-gray-500">by {{ $comment->user->name }} |
                            {{ $comment->created_at->diffForHumans() }}</small>

                        <div class="mt-2 space-x-2">
                            <a href="{{ route('comments.edit', $comment->id) }}"
                                class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-sm">
                                Edit
                            </a>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-sm"
                                    onclick="return confirm('Are you sure you want to delete this comment?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-end mt-6">
                    <a href="{{ route('posts.index') }}"
                        class="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white font-medium rounded hover:bg-gray-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Back to All Posts
                    </a>
                </div>
            </div>
        </div>
    </body>
</x-layout>
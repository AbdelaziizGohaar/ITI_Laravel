<x-layout>
    <div class="max-w-3xl mx-auto space-y-6">
        <h2 class="text-lg font-medium text-gray-700 dark:text-gray-200 mb-4">Edit Comment</h2>

        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="post_id" value="{{ $comment->post_id }}">

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Comment Creator</label>
                <input type="text" value="{{ $comment->user->name }}"
                    class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:text-white" readonly>
                <input type="hidden" name="creator" value="{{ $comment->user_id }}">
            </div>

            <textarea name="comment" rows="3" class="w-full p-2 border rounded"
                placeholder="Update your comment...">{{ $comment->comment }}</textarea>

            <div class="flex justify-between mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Update
                </button>
                <a href="{{ route('posts.show', $comment->commentable->id) }}"
                    class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-700">
                    Back to Post
                </a>
            </div>
        </form>
    </div>
</x-layout>
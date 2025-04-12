<x-layout>
    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Header and Create Button -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">All Posts</h1>
        <a href="{{ route('posts.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            Create Post
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="border px-4 py-2 text-left">#</th>
                    <th class="border px-4 py-2 text-left">Title</th>
                    <th class="border px-4 py-2 text-left">Slug</th>
                    <th class="border px-4 py-2 text-left">Posted By</th>
                    <th class="border px-4 py-2 text-left">Created At</th>
                    <th class="border px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td class="border px-4 py-2">{{ $post->id }}</td>
                        <td class="border px-4 py-2">{{ $post->title }}</td>
                        <td class="px-4 py-2">{{ $post->slug }}</td>
                        {{-- <td class="border px-4 py-2">{{ $post->posted_by }}</td> --}}
                        <td class="px-4 py-2">{{ $post->user ? $post->user->name : 'Not Found' }}</td>
                        <td class="border px-4 py-2">{{ $post->created_at->format('M d, Y H:i') }}</td>
                        <td class="border px-4 py-2 space-x-2 flex gap-1">
                            <a href="{{ route('posts.show', $post->id) }}"
                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                    onclick="return confirm('Are you sure you want to delete this post?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-layout>
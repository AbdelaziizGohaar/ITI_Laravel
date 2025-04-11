<x-layout>

    <body class="bg-gray-100 font-sans leading-normal tracking-normal">
        <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg mt-6 p-6">
            <h1 class="text-2xl font-bold mb-6">Edit Post</h1>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('posts.update', $post) }}">
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div class="mb-6">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                    <input 
                        type="text" 
                        id="title"
                        name="title" 
                        value="{{ old('title', $post->title) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                    >
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Textarea -->
                <div class="mb-6">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                    <textarea 
                        id="description"
                        name="description"
                        rows="5"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                    >{{ old('description', $post->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Post Creator Select -->
                <div class="mb-8">
                    <label for="post_creator" class="block text-gray-700 font-bold mb-2">Post Creator</label>
                    <select 
                        id="post_creator"
                        name="post_creator"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('post_creator') border-red-500 @enderror"
                    >
                        @foreach ($users as $user)
                            <option 
                                value="{{ $user->id }}"
                                {{ $user->id == old('post_creator', $post->user_id) ? 'selected' : '' }}
                            >
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('post_creator')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Post Image</label>
                    <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg">
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

                <!-- Form Actions -->
                <div class="flex justify-between items-center pt-4 border-t">
                    <button 
                        type="submit" 
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition duration-200"
                    >
                        Update Post
                    </button>
                    <a 
                        href="{{ route('posts.index') }}" 
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition duration-200"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </body>
</x-layout>
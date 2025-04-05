<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ITI Blog - All Posts</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 text-white flex justify-between items-center">
        <div class="text-lg font-semibold">ITI Blog</div>
        <div><a href="{{ route('posts.index') }}" class="hover:underline">All Posts</a></div>
    </nav>




    <!-- Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        {{ $slot }}
    </div>
</body>

</html>
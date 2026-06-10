<x-layouts.admin>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-500">Welcome to the A1 Training admin panel.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Blog Posts</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Mongo\BlogPost::count() }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">SEO Pages</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Mongo\PageSEO::count() }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Users</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\User::count() }}</p>
        </div>
    </div>
</x-layouts.admin>

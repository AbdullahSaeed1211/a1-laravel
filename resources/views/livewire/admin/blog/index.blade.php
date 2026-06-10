<div>
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Blog Posts</h1>
        <a href="{{ route('admin.blogs.create') }}" class="bg-black text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 transition-colors">+ New Post</a>
    </div>

    @if(session('message'))
        <div class="bg-green-50 text-green-600 px-4 py-3 rounded-lg mb-6 text-sm">{{ session('message') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($blogs as $blog)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $blog['title'] ?? '' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $blog['slug'] ?? '' }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ ($blog['published'] ?? false) ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ ($blog['published'] ?? false) ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.blogs.edit', $blog['_id']) }}" class="text-accent hover:text-accent/80 text-sm font-medium mr-3">Edit</a>
                        <button wire:click="delete('{{ $blog['_id'] }}')" wire:confirm="Are you sure?" class="text-red-500 hover:text-red-700 text-sm font-medium">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $blogs->links() }}</div>
</div>

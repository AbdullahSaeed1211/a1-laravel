<div>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">SEO Manager</h1>
        <p class="text-gray-500 text-sm">Edit meta titles and descriptions for each page.</p>
    </div>

    @if(session('message'))
        <div class="bg-green-50 text-green-600 px-4 py-3 rounded-lg mb-6 text-sm">{{ session('message') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Page</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Title (EN)</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Title (ES)</th>
                    <th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($seoEntries as $entry)
                <tr class="hover:bg-gray-50">
                    @if($editingId === $entry->_id)
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $entry->slug }}</td>
                        <td class="px-6 py-4"><input wire:model="editTitle" class="w-full border border-gray-300 rounded px-2 py-1 text-sm"></td>
                        <td class="px-6 py-4"><input wire:model="editTitleEs" class="w-full border border-gray-300 rounded px-2 py-1 text-sm"></td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button wire:click="save" class="text-green-600 text-sm font-medium">Save</button>
                            <button wire:click="cancel" class="text-gray-500 text-sm">Cancel</button>
                        </td>
                    @else
                        <td class="px-6 py-4 text-sm text-gray-500 font-medium">{{ $entry->slug }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($entry->title, 50) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($entry->title_es, 50) }}</td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="edit('{{ $entry->_id }}')" class="text-accent hover:text-accent/80 text-sm font-medium">Edit</button>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $seoEntries->links() }}</div>
</div>

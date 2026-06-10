<div>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Edit Blog Post</h1>
        <a href="{{ route('admin.blogs.index') }}" class="text-sm text-accent hover:underline">&larr; Back</a>
    </div>

    <form wire:submit="save" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input wire:model="title" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
            <input wire:model="slug" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Author</label>
            <input wire:model="author" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
            <textarea wire:model="excerpt" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2"></textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Cover Image URL</label>
            <input wire:model="coverImage" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>
        <div class="flex items-center gap-2">
            <input wire:model="published" type="checkbox" id="published" class="rounded border-gray-300">
            <label for="published" class="text-sm text-gray-700">Published</label>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-black text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-gray-800">Update</button>
            <a href="{{ route('admin.blogs.index') }}" class="px-6 py-2 rounded-lg text-sm font-medium border border-gray-300 hover:bg-gray-50">Cancel</a>
        </div>
    </form>
</div>

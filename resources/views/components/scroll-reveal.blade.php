<div x-data="{ visible: false }" x-ref="el" x-intersect="visible = true" :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" class="transition-all duration-700 ease-out">
    {{ $slot }}
</div>

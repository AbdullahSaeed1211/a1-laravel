@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public>
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="text-center max-w-2xl">
            <div class="text-[150px] md:text-[200px] font-heading font-black text-accent/20 leading-none mb-4">404</div>
            <h1 class="text-white font-heading text-4xl md:text-6xl font-black uppercase tracking-tighter mb-6">
                {{ $isEs ? 'Página No Encontrada' : 'Page Not Found' }}
            </h1>
            <p class="text-white/40 text-lg mb-10 max-w-md mx-auto">
                {{ $isEs ? 'La página que buscas no existe o ha sido movida.' : 'The page you\'re looking for doesn\'t exist or has been moved.' }}
            </p>
            <a href="{{ $p }}/" class="inline-block bg-accent text-black px-10 py-4 rounded-full font-heading font-black text-lg uppercase tracking-widest hover:bg-white transition-all">
                {{ $isEs ? 'Volver al Inicio' : 'Back to Home' }}
            </a>
        </div>
    </div>
</x-layouts.public>

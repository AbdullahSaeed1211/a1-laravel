@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <div class="min-h-screen bg-white pb-24">
        <section class="bg-asphaltBlack text-white pt-20 pb-24 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
            <div class="max-w-7xl mx-auto px-4 relative z-10">
                <x-breadcrumbs :crumbs="[
                    ['label' => t('nav.about')],
                ]" />
                <div class="max-w-4xl">
                    <span class="bg-accent/10 text-accent border border-accent/30 px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-6 inline-block">{{ t('about_us') }}</span>
                    <h1 class="text-5xl md:text-7xl font-heading font-black text-white uppercase leading-none tracking-tight mb-6">
                        {{ t('elite_training') }}<br>
                        <span class="text-accent">{{ t('brought_to_you') }}</span>
                    </h1>
                    <p class="text-xl text-gray-400 font-medium leading-relaxed max-w-2xl">
                        {{ t('a1_training_group_is_nycs_1_inhome_and_mobile_personal_train') }}
                    </p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-2 bg-accent"></div>
        </section>

        <section class="max-w-5xl mx-auto px-4 -mt-10 relative z-20">
            <div class="grid grid-cols-3 gap-4">
                @php $stats = [
                    ['value' => '6', 'label' => t('expert_trainers')],
                    ['value' => '5.0', 'label' => 'Google Rating'],
                    ['value' => '7', 'label' => t('services')],
                ]; @endphp
                @foreach($stats as $s)
                <div class="bg-asphaltBlack rounded-2xl p-6 text-center">
                    <div class="text-4xl md:text-5xl font-heading font-black text-accent">{{ $s['value'] }}</div>
                    <div class="text-xs font-bold uppercase tracking-widest text-gray-400 mt-1">{{ $s['label'] }}</div>
                </div>
                @endforeach
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 py-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-5xl font-heading font-black uppercase text-asphaltBlack">{{ t('what_sets_us_apart') }}</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php $features = [
                    ['icon' => '<path d="M6 4h12M6 4v16M6 4H2M6 20h12M18 4v16M18 4h4M18 20h-4M6 8h12M6 12h8M6 16h6"/>', 'title' => 'Gym or Home', 'desc' => 'Train where you feel most comfortable. We come to you.'],
                    ['icon' => '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>', 'title' => 'Clinical Approach', 'desc' => 'Our team includes a Doctor of Physical Therapy.'],
                    ['icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>', 'title' => 'Partner Training', 'desc' => 'Train with a friend or partner for extra motivation.'],
                    ['icon' => '<circle cx="12" cy="8" r="6"/><path d="M12 14v6M9 17h6"/>', 'title' => 'Bilingual EN/ES', 'desc' => 'Full service in English and Spanish.'],
                ]; @endphp
                @foreach($features as $f)
                <div class="bg-lightGray rounded-2xl p-6 border-2 border-transparent hover:border-accent/30 transition-all group">
                    <div class="bg-asphaltBlack p-3 rounded-xl w-fit mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-accent" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $f['icon'] !!}</svg>
                    </div>
                    <h3 class="font-heading font-black uppercase text-asphaltBlack text-lg mb-2">{{ $f['title'] }}</h3>
                    <p class="text-gray-500 text-sm">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <section class="max-w-4xl mx-auto px-4">
            <div class="bg-asphaltBlack rounded-[3rem] p-12 text-white text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-80 h-80 bg-accent/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-center gap-1 mb-4">@for($s=0; $s<5; $s++)<svg class="w-5 h-5 fill-accent text-accent" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor</div>
                    <h2 class="text-3xl md:text-5xl font-heading font-black uppercase mb-4">{{ t('ready_to_start') }}</h2>
                    <a href="{{ $p }}/contact" class="inline-block bg-accent text-asphaltBlack px-8 py-4 rounded-xl font-heading font-black text-xl uppercase hover:bg-yellow-400 transition-all shadow-[0_0_30px_rgba(253,208,82,0.3)] border-b-4 border-asphaltBlack/20">
                        {{ t('book_free_consult') }}
                    </a>
                </div>
            </div>
        </section>

        <x-faq-accordion :faqs="load_faq('about')" title="{{ $isEs ? 'Preguntas Frecuentes' : 'Frequently Asked Questions' }}" :sectionClass="'max-w-3xl mx-auto px-4 py-24'" :headingClass="'text-3xl md:text-4xl font-heading font-black uppercase mb-8 text-center text-asphaltBlack'" :itemClass="'bg-lightGray border border-gray-200 rounded-2xl overflow-hidden'" :contentClass="'text-gray-600 leading-relaxed'" />
    </div>
</x-layouts.public>

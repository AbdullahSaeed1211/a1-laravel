@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <div class="bg-black min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-12 pt-28 md:pt-36">
            <x-breadcrumbs :crumbs="[
                ['label' => t('nav.trainers'), 'url' => url($p . '/trainers')],
                ['label' => $trainer['name']],
            ]" />

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24">
                <div class="relative">
                    @php
                        $slug = $trainer['slug'] ?? '';
                        $localImg = '/images/trainers/' . $slug . '.webp';
                        $img = file_exists(public_path($localImg)) ? $localImg : ($trainer['image'] ?? 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=800&h=1000&fit=crop');
                    @endphp
                    <div class="aspect-4/5 rounded-[50px] overflow-hidden border border-white/10 group shadow-2xl relative">
                        <img src="{{ $img }}" alt="{{ $trainer['name'] }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000">
                        <div class="absolute top-8 left-8">
                            <span class="bg-accent text-black px-6 py-2 rounded-full font-black uppercase text-[10px] tracking-widest shadow-2xl border-2 border-black/20">A1 Master Coach</span>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-8 justify-center">
                        <a href="https://www.instagram.com/a1traininggroup/" target="_blank" rel="noopener noreferrer" class="text-white/20 hover:text-accent font-black uppercase tracking-widest text-[9px] border border-white/10 px-4 py-2 rounded-lg transition-all">Instagram</a>
                        <a href="https://www.linkedin.com/in/a1-training-group-110905344/" target="_blank" rel="noopener noreferrer" class="text-white/20 hover:text-accent font-black uppercase tracking-widest text-[9px] border border-white/10 px-4 py-2 rounded-lg transition-all">Linkedin</a>
                    </div>
                </div>

                <div class="flex flex-col justify-center">
                    <span class="text-accent font-black tracking-[0.4em] text-xs mb-4 uppercase">{{ $isEs && !empty($trainer['titleEs']) ? $trainer['titleEs'] : $trainer['title'] }}</span>
                    <h1 class="text-white text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black tracking-tighter uppercase mb-10 leading-[1.1] accent-text-gradient italic inline-block py-1">{{ $trainer['name'] }}</h1>

                    <div class="mb-12">
                        <h3 class="text-white font-heading text-4xl mb-6 uppercase border-b-2 border-accent inline-block">{{ t('a_bit_about_me') }}</h3>
                        <div class="space-y-6">
                            @php $bio = $isEs && !empty($trainer['longBioEs']) ? $trainer['longBioEs'] : ($trainer['longBio'] ?? $trainer['bio']); @endphp
                            @foreach(explode("\n\n", $bio) as $para)
                            <p class="text-white/60 font-medium text-lg leading-relaxed italic">{{ $para }}</p>
                            @endforeach
                        </div>
                    </div>

                    @if(!empty($trainer['specialties']))
                    <div class="mb-12">
                        <h3 class="text-white font-heading text-2xl mb-4 uppercase">{{ t('specialties') }}</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(($isEs && !empty($trainer['specialtiesEs']) ? $trainer['specialtiesEs'] : $trainer['specialties']) as $s)
                            <span class="bg-accent/10 text-accent text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full border border-accent/20">{{ $s }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @php $relatedServices = [['slug' => 'personal-training', 'label' => $isEs ? 'Entrenamiento Personal' : 'Personal Training'], ['slug' => 'physical-therapy', 'label' => $isEs ? 'Terapia Física' : 'Physical Therapy'], ['slug' => 'boxing', 'label' => 'Boxing'], ['slug' => 'kettlebell', 'label' => $isEs ? 'Curso Kettlebell' : 'Kettlebell Course']]; @endphp
                    <div class="mb-12">
                        <h3 class="text-white font-black uppercase tracking-widest text-[10px] mb-4 opacity-30">{{ $isEs ? 'Servicios Relacionados' : 'Related Services' }}</h3>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($relatedServices as $rs)
                            <a href="{{ $p }}/services/{{ $rs['slug'] }}" class="bg-white/5 border border-white/10 rounded-2xl p-4 text-center hover:border-accent/40 transition-all">
                                <span class="text-white font-bold text-sm uppercase">{{ $rs['label'] }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="space-y-4">
                        <h3 class="text-white font-black uppercase tracking-widest text-[10px] mb-6 opacity-30">{{ t('booking_options') }}</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <a href="{{ $p }}/contact" class="group flex items-center justify-between p-6 rounded-3xl border border-white/10 bg-white/5 hover:border-accent hover:bg-accent/10 transition-all">
                                <span class="font-black uppercase tracking-tighter text-xl text-white group-hover:text-accent">{{ t('lets_train_at_the_studio') }}</span>
                                <span class="w-12 h-12 rounded-full bg-accent flex items-center justify-center text-black group-hover:translate-x-2 transition-transform">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </span>
                            </a>
                            <a href="{{ $p }}/contact" class="group flex items-center justify-between p-6 rounded-3xl border border-white/10 bg-white/5 hover:border-accent hover:bg-accent/10 transition-all">
                                <span class="font-black uppercase tracking-tighter text-xl text-white group-hover:text-accent">{{ t('bring_the_workout_to_me') }}</span>
                                <span class="w-12 h-12 rounded-full bg-accent flex items-center justify-center text-black group-hover:translate-x-2 transition-transform">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="py-24 px-4">
            <div class="max-w-7xl mx-auto bg-white rounded-[60px] p-12 md:p-24 text-center border-[12px] border-black shadow-2xl overflow-hidden relative">
                <div class="relative z-10">
                    <h2 class="text-black font-heading text-4xl md:text-6xl leading-none uppercase tracking-tighter mb-8">
                        {{ t('ready_for') }} <br> <span class="text-accent italic">{{ t('excellence') }}</span>
                    </h2>
                    <p class="text-black/60 font-bold uppercase tracking-widest text-xs mb-12">
                        {{ t('train_with_trainername_today') }}
                    </p>
                    <a href="{{ $p }}/contact" class="btn-accent px-12 py-6 rounded-full font-heading text-2xl tracking-wide shadow-2xl inline-block">
                        {{ t('get_your_first_session') }}
                    </a>
                </div>
                <div class="absolute -bottom-20 -right-20 text-gray-100 text-[300px] font-heading leading-none select-none opacity-40 pointer-events-none">A1</div>
            </div>
        </section>
    </div>
</x-layouts.public>

@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<section class="py-20 md:py-28 px-4 md:px-6 relative overflow-hidden scroll-reveal" x-intersect="$el.classList.add('is-visible')">
    {{-- Ambient background glows --}}
    <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-[300px] md:w-[600px] h-[300px] md:h-[600px] bg-accent/5 rounded-full blur-[100px] md:blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-10 w-[250px] md:w-[450px] h-[250px] md:h-[450px] bg-accent/3 rounded-full blur-[90px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10">
        <div class="bg-white/[0.03] border border-white/10 hover:border-accent/30 transition-all duration-700 rounded-[36px] md:rounded-[48px] p-6 sm:p-10 md:p-14 lg:p-16 relative overflow-hidden backdrop-blur-sm shadow-2xl">
            {{-- Subtle background watermark --}}
            <div class="absolute -bottom-10 -right-10 text-white/[0.02] text-[140px] sm:text-[180px] md:text-[240px] lg:text-[280px] font-heading font-black leading-none select-none pointer-events-none uppercase">STRENGTH</div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center relative z-10">
                
                {{-- Left Column: Portrait & Floating Badge --}}
                <div class="lg:col-span-5 relative mx-auto max-w-sm sm:max-w-md lg:max-w-none w-full">
                    <div class="aspect-[4/5] rounded-[28px] md:rounded-[36px] overflow-hidden border-2 md:border-4 border-white/10 shadow-2xl relative group bg-black">
                        <img src="/images/trainers/christella.jpg" alt="Christella - NYC Personal Trainer" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-90 group-hover:opacity-75 transition-opacity"></div>
                        
                        <div class="absolute bottom-6 left-6 right-6 z-10">
                            <span class="text-accent font-black uppercase text-[10px] md:text-xs tracking-widest block mb-1">
                                {{ $isEs ? 'Entrenadora Personal NYC' : 'NYC Personal Trainer' }}
                            </span>
                            <h3 class="text-white text-3xl md:text-4xl font-black tracking-tighter uppercase leading-none italic italic-fix group-hover:accent-text-gradient transition-all">
                                Christella
                            </h3>
                            <p class="text-white/60 text-xs mt-1 font-medium">Focus Personal Training Institute &bull; NASM</p>
                        </div>
                    </div>

                    {{-- Floating Specialty Badge --}}
                    <div class="absolute -bottom-4 md:-bottom-6 -right-2 md:-right-4 bg-accent text-black px-4 py-3 md:px-5 md:py-4 rounded-[20px] md:rounded-[24px] border-4 border-black shadow-2xl rotate-[3deg] hover:rotate-0 transition-transform duration-300">
                        <span class="block font-heading text-[10px] md:text-xs uppercase tracking-widest opacity-80 leading-none">
                            {{ $isEs ? 'Especialidad' : 'Specialization' }}
                        </span>
                        <span class="block font-heading text-lg md:text-xl font-black uppercase tracking-tight leading-tight mt-1">
                            {{ $isEs ? 'Fuerza Femenina' : "Women's Strength" }}
                        </span>
                    </div>
                </div>

                {{-- Right Column: Content & Story --}}
                <div class="lg:col-span-7 flex flex-col justify-center">
                    {{-- Eyebrow badge --}}
                    <div class="inline-flex items-center gap-2 bg-accent/10 border border-accent/30 text-accent px-4 py-1.5 rounded-full text-[11px] font-black uppercase tracking-widest mb-6 w-fit">
                        <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                        <span>{{ $isEs ? 'Entrenadora Destacada' : 'Featured Coach Spotlight' }}</span>
                    </div>

                    {{-- Section Heading --}}
                    <h2 class="text-white font-heading text-4xl sm:text-5xl md:text-6xl uppercase tracking-tighter leading-none mb-6">
                        {{ $isEs ? 'Conoce a' : 'Meet' }} <span class="accent-text-gradient italic italic-fix">Christella</span>
                    </h2>

                    {{-- Pull Quote / Hook (First paragraph) --}}
                    <div class="border-l-4 border-accent pl-5 py-1 mb-6">
                        <p class="text-lg sm:text-xl font-semibold text-white/95 leading-snug">
                            &ldquo;{{ $isEs ? 'Soy Christella, una entrenadora con sede en NYC a la que le apasiona ayudar a las mujeres a construir una fuerza real y duradera.' : "I'm Christella, an NYC-based trainer who's passionate about helping women build real, lasting strength." }}&rdquo;
                        </p>
                    </div>

                    {{-- Story Paragraphs --}}
                    <div class="space-y-4 text-white/70 text-sm sm:text-base leading-relaxed mb-8">
                        <p>
                            {{ $isEs 
                                ? 'Antes del fitness, pasé años en tecnología, donde lideré iniciativas de accesibilidad y proyectos interdisciplinarios. Esa experiencia me enseñó a descomponer problemas complejos y encontrar a las personas donde están, habilidades que aplico en cada sesión que entreno.'
                                : 'Before fitness, I spent years in tech, where I led accessibility initiatives and cross-functional projects. That experience taught me how to break down complex problems and meet people where they are, skills I bring into every session I coach.' }}
                        </p>
                        <p>
                            {{ $isEs
                                ? 'Soy graduada del Focus Personal Training Institute, donde estudié kinesiología, biomecánica y el sistema musculoesquelético, y actualmente estoy obteniendo mi certificación NASM. Mi enfoque es el entrenamiento de fuerza para mujeres, porque creo que volverse más fuerte cambia cómo te mueves en el mundo, no solo cómo te ves.'
                                : "I'm a graduate of the Focus Personal Training Institute, where I studied kinesiology, biomechanics, and the musculoskeletal system, and I'm currently working toward my NASM certification. My focus is on strength training for women, because I believe getting stronger changes how you move through the world, not just how you look." }}
                        </p>
                        <p>
                            {{ $isEs
                                ? 'Más allá de la programación y el entrenamiento, lo que más me importa es construir una comunidad en el gimnasio donde las mujeres se sientan respaldadas, valoradas y entusiasmadas de asistir. Si eso se parece al tipo de entrenamiento que buscas, me encantaría trabajar contigo.'
                                : "Outside of programming and coaching, I care most about building a gym community where women feel supported, seen, and excited to show up. If that sounds like the kind of training you're looking for, I'd love to work with you." }}
                        </p>
                    </div>

                    {{-- Badges / Credentials --}}
                    <div class="flex flex-wrap gap-2.5 sm:gap-3 mb-8">
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/5 border border-white/10 text-white/80 text-xs font-semibold">
                            <span class="text-accent">&check;</span> Focus Personal Training Institute
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/5 border border-white/10 text-white/80 text-xs font-semibold">
                            <span class="text-accent">&check;</span> {{ $isEs ? 'Kinesiología y Biomecánica' : 'Kinesiology & Biomechanics' }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/5 border border-white/10 text-white/80 text-xs font-semibold">
                            <span class="text-accent">&check;</span> {{ $isEs ? 'Certificación NASM en Curso' : 'NASM Certification (In Progress)' }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/5 border border-white/10 text-white/80 text-xs font-semibold">
                            <span class="text-accent">&check;</span> {{ $isEs ? 'Fuerza para Mujeres' : "Women's Strength Coaching" }}
                        </span>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                        <a href="{{ $p }}/contact" class="btn-accent px-8 py-4 rounded-full shadow-2xl flex items-center justify-center gap-3 hover:scale-105 transition-all group">
                            <span class="font-heading text-lg md:text-xl tracking-wider uppercase">
                                {{ $isEs ? 'Entrena Con Christella' : 'Train With Christella' }}
                            </span>
                            <span class="bg-black text-accent w-7 h-7 rounded-full flex items-center justify-center text-sm group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                        <a href="{{ $p }}/trainers" class="border border-white/20 hover:border-accent text-white/80 hover:text-white px-7 py-4 rounded-full font-heading text-base md:text-lg tracking-wider uppercase transition-all text-center">
                            {{ $isEs ? 'Ver Todos Los Entrenadores' : 'Explore All Coaches' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <div class="min-h-screen bg-white">
        <div class="bg-asphaltBlack text-white py-24 px-4 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url(/images/logo.avif); background-size: cover; background-position: center; filter: blur(20px);"></div>
            <div class="max-w-7xl mx-auto relative z-10 text-center">
                <x-breadcrumbs :crumbs="[['label' => t('nav.contact')]]" />
                <h1 class="text-5xl md:text-7xl font-heading font-black uppercase mb-6 tracking-tight">
                    {{ t('contact_us') }}
                </h1>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto font-medium">
                    {{ t('have_questions_about_our_services_or_need_help_were_here_to') }}
                </p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-2 bg-accent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-16 -mt-12 relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center text-accent mb-6">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <h3 class="font-heading text-2xl font-black text-asphaltBlack uppercase mb-2">{{ t('call_us') }}</h3>
                    <p class="text-gray-500 mb-4 text-sm font-medium">Mon-Sat 6AM - 9PM</p>
                    <a href="tel:+19177326520" class="text-2xl font-black text-accent hover:text-asphaltBlack transition-colors">(917) 732-6520</a>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center text-accent mb-6">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <h3 class="font-heading text-2xl font-black text-asphaltBlack uppercase mb-2">{{ t('service_area') }}</h3>
                    <p class="text-gray-500 mb-4 text-sm font-medium">{{ t('inhome_service_in_manhattan_and_beyond') }}</p>
                    <span class="text-lg font-bold text-gray-800">Manhattan, Brooklyn & The Hamptons</span>
                    <span class="text-sm text-gray-500 mt-1">598 Broadway, New York, NY 10012</span>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center text-accent mb-6">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <h3 class="font-heading text-2xl font-black text-asphaltBlack uppercase mb-2">{{ t('email_us') }}</h3>
                    <p class="text-gray-500 mb-4 text-sm font-medium">{{ t('response_within_24_hours') }}</p>
                    <a href="mailto:a1traininggroup@gmail.com" class="text-xl font-black text-accent hover:text-asphaltBlack transition-colors">a1traininggroup@gmail.com</a>
                </div>
            </div>

            <!-- Trainers strip (temporary) — compact, smaller photos -->
            @php $contactTrainers = array_values($trainers ?? load_content('trainers.json')); @endphp
            <div class="mt-12 bg-gray-50 rounded-3xl border border-gray-100 p-6 md:p-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-6">
                    <div>
                        <span class="text-accent font-black uppercase tracking-widest text-xs block">{{ $isEs ? 'Nuestro Equipo' : 'Meet Our Trainers' }}</span>
                        <h2 class="text-2xl md:text-3xl font-heading font-black uppercase tracking-tight text-asphaltBlack">{{ $isEs ? 'Entrenadores Disponibles' : 'Available Trainers' }}</h2>
                    </div>
                    <a href="{{ $p }}/trainers" class="text-xs font-black uppercase tracking-widest text-accent hover:text-asphaltBlack">{{ $isEs ? 'Ver Todos' : 'View All' }} &rarr;</a>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-4">
                    @foreach($contactTrainers as $trainer)
                    <a href="{{ $p }}/trainers/{{ $trainer['slug'] }}" class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:border-accent/50 hover:-translate-y-0.5 transition-all text-center p-3">
                        <div class="w-16 h-16 md:w-20 md:h-20 mx-auto rounded-full overflow-hidden border-2 border-gray-100 group-hover:border-accent/50">
                            <img src="{{ $trainer['image'] ?? '' }}" alt="{{ $trainer['name'] }}" class="w-full h-full object-cover object-top" loading="lazy">
                        </div>
                        <div class="mt-2 text-sm font-black text-asphaltBlack leading-tight">{{ $trainer['name'] }}</div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-gray-400 truncate">{{ $isEs && !empty($trainer['titleEs']) ? $trainer['titleEs'] : ($trainer['title'] ?? '') }}</div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Mindbody Appointments & Trainer Schedule Widget -->
            <div id="schedule" class="mt-16 bg-white rounded-3xl shadow-xl border border-gray-100 p-6 md:p-10 scroll-mt-24">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 pb-6 border-b border-gray-100 gap-4">
                    <div>
                        <span class="text-accent font-black uppercase tracking-widest text-xs mb-1 block">
                            {{ $isEs ? 'Horarios en Tiempo Real' : 'Trainer Schedules' }}
                        </span>
                        <h2 class="text-3xl md:text-5xl font-heading font-black uppercase tracking-tight text-asphaltBlack">
                            {{ $isEs ? 'Citas y Horarios de Entrenadores' : 'Trainer Schedules & Appointments' }}
                        </h2>
                        <p class="text-gray-500 mt-2 text-sm md:text-base max-w-2xl">
                            {{ $isEs ? 'Consulta la disponibilidad en vivo de nuestros entrenadores y reserva tu cita directamente.' : 'View real-time trainer availability and book your training session directly.' }}
                        </p>
                    </div>
                    <div class="shrink-0">
                        <script src="https://widgets.mindbodyonline.com/javascripts/healcode.js" type="text/javascript"></script>
                        <healcode-widget data-version="0.2" data-link-class="healcode-pricing-option-text-link" data-site-id="130594" data-mb-site-id="5749547" data-service-id="100038" data-bw-identity-site="true" data-type="pricing-link" data-inner-html="{{ $isEs ? 'Comprar Sesión' : 'Buy Now' }}" />
                    </div>
                </div>

                <!-- Mindbody Appointments widget begin -->
                <div class="mindbody-widget" data-widget-type="Appointments" data-widget-id="3568434ef8f"></div>
                <script async src="https://brandedweb.mindbodyonline.com/embed/widget.js"></script>
                <!-- Mindbody Appointments widget end -->
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mt-20">
                <div class="space-y-8">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-2xl border-4 border-white h-[400px] relative group">
                        <iframe src="https://www.google.com/maps?q=598+Broadway,+New+York,+NY+10012&output=embed"
                            width="100%" height="100%" style="border: 0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            title="A1 Training Group — 598 Broadway, New York, NY 10012"
                            class="grayscale group-hover:grayscale-0 transition-all duration-700"></iframe>
                    </div>
                    <p class="text-sm text-gray-500 font-medium">598 Broadway, New York, NY 10012 — {{ $isEs ? 'Manhattan, Brooklyn y The Hamptons' : 'Manhattan, Brooklyn & The Hamptons' }} · <a href="tel:+19177326520" class="text-accent font-bold">(917) 732-6520</a></p>

                    <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                        <div class="flex items-center gap-3 mb-6">
                            <svg class="w-6 h-6 text-accent" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            <h3 class="font-heading text-2xl font-black uppercase text-asphaltBlack">{{ t('common_questions') }}</h3>
                        </div>
                        <div class="space-y-4" x-data="{ openFaq: null }">
                            <x-faq-accordion :faqs="load_faq('contact')" :title="''" :sectionClass="''" :headingClass="'hidden'" :itemClass="'bg-white rounded-xl shadow-sm'" :contentClass="'text-gray-500 text-sm leading-relaxed'" />
                        </div>
                    </div>
                </div>

                <div class="bg-asphaltBlack text-white p-8 md:p-12 rounded-3xl shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-accent/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                    <h2 class="text-3xl font-heading font-black uppercase mb-2 relative z-10">{{ t('send_a_message') }}</h2>
                    <p class="text-gray-400 mb-8 relative z-10">{{ t('fill_out_the_form_below_and_well_get_back_to_you_shortly') }}</p>

                    <div class="relative z-10">
                        <iframe
                            src="https://links.mirchmedia.com/widget/form/2W6NCi9v18GuRLSC6jOJ"
                            style="width:100%;height:100%;min-height:806px;border:none;border-radius:4px"
                            id="inline-2W6NCi9v18GuRLSC6jOJ"
                            data-layout="{'id':'INLINE'}"
                            data-trigger-type="alwaysShow"
                            data-trigger-value=""
                            data-activation-type="alwaysActivated"
                            data-activation-value=""
                            data-deactivation-type="neverDeactivate"
                            data-deactivation-value=""
                            data-form-name="Form 0"
                            data-height="806"
                            data-layout-iframe-id="inline-2W6NCi9v18GuRLSC6jOJ"
                            data-form-id="2W6NCi9v18GuRLSC6jOJ"
                            title="Form 0"
                        >
                        </iframe>
                        <script src="https://links.mirchmedia.com/js/form_embed.js"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>

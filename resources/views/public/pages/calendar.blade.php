@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <section class="py-24 md:py-32 px-4 relative overflow-hidden pt-36">
        <div class="max-w-4xl mx-auto relative z-10">
            <h1 class="text-white font-heading text-4xl sm:text-5xl md:text-7xl tracking-tighter uppercase mb-6 leading-[1.1]">
                {{ t('class_schedule') }}
            </h1>
            <p class="text-white/40 text-lg max-w-2xl leading-relaxed mb-8">{{ $isEs
                ? 'A1 Training Group ofrece horarios flexibles que se adaptan a tu estilo de vida. Entrena por la mañana, tarde o noche — en nuestro estudio, en tu casa o virtualmente.'
                : 'A1 Training Group offers flexible scheduling to fit your lifestyle. Train in the morning, afternoon, or evening — at our studio, your home, or virtually.' }}</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <div class="bg-white/5 border border-white/10 rounded-[30px] p-8 text-center">
                    <div class="w-14 h-14 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-black font-heading text-2xl font-black">AM</span>
                    </div>
                    <h3 class="text-white font-heading text-xl font-black uppercase mb-2">{{ t('morning') }}</h3>
                    <p class="text-white/40 text-sm">{{ t('600_am_1200_pm') }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-[30px] p-8 text-center">
                    <div class="w-14 h-14 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-black font-heading text-2xl font-black">PM</span>
                    </div>
                    <h3 class="text-white font-heading text-xl font-black uppercase mb-2">{{ t('afternoon') }}</h3>
                    <p class="text-white/40 text-sm">{{ t('1200_pm_600_pm') }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-[30px] p-8 text-center">
                    <div class="w-14 h-14 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-black font-heading text-2xl font-black">PM</span>
                    </div>
                    <h3 class="text-white font-heading text-xl font-black uppercase mb-2">{{ t('evening') }}</h3>
                    <p class="text-white/40 text-sm">{{ t('600_pm_900_pm') }}</p>
                </div>
            </div>

            <!-- Mindbody Appointments & Trainer Schedule Widget -->
            <div class="mt-16 bg-white rounded-[30px] p-6 md:p-10 text-asphaltBlack shadow-2xl">
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

            <div class="mt-12 text-center">
                <a href="{{ $p }}/contact#schedule" class="inline-block bg-accent text-black px-10 py-4 rounded-full font-heading font-black text-lg uppercase tracking-widest hover:bg-white transition-all">{{ t('book_your_session') }}</a>
            </div>
        </div>
    </section>

    <x-faq-accordion :faqs="load_faq('calendar')" title="{{ $isEs ? 'Preguntas Frecuentes' : 'FAQs' }}" />
</x-layouts.public>

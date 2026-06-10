@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <section class="py-24 md:py-32 px-4 relative overflow-hidden pt-36">
        <div class="max-w-4xl mx-auto relative z-10">
            <h1 class="text-white font-heading text-4xl sm:text-5xl md:text-7xl tracking-tighter uppercase mb-6 leading-[1.1]">
                {{ t('renewals') }}
            </h1>
            <p class="text-white/40 text-lg max-w-2xl leading-relaxed mb-8">{{ $isEs
                ? '¿Listo para continuar tu viaje de fitness? Renueva tu paquete de sesiones y sigue progresando con A1 Training Group.'
                : 'Ready to continue your fitness journey? Renew your session package and keep progressing with A1 Training Group.' }}</p>
            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8 md:p-12 mt-8">
                <h2 class="text-white font-heading text-2xl md:text-3xl font-black uppercase mb-6">{{ t('renewal_options') }}</h2>
                <ul class="space-y-4">
                    <li class="flex items-start gap-4">
                        <span class="w-6 h-6 bg-accent rounded-full flex items-center justify-center shrink-0 mt-0.5"><span class="text-black text-xs font-black">1</span></span>
                        <div><span class="text-white font-bold block">{{ t('monthly_package') }}</span><span class="text-white/40 text-sm">{{ t('autorenew_each_month_with_the_same_trainer') }}</span></div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="w-6 h-6 bg-accent rounded-full flex items-center justify-center shrink-0 mt-0.5"><span class="text-black text-xs font-black">2</span></span>
                        <div><span class="text-white font-bold block">{{ t('session_pack_renewal') }}</span><span class="text-white/40 text-sm">{{ t('purchase_a_new_session_pack_when_you_run_out') }}</span></div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="w-6 h-6 bg-accent rounded-full flex items-center justify-center shrink-0 mt-0.5"><span class="text-black text-xs font-black">3</span></span>
                        <div><span class="text-white font-bold block">{{ t('service_upgrade') }}</span><span class="text-white/40 text-sm">{{ t('ready_to_try_something_new_switch_services_anytime') }}</span></div>
                    </li>
                </ul>
                <a href="{{ $p }}/contact" class="inline-block mt-8 bg-accent text-black px-8 py-4 rounded-full font-heading font-black uppercase tracking-widest text-sm hover:bg-white transition-all">{{ t('talk_to_us_about_renewal') }}</a>
            </div>
        </div>
    </section>
    <x-faq-accordion :faqs="load_faq('renewals')" title="{{ $isEs ? 'Preguntas Frecuentes' : 'FAQs' }}" />

    <x-sections.cta />
</x-layouts.public>

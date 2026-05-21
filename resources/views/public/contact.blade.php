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
                    <span class="text-lg font-bold text-gray-800">Manhattan, NYC</span>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 flex flex-col items-center text-center hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center text-accent mb-6">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <h3 class="font-heading text-2xl font-black text-asphaltBlack uppercase mb-2">{{ t('email_us') }}</h3>
                    <p class="text-gray-500 mb-4 text-sm font-medium">{{ t('response_within_24_hours') }}</p>
                    <a href="mailto:info@a1traininggroupllc.com" class="text-xl font-black text-accent hover:text-asphaltBlack transition-colors">info@a1traininggroupllc.com</a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mt-20">
                <div class="space-y-8">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-2xl border-4 border-white h-[400px] relative group">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.1678280628287!2d-73.9144349234857!3d40.701911971395804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25c0e0b0e0e0f%3A0x1d1d1d1d1d1d1d1d!2s322%20Grove%20St%2C%20Brooklyn%2C%20NY%2011237!5e0!3m2!1sen!2sus!4v1680000000000!5m2!1sen!2sus"
                            width="100%" height="100%" style="border: 0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            class="grayscale group-hover:grayscale-0 transition-all duration-700"></iframe>
                    </div>

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

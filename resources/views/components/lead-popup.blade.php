<div
    x-data="{ show: false }"
    x-init="
        setTimeout(() => show = true, 15000);
        window.addEventListener('scroll', () => {
            if (window.scrollY > document.documentElement.scrollHeight * 0.6) show = true;
        });
    "
    x-show="show"
    x-cloak
    class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
>
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="show = false"></div>
    <div class="relative bg-asphaltBlack rounded-3xl shadow-2xl max-w-lg w-full p-6 md:p-8 overflow-y-auto max-h-[90vh] border border-white/10">
        <button @click="show = false" class="absolute top-4 right-4 text-white/40 hover:text-white transition-colors z-10">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
        <h3 class="text-white font-heading text-2xl font-black uppercase mb-1 pr-8">{{ t('get_started_today') ?? 'Get Started Today' }}</h3>
        <p class="text-white/40 text-sm mb-6">{{ t('fill_out_the_form_below_and_well_get_back_to_you_shortly') ?? 'Fill out the form and we\'ll get back to you shortly' }}</p>
        <iframe
            src="https://links.mirchmedia.com/widget/form/2W6NCi9v18GuRLSC6jOJ"
            style="width:100%;border:none;border-radius:4px"
            id="popup-2W6NCi9v18GuRLSC6jOJ"
            data-layout="{'id':'INLINE'}"
            data-trigger-type="alwaysShow"
            data-trigger-value=""
            data-activation-type="alwaysActivated"
            data-activation-value=""
            data-deactivation-type="neverDeactivate"
            data-deactivation-value=""
            data-form-name="Form 0"
            data-height="650"
            data-layout-iframe-id="popup-2W6NCi9v18GuRLSC6jOJ"
            data-form-id="2W6NCi9v18GuRLSC6jOJ"
            title="Form 0"
        >
        </iframe>
        <script src="https://links.mirchmedia.com/js/form_embed.js"></script>
    </div>
</div>

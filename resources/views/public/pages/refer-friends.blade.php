@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <section class="py-24 md:py-32 px-4 relative overflow-hidden pt-36">
        <div class="max-w-5xl mx-auto relative z-10 text-center">
            <x-breadcrumbs :crumbs="[['label' => $isEs ? 'Referir Amigos' : 'Refer Friends']]" />
            <h1 class="text-white font-heading text-4xl sm:text-5xl md:text-7xl lg:text-8xl tracking-tighter uppercase mb-6 leading-[1.1]">
                {{ t('earn_100') }}<br><span class="text-accent italic">{{ t('for_each_friend_you_refer') }}</span>
            </h1>
            <p class="text-white/40 text-lg max-w-2xl mx-auto leading-relaxed mb-8">{{ $isEs
                ? 'Comparte el amor por A1 Training Group con tus amigos y familiares. Cuando se inscriban, ambos reciben recompensas.'
                : 'Share the love for A1 Training Group with your friends and family. When they sign up, you both get rewarded.' }}</p>
        </div>
    </section>

    <section class="px-4 pb-16">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-accent p-8 md:p-12 rounded-[30px]">
                <h3 class="text-black font-heading text-3xl font-black uppercase mb-4">{{ t('for_your_friend') }}</h3>
                <p class="text-black/60 text-lg mb-6">{{ t('15_off_their_first_billing_cycle_when_they_sign_up_using_you') }}</p>
                <p class="text-black/40 text-sm">{{ t('they_try_a1_at_a_discount_you_earn_credit_everyone_wins') }}</p>
            </div>
            <div class="bg-white/5 border border-white/10 p-8 md:p-12 rounded-[30px]">
                <h3 class="text-white font-heading text-3xl font-black uppercase mb-4">{{ t('for_you') }}</h3>
                <p class="text-white/40 text-lg mb-6">{{ t('100_off_your_next_bill_for_every_friend_who_signs_up_and_com') }}</p>
                <p class="text-white/20 text-sm">{{ t('no_limit_refer_as_many_friends_as_you_like') }}</p>
            </div>
        </div>
    </section>

    <section class="px-4 pb-24">
        <div class="max-w-3xl mx-auto bg-white/5 border border-white/10 rounded-[30px] p-8 md:p-12 text-center">
            <h2 class="text-white font-heading text-2xl font-black uppercase mb-4">{{ t('how_it_works') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div><span class="text-accent font-heading text-4xl font-black block mb-2">1</span><p class="text-white/40 text-sm">{{ t('share_your_link') }}</p></div>
                <div><span class="text-accent font-heading text-4xl font-black block mb-2">2</span><p class="text-white/40 text-sm">{{ t('they_sign_up') }}</p></div>
                <div><span class="text-accent font-heading text-4xl font-black block mb-2">3</span><p class="text-white/40 text-sm">{{ t('you_both_earn') }}</p></div>
            </div>
            <a href="{{ $p }}/contact" class="inline-block mt-8 bg-accent text-black px-10 py-4 rounded-full font-heading font-black text-lg uppercase tracking-widest hover:bg-white transition-all">{{ t('start_referring') }}</a>
        </div>
    </section>

    <x-faq-accordion :faqs="load_faq('refer-friends')" title="{{ $isEs ? 'Preguntas Frecuentes' : 'FAQs' }}" />

    <x-sections.cta />
</x-layouts.public>

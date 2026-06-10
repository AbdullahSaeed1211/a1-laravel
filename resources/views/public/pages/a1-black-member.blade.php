@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <section class="py-24 md:py-32 px-4 relative overflow-hidden pt-36">
        <div class="max-w-5xl mx-auto relative z-10 text-center">
            <x-breadcrumbs :crumbs="[['label' => 'A1 Black']]" />
            <span class="text-accent font-black tracking-[0.3em] text-xs uppercase">{{ t('rewards_program') }}</span>
            <h1 class="text-white font-heading text-5xl md:text-8xl tracking-tighter uppercase mt-6 mb-6 leading-none">{{ t('earn_points') }}<br><span class="text-accent italic">{{ t('get_rewards') }}</span></h1>
            <p class="text-white/40 text-lg max-w-2xl mx-auto leading-relaxed">{{ $isEs
                ? 'El programa A1 Black Member recompensa tu dedicación. Gana puntos por cada dólar que gastas y canjéalos por descuentos exclusivos.'
                : 'The A1 Black Member program rewards your dedication. Earn points for every dollar you spend and redeem them for exclusive discounts.' }}</p>
        </div>
    </section>

    <section class="px-4 pb-8">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8 md:p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-accent flex items-center justify-center mx-auto mb-6">
                    <span class="text-black font-heading text-3xl font-black">1</span>
                </div>
                <h3 class="text-white font-heading text-2xl font-black uppercase mb-4">{{ t('sign_up') }}</h3>
                <p class="text-white/40 text-sm">{{ t('join_a1_black_member_for_free_no_membership_cost_just_benefi') }}</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8 md:p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-accent flex items-center justify-center mx-auto mb-6">
                    <span class="text-black font-heading text-3xl font-black">2</span>
                </div>
                <h3 class="text-white font-heading text-2xl font-black uppercase mb-4">{{ t('earn_points_1') }}</h3>
                <p class="text-white/40 text-sm">{{ t('earn_1_point_for_every_1_you_spend_on_training_sessions_phys') }}</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8 md:p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-accent flex items-center justify-center mx-auto mb-6">
                    <span class="text-black font-heading text-3xl font-black">3</span>
                </div>
                <h3 class="text-white font-heading text-2xl font-black uppercase mb-4">{{ t('redeem') }}</h3>
                <p class="text-white/40 text-sm">{{ t('5_points_10_off_your_next_purchase_stack_and_redeem_whenever') }}</p>
            </div>
        </div>
    </section>

    <section class="px-4 pb-24">
        <div class="max-w-3xl mx-auto bg-accent rounded-[30px] p-8 md:p-12 text-center">
            <h2 class="text-black font-heading text-3xl font-black uppercase mb-4">{{ t('terms') }}</h2>
            <ul class="text-black/60 text-sm space-y-2 text-left max-w-md mx-auto">
                <li class="flex items-start gap-2"><span class="text-black font-black">•</span> {{ t('valid_on_all_paid_a1_training_group_services') }}</li>
                <li class="flex items-start gap-2"><span class="text-black font-black">•</span> {{ t('points_never_expire_while_membership_is_active') }}</li>
                <li class="flex items-start gap-2"><span class="text-black font-black">•</span> {{ t('cannot_be_combined_with_other_promotions') }}</li>
            </ul>
        </div>
    </section>

    <x-faq-accordion :faqs="load_faq('a1-black-member')" title="{{ $isEs ? 'Preguntas Frecuentes' : 'FAQs' }}" />

    <x-sections.cta />
</x-layouts.public>

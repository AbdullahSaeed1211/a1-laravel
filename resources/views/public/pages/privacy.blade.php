@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <main class="min-h-screen bg-white py-20">
        <div class="max-w-4xl mx-auto px-4">
            <x-breadcrumbs :crumbs="[['label' => t('privacy_policy')]]" />
            <h1 class="text-4xl font-heading font-black uppercase text-asphaltBlack mb-6">{{ t('privacy_policy') }}</h1>
            <p class="text-gray-600 mb-4">{{ t('we_collect_contact_information_you_submit_through_forms_to_r') }}</p>
            <p class="text-gray-600 mb-4">{{ t('we_do_not_sell_your_personal_information_we_may_share_data_w') }}</p>
            <p class="text-gray-600">{{ t('for_privacy_questions_contact_us_at_infoa1traininggroupllcco') }}</p>
        </div>
    </main>
</x-layouts.public>

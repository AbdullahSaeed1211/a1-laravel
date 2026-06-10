@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <main class="min-h-screen bg-white py-20">
        <div class="max-w-4xl mx-auto px-4">
            <x-breadcrumbs :crumbs="[['label' => t('terms_of_service')]]" />
            <h1 class="text-4xl font-heading font-black uppercase text-asphaltBlack mb-6">{{ t('terms_of_service') }}</h1>
            <p class="text-gray-600 mb-4">{{ t('by_using_this_website_you_agree_to_these_terms_content_is_pr') }}</p>
            <p class="text-gray-600 mb-4">{{ t('enrollment_and_payments_are_subject_to_course_availability_a') }}</p>
            <p class="text-gray-600">{{ t('for_support_contact_us_at_888_8722504_or_infoa1traininggroup') }}</p>
        </div>
    </main>
</x-layouts.public>

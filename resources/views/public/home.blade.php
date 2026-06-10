<x-layouts.public :meta="$meta ?? []">
    <x-sections.hero />
    <x-sections.booking :trainers="$trainers" :services="$services" />
    <x-sections.about />
    <x-sections.quote />
    <x-sections.services :services="$services" />
    <x-sections.trainers :trainers="$trainers" />
    <x-sections.brands />
    <x-sections.reviews />
    <x-sections.cta />
</x-layouts.public>

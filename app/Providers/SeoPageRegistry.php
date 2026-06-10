<?php

namespace App\Providers;

class SeoPageRegistry
{
    public static function getPages(): array
    {
        return [
            ['key' => 'home', 'label' => 'Homepage', 'routeName' => 'home'],
            ['key' => 'about', 'label' => 'About', 'routeName' => 'about'],
            ['key' => 'trainers', 'label' => 'Trainers', 'routeName' => 'trainers.index'],
            ['key' => 'services', 'label' => 'Services', 'routeName' => 'services.index'],
            ['key' => 'blog', 'label' => 'Blog', 'routeName' => 'blog.index'],
            ['key' => 'a1-black-member', 'label' => 'A1 Black Member', 'routeName' => 'a1-black-member'],
            ['key' => 'refer-friends', 'label' => 'Refer Friends', 'routeName' => 'refer-friends'],
            ['key' => 'reviews', 'label' => 'Reviews', 'routeName' => 'reviews'],
            ['key' => 'contact', 'label' => 'Contact', 'routeName' => 'contact'],
            ['key' => 'privacy', 'label' => 'Privacy Policy', 'routeName' => 'privacy'],
            ['key' => 'terms', 'label' => 'Terms of Service', 'routeName' => 'terms'],
            ['key' => 'calendar', 'label' => 'Calendar', 'routeName' => 'calendar'],
            ['key' => 'renewals', 'label' => 'Renewals', 'routeName' => 'renewals'],
        ];
    }
}

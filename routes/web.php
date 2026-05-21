<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Public\BlogController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\Public\ServiceController;
use App\Http\Controllers\Public\ServiceController as Svc;
use App\Http\Controllers\Public\SitemapController;
use App\Http\Controllers\Public\TrainerController;
use App\Livewire\Admin\Blog\Create;
use App\Livewire\Admin\Blog\Edit;
use App\Livewire\Admin\Blog\Index;
// ─── Wix legacy pages (outside locale middleware) ───
// These serve the same content as canonical pages but preserve the Wix URL
use App\Services\SEOService;
use Illuminate\Support\Facades\Route;

$canonical = fn ($url) => ['canonical' => url($url)];

Route::get('/privacy-policy', function () use ($canonical) {
    return view('public.pages.privacy', ['meta' => array_merge(SEOService::forPage('privacy', app()->getLocale()), $canonical('privacy'))]);
});
Route::get('/terms-and-conditions', function () use ($canonical) {
    return view('public.pages.terms', ['meta' => array_merge(SEOService::forPage('terms', app()->getLocale()), $canonical('terms'))]);
});
Route::get('/about-9', function () use ($canonical) {
    return view('public.pages.about', ['meta' => array_merge(SEOService::forPage('about', app()->getLocale()), $canonical('about'))]);
});
Route::get('/testimonials', function () use ($canonical) {
    return view('public.pages.reviews', ['meta' => array_merge(SEOService::forPage('reviews', app()->getLocale()), $canonical('reviews'))]);
});
Route::get('/what-sets-us-apart', function () use ($canonical) {
    return view('public.pages.about', ['meta' => array_merge(SEOService::forPage('about', app()->getLocale()), $canonical('about'))]);
});
Route::get('/referral', function () use ($canonical) {
    return view('public.pages.refer-friends', ['meta' => array_merge(SEOService::forPage('refer-friends', app()->getLocale()), $canonical('refer-friends'))]);
});
Route::get('/loyalty', function () use ($canonical) {
    return view('public.pages.a1-black-member', ['meta' => array_merge(SEOService::forPage('a1-black-member', app()->getLocale()), $canonical('a1-black-member'))]);
});
Route::get('/personal-training-packages', fn () => app(Svc::class)->show('personal-training'));
Route::get('/boxing', fn () => app(Svc::class)->show('boxing'));
// Blog posts: keep as redirect since slugs differ between Wix and our blog
Route::redirect('/post/{slug}', '/blog/{slug}', 301);

// Wix service sub-pages (deep links → redirect to canonical)
Route::redirect('/personal-training-at-the-studio', '/services/personal-training/studio', 301);
Route::redirect('/complementary-home-gym-training-session', '/services/personal-training/in-home', 301);
Route::redirect('/complementary-home-gym-training-session-1', '/services/personal-training/in-home', 301);
Route::redirect('/physical-therapy-at-the-studio', '/services/physical-therapy/studio', 301);
Route::redirect('/studio-physical-therapy-consultation', '/services/physical-therapy/consult-studio', 301);

// Wix internal/action pages (redirect to relevant page)
Route::redirect('/book-online', '/services/consultations', 301);
Route::redirect('/book-a-consult', '/services/consultations', 301);
Route::redirect('/pre-contact-form', '/contact', 301);
Route::redirect('/form-submitted', '/', 301);
Route::redirect('/payment-request-page', '/services', 301);
Route::redirect('/pricing-plans/list', '/services', 301);
Route::redirect('/services-4', '/services', 301);
Route::redirect('/blank-1', '/', 301);
Route::redirect('/blank-2', '/', 301);
Route::redirect('/privacy-policy-1', '/privacy', 301);

// Wix copy-of* duplicates (redirect to canonical)
Route::redirect('/copy-of-home', '/', 301);
Route::redirect('/copy-of-coach-wei', '/trainers/wei', 301);
Route::redirect('/copy-of-coach-kate', '/trainers/kate', 301);
Route::redirect('/copy-of-coach-jamie', '/trainers/jamie', 301);
Route::redirect('/copy-of-coach-phillip', '/trainers/phillip', 301);
Route::redirect('/copy-of-coach-abby', '/trainers/abby', 301);
Route::redirect('/copy-of-personal-training-at-the-studio', '/services/personal-training/studio', 301);
Route::redirect('/copy-of-physical-therapy-at-the-studio', '/services/physical-therapy/studio', 301);
Route::redirect('/copy-of-physical-therapy-remote', '/services/physical-therapy/in-home', 301);
Route::redirect('/copy-of-message-therapy-at-the-studio', '/services/massage-therapy/studio', 301);
Route::redirect('/copy-of-message-therapy-remote', '/services/massage-therapy/in-home', 301);
Route::redirect('/copy-of-kettlebell-course-remote', '/services/kettlebell/course', 301);
Route::redirect('/copy-of-boxing-training-at-the-studio', '/services/boxing/studio', 301);
Route::redirect('/copy-of-boxing-studio', '/services/boxing/studio', 301);
Route::redirect('/coach-wei', '/trainers/wei', 301);
Route::redirect('/coach-kate', '/trainers/kate', 301);
Route::redirect('/coach-jamie', '/trainers/jamie', 301);
Route::redirect('/coach-phillip', '/trainers/phillip', 301);
Route::redirect('/coach-abby', '/trainers/abby', 301);

// ─── /en redirects for SEO (301 → root) ───
Route::redirect('/en', '/', 301);
Route::get('/en/{any}', fn ($any) => redirect('/'.$any, 301))->where('any', '.*');

// ─── Health check (no middleware) ───
Route::get('/health', function () {
    $locale = app()->getLocale();
    $checks = [
        'app_key' => env('APP_KEY') ? 'set' : 'MISSING',
        'env' => app()->environment(),
        'locale' => $locale,
        'lang_file_exists' => file_exists(lang_path("{$locale}.json")) ? 'yes' : 'MISSING',
        'lang_file_path' => lang_path("{$locale}.json"),
        'nav_services_translation' => t('nav.services'),
        'railway_edge' => $_SERVER['HTTP_X_RAILWAY_EDGE'] ?? 'not set',
        'app_url' => env('APP_URL', 'not set'),
        'session_domain' => config('session.domain'),
        'asset_url' => config('app.asset_url'),
        'storage_writable' => is_writable(storage_path()),
        'views_writable' => is_writable(storage_path('framework/views')),
        'db_default' => config('database.default'),
        'php_version' => PHP_VERSION,
        'ext_mongodb' => extension_loaded('mongodb') ? 'loaded' : 'missing',
    ];

    try {
        view('welcome')->render();
        $checks['view_rendered'] = true;
    } catch (Throwable $e) {
        $checks['view_error'] = $e->getMessage();
    }

    return response()->json($checks);
});

Route::middleware(['locale', 'cacheResponse'])->group(function () {

    // English routes (with response cache for static pages)
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/trainers', [TrainerController::class, 'index'])->name('trainers.index');
    Route::get('/trainers/{slug}', [TrainerController::class, 'show'])->name('trainers.show');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('/services/{slug}/{sub}', [ServiceController::class, 'showSub'])->name('services.sub');
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/a1-black-member', [PageController::class, 'a1BlackMember'])->name('a1-black-member');
    Route::get('/refer-friends', [PageController::class, 'referFriends'])->name('refer-friends');
    Route::get('/reviews', [PageController::class, 'reviews'])->name('reviews');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/api/contact', [ContactController::class, 'submit'])->name('contact.submit');
    Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [PageController::class, 'terms'])->name('terms');
    Route::get('/calendar', [PageController::class, 'calendar'])->name('calendar');
    Route::get('/renewals', [PageController::class, 'renewals'])->name('renewals');

    // Sitemap
    Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
    Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

    // Spanish routes
    Route::prefix('es')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('es.home');
        Route::get('/about', [PageController::class, 'about'])->name('es.about');
        Route::get('/trainers', [TrainerController::class, 'index'])->name('es.trainers.index');
        Route::get('/trainers/{slug}', [TrainerController::class, 'show'])->name('es.trainers.show');
        Route::get('/services', [ServiceController::class, 'index'])->name('es.services.index');
        Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('es.services.show');
        Route::get('/services/{slug}/{sub}', [ServiceController::class, 'showSub'])->name('es.services.sub');
        Route::get('/blog', [BlogController::class, 'index'])->name('es.blog.index');
        Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('es.blog.show');
        Route::get('/a1-black-member', [PageController::class, 'a1BlackMember'])->name('es.a1-black-member');
        Route::get('/refer-friends', [PageController::class, 'referFriends'])->name('es.refer-friends');
        Route::get('/reviews', [PageController::class, 'reviews'])->name('es.reviews');
        Route::get('/contact', [ContactController::class, 'index'])->name('es.contact');
        Route::post('/api/contact', [ContactController::class, 'submit'])->name('es.contact.submit');
        Route::get('/privacy', [PageController::class, 'privacy'])->name('es.privacy');
        Route::get('/terms', [PageController::class, 'terms'])->name('es.terms');
        Route::get('/calendar', [PageController::class, 'calendar'])->name('es.calendar');
        Route::get('/renewals', [PageController::class, 'renewals'])->name('es.renewals');

    });

    // Admin routes
    Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/blogs', Index::class)->name('admin.blogs.index');
        Route::get('/blogs/create', Create::class)->name('admin.blogs.create');
        Route::get('/blogs/{id}/edit', Edit::class)->name('admin.blogs.edit');
        Route::get('/seo', App\Livewire\Admin\Seo\Index::class)->name('admin.seo.index');
    });

});

require __DIR__.'/auth.php';

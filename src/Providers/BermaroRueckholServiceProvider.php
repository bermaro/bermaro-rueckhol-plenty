<?php

namespace BermaroRueckhol\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Modules\Webshop\Consent\Contracts\ConsentRepositoryContract;

/**
 * Registriert den Eintrag "Rückhol-System" im Cookie-Banner (technische Gruppe "tracking",
 * im Banner der Shops als "Statistik" angezeigt).
 * Das Skript läuft im Shop nur, wenn der Besucher hier zugestimmt hat.
 */
class BermaroRueckholServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot(ConsentRepositoryContract $consentRepository)
    {
        $consentRepository->registerConsent(
            'rueckhol',
            'Rückhol-System',
            [
                'description' => 'Merkt sich Ihren Warenkorb und angesehene Artikel, um Ihnen beim Verlassen der Seite Hilfe oder einen Gutschein anzubieten und Sie auf Wunsch an Ihren Warenkorb zu erinnern.',
                'provider'    => 'BERMARO GmbH, Georg-Stöckel-Str. 10, 92637 Weiden',
                'lifespan'    => 'Dauerhaft (bis zum Löschen der Browserdaten)',
                // Datenschutzerklärung im Ceres-Shop liegt unter /privacy-policy (19.11.2026: /datenschutz ergab in B2C eine 404-Seite)
                'policyUrl'   => function () {
                    return '/privacy-policy';
                },
                'group'       => 'tracking',
                'necessary'   => false,
                'isOptOut'    => false,
                'cookieNames' => ['rh_vid', 'rh_nl_status', 'rh_nl_pause']
            ]
        );
    }
}

<?php

namespace BermaroRueckhol\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Modules\Webshop\Consent\Contracts\ConsentRepositoryContract;

/**
 * Registriert den Eintrag "Rückhol-System" im Cookie-Banner (Gruppe "Tracking").
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
                'policyUrl'   => function () {
                    return '/datenschutz';
                },
                'group'       => 'tracking',
                'necessary'   => false,
                'isOptOut'    => false,
                'cookieNames' => ['rh_vid', 'rh_nl_status', 'rh_nl_pause']
            ]
        );
    }
}

<?php

namespace BermaroRueckhol\Providers;

use Plenty\Plugin\ConfigRepository;
use Plenty\Plugin\Templates\Twig;

/**
 * Gibt das Skript-Tag des Rückhol-Systems im Shop aus (Container "Script loader: After scripts loaded").
 * Ohne Shop-ID oder bei ausgeschaltetem Schalter wird nichts ausgegeben.
 */
class RueckholSkript
{
    public function call(Twig $twig, ConfigRepository $config)
    {
        $aktiv = $config->get('BermaroRueckhol.aktiv', 'true');
        $server = rtrim((string)$config->get('BermaroRueckhol.server', 'https://bermaro-rueckhol-55m3uymmla-ey.a.run.app'), '/');
        $mandant = preg_replace('/[^a-z0-9-]/', '', (string)$config->get('BermaroRueckhol.mandant', ''));

        if (!in_array($aktiv, ['true', '1', 1, true], true)) {
            return '';
        }
        if ($server === '' || $mandant === '') {
            return '';
        }

        return $twig->render('BermaroRueckhol::Skript', [
            'skriptUrl' => $server . '/s/' . $mandant . '.js'
        ]);
    }
}

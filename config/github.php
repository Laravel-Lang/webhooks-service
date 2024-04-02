<?php

declare(strict_types=1);

/*
 * This file is part of Laravel GitHub.
 *
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use LaravelLang\LocaleList\Locale;

return [
    'default' => 'main',

    'connections' => [
        'main' => [
            'method' => 'token',
            'token'  => env('GITHUB_TOKEN'),
        ],
    ],

    'cache' => [
        'main' => [
            'driver'    => 'illuminate',
            'connector' => null,
        ],
    ],

    'identifiers' => [
        'dependabot' => 49699333,
        'actions'    => 41898282,
    ],

    'webhooks' => [
        'github.assign'      => ['pull_request'],
        'github.dependabot'  => ['pull_request'],
        'github.release'     => ['release'],
        'github.translation' => ['pull_request'],
    ],

    'pull_request' => [
        'auto_merge' => [
            'code-style',
            'locales',
            'machine',
            'statuses',
            'sync',
        ],
    ],

    'labels' => [
        'create' => [
            'added'          => ['0e8a16', 'Change that adds something'],
            'bug'            => ['d93f0b', 'Something isn\'t working'],
            'code-style'     => ['d93f0b', 'Marks changes related to code style'],
            'dependabot'     => ['1f2328', 'Changes suggested by Dependabot'],
            'dependencies'   => ['0366d6', 'Updating dependencies'],
            'feature'        => ['a2eeef', 'New feature or request'],
            'fix'            => ['d4c5f9', 'Functionality or something fix'],
            'locales'        => ['ededed', 'Adding new localizations'],
            'machine'        => ['fef2c0', 'Machine translation of text'],
            'major'          => ['1d76db', 'Breaking changes'],
            'minor'          => ['a0600b', 'Non-critical changes to the project structure'],
            'removed'        => ['fbca04', 'Removed functionality or content'],
            'security'       => ['d1260f', 'Security violation detected'],
            'skip-changelog' => ['dfe4ed', 'Hides from changelog'],
            'statuses'       => ['ededed', 'Updating localization statuses'],
            'sync'           => ['ededed', 'Actualization of translation keys'],
        ],
        'delete' => [
            'documentation',
            'duplicate',
            'enhancement',
            'fixed',
            'fixing',
            'good first issue',
            'help wanted',
            'invalid',
            'question',
            'wontfix',
        ],
    ],

    'team' => [
        Locale::Afrikaans->value          => [],
        Locale::Albanian->value           => [],
        Locale::Amharic->value            => [],
        Locale::Arabic->value             => ['Khuthaily', 'mohamedsabil83'],
        Locale::Armenian->value           => [],
        Locale::Assamese->value           => [],
        Locale::Azerbaijani->value        => ['slvler'],
        Locale::Bambara->value            => [],
        Locale::Basque->value             => [],
        Locale::Belarusian->value         => [],
        Locale::Bengali->value            => ['arman-arif'],
        Locale::Bhojpuri->value           => [],
        Locale::Bosnian->value            => ['jure-knezovic'],
        Locale::Bulgarian->value          => [],
        Locale::Catalan->value            => [],
        Locale::Cebuano->value            => [],
        Locale::CentralKhmer->value       => [],
        Locale::Chinese->value            => ['overtrue'],
        Locale::ChineseHongKong->value    => ['overtrue'],
        Locale::ChineseT->value           => ['overtrue'],
        Locale::ChineseT->value           => [],
        Locale::Croatian->value           => ['jure-knezovic'],
        Locale::Czech->value              => [],
        Locale::Danish->value             => ['jensstigaard'],
        Locale::Dogri->value              => [],
        Locale::Dutch->value              => ['WhereIsLucas', 'chillbram'],
        Locale::English->value            => [],
        Locale::Esperanto->value          => [],
        Locale::Estonian->value           => [],
        Locale::Ewe->value                => [],
        Locale::Finnish->value            => [],
        Locale::French->value             => ['caouecs', 'WhereIsLucas'],
        Locale::Frisian->value            => [],
        Locale::Galician->value           => [],
        Locale::Georgian->value           => [],
        Locale::German->value             => ['sotten', 'WhereIsLucas'],
        Locale::GermanSwitzerland->value  => ['sotten'],
        Locale::Greek->value              => ['michaelkonstantinou'],
        Locale::Gujarati->value           => [],
        Locale::Hausa->value              => [],
        Locale::Hawaiian->value           => [],
        Locale::Hebrew->value             => [],
        Locale::Hindi->value              => [],
        Locale::Hungarian->value          => [],
        Locale::Icelandic->value          => [],
        Locale::Igbo->value               => [],
        Locale::Indonesian->value         => [],
        Locale::Irish->value              => [],
        Locale::Italian->value            => ['masterix21'],
        Locale::Japanese->value           => ['wadakatu'],
        Locale::Kannada->value            => [],
        Locale::Kazakh->value             => [],
        Locale::Kinyarwanda->value        => [],
        Locale::Korean->value             => [],
        Locale::Kurdish->value            => [],
        Locale::KurdishSorani->value      => [],
        Locale::Kyrgyz->value             => [],
        Locale::Lao->value                => [],
        Locale::Latvian->value            => [],
        Locale::Lingala->value            => [],
        Locale::Lithuanian->value         => [],
        Locale::Luganda->value            => [],
        Locale::Luxembourgish->value      => [],
        Locale::Macedonian->value         => ['keljtanoski'],
        Locale::Maithili->value           => [],
        Locale::Malagasy->value           => [],
        Locale::Malay->value              => [],
        Locale::Malayalam->value          => [],
        Locale::Maltese->value            => [],
        Locale::Maori->value              => [],
        Locale::Marathi->value            => [],
        Locale::MeiteilonManipuri->value  => [],
        Locale::Mongolian->value          => [],
        Locale::MyanmarBurmese->value     => [],
        Locale::Nepali->value             => ['diveshthapa'],
        Locale::NorwegianBokmal->value    => [],
        Locale::NorwegianNynorsk->value   => [],
        Locale::Occitan->value            => [],
        Locale::OdiaOriya->value          => [],
        Locale::Oromo->value              => [],
        Locale::Pashto->value             => [],
        Locale::Persian->value            => ['ariaieboy'],
        Locale::Pilipino->value           => [],
        Locale::Polish->value             => ['makowskid'],
        Locale::Portuguese->value         => ['jorgercosta'],
        Locale::PortugueseBrazil->value   => ['EuCarlos'],
        Locale::Punjabi->value            => [],
        Locale::Quechua->value            => [],
        Locale::Romanian->value           => ['Van4kk'],
        Locale::Russian->value            => ['andrey-helldar'],
        Locale::Sanskrit->value           => [],
        Locale::Sardinian->value          => [],
        Locale::ScotsGaelic->value        => [],
        Locale::SerbianCyrillic->value    => ['LukaLatkovic'],
        Locale::SerbianLatin->value       => ['LukaLatkovic', 'jure-knezovic'],
        Locale::SerbianMontenegrin->value => ['LukaLatkovic', 'jure-knezovic'],
        Locale::Shona->value              => [],
        Locale::Sindhi->value             => [],
        Locale::Sinhala->value            => [],
        Locale::Slovak->value             => [],
        Locale::Slovenian->value          => [],
        Locale::Somali->value             => [],
        Locale::Spanish->value            => ['luisprmat'],
        Locale::Sundanese->value          => [],
        Locale::Swahili->value            => ['Pheogrammer'],
        Locale::Swedish->value            => [],
        Locale::Tagalog->value            => [],
        Locale::Tajik->value              => [],
        Locale::Tamil->value              => [],
        Locale::Tatar->value              => [],
        Locale::Telugu->value             => [],
        Locale::Thai->value               => ['bact'],
        Locale::Tigrinya->value           => [],
        Locale::Turkish->value            => ['slvler'],
        Locale::Turkmen->value            => [],
        Locale::TwiAkan->value            => [],
        Locale::Uighur->value             => [],
        Locale::Ukrainian->value          => ['Oleksandr-Moik', 'MrAlKuz'],
        Locale::Urdu->value               => [],
        Locale::UzbekCyrillic->value      => [],
        Locale::UzbekLatin->value         => [],
        Locale::Vietnamese->value         => ['dinhquochan'],
        Locale::Welsh->value              => [],
        Locale::Xhosa->value              => [],
        Locale::Yiddish->value            => [],
        Locale::Yoruba->value             => [],
        Locale::Zulu->value               => [],
    ],
];

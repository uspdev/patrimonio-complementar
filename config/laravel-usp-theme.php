<?php

$admin = [
    [
        'text' => '<i class="fas fa-atom"></i>  SubItem 1',
        'url' => 'subitem1',
    ],
    [
        'text' => 'SubItem 2',
        'url' => '/subitem2',
        'can' => 'admin',
    ],
    [
        'type' => 'divider',
    ],
    [
        'type' => 'header',
        'text' => 'Cabeçalho',
    ],
    [
        'text' => 'SubItem 3',
        'url' => 'subitem3',
    ],
];

$submenu2 = [
    // [
    //     'text' => 'Por número de patrimônio',
    //     'url' => 'listarPorNumero',
    // ],
    [
        'text' => 'Por sala',
        'url' => 'listarPorSala',
        'can' => 'gerente',
    ],
];

$buscar = [
    [
        'text' => 'por Número',
        'url' => 'numpat',
        'can' => 'gerente',
    ],
    [
        'text' => 'Por local',
        'url' => 'buscarPorLocal',
        'can' => 'gerente',
    ],
    [
        'text' => 'Por responsável',
        'url' => 'buscarPorResponsavel',
        'can' => 'gerente',
    ],
];

$menu = [
    [
        'text' => 'Listar',
        'submenu' => $submenu2,
        'can' => 'gerente',
    ],
    [
        'text' => 'Buscar',
        'submenu' => $buscar,
        'can' => 'gerente',
    ],
    [
        'text' => 'Locais',
        'url' => 'localusp',
        'can' => 'gerente',
    ],
    [
        'text' => 'Relatório',
        'url' => 'relatorio',
        'can' => 'gerente',
    ],
    [
        'text' => '<span class="text-danger">Locais admin</span>',
        'url' => 'localusp/admin',
        'can' => 'admin',
    ],
    [
        'text' => '<span class="text-danger">Centros de despesa</span>',
        'url' => 'cendsp',
        'can' => 'admin',
    ],
];

$right_menu = [
    [
        // menu utilizado para views da biblioteca senhaunica-socialite.
        'key' => 'senhaunica-socialite',
    ],
    [
        'key' => 'laravel-tools',
    ],
    // [
    //     'text' => '<i class="fas fa-cog"></i>',
    //     'title' => 'Configurações',
    //     'target' => '_blank',
    //     'url' => config('app.url') . '/item1',
    //     'align' => 'right',
    // ],
];

return [
    # valor default para a tag title, dentro da section title.
    # valor pode ser substituido pela aplicação.
    'title' => config('app.name'),

    # USP_THEME_SKIN deve ser colocado no .env da aplicação
    'skin' => env('USP_THEME_SKIN', 'uspdev'),

    # chave da sessão. Troque em caso de colisão com outra variável de sessão.
    'session_key' => 'laravel-usp-theme',

    # usado na tag base, permite usar caminhos relativos nos menus e demais elementos html
    # na versão 1 era dashboard_url
    'app_url' => config('app.url'),

    # login e logout
    'logout_method' => 'POST',
    'logout_url' => 'logout',
    'login_url' => 'login',

    # menus
    'menu' => $menu,
    'right_menu' => $right_menu,
];

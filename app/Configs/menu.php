<?php

return
    [
        [
            'label' => 'Vendas',
            'link' => action(\Controllers\Home::class),
            'icon' => 'fas fa-cash-register'
        ],
        [
            'label' => 'Produtos',
            'link' => action(\Controllers\Produtos::class),
            'icon' => 'fas fa-shopping-cart',
        ],
        [
            'label' => 'Clientes',
            'link' => action(\Controllers\Clientes::class),
            'icon' => 'fas fa-users'
        ],
        [
            'label' => 'Fornecedores',
            'link' => action(\Controllers\Fornecedores::class),
            'icon' => 'fas fa-shipping-fast'
        ],
        [
            'label' => 'Recebimentos',
            'link' => action(Controllers\RelatoriosController::class, 'recebimentos'),
            'icon' => 'fas fa-hand-holding-usd'
        ],
        [
            'label' => 'Estoque',
            'link' => action(Controllers\RelatoriosController::class, 'produtos'),
            'icon' => 'fas fa-layer-group'
        ],

        [
            'label' => 'Usuários',
            'link' => action(\Controllers\Usuarios\Cadastro::class),
            'icon' => 'fas fa-address-card'
        ],
    ];
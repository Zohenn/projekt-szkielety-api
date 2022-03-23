<?php

return [
    'gt' => [
        'numeric' => 'Podana wartość musi być większa od :value'
    ],
    'gte' => [
        'numeric' => 'Podana wartość musi być większa lub równa :gte',
    ],
    'min' => [
        'string' => 'Minimalna długość: :min',
        'numeric' => 'Minimalna wartość: :min',
    ],
    'max' => [
        'string' => 'Maksymalna długość: :max',
        'numeric' => 'Maksymalna wartość: :max',
        'file' => 'Maksymalny rozmiar pliku :max',
    ],
    'regex' => 'Podana wartość nie pasuje do wzoru',
    'exists' => 'Podana wartość nie istnieje',
    'numeric' => 'Podana wartość musi być liczbą',
    'required' => 'Pole nie może być puste',
    'image' => 'Plik musi być zdjęciem',
    'confirmed' => 'Hasła musza się zgadzać',
    'custom' => [
        'email' => [
            'unique' => 'Adres email jest już w użyciu',
        ],
    ],
];

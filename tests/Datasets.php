<?php

dataset('user_registration_validation_scenarios', [
    'empty fields' => [
        '',             // $name
        '',             // $email
        '',             // $password
        ['name', 'email', 'password'] // $expectedErrors
    ],
    'invalid email format' => [
        'John Doe',
        'invalid-email-address',
        'password123',
        ['email']
    ],
    'data exceeds maximum length' => [
        str_repeat('n', 256),
        'test@example.com',
        str_repeat('p', 256),
        ['name', 'password']
    ],
    'duplicate email address' => [
        'John Doe',
        'duplicate@example.com',
        'password123',
        ['email']
    ],
]);

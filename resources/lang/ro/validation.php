<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute trebuie acceptat(ă).',
    'active_url' => 'Adresa de URL: :attribute nu este validă.',
    'after' => ':attribute trebuie să fie o dată după :date.',
    'after_or_equal' => ':attribute trebuie să fie o dată egală cu sau mai mare ca :date.',
    'alpha' => 'Câmpul :attribute trebuie să conțină doar litere.',
    'alpha_dash' => 'Câmpul :attribute trebuie să conțină doar litere, numere, liniuțe sau liniuță jos.',
    'alpha_num' => 'Câmpul :attribute trebuie să conține doar litere și numere.',
    'array' => 'Câmpul :attribute trebuie să fie de tip listă.',
    'before' => ':attribute trebuie să fie o dată înainte de :date.',
    'before_or_equal' => ':attribute trebuie să fie o dată egală cu sau mai mică ca :date.',
    'between' => [
        'numeric' => 'Valoarea câmpului :attribute trebuie să fie între :min și :max.',
        'file' => 'Dimensiunea fișierului :attribute trebuie să fie între :min și :max kilobiți.',
        'string' => 'Lungimea șirului :attribute trebuie să fie între :min și :max caractere.',
        'array' => 'Dimensiunea listei :attribute trebuie să fie între :min și :max elemente.',
    ],
    'boolean' => 'Câmpul :attribute trebuie să fie adevărat sau fals.',
    'confirmed' => 'Câmpul :attribute nu corespunde.',
    'date' => ':attribute nu reprezintă o dată validă.',
    'date_equals' => ':attribute trebuie să fie o dată egală cu :date.',
    'date_format' => ':attribute nu corespunde cu formatul :format.',
    'different' => 'Valoarea câmpului :attribute și :other trebuie să fie diferite.',
    'digits' => 'Valoarea câmpului :attribute trebuie să fie de :digits cifre.',
    'digits_between' => 'Valoarea câmpului :attribute trebuie să fie între :min și :max cifre.',
    'dimensions' => 'Dimensiunile imaginii :attribute sunt invalide.',
    'distinct' => ':attribute nu are o valoare distinctă.',
    'email' => ':attribute nu este validă.',
    'ends_with' => ':attribute trebuie să se termine cu una din valorile: :values.',
    'exists' => ':attribute selectat este invalid.',
    'file' => ':attribute trebuie să fie de tip fișier.',
    'filled' => ':attribute trebuie să conțină o valoare.',
    'gt' => [
        'numeric' => ':attribute trebuie să fie mai mare ca :value.',
        'file' => ':attribute trebuie să fie mai mare de :value kilobit(ți).',
        'string' => ':attribute trebuie să fie mai mare decât :value caracter(e).',
        'array' => ':attribute trebuie să conțină mai mult de :value element(e).',
    ],
    'gte' => [
        'numeric' => ':attribute trebuie să fie mai mare sau egal ca :value.',
        'file' => ':attribute trebuie să fie mai mare sau egal cu :value kilobit(ți).',
        'string' => ':attribute trebuie să fie mai mare sau egal decât :value caracter(e).',
        'array' => ':attribute trebuie să aibă :value sau mai multe elemente.',
    ],
    'image' => ':attribute trebuie să fie de tip imagine.',
    'in' => ':attribute selectat este invalid.',
    'in_array' => 'Câmpul :attribute nu există în câmpul :other.',
    'integer' => ':attribute trebuie să fie de tip număr.',
    'ip' => ':attribute trebuie să fie o adresă IP validă.',
    'ipv4' => ':attribute trebuie să fie o adresă IPv4 validă.',
    'ipv6' => ':attribute trebuie să fie o adresă IPv6 validă.',
    'json' => ':attribute trebuie să fie un șir de caractere valide (tip JSON).',
    'lt' => [
        'numeric' => ':attribute trebuie să fie mai mic ca :value.',
        'file' => ':attribute trebuie să fie mai mic de :value kilobit(ți).',
        'string' => ':attribute trebuie să fie mai mic decât :value caracter(e).',
        'array' => ':attribute trebuie să fie mai mic de :value element(e).',
    ],
    'lte' => [
        'numeric' => ':attribute trebuie să fie mai mic sau egal cu :value.',
        'file' => ':attribute trebuie să fie mai mic sau egal cu :value kilobit(ți).',
        'string' => ':attribute trebuie să fie mai mic sau egal decât :value caracter(e).',
        'array' => ':attribute nu trebuie să aiba mai mult de :value element(e).',
    ],
    'max' => [
        'numeric' => ':attribute nu trebuie să fie mai mare ca :max.',
        'file' => ':attribute nu trebuie să fie mai mare de :max kilobit(ți).',
        'string' => ':attribute nu poate fi mai mare decât :max caracter(e).',
        'array' => ':attribute nu poate avea mai mult de :max element(e).',
    ],
    'mimes' => ':attribute trebuie să fie un fișier de tipul: :values.',
    'mimetypes' => ':attribute trebuie să fie un fișier de tipul: :values.',
    'min' => [
        'numeric' => ':attribute trebuie să fie cel puțin :min.',
        'file' => ':attribute trebuie să fie cel puțin :min kilobit(ți).',
        'string' => ':attribute trebuie să fie cel puțin :min caracter(e).',
        'array' => ':attribute trebuie să fie cel puțin :min element(e).',
    ],
    'multiple_of' => ':attribute trebuie să fie un multiplu de :value',
    'not_in' => ':attribute este invalid.',
    'not_regex' => 'Formatul :attribute este invalid.',
    'numeric' => ':attribute trebuie să fie de tip număr.',
    'password' => 'Parola este incorectă.',
    'present' => 'Câmpul :attribute trebuie să fie vizibil.',
    'regex' => ':attribute formatul este invalid.',
    'required' => 'Câmpul :attribute este obligatoriu.',
    'required_if' => 'Câmpul :attribute este obligatoriu atunci când :other este :value.',
    'required_unless' => 'Câmpul :attribute este obligatoriu numai dacă :other conține valorile :values.',
    'required_with' => 'Câmpul :attribute este obligatoriu când valoarea :values există.',
    'required_with_all' => 'Câmpul :attribute este obligatoriu când toate valorile :values există.',
    'required_without' => 'Câmpul :attribute este obligatoriu când valoarea :values nu există.',
    'required_without_all' => 'Câmpul :attribute este obligatoriu când niciuna din valorile :values nu există.',
    'same' => ':attribute și :other trebuie să corespundă.',
    'size' => [
        'numeric' => ':attribute trebuie să fie de :size.',
        'file' => ':attribute trebuie să fie de :size kilobit(ți).',
        'string' => ':attribute trebuie să fie de :size caracter(e).',
        'array' => ':attribute trebuie să conțină :size element(e).',
    ],
    'starts_with' => ':attribute trebuie să înceapă cu una din valorile: :values.',
    'string' => ':attribute trebuie să fie un șir de litere.',
    'timezone' => ':attribute trebuie să fie un fus orar valid.',
    'unique' => ':attribute nu este disponibilă.',
    'uploaded' => 'Încărcarea fișierului :attribute a eșuat.',
    'url' => 'Formatul URL-ului :attribute este invalid.',
    'uuid' => ':attribute trebuie să fie un UUID (identificator unic universal) valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'name' => [
            'required'  => ':attribute sunt obligatorii.',
            'regex'     => ':attribute conține un format invalid',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
        'full_name' => [
            'required'  => ':attribute sunt obligatorii.',
            'regex'     => ':attribute conține un format invalid',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
        'email' => [
            'required'  => ':attribute este obligatorie.',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
        'nickname' => [
            'required'  => ':attribute este obligatoriu.',
            'regex'     => ':attribute conține un format invalid',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
        'password' => [
            'required'  => ':attribute este obligatorie.',
            'regex'     => ':attribute conține un format invalid',
            'min'       => ':attribute trebuie să aibă 8 caractere minim.',
        ],
        'message' => [
            'required'  => ':attribute este obligatoriu.',
            'min'       => ':attribute trebuie să aibă 60 de caractere minim.',
        ],
        'comment' => [
            'required'  => ':attribute este obligatoriu.',
            'min'       => ':attribute trebuie să aibă 5 de caractere minim.',
        ],
        'comment_reply' => [
            'required'  => ':attribute este obligatoriu.',
            'min'       => ':attribute trebuie să aibă 5 de caractere minim.',
        ],
        'reply_to_comment_reply' => [
            'required'  => ':attribute este obligatoriu.',
            'min'       => ':attribute trebuie să aibă 5 de caractere minim.',
        ],
        'privacy_policy' => [
            'accepted'  => 'Trebuie să accepți :attribute.',
        ],
        'domain' => [
            'required'  => ':attribute este obligatoriu.',
            'regex'     => ':attribute conține un format invalid (acesta trebuie să conțină doar litere mici).',
            'max'       => ':attribute nu trebuie să depășească 50 de caractere.',
            'unique'    => ':attribute există deja în baza de date.',
        ],
        'type' => [
            'required'  => ':attribute este obligatoriu.',
            'regex'     => ':attribute conține un format invalid',
            'max'       => ':attribute nu trebuie să depășească 50 de caractere.',
        ],
        'notify_code' => [
            'required'  => ':attribute este obligatoriu.',
            'regex'     => ':attribute conține un format invalid (acesta trebuie să conțină litere mari / mici sau cifre).',
            'max'       => ':attribute nu trebuie să depășească 10 de caractere.',
            'unique'    => ':attribute există deja în baza de date.',
        ],
        'notify_short_description' => [
            'required'  => ':attribute este obligatorie.',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
        'campaign_name' => [
            'required'  => ':attribute este obligatoriu.',
            'regex'     => ':attribute conține un format invalid (acesta trebuie să conțină litere mari / mici sau cifre).',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
        'campaign_description' => [
            'required'  => ':attribute este obligatorie.',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
        'campaign_is_active' => [
            'required'  => 'Este necesar să activezi această campanie.',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
        'valid_from' => [
            'required'  => ':attribute este obligatorie.',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
        'valid_to' => [
            'required'  => ':attribute este obligatorie.',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
        'occur_times' => [
            'required'  => ':attribute este obligatorie.',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
        'occur_when' => [
            'required'  => ':attribute este obligatorie.',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
        'occur_day' => [
            'required'  => ':attribute este obligatorie.',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
        'occur_hour' => [
            'required'  => ':attribute este obligatorie.',
            'max'       => ':attribute nu trebuie să depășească 255 de caractere.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name'                     => 'Numele și Prenumele',
        'full_name'                => 'Numele și Prenumele',
        'email'                    => 'Adresa de Email',
        'nickname'                 => 'Nickname-ul',
        'password'                 => 'Parola',
        'message'                  => 'Mesajul',
        'comment'                  => 'Comentariul',
        'comment_reply'            => 'Răspunsul la comentariu',
        'reply_to_comment_reply'   => 'Răspunsul la comentariu',
        'privacy_policy'           => 'Termenii și Condițiile',
        'domain'                   => 'Numele domeniului',
        'type'                     => 'Tipul domeniului',
        'notify_code'              => 'Codul de notificare',
        'notify_short_description' => 'Scurta descriere a notificării',
        'campaign_name'            => 'Numele campaniei',
        'campaign_description'     => 'Descrierea campaniei',
        'valid_from'               => 'Data de început a campaniei',
        'valid_to'                 => 'Data de final a campaniei',
        'occur_times'              => 'Numărul de recurențe',
        'occur_when'               => 'Perioada recurenței',
        'occur_day'                => 'Ziua recurenței',
        'occur_hour'               => 'Timpul recurenței',
    ],

];

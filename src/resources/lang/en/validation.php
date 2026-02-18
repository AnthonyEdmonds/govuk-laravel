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

    'accepted' => 'You must accept :attribute.',
    'accepted_if' => 'You must accept :attribute must be accepted as :other is :value.',
    'active_url' => ':Attribute must be a valid URL.',
    'after' => ':Attribute must be after :date.',
    'after_or_equal' => ':Attribute must be after or on :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes, and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'any_of' => 'The :attribute is invalid.',
    'array' => ':Attribute must be a list.',
    'ascii' => 'The :attribute must only contain single-byte alphanumeric characters and symbols.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'array' => 'The :attribute must have between :min and :max items.',
        'file' => 'The selected file must be between :min and :maxkB.',
        'numeric' => 'The :attribute must be between :min and :max.',
        'string' => 'The :attribute must be between :min and :max characters.',
    ],
    'boolean' => 'The :attribute must be true or false.',
    'can' => ':Attribute contains an unauthorized value.',
    'confirmed' => ':Attribute confirmation does not match.',
    'contains' => ':Attribute is missing a required value.',
    'current_password' => 'The password is incorrect.',
    'date' => ':Attribute must be a valid date.',
    'date_equals' => ':Attribute must be a date equal to :date.',
    'date_format' => ':Attribute must match the format :format.',
    'decimal' => ':Attribute must have :decimal decimal places.',
    'declined' => 'You must decline :attribute.',
    'declined_if' => 'You must decline :attribute as :other is :value.',
    'different' => ':Attribute and :other must be different.',
    'digits' => ':Attribute must be :digits digits.',
    'digits_between' => ':Attribute must be between :min and :max digits.',
    'dimensions' => ':Attribute has invalid image dimensions.',
    'distinct' => ':Attribute has a duplicate value.',
    'doesnt_contain' => ':Attribute must not contain any of the following: :values.',
    'doesnt_end_with' => ':Attribute must not end with one of the following: :values.',
    'doesnt_start_with' => ':Attribute must not start with one of the following: :values.',
    'email' => ':Attribute must be a valid email address.',
    'encoding' => ':Attribute must be encoded in :encoding.',
    'ends_with' => ':Attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'extensions' => 'The :attribute must have one of the following extensions: :values.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute must have a value.',
    'gt' => [
        'array' => 'You must have more than :value items for :attribute.',
        'file' => 'The selected file must be greater than :value kB.',
        'numeric' => 'The :attribute must be greater than :value.',
        'string' => 'The :attribute must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'You must have at least :value items for :attribute.',
        'file' => 'The selected file must be at least :valuekB.',
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
    ],
    'hex_color' => ':Attribute must be a hexadecimal colour, like #7c878e.',
    'image' => ':Attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => ':Attribute must exist in :other.',
    'in_array_keys' => ':Attribute must contain at least one of the following keys: :values.',
    'integer' => ':Attribute must be a whole number.',
    'ip' => ':Attribute must be a valid IP address.',
    'ipv4' => ':Attribute must be a valid IPv4 address.',
    'ipv6' => ':Attribute must be a valid IPv6 address.',
    'json' => ':Attribute must be a valid JSON string.',
    'list' => ':Attribute must be a list.',
    'lowercase' => ':Attribute must be lowercase.',
    'lt' => [
        'array' => 'The :attribute must have less than :value items.',
        'file' => 'The selected file must be smaller than :valuekB.',
        'numeric' => 'The :attribute must be less than :value.',
        'string' => 'The :attribute must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute must not have more than :value items.',
        'file' => 'The selected file must be at most :valuekB.',
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'array' => 'The :attribute must not have more than :max items.',
        'file' => 'The selected file must not be greater than :maxkB.',
        'numeric' => 'The :attribute must not be greater than :max.',
        'string' => 'The :attribute must not be greater than :max characters.',
    ],
    'max_digits' => 'The :attribute must not have more than :max digits.',
    'mimes' => 'The selected file must be a :values.',
    'mimetypes' => 'The selected file must be a :values.',
    'min' => [
        'array' => 'The :attribute must have at least :min items.',
        'file' => 'The selected file must be at least :minkB.',
        'numeric' => 'The :attribute must be at least :min.',
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'min_digits' => 'The :attribute must have at least :min digits.',
    'missing' => 'The :attribute must be missing.',
    'missing_if' => 'The :attribute must be missing when :other is :value.',
    'missing_unless' => 'The :attribute must be missing unless :other is :value.',
    'missing_with' => 'The :attribute must be missing when :values is present.',
    'missing_with_all' => 'The :attribute must be missing when :values are present.',
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'Enter the :attribute in the correct format.',
    'numeric' => 'The :attribute must be a number.',
    'password' => [
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute must be present.',
    'present_if' => 'The :attribute must be present when :other is :value.',
    'present_unless' => 'The :attribute must be present unless :other is :value.',
    'present_with' => 'The :attribute must be present when :values is present.',
    'present_with_all' => 'The :attribute must be present when :values are present.',
    'prohibited' => 'The :attribute is prohibited.',
    'prohibited_if' => 'The :attribute is prohibited when :other is :value.',
    'prohibited_if_accepted' => 'The :attribute is prohibited when :other is accepted.',
    'prohibited_if_declined' => 'The :attribute is prohibited when :other is declined.',
    'prohibited_unless' => 'The :attribute is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute prohibits :other from being present.',
    'regex' => ' Enter :attribute in the correct format.',
    'required' => 'Enter a value for :attribute.',
    'required_array_keys' => 'The :attribute must contain entries for: :values.',
    'required_if' => 'The :attribute is required when :other is :value.',
    'required_if_accepted' => 'The :attribute is required when :other is accepted.',
    'required_if_declined' => 'The :attribute is required when :other is declined.',
    'required_unless' => 'The :attribute is required unless :other is in :values.',
    'required_with' => 'The :attribute is required when :values is present.',
    'required_with_all' => 'The :attribute is required when :values are present.',
    'required_without' => 'The :attribute is required when :values is not present.',
    'required_without_all' => 'The :attribute is required when none of :values are present.',
    'same' => 'The :attribute must match :other.',
    'size' => [
        'array' => 'The :attribute must contain :size items.',
        'file' => 'The selected file must be :sizekB.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'The :attribute must be :size characters.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => ':Attribute must be text.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => ':Attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'uppercase' => ':Attribute must be uppercase.',
    'url' => ':Attribute must be a valid link.',
    'ulid' => ':Attribute must be a valid ULID.',
    'uuid' => ':Attribute must be a valid UUID.',

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

    'attributes' => [],

];

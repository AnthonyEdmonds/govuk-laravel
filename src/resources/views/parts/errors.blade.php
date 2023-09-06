@isset($errors)
    @if($errors->any() === true)
        @php
            $messages = [];
    
            foreach ($errors->getMessages() as $name => $message) {
                $messages[$name] = $message[0];
            }
        @endphp
    
        <x-govuk::error-summary :messages="$messages" />
    @endif
@endisset

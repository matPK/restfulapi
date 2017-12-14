Hello {{ $user->name }}
Thank you for creating an account. Please verify your e-mail using this link:
{{ route('verify', $user->verification_token) }}
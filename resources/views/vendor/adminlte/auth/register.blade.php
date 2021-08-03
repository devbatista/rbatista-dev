@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_body')
    <form action="{{ $register_url }}" method="post">
        @csrf

        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" name="nome" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}"
                   value="{{ old('nome') }}" placeholder="{{ __('adminlte::adminlte.full_name') }} *" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }} *">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password"
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.password') }} *">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }} *">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password_confirmation'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
            @endif
        </div>

        {{-- Profissão field --}}
        <div class="input-group mb-3">
            <input type="text" name="profissao" class="form-control {{ $errors->has('profissao') ? 'is-invalid' : '' }}"
                   value="{{ old('profissao') }}" placeholder="Profissão *">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-briefcase {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('profissao') }}</strong>
                </div>
            @endif
        </div>

        {{-- Data de nascimento field --}}
        <div class="input-group mb-3">
            <input type="date" name="dt_nascimento" class="form-control {{ $errors->has('dt_nascimento') ? 'is-invalid' : '' }}"
                   value="{{ old('dt_nascimento') }}" placeholder="Data de nascimento *">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-calendar-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('dt_nascimento') }}</strong>
                </div>
            @endif
        </div>

        {{-- Telefone field --}}
        <div class="input-group mb-3">
            <input type="text" name="telefone" class="form-control {{ $errors->has('telefone') ? 'is-invalid' : '' }}"
                   value="{{ old('telefone') }}" placeholder="Telefone *">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fab fa-whatsapp {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('telefone') }}</strong>
                </div>
            @endif
        </div>

        <div class="input-group mb-3">
            <input type="text" name="endereco" class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}"
                   value="{{ old('endereco') }}" placeholder="Endereço *">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-address-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('endereco') }}</strong>
                </div>
            @endif
        </div>

        <div class="input-group mb-3">
            <input type="text" name="cpf" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}"
                   value="{{ old('cpf') }}" placeholder="CPF">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-circle {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('cpf') }}</strong>
                </div>
            @endif
        </div>

        <div class="input-group mb-3">
            <input type="text" name="cnpj" class="form-control {{ $errors->has('cnpj') ? 'is-invalid' : '' }}"
                   value="{{ old('cnpj') }}" placeholder="CNPJ">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-secret {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('cnpj') }}</strong>
                </div>
            @endif
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>
@stop

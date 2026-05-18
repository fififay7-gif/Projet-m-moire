@extends('layouts.app')

@section('content')

<style>

body{
    background: linear-gradient(135deg,#eef2ff,#f5f7fb);
}

/* CENTER CARD */
.login-wrapper{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:80vh;
}

/* CARD */
.login-card{
    width:420px;
    background:white;
    border-radius:18px;
    box-shadow:0 15px 40px rgba(0,0,0,0.08);
    overflow:hidden;
    transition:0.3s;
}

.login-card:hover{
    transform:translateY(-5px);
}

/* HEADER */
.card-header{
    background: linear-gradient(135deg,#1e3a8a,#2563eb);
    color:white;
    text-align:center;
    padding:18px;
    font-size:18px;
    font-weight:bold;
}

/* BODY */
.card-body{
    padding:25px;
}

/* LABEL */
label{
    font-weight:600;
    color:#1e3a8a;
    font-size:14px;
}

/* INPUTS */
.form-control{
    border-radius:10px;
    padding:10px;
    border:1px solid #e5e7eb;
    transition:0.2s;
}

.form-control:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,0.15);
}

/* ALERT */
.alert{
    border-radius:10px;
}

/* BUTTON EMS */
.btn-primary{
    background: linear-gradient(135deg,#2563eb,#1e3a8a);
    border:none;
    padding:10px;
    border-radius:10px;
    font-weight:bold;
    transition:0.3s;
}

.btn-primary:hover{
    background: linear-gradient(135deg,#1e3a8a,#2563eb);
    transform:scale(1.03);
}

/* CHECKBOX */
.form-check-label{
    color:#64748b;
}

</style>

<div class="login-wrapper">

    <div class="login-card">

        <div class="card-header">
            🔐 EMS LOGIN
        </div>

        <div class="card-body">

            {{-- ERREURS --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label>Email Address</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           required>
                </div>

                {{-- PASSWORD --}}
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           required>
                </div>

                {{-- REMEMBER --}}
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember">
                    <label class="form-check-label">Remember Me</label>
                </div>

                {{-- BUTTON --}}
                <button type="submit" class="btn btn-primary w-100">
                    Se connecter
                </button>

            </form>

        </div>

    </div>

</div>

@endsection

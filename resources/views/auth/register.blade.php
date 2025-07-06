{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no"
  />
  <title>Register • SPK SMART</title>

  <!-- Sneat Core CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

  <style>
    /* full‐screen gradient + dot pattern */
    body {
      margin: 0;
      min-height: 100vh;
      background:
        linear-gradient(135deg, #667eea 0%, #764ba2 100%),
        url("data:image/svg+xml,%3Csvg width='20' height='20' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle fill='%23ffffff22' cx='2' cy='2' r='1'/%3E%3C/svg%3E") repeat;
      background-blend-mode: overlay;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    /* subtle overlay pattern (if you prefer) */
    .bg-pattern {
      position: absolute;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='30' cy='30' r='1' fill='%23ffffff11'/%3E%3C/svg%3E");
      z-index: 0;
    }
    /* centered skinny card */
    .auth-card {
      position: relative;
      z-index: 1;
      width: 100%;
      max-width: 360px;
      margin: 2rem;
    }
    /* white card w/ rounded corners & shadow */
    .auth-card .card {
      border-radius: 1rem;
      box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.1);
    }
    .auth-card .card-body {
      padding: 2rem;
    }
    .form-label {
      color: #37474F;
    }
    .text-muted {
      color: #6c757d!important;
    }
  </style>
</head>

<body>
  <div class="bg-pattern"></div>

  <div class="auth-card">
    <div class="card">
      <div class="card-body">

        {{-- Logo --}}
        <div class="text-center mb-4">
          <img src="{{ asset('assets/img/logo110.png') }}"
               alt="SPK Logo"
               style="width:48px;"/>
        </div>

        {{-- <h4 class="text-center mb-2">Buat Akun Baru</h4> --}}
        <p class="text-center text-muted mb-4">
          Silakan isi data di bawah untuk mendaftar.
        </p>

        {{-- Validation Errors --}}
        <x-input-error :messages="$errors->all()" class="mb-4 text-danger" />

        <form method="POST" action="{{ route('register') }}" class="mb-3">
          @csrf
          
          <div class="mb-3">
            <label for="nisn" class="form-label">Nisn</label>
            <input
              id="nisn"
              name="nisn"
              type="text"
              value="{{ old('nisn') }}"
              required autofocus
              placeholder="Masukkan nisn"
              class="form-control bg-light"
            />
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input
              id="name"
              name="name"
              type="text"
              value="{{ old('name') }}"
              required autofocus
              placeholder="Masukkan nama lengkap"
              class="form-control bg-light"
            />
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
              id="email"
              name="email"
              type="email"
              value="{{ old('email') }}"
              required
              placeholder="Masukkan email"
              class="form-control bg-light"
            />
          </div>

          <div class="mb-3 form-password-toggle">
            <label for="password" class="form-label">Password</label>
            <div class="input-group input-group-merge">
              <input
                id="password"
                name="password"
                type="password"
                required
                placeholder="••••••••"
                class="form-control bg-light"
              />
              <span class="input-group-text cursor-pointer">
                <i class="bx bx-hide"></i>
              </span>
            </div>
          </div>

          <div class="mb-4 form-password-toggle">
            <label for="password_confirmation" class="form-label">
              Konfirmasi Password
            </label>
            <div class="input-group input-group-merge">
              <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                required
                placeholder="••••••••"
                class="form-control bg-light"
              />
              <span class="input-group-text cursor-pointer">
                <i class="bx bx-hide"></i>
              </span>
            </div>
          </div>

          <button type="submit"
                  class="btn btn-primary w-100 py-2 mb-3">
            Register
          </button>
        </form>

        <p class="text-center mb-0">
          <span class="text-muted">Sudah punya akun?</span>
          <a href="{{ route('login') }}" class="fw-semibold ms-1">
            Masuk di sini
          </a>
        </p>

      </div>
    </div>
  </div>

  <!-- Sneat JS -->
  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
  <script>
    // show/hide password
    document.querySelectorAll('.form-password-toggle .input-group-text')
      .forEach(el => el.addEventListener('click', () => {
        const inp = el.previousElementSibling;
        if (inp.type === 'password') {
          inp.type = 'text'; el.innerHTML = '<i class="bx bx-show"></i>';
        } else {
          inp.type = 'password'; el.innerHTML = '<i class="bx bx-hide"></i>';
        }
      }));
  </script>
</body>
</html>

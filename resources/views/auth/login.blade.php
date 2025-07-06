{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no"
  />
  <title>Sign in • SPK SMART</title>

  <!-- Core CSS -->
  <link
    rel="stylesheet"
    href="{{ asset('assets/vendor/css/core.css') }}"
  />
  <link
    rel="stylesheet"
    href="{{ asset('assets/vendor/css/theme-default.css') }}"
  />
  <link
    rel="stylesheet"
    href="{{ asset('assets/css/demo.css') }}"
  />

  <style>
    /* Ganti body putih polos menjadi gradient + subtle pattern */
    body {
      margin: 0;
      min-height: 100vh;
      /* Linear gradient lembut */
      background: linear-gradient(135deg, #71b7e6 0%, #9b59b6 100%);
      /* Overlay pattern titik kecil */
      background-image:
        linear-gradient(135deg, #71b7e6 0%, #9b59b6 100%),
        url("data:image/svg+xml,%3Csvg width='20' height='20' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle fill='%23ffffff22' cx='2' cy='2' r='1'/%3E%3C/svg%3E");
      background-repeat: repeat;
      background-blend-mode: overlay;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Biarkan kartu tetap seperti semula, tapi pastikan z-index lebih tinggi */
    .bg-pattern { display: none; /* hapus pola lama */ }
    .auth-card {
      position: relative;
      z-index: 1;
      max-width: 360px;
      width: 100%;
      margin: auto;
      top: 10%;
    }
  </style>
</head>

<body>
  <div class="bg-pattern"></div>

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner auth-card">

        <!-- Card -->
        <div class="card">
          <div class="card-body p-4">

            <!-- Logo -->
            <div class="app-brand justify-content-center mb-4">
              <a href="/" class="app-brand-link gap-2">
                <img
                  src="{{ asset('assets/img/logo110.png') }}"
                  alt="SPK Logo"
                  class="app-brand-logo"
                  style="width: 60px;"
                />
                {{-- <span class="app-brand-text demo text-body fw-bolder">SPK 110 JKT</span> --}}
              </a>
            </div>
            <hr>

            {{-- <h4 class="mb-1 pt-2">Selamat datang! 👋</h4> --}}
            {{-- <p class="mb-4">Silakan masuk untuk melanjutkan.</p> --}}

            <!-- Session Status -->
            <x-auth-session-status
              class="mb-3 text-success"
              :status="session('status')"
            />

            <!-- Validation Errors -->
            <x-input-error
              :messages="$errors->all()"
              class="mb-3 text-danger"
            />

            <!-- Login Form -->
            <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  class="form-control"
                  placeholder="Masukan Email anda"
                  value="{{ old('email') }}"
                  required
                  autofocus
                />
              </div>

              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="••••••••"
                    required
                  />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>

              {{-- <div class="mb-3">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="remember_me"
                    name="remember"
                  />
                  <label class="form-check-label" for="remember_me">
                    Remember me
                  </label>
                </div>
              </div> --}}

              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">
                  Sign in
                </button>
              </div>
            </form>

            <p class="text-center">
              <span>Belum punya akun?</span>
              <a href="{{ route('register') }}">
                <span> Klik disini</span>
              </a>
            </p>
          </div>
        </div>
        <!-- /Card -->

      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
  <script>
    // Toggle password visibility
    document.querySelectorAll('.form-password-toggle .input-group-text')
      .forEach(el => el.addEventListener('click', () => {
        const input = el.previousElementSibling;
        if (input.type === 'password') {
          input.type = 'text';
          el.innerHTML = '<i class="bx bx-show"></i>';
        } else {
          input.type = 'password';
          el.innerHTML = '<i class="bx bx-hide"></i>';
        }
      }));
  </script>
</body>
</html>

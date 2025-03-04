<!doctype html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Aktivitas</title>
        <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
        <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

        <!-- Fonts and icons -->
        <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
        <script>
            WebFont.load({
                google: { families: ["Public Sans:300,400,500,600,700"] },
                custom: {
                    families: [
                        "Font Awesome 5 Solid",
                        "Font Awesome 5 Regular",
                        "Font Awesome 5 Brands",
                        "simple-line-icons",
                    ],
                    urls: [{{ asset('assets/css/fonts.min.css') }}],
                },
                active: function () {
                    sessionStorage.fonts = true;
                },
            });
        </script>

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    </head>
</head>

<body>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="text-center">
                                <img class="rounded mx-auto d-block my-3" src="{{ asset('assets/img/kaiadmin/bpkp_logo.png') }}"
                                    width="200" height="90">
                                <h4 class="text-center mt-4">Selamat Datang</h4>
                            </div>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <input type="text" name="nip" id="nip" class="form-control my-4 py-3" placeholder="NIP">
                                <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                                <input type="password" name="password" id="password" class="form-control my-4 py-3" placeholder="Password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Remember me</label>
                                </div>
                                <div class="d-grid gap-2 col-6 mx-auto mt-4">
                                    <button class="btn btn-primary">{{ __('Log in') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="asset\js\bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
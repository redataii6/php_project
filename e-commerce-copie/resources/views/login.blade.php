<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    @vite('resources/css/inscription.css')

</head>

<body>

    <div style="left: 50px; position: absolute; top: 0; ">
        <a href="/"><img style="height:200px; width: 200px; " id="logo" src="Shiny.svg" alt="logo"></a>
    </div>
    <div class="container" id="container">

        <div class="form-container sign-up">
            <form action="{{ route('signin.post') }}" method="POST">
                @csrf
                <h1>S’inscrire</h1>
                <p>C’est rapide et facile.</p>
                <div style="display: flex; flex-direction: column;">
                    <input style="width:410px;" name="name" type="text" placeholder="Nom complet" value="{{ old('name') }}">
                    @error('name', 'signin')
                    <div style="display: flex; align-items: center;">
                        <img style="width:12px; height:12px; position:relative; left:5px; top:-1.5px;" src="{{ asset('exclamation.png') }}" alt="">
                        <p style="font-size:12px; color:red; margin: 0; margin-left:10px;">{{ $message }}</p>
                    </div>
                    @enderror

                </div>

                <div style="display: flex; flex-direction: column;">
                    <input style="width:410px;" name="email" type="email" placeholder="Adresse mail" value="{{ old('email') }}">
                    @error('email', 'signin')
                    <div style="display: flex; align-items: center;">
                        <img style="width:12px; height:12px; position:relative; left:5px; top:-1.5px;" src="{{ asset('exclamation.png') }}" alt="">
                        <p style="font-size:12px; color:red; margin: 0; margin-left:10px;">{{ $message }}</p>
                    </div>
                    @enderror
                </div>

                <div style="display: flex; flex-direction: column;">
                    <div style="display: flex;">
                        <input name="password" type="password" placeholder="Mot de passe">
                        <input style="margin-left: 10px;width:370px;" name="password_confirmation" type="password" placeholder="confirmation mot de passe">
                    </div>
                    @error('password', 'signin')
                    <div style="display: flex; align-items: center;">
                        <img style="width:12px; height:12px; position:relative; left:5px; top:-1.5px;" src="{{ asset('exclamation.png') }}" alt="">
                        <p style="font-size:12px; color:red; margin: 0; margin-left:10px;">{{ $message }}</p>
                    </div>
                    @enderror

                </div>

                <button type="submit">S'inscrire</button>
            </form>
        </div>

        <div class="form-container sign-in">
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <h1>Bienvenue</h1>
                <div style="display: flex; flex-direction: column; width: 100%;">
                    <input name="email" type="email" placeholder="Adresse email">
                    @error('email', 'login')
                    <div style="display: flex; align-items: center;">
                        <img style="width:12px; height:12px; position:relative; left:5px; top:-1.5px;" src="{{ asset('exclamation.png') }}" alt="">
                        <p style="font-size:12px; color:red; margin: 0; margin-left:10px;">{{ $message }}</p>
                    </div>
                    @enderror

                </div>
                <div style="display: flex; flex-direction: column; width: 100%;">
                    <input name="password" type="password" placeholder="Mot de passe">
                    @error('password', 'login')
                    <div style="display: flex; align-items: center;">
                        <img style="width:12px; height:12px; position:relative; left:5px; top:-1.5px;" src="{{ asset('exclamation.png') }}" alt="">
                        <p style="font-size:12px; color:red; margin: 0; margin-left:10px;">{{ $message }}</p>
                    </div>
                    @enderror
                </div>

                <button class="absolute top-[445px] left-[30px] w-[200px] h-[55px] bg-black text-white border-none rounded-full text-[20px] font-bold" type="submit">Connexion</button>
            </form>

        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <div style="background-color: black; position:absolute; height:650px; width:550px; z-index:1; opacity: 0.45;"></div>
                    <img src="{{ asset('login_pic1.png') }}" alt="">
                    <div style="z-index: 10;">
                        <h1>Bonjour!</h1>
                        <p>Shiny est bien plus qu’une simple boutique en ligne, c’est un univers
                            dédié à ceux qui vivent la mode et le lifestyle avec audace et authenticité </p>
                        <p>Déjà inscrit ?</p>

                        <button class="hidden" id="login">Connectez-vous</button>
                    </div>
                </div>
                <div class="toggle-panel toggle-right">
                    <div style="background-color: black; position:absolute; height:650px; width:550px; z-index:1; opacity: 0.45;"></div>
                    <img src="{{ asset('login_pic1.png') }}" alt="">
                    <div style="z-index: 10;">
                        <h1>Bonjour!</h1>
                        <p>Shiny est bien plus qu’une simple boutique en ligne, c’est un univers
                            dédié à ceux qui vivent la mode et le lifestyle avec audace et authenticité </p>
                        <p>Pas encore de compte ?</p>
                        <button class="hidden" id="register">Créer un compte</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    


    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });

        window.addEventListener('DOMContentLoaded', () => {
            @if(session('showSignUp'))
            container.classList.add("active");
            @endif
        });
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Story App</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

@include('layouts.navigation')

<div class="max-w-5xl mx-auto p-6">

    <!-- NAV -->
    <div class="flex justify-between items-center mb-6">
        <a href="/" class="text-xl font-bold">Galerija</a>

        <div>
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button>Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mr-4">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </div>

    <!-- CONTENT -->
    {{ $slot }}

</div>

<!-- Alpine -->
<script src="//unpkg.com/alpinejs" defer></script>

<!-- 🎉 CONFETTI ANIMATION -->
<style>
@keyframes fall {
    to {
        transform: translateY(100vh);
        opacity: 0;
    }
}
</style>

<!-- 💳 PAYMENT LOGIC -->
<script>
window.paymentModal = function() {
    return {
        open: false,
        storyId: null,
        step: 'form',
        amount: null,

        pay() {
            if (!this.amount || this.amount <= 0) {
                alert('Įvesk sumą 😄');
                return;
            }

            this.step = 'loading';

            setTimeout(() => {
                fetch('/donate/' + this.storyId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        amount: this.amount
                    })
                })
                .then(res => res.json())
                .then(data => {

                    if (data.error) {
                        alert(data.error);
                        this.step = 'form';
                        return;
                    }

                    this.step = 'success';
                    this.confetti();
                })
                .catch(() => {
                    alert('Kažkas nepavyko 😢');
                    this.step = 'form';
                });

            }, 800);
        },

        finish() {
            this.open = false;
            this.step = 'form';
            window.location.reload();
        },

        confetti() {
            const duration = 1500;
            const end = Date.now() + duration;

            const interval = setInterval(() => {
                if (Date.now() > end) return clearInterval(interval);

                const el = document.createElement('div');
                el.innerHTML = "🎉";
                el.style.position = 'fixed';
                el.style.left = Math.random() * 100 + 'vw';
                el.style.top = '-10px';
                el.style.fontSize = '20px';
                el.style.animation = 'fall 1.5s linear';

                document.body.appendChild(el);
                setTimeout(() => el.remove(), 1500);

            }, 100);
        }
    }
}
</script>

</body>
</html>

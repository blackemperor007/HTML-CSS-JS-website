<?php
// Calculer la date de lancement (24h à partir de maintenant)
$launch_date = strtotime('+24 hours');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lancement Imminent - AppVilla</title>
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(-45deg, #2a0a55, #F1555A, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            overflow: hidden;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            text-align: center;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .logo {
            width: 200px;
            margin-bottom: 2rem;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            opacity: 0;
            animation: fadeInUp 1s ease forwards;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0;
            animation: fadeInUp 1s ease forwards 0.5s;
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 3rem 0;
        }

        .countdown-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 10px;
            min-width: 120px;
            opacity: 0;
            animation: fadeInUp 1s ease forwards 1s;
        }

        .countdown-item span {
            display: block;
        }

        .number {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .text {
            font-size: 1rem;
            text-transform: uppercase;
        }

        .social-icons {
            margin-top: 3rem;
            opacity: 0;
            animation: fadeInUp 1s ease forwards 1.5s;
        }

        .social-icons a {
            color: white;
            font-size: 1.5rem;
            margin: 0 1rem;
            transition: transform 0.3s ease;
        }

        .social-icons a:hover {
            transform: translateY(-5px);
        }

        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .countdown {
                flex-wrap: wrap;
                gap: 1rem;
            }

            .countdown-item {
                min-width: 100px;
                padding: 1rem;
            }

            h1 {
                font-size: 2rem;
            }

            p {
                font-size: 1rem;
            }
        }

        .notify-form {
            margin-top: 2rem;
            opacity: 0;
            animation: fadeInUp 1s ease forwards 2s;
        }

        .notify-form input {
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            width: 300px;
            max-width: 100%;
            margin-right: 1rem;
            font-size: 1rem;
        }

        .notify-form button {
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            background: #F1555A;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .notify-form button:hover {
            background: #081828;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="particles"></div>
    
    <div class="container">
        <img src="assets/images/logo/white-logo.svg" alt="Logo" class="logo">
        
        <h1 class="title">Lancement Imminent</h1>
        <p class="subtitle">Notre nouveau site arrive bientôt</p>
        
        <div class="countdown">
            <div class="countdown-item">
                <span class="number" id="hours">00</span>
                <span class="text">Heures</span>
            </div>
            <div class="countdown-item">
                <span class="number" id="minutes">00</span>
                <span class="text">Minutes</span>
            </div>
            <div class="countdown-item">
                <span class="number" id="seconds">00</span>
                <span class="text">Secondes</span>
            </div>
        </div>

        <div class="notify-form">
            <input type="email" placeholder="Entrez votre email">
            <button>Me notifier</button>
        </div>

        <div class="social-icons">
            <a href="#"><i class="lni lni-facebook-filled"></i></a>
            <a href="#"><i class="lni lni-twitter-original"></i></a>
            <a href="#"><i class="lni lni-instagram"></i></a>
            <a href="#"><i class="lni lni-linkedin-original"></i></a>
        </div>
    </div>

    <script>
        // Animation des particules
        function createParticle() {
            const particles = document.querySelector('.particles');
            const particle = document.createElement('div');
            
            particle.style.cssText = `
                position: absolute;
                width: 5px;
                height: 5px;
                background: rgba(255,255,255,0.5);
                border-radius: 50%;
                pointer-events: none;
                animation: particleFloat 10s linear infinite;
                left: ${Math.random() * 100}vw;
                top: ${Math.random() * 100}vh;
            `;

            particles.appendChild(particle);

            setTimeout(() => {
                particle.remove();
            }, 10000);
        }

        // Créer des particules toutes les 200ms
        setInterval(createParticle, 200);

        // Compte à rebours
        const launchDate = <?php echo $launch_date ?> * 1000; // Convertir en millisecondes

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = launchDate - now;

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');

            if (distance < 0) {
                clearInterval(countdownInterval);
                document.querySelector('.countdown').innerHTML = '<h2>Le site est en ligne !</h2>';
                window.location.href = 'index.html';
            }
        }

        const countdownInterval = setInterval(updateCountdown, 1000);
        updateCountdown();

        // Animation du texte
        const title = document.querySelector('.title');
        const subtitle = document.querySelector('.subtitle');
        
        function animateText(element, delay = 0) {
            const text = element.textContent;
            element.textContent = '';
            
            text.split('').forEach((char, index) => {
                setTimeout(() => {
                    element.textContent += char;
                }, 100 * index + delay);
            });
        }

        setTimeout(() => {
            animateText(title);
            setTimeout(() => {
                animateText(subtitle, 1000);
            }, text.length * 100);
        }, 500);
    </script>
</body>
</html> 
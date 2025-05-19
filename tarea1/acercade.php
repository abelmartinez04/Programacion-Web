<?php require('partes/head.php'); ?>
<div id="divContenido">
    <style>
        .acerca-container {
            display: flex;
            align-items: center;
            gap: 30px;
            padding: 30px;
            background-color: #fafafa;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            max-width: 800px;
            margin: 30px auto;
        }

        .acerca-container img {
            border-radius: 10px;
            height: 200px;
            object-fit: cover;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        .acerca-text {
            max-width: 500px;
            text-align: left;
        }

        .acerca-text h2 {
            margin-top: 0;
            color: #333;
        }

        .acerca-text p {
            margin: 8px 0;
            font-size: 1rem;
            color: #555;
        }

        .acerca-text .links {
            margin-top: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .acerca-text .links a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s;
            font-weight: bold;
            display: inline-block;
            width: fit-content;
        }

        .acerca-text .links a:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }
    </style>

    <div class="acerca-container">
        <img src="imgs/picture.jpg.png" alt="Abel Martinez" height="200">
        <div class="acerca-text">
            <h2>Acerca de mí</h2>
            <p><strong>Nombre:</strong> Abel Martinez</p>
            <div class="links">
                <a href="https://t.me/abelmartinez04" target="_blank">Telegram</a>
                <a href="https://wa.me/18496545803" target="_blank">WhatsApp</a>
                <a href="https://youtu.be/LPB2GCQq1qM?si=FTdBA9yU-t4uKH2K" target="_blank">🎬Video recomendado</a>
            </div>
            
        </div>
    </div>
</div>

<?php require('partes/bottom.php'); ?>
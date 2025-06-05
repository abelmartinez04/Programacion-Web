<?php 

include('libreria/main.php');
plantilla::aplicar();

?>
<style>
    .barbie-title {
        font-family: 'Comic Sans MS', cursive, sans-serif;
        color: #e91e63;
        font-size: 2.5rem;
        text-align: center;
        margin-top: 30px;
        text-shadow: 2px 2px 5px #f8bbd0;
    }

    .barbie-subtitle {
        font-family: 'Comic Sans MS', cursive, sans-serif;
        color: #d81b60;
        font-size: 1.2rem;
        text-align: center;
        margin-bottom: 30px;
    }

    .barbie-img {
        display: block;
        margin: 0 auto;
        border: 5px solid #f48fb1;
        border-radius: 20px;
        max-height: 400px;
        box-shadow: 0 4px 20px rgba(233, 30, 99, 0.5);
    }

    .barbie-description {
        background-color: #fce4ec;
        padding: 20px;
        border-radius: 15px;
        font-size: 1.1rem;
        color: #880e4f;
        box-shadow: 0 0 10px rgba(233, 30, 99, 0.2);
    }
</style>

<div class="text-center">
    <h1 class="barbie-title">🌸 ¡Bienvenida al Mundo Barbie! 🌸</h1>
    <p class="barbie-subtitle">Explora un mundo lleno de estilo, aventuras y muchas profesiones increíbles.</p>
</div>

<div class="barbie-description mb-4">
    <p>
        Este sitio es tu pasaporte a un universo donde Barbie y sus amigas viven emocionantes aventuras.
        Descubre los distintos personajes, explora sus profesiones y analiza estadísticas fabulosas.
    </p>
</div>

<img src="imgs/barbie.jpg" alt="Mundo Barbie" class="img-fluid barbie-img mb-4">

<div class="barbie-description">
    <p>
        ✨ Usa el menú superior para navegar y conocer más sobre:
        <ul>
            <li>👩‍🎤 Personajes con estilo único</li>
            <li>💼 Profesiones fascinantes</li>
            <li>📊 Estadísticas brillantes</li>
        </ul>
        ¡Que comience la aventura en el Mundo Barbie!
    </p>
</div>
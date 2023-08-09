<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-image: url("img.jpg");
            background-size: cover;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        .menu {
            width: 100%;
            height: 200px;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease; /* Adicionando transição ao fundo e ao efeito de escala */
        }

        .menu:hover {
            background-color: #69c4f0;
            color: #fff;
            transform: scale(1.1); /* Efeito de escala ao passar o mouse */
        }
    </style>
</head>
<body>
    <div class="grid-container">
        <a href="nioaque" class="menu" style="background-color: #FFC300;">Nioaque</a>
        <a href="jardim" class="menu" style="background-color: #FF5733;">Jardim</a>
        <a href="bonito" class="menu" style="background-color: #FFC300;">Bonito</a>
        <a href="maracaju" class="menu" style="background-color: #FF5733;">Maracaju</a>
        <a href="sidrolandia" class="menu" style="background-color: #C70039;">Sidrolandia</a>
        <a href="campogrande" class="menu" style="background-color: #FF5733;">Campo Grande</a>
        <a href="aquidauana" class="menu" style="background-color: #FFC300;">Aquidauana</a>
        <a href="belavista" class="menu" style="background-color: #FF5733;">Bela Vista</a>
        <a href="anastacio" class="menu" style="background-color: #FFC300;">Anastacio</a>
    </div>
</body>
</html>

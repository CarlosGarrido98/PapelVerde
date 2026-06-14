<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Paleta de Colores - Papel Verde</title>

<style>
:root{
    --verde-oscuro: #14532D;
    --verde-medio: #166534;
    --verde-claro: #4CAF50;
    --verde-acento: #6BBF59;
    --fondo-claro: #F4F5F7;
    --texto-principal: #1A1A1A;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family: 'Segoe UI', sans-serif;
    background: var(--fondo-claro);
    color: var(--texto-principal);
    padding: 40px;
}

.container{
    max-width: 1200px;
    margin: auto;
}

h1{
    text-align: center;
    margin-bottom: 10px;
    color: var(--verde-oscuro);
}

.subtitle{
    text-align: center;
    margin-bottom: 40px;
    color: #666;
}

.palette{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 24px;
}

.color-card{
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
}

.color-card:hover{
    transform: translateY(-5px);
}

.color-preview{
    height: 140px;
}

.color-info{
    padding: 20px;
}

.color-name{
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 8px;
}

.color-code{
    font-family: monospace;
    color: #555;
}

.verde-oscuro{ background: var(--verde-oscuro); }
.verde-medio{ background: var(--verde-medio); }
.verde-claro{ background: var(--verde-claro); }
.verde-acento{ background: var(--verde-acento); }
.fondo-claro{ background: var(--fondo-claro); border: 1px solid #ddd; }
.texto-principal{ background: var(--texto-principal); }

.usage{
    margin-top: 50px;
    background: white;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.usage h2{
    color: var(--verde-oscuro);
    margin-bottom: 20px;
}

.usage ul{
    line-height: 1.8;
}
</style>
</head>
<body>

<div class="container">

    <h1>🌿 Paleta de Colores - Papel Verde</h1>
    <p class="subtitle">Identidad visual inspirada en sostenibilidad, naturaleza y confianza.</p>

    <div class="palette">

        <div class="color-card">
            <div class="color-preview verde-oscuro"></div>
            <div class="color-info">
                <div class="color-name">Verde Oscuro Principal</div>
                <div class="color-code">#14532D</div>
            </div>
        </div>

        <div class="color-card">
            <div class="color-preview verde-medio"></div>
            <div class="color-info">
                <div class="color-name">Verde Medio</div>
                <div class="color-code">#166534</div>
            </div>
        </div>

        <div class="color-card">
            <div class="color-preview verde-claro"></div>
            <div class="color-info">
                <div class="color-name">Verde Claro</div>
                <div class="color-code">#4CAF50</div>
            </div>
        </div>

        <div class="color-card">
            <div class="color-preview verde-acento"></div>
            <div class="color-info">
                <div class="color-name">Verde Acento</div>
                <div class="color-code">#6BBF59</div>
            </div>
        </div>

        <div class="color-card">
            <div class="color-preview fondo-claro"></div>
            <div class="color-info">
                <div class="color-name">Fondo Claro</div>
                <div class="color-code">#F4F5F7</div>
            </div>
        </div>

        <div class="color-card">
            <div class="color-preview texto-principal"></div>
            <div class="color-info">
                <div class="color-name">Texto Principal</div>
                <div class="color-code">#1A1A1A</div>
            </div>
        </div>

    </div>

    <div class="usage">
        <h2>Uso recomendado</h2>
        <ul>
            <li><strong>#14532D</strong> → Logo, títulos y elementos principales.</li>
            <li><strong>#166534</strong> → Botones principales y secciones destacadas.</li>
            <li><strong>#4CAF50</strong> → Iconos, ilustraciones y elementos ecológicos.</li>
            <li><strong>#6BBF59</strong> → Hover, estados activos y llamadas a la acción.</li>
            <li><strong>#F4F5F7</strong> → Fondo general del sitio.</li>
            <li><strong>#1A1A1A</strong> → Texto principal para máxima legibilidad.</li>
        </ul>
    </div>

</div>

</body>
</html>
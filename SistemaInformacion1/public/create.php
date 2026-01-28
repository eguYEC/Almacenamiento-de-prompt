<?php
include '../config/db.php';
include '../partials/header.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "INSERT INTO Prompt
    (titulo_contenido, descripcion, ia_destino, es_favoritado, version_actual, id_categoria)
    VALUES (?, ?, ?, 0, 1, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $_POST['titulo'],
        $_POST['descripcion'],
        $_POST['ia'],
        $_POST['categoria']
    ]);

    $idPrompt = $conn->lastInsertId();

    $sqlV = "INSERT INTO Version (numero, contenido, id_prompt)
             VALUES (1, ?, ?)";

    $stmtV = $conn->prepare($sqlV);
    $stmtV->execute([
        $_POST['contenido'],
        $idPrompt
    ]);

    $mensaje = "✅ Prompt creado correctamente (ID: $idPrompt)";
}
?>

<canvas id="canvas"></canvas>

<div class="card">
    <div class="card-header">
        <h2>Crear Nuevo Prompt</h2>
        <a href="index.php" class="volver-btn">Volver al menú</a>
    </div>

    <?php if (!empty($mensaje)) echo "<p class='mensaje'>$mensaje</p>"; ?>

    <form method="post">
        <label>Título</label>
        <input name="titulo" required placeholder="Nombre del prompt">

        <label>Contenido</label>
        <textarea name="contenido" rows="4" required placeholder="Escribe el contenido aquí..."></textarea>

        <label>Descripción</label>
        <textarea name="descripcion" placeholder="Descripción opcional..."></textarea>

        <label>Categoría</label>
        <select name="categoria">
            <option value="1">Programación</option>
            <option value="2">Educación</option>
            <option value="3">Marketing</option>
            <option value="4">Creatividad</option>
            <option value="5">Productividad</option>
        </select>

        <label>IA destino</label>
        <select name="ia">
            <option>ChatGPT</option>
            <option>Claude</option>
            <option>Gemini</option>
            <option>General</option>
        </select>

        <button>Guardar Prompt</button>
    </form>
</div>

<style>
html, body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    height: 100%;
    overflow-x: hidden;
}

canvas {
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 0;
    width: 100%;
    height: 100%;
}

.card {
    position: relative;
    z-index: 1;
    max-width: 700px;
    width: 90%;
    margin: 20px auto 40px;
    padding: 30px 25px;
    background: rgba(20, 20, 30, 0.85);
    border-radius: 16px;
    color: #ffffff;
    box-shadow: 0 10px 40px rgba(0,0,0,0.6);
    backdrop-filter: blur(6px);
}

/* Header con botón */
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h2 {
    font-size: 2rem;
    color: #00f6ff;
    text-shadow: 0 0 8px #00f6ff;
}

.volver-btn {
    text-decoration: none;
    padding: 8px 16px;
    background: rgba(255,255,255,0.05);
    color: #fff;
    border-radius: 6px;
    font-weight: 600;
    transition: all 0.2s;
}

.volver-btn:hover {
    background: #00f6ff;
    color: #0a0a0a;
}

/* Mensaje de éxito */
.card .mensaje {
    background: rgba(0,255,128,0.2);
    color: #00ff80;
    padding: 10px 15px;
    border-radius: 6px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: bold;
}

/* Formulario */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

label {
    font-weight: 600;
    margin-bottom: 4px;
}

input, textarea, select {
    padding: 12px;
    border-radius: 8px;
    border: none;
    outline: none;
    font-size: 1rem;
    background: rgba(255,255,255,0.05);
    color: #fff;
    transition: all 0.2s;
}

input::placeholder, textarea::placeholder { color: #ccc; }

input:focus, textarea:focus {
    background: rgba(255,255,255,0.15);
}

/* SELECTS */
select {
    background: rgba(255,255,255,0.05);
    color: #fff;
    cursor: pointer;
}

select:hover, select:focus {
    background: #00f6ff;
    color: #0a0a0a;
}

/* Botón */
button {
    padding: 14px;
    background: #00f6ff;
    color: #0a0a0a;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    transition: all 0.2s;
}

button:hover {
    background: #202122ff;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.4);
}

/* Responsive */
@media(max-width:768px){
    .card { margin: 15px auto 30px; padding: 25px; }
    .card-header h2 { font-size: 1.9rem; }
}

@media(max-width:480px){
    .card { margin: 10px auto 20px; padding: 20px; }
    .card-header h2 { font-size: 1.7rem; }
    input, textarea, select { font-size: 0.95rem; }
    button, .volver-btn { font-size: 1rem; padding: 12px; }
}
canvas {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 0;
    pointer-events: none; /* MUY IMPORTANTE */
}

/* Barra superior SIEMPRE visible */
.top-bar {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    z-index: 1000;
}

/* Contenido principal */
.container-center,
.card {
    position: relative;
    z-index: 2;
}
html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    overflow-y: auto;
}
.container-center {
    padding-top: 80px;
}
.top-bar {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;

    /* IMPORTANTE */
    width: auto;
    background: transparent;
}
.top-bar-user {
    display: flex;
    align-items: center;
    gap: 12px;

    background: rgba(30, 30, 47, 0.9);
    padding: 10px 14px;
    border-radius: 999px; /* efecto píldora */

    box-shadow: 0 6px 20px rgba(0,0,0,0.35);
    backdrop-filter: blur(6px);
}
</style>

<script>
// --- Tu JS de partículas avanzado ---
const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");
let particles = [], fireworkParticles = [], dustParticles = [], ripples = [], techRipples = [];
let backgroundHue = 0, frameCount = 0, autoDrift = true;
const mouse = (() => { let state = { x: null, y: null }; return { get x(){return state.x;}, get y(){return state.y;}, set({x,y}){state={x,y};}, reset(){state={x:null,y:null};}}})();

function adjustParticleCount(){const h=[200,300,400,500,600],w=[450,600,900,1200,1600],hn=[40,60,70,90,110],wn=[40,50,70,90,110];let n=130;for(let i=0;i<h.length;i++)if(canvas.height<h[i]){n=hn[i];break;}for(let i=0;i<w.length;i++)if(canvas.width<w[i]){n=Math.min(n,wn[i]);break;}return n;}

class Particle{constructor(x,y,isFirework=false){const s=isFirework?Math.random()*2+1:Math.random()*0.5+0.3;Object.assign(this,{isFirework,x,y,vx:Math.cos(Math.random()*Math.PI*2)*s,vy:Math.sin(Math.random()*Math.PI*2)*s,size:isFirework?Math.random()*2+2:Math.random()*3+1,hue:Math.random()*360,alpha:1,sizeDirection:Math.random()<0.5?-1:1,trail:[]});} update(mouse){const d=mouse.x!==null?(mouse.x-this.x)**2+(mouse.y-this.y)**2:0;if(!this.isFirework){const f=d&&d<22500?(22500-d)/22500:0;if(mouse.x===null&&autoDrift){this.vx+=(Math.random()-0.5)*0.03;this.vy+=(Math.random()-0.5)*0.03;}if(d){const sd=Math.sqrt(d);this.vx+=((mouse.x-this.x)/sd)*f*0.1;this.vy+=((mouse.y-this.y)/sd)*f*0.1;}this.vx*=mouse.x!==null?0.99:0.998;this.vy*=mouse.y!==null?0.99:0.998;} else {this.alpha-=0.02;} this.x+=this.vx; this.y+=this.vy; if(this.x<=0||this.x>=canvas.width-1)this.vx*=-0.9;if(this.y<0||this.y>canvas.height)this.vy*=-0.9; this.size+=this.sizeDirection*0.1;if(this.size>4||this.size<1)this.sizeDirection*=-1; this.hue=(this.hue+0.3)%360;if(frameCount%2===0&&(Math.abs(this.vx)>0.1||Math.abs(this.vy)>0.1)){this.trail.push({x:this.x,y:this.y,hue:this.hue,alpha:this.alpha});if(this.trail.length>15)this.trail.shift();}} draw(ctx){const g=ctx.createRadialGradient(this.x,this.y,0,this.x,this.y,this.size);g.addColorStop(0,`hsla(${this.hue},80%,60%,${Math.max(this.alpha,0)})`);g.addColorStop(1,`hsla(${this.hue+30},80%,30%,${Math.max(this.alpha,0)})`);ctx.fillStyle=g;ctx.shadowBlur=canvas.width>900?10:0;ctx.shadowColor=`hsl(${this.hue},80%,60%)`;ctx.beginPath();ctx.arc(this.x,this.y,this.size,0,Math.PI*2);ctx.fill();ctx.shadowBlur=0;if(this.trail.length>1){ctx.beginPath();ctx.lineWidth=1.5;for(let i=0;i<this.trail.length-1;i++){const {x:x1,y:y1,hue:h1,alpha:a1}=this.trail[i];const {x:x2,y:y2,hue:h2,alpha:a2}=this.trail[i+1];ctx.strokeStyle=`hsla(${(h1+h2)/2},80%,60%,${Math.max(a1,0)})`;ctx.moveTo(x1,y1);ctx.lineTo(x2,y2);}ctx.stroke();}} isDead(){return this.isFirework&&this.alpha<=0;}}

class DustParticle{constructor(){Object.assign(this,{x:Math.random()*canvas.width,y:Math.random()*canvas.height,size:Math.random()*1.5+0.5,hue:Math.random()*360,vx:(Math.random()-0.5)*0.05,vy:(Math.random()-0.5)*0.05});} update(){this.x=(this.x+this.vx+canvas.width)%canvas.width; this.y=(this.y+this.vy+canvas.height)%canvas.height; this.hue=(this.hue+0.1)%360;} draw(ctx){ctx.fillStyle=`hsla(${this.hue},30%,70%,0.3)`;ctx.beginPath();ctx.arc(this.x,this.y,this.size,0,Math.PI*2);ctx.fill();}}

class Ripple{constructor(x,y,hue=0,maxR=30){Object.assign(this,{x,y,radius:0,maxRadius:maxR,alpha:0.5,hue});} update(){this.radius+=1.5; this.alpha-=0.01; this.hue=(this.hue+5)%360;} draw(ctx){ctx.strokeStyle=`hsla(${this.hue},80%,60%,${this.alpha})`;ctx.lineWidth=2;ctx.beginPath();ctx.arc(this.x,this.y,this.radius,0,Math.PI*2);ctx.stroke();} isDone(){return this.alpha<=0;}}

function createParticles(){particles.length=0; dustParticles.length=0; const n=adjustParticleCount(); for(let i=0;i<n;i++)particles.push(new Particle(Math.random()*canvas.width,Math.random()*canvas.height)); for(let i=0;i<200;i++)dustParticles.push(new DustParticle());}
function resizeCanvas(){canvas.width=window.innerWidth;canvas.height=window.innerHeight; createParticles();}
function drawBackground(){backgroundHue=(backgroundHue+0.2)%360; const g=ctx.createLinearGradient(0,0,0,canvas.height);g.addColorStop(0,`hsl(${backgroundHue},40%,15%)`); g.addColorStop(1,`hsl(${(backgroundHue+120)%360},40%,25%)`);ctx.fillStyle=g; ctx.fillRect(0,0,canvas.width,canvas.height);}
function connectParticles(){const gridSize=120,grid=new Map();particles.forEach(p=>{const k=`${Math.floor(p.x/gridSize)},${Math.floor(p.y/gridSize)}`;if(!grid.has(k))grid.set(k,[]);grid.get(k).push(p);});ctx.lineWidth=1.5;particles.forEach(p=>{const gx=Math.floor(p.x/gridSize),gy=Math.floor(p.y/gridSize);for(let dx=-1;dx<=1;dx++){for(let dy=-1;dy<=1;dy++){const key=`${gx+dx},${gy+dy}`;if(grid.has(key)){grid.get(key).forEach(n=>{if(n!==p){const dx=n.x-p.x,dy=n.y-p.y,d=dx*dx+dy*dy;if(d<10000){ctx.strokeStyle=`hsla(${(p.hue+n.hue)/2},80%,60%,${1-Math.sqrt(d)/100})`;ctx.beginPath();ctx.moveTo(p.x,p.y);ctx.lineTo(n.x,n.y);ctx.stroke();}}});}}}})}

function animate(){drawBackground(); [dustParticles,particles,ripples,techRipples,fireworkParticles].forEach(a=>{for(let i=a.length-1;i>=0;i--){const o=a[i]; o.update(mouse); o.draw(ctx); if(o.isDone?.()||o.isDead?.()) a.splice(i,1);}}); connectParticles(); frameCount++; requestAnimationFrame(animate);}

canvas.addEventListener("mousemove", e=>{const r=canvas.getBoundingClientRect(); mouse.set({x:e.clientX-r.left,y:e.clientY-r.top}); techRipples.push(new Ripple(mouse.x,mouse.y)); autoDrift=false;});
canvas.addEventListener("mouseleave", ()=>{mouse.reset(); autoDrift=true;});
canvas.addEventListener("click", e=>{const r=canvas.getBoundingClientRect(); const x=e.clientX-r.left,y=e.clientY-r.top; ripples.push(new Ripple(x,y,0,60)); for(let i=0;i<15;i++){const a=Math.random()*Math.PI*2,s=Math.random()*2+1; const p=new Particle(x,y,true); p.vx=Math.cos(a)*s; p.vy=Math.sin(a)*s; fireworkParticles.push(p);}});

window.addEventListener("resize",resizeCanvas); resizeCanvas(); animate();
</script>

<?php include '../partials/footer.php'; ?>



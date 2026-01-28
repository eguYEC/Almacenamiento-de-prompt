<?php
include '../config/db.php';
include '../partials/header.php';

$sql = "SELECT p.id, p.titulo_contenido, p.descripcion, c.nombre AS categoria,
               p.ia_destino,
               v.contenido
        FROM Prompt p
        JOIN Categoria c ON p.id_categoria = c.id
        LEFT JOIN Version v
            ON p.id = v.id_prompt AND v.numero = p.version_actual";

$stmt = $conn->query($sql);
$prompts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<canvas id="canvas"></canvas>

<div class="card">
    <div class="card-header">
        <h2>Editar Prompts</h2>
        <a href="index.php" class="volver-btn">Volver al menú</a>
    </div>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Categoría</th>
            <th>IA</th>
            <th>✏️</th>
        </tr>

        <?php foreach ($prompts as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['titulo_contenido'] ?></td>
            <td><?= $p['categoria'] ?></td>
            <td><?= $p['ia_destino'] ?></td>
            <td>
                <a href="update_prompt.php?id=<?= $p['id'] ?>" class="edit-btn">Editar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<style>
/* Reset y tipografía */
body, html {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    overflow-x: hidden;
    height: 100%;
}


/* Canvas de partículas */
canvas {
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 0;
    width: 100%;
    height: 100%;
}


/* Card */
.card {
    position: relative;
    z-index: 1;
    max-width: 900px;
    width: 95%;
    margin: 20px auto 40px;
    padding: 30px 25px;
    background: rgba(20,20,30,0.85);
    border-radius: 16px;
    color: #fff;
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


/* Tabla */
.table {
    width: 100%;
    border-collapse: collapse;
}


.table th, .table td {
    padding: 12px 15px;
    text-align: left;
}


.table th {
    background: rgba(255,255,255,0.1);
    color: #00f6ff;
}


.table tr:nth-child(even) {
    background: rgba(255,255,255,0.05);
}


.table tr:hover {
    background: rgba(0,246,255,0.15);
}


.table a {
    color: #fff;
    text-decoration: none;
    transition: all 0.2s;
}


.table a:hover {
    color: #00d0ff;
    text-decoration: underline;
}


/* Estrella favoritos */
.star {
    cursor:pointer;
    font-size:20px;
    color:#555;
    transition: all 0.2s;
}


.star.active {
    color: gold;
}


/* Modal */
.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(2px);
    align-items: center;
    justify-content: center;
    z-index: 2;
}


.modal-content {
    background: #1f2f36;
    color: #fff;
    padding: 25px 30px;
    width: 80%;
    max-width: 1000px;
    border-radius: 14px;
    box-shadow: 0 0 30px rgba(0,0,0,0.4);
    transform: scale(0.2);
    opacity: 0;
    transition: all 0.5s cubic-bezier(0.22, 1, 0.36, 1);
}


.modal.show .modal-content {
    transform: scale(1);
    opacity: 1;
}


/* Responsive */
@media(max-width:768px){
    .card { padding: 25px; }
    .card-header h2 { font-size: 1.9rem; }
    .volver-btn { font-size: 0.95rem; padding: 8px 14px; }
}


@media(max-width:480px){
    .card { padding: 20px; }
    .card-header h2 { font-size: 1.7rem; }
    .volver-btn { font-size: 0.85rem; padding: 6px 12px; }
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
// === JS de partículas igual que create.php ===
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


// ==== Modal ====
function openModal(data){
    document.getElementById('modal-title').innerText = data.titulo_contenido;
    document.getElementById('modal-desc').innerText = data.descripcion;
    document.getElementById('modal-content').innerText = data.contenido;
    const modal = document.getElementById('modal');
    modal.style.display = "flex";
    setTimeout(() => { modal.classList.add("show"); }, 10);
}


function closeModal(e){
    const modal = document.getElementById('modal');
    if(e.target.id === "modal"){
        modal.classList.remove("show");
        setTimeout(() => { modal.style.display = "none"; }, 500);
    }
}


// Toggle favorito
function toggleFavorite(id, star){
    fetch("toggle_favorite.php?id=" + id)
        .then(res => res.text())
        .then(resp => { star.classList.toggle("active"); });
}
</script>

<?php include '../partials/footer.php'; ?>

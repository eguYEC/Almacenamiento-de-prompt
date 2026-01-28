<?php include '../partials/header.php'; ?>


<!-- CANVAS DE FONDO -->
<canvas id="canvas"></canvas>


<!-- TARJETA CENTRAL -->
<div class="card">
    <h1>PROMPT VAULT</h1>
    <p class="subtitle">Gestión profesional de prompts</p>


    <div class="menu">
        <a href="create.php">➕ Crear nuevo prompt</a>
        <a href="search.php">🔍 Buscar prompts</a>
        <a href="edit.php">✏️ Editar prompt</a>
        <a href="favorites.php">⭐ Favoritos</a>
        <a href="categorias.php">📂 Categorías</a>
    </div>
</div>


<!-- ESTILOS -->
<style>
/* RESET BÁSICO */
html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    overflow-y: auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}


/* CANVAS DE FONDO */
canvas {
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 0;
}


/* TARJETA CENTRAL */
.card {
    position: relative;
    z-index: 1;
    max-width: 700px;
    margin: 120px auto;
    padding: 40px;
    background: rgba(20, 20, 30, 0.85);
    border-radius: 16px;
    color: #ffffff;
    text-align: center;
    box-shadow: 0 8px 30px rgba(0,0,0,0.6);
    backdrop-filter: blur(5px);
    transition: transform 0.3s;
}
.card:hover {
    transform: translateY(-5px);
}


.card h1 {
    font-size: 3rem;
    margin-bottom: 10px;
    color: #00f6ff;
    text-shadow: 0 0 8px #00f6ff;
}


.card .subtitle {
    font-size: 1.2rem;
    color: #b0b0c0;
    margin-bottom: 30px;
}


/* MENÚ DE BOTONES */
.menu {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 10px;
}


.menu a {
    padding: 14px 20px;
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}
.menu a:hover {
    background: linear-gradient(135deg, #3b82f6, #60a5fa);
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.4);
}


/* RESPONSIVO */
@media(max-width: 768px){
    .card {
        margin: 80px 20px;
        padding: 30px;
    }
    .card h1 {
        font-size: 2.5rem;
    }
    .menu a {
        font-size: 0.95rem;
        padding: 12px 16px;
    }
}
/* Canvas siempre al fondo */
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


/* Contenido principal */
.container-center,
.card {
    position: relative;
    z-index: 2;
}
.container-center {
    padding-top: 80px;
}

</style>


<!-- SCRIPT JS DE PARTICULAS -->
<script>
// --- VARIABLES PRINCIPALES ---
const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");


let particles = [], fireworkParticles = [], dustParticles = [], ripples = [], techRipples = [];
let backgroundHue = 0, frameCount = 0, autoDrift = true;


const mouse = (() => {
    let state = { x: null, y: null };
    return {
        get x() { return state.x; },
        get y() { return state.y; },
        set({ x, y }) { state = { x, y }; },
        reset() { state = { x: null, y: null }; }
    };
})();


// --- AJUSTE DE PARTICULAS POR TAMAÑO ---
function adjustParticleCount() {
    const hCond = [200,300,400,500,600], wCond = [450,600,900,1200,1600];
    const hNum = [40,60,70,90,110], wNum = [40,50,70,90,110];
    let num = 130;
    for(let i=0;i<hCond.length;i++) if(canvas.height<hCond[i]) {num=hNum[i]; break;}
    for(let i=0;i<wCond.length;i++) if(canvas.width<wCond[i]) {num=Math.min(num,wNum[i]); break;}
    return num;
}


// --- CLASES ---
class Particle {
    constructor(x,y,isFirework=false){
        const speed = isFirework ? Math.random()*2+1 : Math.random()*0.5+0.3;
        Object.assign(this,{
            isFirework,x,y,
            vx: Math.cos(Math.random()*Math.PI*2)*speed,
            vy: Math.sin(Math.random()*Math.PI*2)*speed,
            size: isFirework ? Math.random()*2+2 : Math.random()*3+1,
            hue: Math.random()*360,
            alpha:1,
            sizeDirection: Math.random()<0.5?-1:1,
            trail:[]
        });
    }
    update(mouse){
        const dist = mouse.x!==null ? (mouse.x-this.x)**2 + (mouse.y-this.y)**2 : 0;
        if(!this.isFirework){
            const force = dist && dist<22500 ? (22500-dist)/22500 : 0;
            if(mouse.x===null && autoDrift){ this.vx+=(Math.random()-0.5)*0.03; this.vy+=(Math.random()-0.5)*0.03;}
            if(dist){
                const sqrtD=Math.sqrt(dist);
                this.vx += ((mouse.x-this.x)/sqrtD)*force*0.1;
                this.vy += ((mouse.y-this.y)/sqrtD)*force*0.1;
            }
            this.vx *= mouse.x!==null?0.99:0.998;
            this.vy *= mouse.y!==null?0.99:0.998;
        } else { this.alpha -= 0.02; }
        this.x += this.vx; this.y += this.vy;
        if(this.x<=0||this.x>=canvas.width-1)this.vx*=-0.9;
        if(this.y<0||this.y>canvas.height)this.vy*=-0.9;
        this.size += this.sizeDirection*0.1;
        if(this.size>4||this.size<1)this.sizeDirection*=-1;
        this.hue = (this.hue+0.3)%360;
        if(frameCount%2===0&&(Math.abs(this.vx)>0.1||Math.abs(this.vy)>0.1)){
            this.trail.push({x:this.x,y:this.y,hue:this.hue,alpha:this.alpha});
            if(this.trail.length>15)this.trail.shift();
        }
    }
    draw(ctx){
        const gradient = ctx.createRadialGradient(this.x,this.y,0,this.x,this.y,this.size);
        gradient.addColorStop(0, `hsla(${this.hue}, 80%, 60%, ${Math.max(this.alpha,0)})`);
        gradient.addColorStop(1, `hsla(${this.hue+30}, 80%, 30%, ${Math.max(this.alpha,0)})`);
        ctx.fillStyle = gradient;
        ctx.shadowBlur = canvas.width>900?10:0;
        ctx.shadowColor = `hsl(${this.hue},80%,60%)`;
        ctx.beginPath(); ctx.arc(this.x,this.y,this.size,0,Math.PI*2); ctx.fill();
        ctx.shadowBlur=0;
        if(this.trail.length>1){
            ctx.beginPath(); ctx.lineWidth=1.5;
            for(let i=0;i<this.trail.length-1;i++){
                const {x:x1,y:y1,hue:h1,alpha:a1} = this.trail[i];
                const {x:x2,y:y2} = this.trail[i+1];
                ctx.strokeStyle = `hsla(${h1},80%,60%,${Math.max(a1,0)})`;
                ctx.moveTo(x1,y1); ctx.lineTo(x2,y2);
            } ctx.stroke();
        }
    }
    isDead(){return this.isFirework && this.alpha<=0;}
}


class DustParticle{
    constructor(){
        Object.assign(this,{
            x:Math.random()*canvas.width,
            y:Math.random()*canvas.height,
            size:Math.random()*1.5+0.5,
            hue:Math.random()*360,
            vx:(Math.random()-0.5)*0.05,
            vy:(Math.random()-0.5)*0.05
        });
    }
    update(){
        this.x = (this.x + this.vx + canvas.width)%canvas.width;
        this.y = (this.y + this.vy + canvas.height)%canvas.height;
        this.hue=(this.hue+0.1)%360;
    }
    draw(ctx){ ctx.fillStyle=`hsla(${this.hue},30%,70%,0.3)`; ctx.beginPath(); ctx.arc(this.x,this.y,this.size,0,Math.PI*2); ctx.fill(); }
}


class Ripple{
    constructor(x,y,hue=0,maxRadius=30){Object.assign(this,{x,y,radius:0,maxRadius,alpha:0.5,hue});}
    update(){ this.radius+=1.5; this.alpha-=0.01; this.hue=(this.hue+5)%360;}
    draw(ctx){ctx.strokeStyle=`hsla(${this.hue},80%,60%,${this.alpha})`; ctx.lineWidth=2; ctx.beginPath(); ctx.arc(this.x,this.y,this.radius,0,Math.PI*2); ctx.stroke();}
    isDone(){return this.alpha<=0;}
}


// --- FUNCIONES Y ANIMACIÓN ---
function createParticles(){
    particles.length=0; dustParticles.length=0;
    const num = adjustParticleCount();
    for(let i=0;i<num;i++) particles.push(new Particle(Math.random()*canvas.width, Math.random()*canvas.height));
    for(let i=0;i<200;i++) dustParticles.push(new DustParticle());
}


function resizeCanvas(){ canvas.width=window.innerWidth; canvas.height=window.innerHeight; createParticles(); }


function drawBackground(){
    backgroundHue=(backgroundHue+0.2)%360;
    const grad = ctx.createLinearGradient(0,0,0,canvas.height);
    grad.addColorStop(0, `hsl(${backgroundHue},40%,15%)`);
    grad.addColorStop(1, `hsl(${(backgroundHue+120)%360},40%,25%)`);
    ctx.fillStyle = grad; ctx.fillRect(0,0,canvas.width,canvas.height);
}


function connectParticles(){
    const gridSize=120, grid=new Map();
    particles.forEach(p=>{ const key=`${Math.floor(p.x/gridSize)},${Math.floor(p.y/gridSize)}`; if(!grid.has(key)) grid.set(key,[]); grid.get(key).push(p);});
    ctx.lineWidth=1.5;
    particles.forEach(p=>{
        const gx=Math.floor(p.x/gridSize), gy=Math.floor(p.y/gridSize);
        for(let dx=-1;dx<=1;dx++){
            for(let dy=-1;dy<=1;dy++){
                const key=`${gx+dx},${gy+dy}`;
                if(grid.has(key)){
                    grid.get(key).forEach(neighbor=>{
                        if(neighbor!==p){
                            const diffX=neighbor.x-p.x, diffY=neighbor.y-p.y;
                            const dist=diffX*diffX+diffY*diffY;
                            if(dist<10000){ ctx.strokeStyle=`hsla(${(p.hue+neighbor.hue)/2},80%,60%,${1-Math.sqrt(dist)/100})`; ctx.beginPath(); ctx.moveTo(p.x,p.y); ctx.lineTo(neighbor.x,neighbor.y); ctx.stroke(); }
                        }
                    });
                }
            }
        }
    });
}


function animate(){
    drawBackground();
    [dustParticles, particles, ripples, techRipples, fireworkParticles].forEach(arr=>{
        for(let i=arr.length-1;i>=0;i--){ const obj=arr[i]; obj.update(mouse); obj.draw(ctx); if(obj.isDone?.()||obj.isDead?.()) arr.splice(i,1);}
    });
    connectParticles();
    frameCount++; requestAnimationFrame(animate);
}


// --- EVENTOS ---
canvas.addEventListener("mousemove", e=>{
    const rect=canvas.getBoundingClientRect();
    mouse.set({x:e.clientX-rect.left,y:e.clientY-rect.top});
    techRipples.push(new Ripple(mouse.x,mouse.y));
    autoDrift=false;
});
canvas.addEventListener("mouseleave", ()=>{mouse.reset(); autoDrift=true;});
canvas.addEventListener("click", e=>{
    const rect=canvas.getBoundingClientRect();
    const x=e.clientX-rect.left, y=e.clientY-rect.top;
    ripples.push(new Ripple(x,y,0,60));
    for(let i=0;i<15;i++){
        const angle=Math.random()*Math.PI*2, speed=Math.random()*2+1;
        const p=new Particle(x,y,true); p.vx=Math.cos(angle)*speed; p.vy=Math.sin(angle)*speed;
        fireworkParticles.push(p);
    }
});


window.addEventListener("resize", resizeCanvas);
resizeCanvas(); animate();
</script>


<?php include '../partials/footer.php'; ?>




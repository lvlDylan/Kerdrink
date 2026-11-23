const canvas = document.getElementById('captchaCanvas'); 
const ctx = canvas.getContext('2d'); 
const refreshBtn = document.getElementById('refreshBtn'); 
const validateBtn = document.getElementById('validateBtn'); 
const userInput = document.getElementById('userInput'); 
const message = document.getElementById('message'); 
let currentCaptcha = ''; 

// Création d'une chaîne de caractère pseudo aléatoire de paramètre length (10 par défaut)
function generateRandomText(length = 7) {
    if (isNaN(length))
        length = 7;

    const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    let result = "";

    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        result += characters[randomIndex];
    }

    return result;
}

function drawCaptcha(ctx) {
  currentCaptcha = generateRandomText();
  
  // Fond
  ctx.fillStyle = '#f0f0f0';
  ctx.fillRect(0, 0, canvas.width, canvas.height);

  // Lignes de bruit aléatoires
  for (let i = 0; i < 4; i++) {
    ctx.strokeStyle = `rgb(${Math.random() * 150}, ${Math.random() * 150}, ${Math.random() * 150})`;
    ctx.beginPath();
    ctx.moveTo(Math.random() * canvas.width, Math.random() * canvas.height);
    ctx.lineTo(Math.random() * canvas.width, Math.random() * canvas.height);
    ctx.lineWidth = 1.5;
    ctx.stroke();
  }

  // Rendu caractère par caractère avec rotation et décalage
  const startX = 20;
  const spacing = 28;
  ctx.textBaseline = 'middle';

  for (let i = 0; i < currentCaptcha.length; i++) {
    const char = currentCaptcha[i];
    const x = startX + i * spacing;
    const y = canvas.height / 2 + (Math.random() * 10 - 5);
    const angle = (Math.random() * 40 - 20) * (Math.PI / 180);

    ctx.save();
    ctx.translate(x, y);
    ctx.rotate(angle);
    ctx.font = `bold ${26 + Math.floor(Math.random() * 6)}px sans-serif`;
    ctx.fillStyle = `rgb(${Math.random() * 100}, ${Math.random() * 100}, ${Math.random() * 100})`;
    ctx.fillText(char, 0, 0);
    ctx.restore();
  }
}

drawCaptcha(ctx);

refreshBtn.addEventListener('click', () => drawCaptcha(ctx));
validateBtn.addEventListener('click', () => {
    if (currentCaptcha === userInput.value) {
        document.getElementById('registerBtn').disabled = false;
    }
});
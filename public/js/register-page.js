/* =============================================
   MATCHUP — Register Page JavaScript
   ============================================= */

document.addEventListener('DOMContentLoaded', () => {

  // ─── 1. Background Orbs ───────────────────────────────────────────────────
  ['bg-orb-1','bg-orb-2'].forEach(cls => {
    const orb = document.createElement('div');
    orb.className = `bg-orb ${cls}`;
    document.body.prepend(orb);
  });

  // ─── 2. Floating Particles ────────────────────────────────────────────────
  for (let i = 0; i < 14; i++) {
    const p = document.createElement('div');
    p.className = 'particle';
    p.style.cssText = `
      left:${(Math.random()*100).toFixed(1)}%;
      --dur:${(6+Math.random()*9).toFixed(1)}s;
      --dx:${(Math.random()*100-50).toFixed(0)}px;
      animation-delay:${(Math.random()*10).toFixed(1)}s;
    `;
    document.body.appendChild(p);
  }

  // ─── 3. Restructure the Form ─────────────────────────────────────────────
  const body      = document.body;
  const headerEl  = document.querySelector('header');
  const formEl    = document.querySelector('form');

  // Page wrapper
  const pageWrap = document.createElement('div');
  pageWrap.className = 'page-wrapper';

  // Card
  const card = document.createElement('div');
  card.className = 'register-card';

  // Card header
  card.innerHTML = `
    <div class="card-header">
      <div class="card-icon">⚽</div>
      <h2>إنشاء حساب</h2>
      <p>انضم إلى MatchUp وابدأ حجز ملعبك الآن</p>
    </div>
  `;

  // Move form into card
  card.appendChild(formEl);
  pageWrap.appendChild(card);
  body.appendChild(pageWrap);

  // ─── 4. Rebuild Form Fields ───────────────────────────────────────────────
  // We restyle each div inside the form
  const fieldDivs = formEl.querySelectorAll('div');
  const configs = [
    { id:'name',                  label:'الاسم الكامل',       icon:'fa-user',       type:'text',     placeholder:'أدخل اسمك الكامل',        pw: false },
    { id:'email',                 label:'البريد الإلكتروني',  icon:'fa-envelope',   type:'email',    placeholder:'example@mail.com',         pw: false },
    { id:'password',              label:'كلمة المرور',         icon:'fa-lock',       type:'password', placeholder:'••••••••',                  pw: true  },
    { id:'password_confirmation', label:'تأكيد كلمة المرور',  icon:'fa-shield-halved', type:'password', placeholder:'••••••••',              pw: false },
  ];

  // Clear and rebuild
  formEl.innerHTML = '';

  configs.forEach(cfg => {
    const group = document.createElement('div');
    group.className = 'form-group';

    // Label
    const lbl = document.createElement('label');
    lbl.setAttribute('for', cfg.id);
    lbl.textContent = cfg.label;
    group.appendChild(lbl);

    // Input wrap
    const wrap = document.createElement('div');
    wrap.className = 'input-wrap';
    wrap.id = `wrap-${cfg.id}`;

    // Icon left
    const iconL = document.createElement('i');
    iconL.className = `fa-solid ${cfg.icon}`;
    wrap.appendChild(iconL);

    // Input
    const inp = document.createElement('input');
    inp.id   = cfg.id;
    inp.name = cfg.id;
    inp.type = cfg.type;
    inp.placeholder = cfg.placeholder;
    inp.autocomplete = cfg.id === 'password' ? 'new-password'
                     : cfg.id === 'password_confirmation' ? 'new-password'
                     : cfg.id === 'email' ? 'username' : cfg.id;
    if (cfg.id === 'name') inp.autofocus = true;
    inp.required = true;
    wrap.appendChild(inp);

    // Eye toggle for password fields
    if (cfg.pw || cfg.id === 'password_confirmation') {
      const eye = document.createElement('button');
      eye.type = 'button';
      eye.className = 'toggle-pw';
      eye.setAttribute('aria-label', 'إظهار/إخفاء كلمة المرور');
      eye.innerHTML = '<i class="fa-solid fa-eye"></i>';
      eye.addEventListener('click', () => {
        const shown = inp.type === 'text';
        inp.type = shown ? 'password' : 'text';
        eye.innerHTML = shown
          ? '<i class="fa-solid fa-eye"></i>'
          : '<i class="fa-solid fa-eye-slash"></i>';
      });
      wrap.appendChild(eye);
    }

    group.appendChild(wrap);

    // Strength bar for main password
    if (cfg.id === 'password') {
      const bar = document.createElement('div');
      bar.className = 'pw-strength';
      bar.innerHTML = '<div class="pw-strength-fill" id="pw-fill"></div>';
      group.appendChild(bar);

      const hint = document.createElement('div');
      hint.className = 'pw-hint';
      hint.id = 'pw-hint';
      hint.textContent = 'أدخل كلمة مرور قوية';
      group.appendChild(hint);
    }

    // Error placeholder
    const err = document.createElement('div');
    err.className = 'field-error';
    err.id = `err-${cfg.id}`;
    group.appendChild(err);

    formEl.appendChild(group);
  });

  // CSRF hidden input
  const csrf = document.createElement('input');
  csrf.type  = 'hidden';
  csrf.name  = '_token';
  csrf.value = document.querySelector('meta[name="csrf-token"]')?.content || '';
  formEl.prepend(csrf);

  // Footer: login link + submit
  const footer = document.createElement('div');
  footer.className = 'form-footer';

  const btn = document.createElement('button');
  btn.type = 'submit';
  btn.className = 'btn-register';
  btn.innerHTML = `
    <div class="spinner"></div>
    <span class="btn-text">إنشاء الحساب ⚡</span>
  `;

  const loginLink = document.createElement('div');
  loginLink.className = 'login-link';
  loginLink.innerHTML = `لديك حساب بالفعل؟ <a href="/login">سجّل الدخول</a>`;

  footer.appendChild(btn);
  footer.appendChild(loginLink);
  formEl.appendChild(footer);

  // ─── 5. Password Strength Meter ───────────────────────────────────────────
  const pwInput = document.getElementById('password');
  const pwFill  = document.getElementById('pw-fill');
  const pwHint  = document.getElementById('pw-hint');

  const levels = [
    { min: 0,  max: 1,  w: '0%',   color: '#2e5e42', label: 'أدخل كلمة مرور' },
    { min: 1,  max: 2,  w: '25%',  color: '#ff5e5e', label: 'ضعيفة جداً' },
    { min: 2,  max: 3,  w: '50%',  color: '#ffaa00', label: 'مقبولة' },
    { min: 3,  max: 4,  w: '75%',  color: '#00d46a', label: 'جيدة' },
    { min: 4,  max: 5,  w: '100%', color: '#39ff8a', label: 'ممتازة 🔥' },
  ];

  const calcStrength = (pw) => {
    let score = 0;
    if (pw.length >= 8)  score++;
    if (pw.length >= 12) score++;
    if (/[A-Z]/.test(pw)) score++;
    if (/[0-9]/.test(pw)) score++;
    if (/[^A-Za-z0-9]/.test(pw)) score++;
    return score;
  };

  if (pwInput) {
    pwInput.addEventListener('input', () => {
      const score = calcStrength(pwInput.value);
      const lvl   = levels.find(l => score >= l.min && score < l.max) || levels[levels.length-1];
      if (pwFill) {
        pwFill.style.width      = pwInput.value ? lvl.w : '0%';
        pwFill.style.background = lvl.color;
      }
      if (pwHint) {
        pwHint.textContent  = pwInput.value ? lvl.label : 'أدخل كلمة مرور قوية';
        pwHint.style.color  = pwInput.value ? lvl.color : '';
      }
    });
  }

  // ─── 6. Live Confirm-Password Check ──────────────────────────────────────
  const confirmInput = document.getElementById('password_confirmation');
  const confirmWrap  = document.getElementById('wrap-password_confirmation');
  const confirmErr   = document.getElementById('err-password_confirmation');

  if (confirmInput) {
    confirmInput.addEventListener('input', () => {
      if (!confirmInput.value) {
        confirmErr.textContent = '';
        confirmWrap.classList.remove('has-error');
        return;
      }
      const match = confirmInput.value === pwInput.value;
      confirmErr.innerHTML = match
        ? '<i class="fa-solid fa-check" style="color:#39ff8a"></i> كلمتا المرور متطابقتان'
        : '<i class="fa-solid fa-triangle-exclamation"></i> كلمتا المرور غير متطابقتين';
      confirmErr.style.color = match ? 'var(--green-neon)' : 'var(--error)';
      confirmWrap.classList.toggle('has-error', !match);
    });
  }

  // ─── 7. Input Focus Glow ──────────────────────────────────────────────────
  document.querySelectorAll('.input-wrap input').forEach(inp => {
    inp.addEventListener('focus', () => {
      inp.closest('.input-wrap').querySelector('i.fa-solid:first-child').style.color = 'var(--green-neon)';
    });
    inp.addEventListener('blur', () => {
      inp.closest('.input-wrap').querySelector('i.fa-solid:first-child').style.color = '';
    });
  });

  // ─── 8. Submit Button Loading + Validation ────────────────────────────────
  formEl.addEventListener('submit', (e) => {
    let valid = true;

    // Basic empty check
    configs.forEach(cfg => {
      const inp  = document.getElementById(cfg.id);
      const wrap = document.getElementById(`wrap-${cfg.id}`);
      const err  = document.getElementById(`err-${cfg.id}`);
      if (!inp.value.trim()) {
        wrap.classList.add('has-error');
        err.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> هذا الحقل مطلوب';
        err.style.color = 'var(--error)';
        valid = false;
      } else {
        wrap.classList.remove('has-error');
        if (cfg.id !== 'password_confirmation') err.textContent = '';
      }
    });

    // Password match
    if (pwInput && confirmInput && pwInput.value !== confirmInput.value) {
      confirmWrap.classList.add('has-error');
      confirmErr.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> كلمتا المرور غير متطابقتين';
      confirmErr.style.color = 'var(--error)';
      valid = false;
    }

    if (!valid) { e.preventDefault(); return; }

    btn.classList.add('loading');
  });

  // ─── 9. Ripple Effect ─────────────────────────────────────────────────────
  btn.addEventListener('click', (e) => {
    const rect = btn.getBoundingClientRect();
    const rpl  = document.createElement('span');
    const size = Math.max(rect.width, rect.height);
    rpl.style.cssText = `
      position:absolute; border-radius:50%;
      width:${size}px; height:${size}px;
      left:${e.clientX-rect.left-size/2}px;
      top:${e.clientY-rect.top-size/2}px;
      background:rgba(2,12,8,0.2);
      transform:scale(0); pointer-events:none;
      animation: ripple 0.55s ease-out forwards;
    `;
    btn.appendChild(rpl);
    setTimeout(() => rpl.remove(), 600);
  });

  const rplStyle = document.createElement('style');
  rplStyle.textContent = '@keyframes ripple { to { transform:scale(3); opacity:0; } }';
  document.head.appendChild(rplStyle);

  // ─── 10. Cursor Glow ─────────────────────────────────────────────────────
  const glow = document.createElement('div');
  glow.style.cssText = `
    position:fixed; pointer-events:none; z-index:9999;
    width:350px; height:350px; border-radius:50%;
    background:radial-gradient(circle, rgba(57,255,138,0.05) 0%, transparent 70%);
    transform:translate(-50%,-50%); opacity:0;
    transition:opacity 0.3s;
  `;
  document.body.appendChild(glow);

  let mx=0, my=0, gx=0, gy=0;
  document.addEventListener('mousemove', e => { mx=e.clientX; my=e.clientY; glow.style.opacity='1'; });
  document.addEventListener('mouseleave', () => { glow.style.opacity='0'; });
  (function animGlow() {
    gx += (mx-gx)*0.09; gy += (my-gy)*0.09;
    glow.style.left = gx+'px'; glow.style.top = gy+'px';
    requestAnimationFrame(animGlow);
  })();

});

/* =============================================
   MATCHUP — Login Page JavaScript
   ============================================= */

document.addEventListener('DOMContentLoaded', () => {

  // ─── 1. Background Orbs & Particles ─────────────────────────────────────
  ['bg-orb-1','bg-orb-2','bg-orb-3'].forEach(cls => {
    const orb = document.createElement('div');
    orb.className = `bg-orb ${cls}`;
    document.body.prepend(orb);
  });

  for (let i = 0; i < 16; i++) {
    const p = document.createElement('div');
    p.className = 'particle';
    p.style.cssText = `
      left:${(Math.random()*100).toFixed(1)}%;
      --dur:${(6+Math.random()*9).toFixed(1)}s;
      --dx:${(Math.random()*100-50).toFixed(0)}px;
      --delay:${(Math.random()*10).toFixed(1)}s;
    `;
    document.body.appendChild(p);
  }

  // ─── 2. Build Full Layout ─────────────────────────────────────────────────
  const body  = document.body;
  const formEl = document.querySelector('form');

  // Page wrapper
  const pageWrap = document.createElement('div');
  pageWrap.className = 'page-wrapper';

  // Split container
  const container = document.createElement('div');
  container.className = 'login-container';

  // ── Left branding panel ──
  const leftPanel = document.createElement('div');
  leftPanel.className = 'login-left';
  leftPanel.innerHTML = `
    <div class="field-circle"></div>
    <div class="brand-content">
      <div class="brand-logo-wrap">
        <img src="images/soccer-logo.png" alt="MatchUp Logo">
      </div>
      <span class="brand-name">MatchUp</span>
      <p class="brand-tagline">المنصة الذكية لحجز الملاعب وإدارة المباريات بكل سهولة</p>
      <div class="mini-stats">
        <div class="mini-stat">
          <span class="mini-stat-num" data-target="320">0</span>
          <span class="mini-stat-lbl">ملعب</span>
        </div>
        <div class="mini-stat">
          <span class="mini-stat-num" data-target="12000">0</span>
          <span class="mini-stat-lbl">حجز</span>
        </div>
        <div class="mini-stat">
          <span class="mini-stat-num" data-target="98">0</span>
          <span class="mini-stat-lbl">% رضى</span>
        </div>
      </div>
    </div>
  `;

  // ── Right form panel ──
  const rightPanel = document.createElement('div');
  rightPanel.className = 'login-right';

  // Session status
  const sessionStatus = document.createElement('div');
  sessionStatus.className = 'session-status';
  sessionStatus.id = 'session-status';
  sessionStatus.innerHTML = '<i class="fa-solid fa-circle-check"></i> <span id="session-msg"></span>';

  // Form header
  const formHeader = document.createElement('div');
  formHeader.className = 'form-header';
  formHeader.innerHTML = `
    <h2>مرحباً بعودتك 👋</h2>
    <p>سجّل دخولك للوصول إلى حجوزاتك وملاعبك</p>
  `;

  rightPanel.appendChild(sessionStatus);
  rightPanel.appendChild(formHeader);
  rightPanel.appendChild(formEl);

  container.appendChild(leftPanel);
  container.appendChild(rightPanel);
  pageWrap.appendChild(container);
  body.appendChild(pageWrap);

  // ─── 3. Rebuild Form Fields ───────────────────────────────────────────────
  formEl.innerHTML = '';

  // Email field
  const emailGroup = buildField({
    id: 'email', name: 'email',
    label: 'البريد الإلكتروني',
    type: 'email',
    icon: 'fa-envelope',
    placeholder: 'example@mail.com',
    autocomplete: 'username',
    autofocus: true,
  });

  // Password field (with eye toggle)
  const pwGroup = buildField({
    id: 'password', name: 'password',
    label: 'كلمة المرور',
    type: 'password',
    icon: 'fa-lock',
    placeholder: '••••••••',
    autocomplete: 'current-password',
    hasToggle: true,
  });

  // Remember + Forgot row
  const rememberRow = document.createElement('div');
  rememberRow.className = 'remember-row';
  rememberRow.innerHTML = `
    <label class="remember-label">
      <input type="checkbox" id="remember_me" name="remember">
      <span>تذكّرني</span>
    </label>
    <a class="forgot-link" href="/forgot-password">نسيت كلمة المرور؟</a>
  `;

  // Submit button
  const btn = document.createElement('button');
  btn.type = 'submit';
  btn.className = 'btn-login';
  btn.innerHTML = `
    <div class="spinner"></div>
    <span class="btn-text">تسجيل الدخول ⚡</span>
  `;

  // Register CTA
  const regCta = document.createElement('div');
  regCta.className = 'register-cta';
  regCta.innerHTML = `ليس لديك حساب؟ <a href="/register">إنشاء حساب جديد</a>`;

  // CSRF
  const csrf = document.createElement('input');
  csrf.type = 'hidden';
  csrf.name = '_token';
  csrf.value = document.querySelector('meta[name="csrf-token"]')?.content || '';
  formEl.appendChild(csrf);

  formEl.appendChild(emailGroup);
  formEl.appendChild(pwGroup);
  formEl.appendChild(rememberRow);
  formEl.appendChild(btn);
  formEl.appendChild(regCta);

  // ─── 4. Field Builder Helper ──────────────────────────────────────────────
  function buildField({ id, name, label, type, icon, placeholder, autocomplete, autofocus, hasToggle }) {
    const group = document.createElement('div');
    group.className = 'form-group';

    const lbl = document.createElement('label');
    lbl.setAttribute('for', id);
    lbl.textContent = label;
    group.appendChild(lbl);

    const wrap = document.createElement('div');
    wrap.className = 'input-wrap';
    wrap.id = `wrap-${id}`;

    const iconEl = document.createElement('i');
    iconEl.className = `fa-solid ${icon} input-icon`;
    wrap.appendChild(iconEl);

    const inp = document.createElement('input');
    inp.id = id;
    inp.name = name;
    inp.type = type;
    inp.placeholder = placeholder;
    inp.autocomplete = autocomplete || 'off';
    inp.required = true;
    if (autofocus) inp.autofocus = true;
    wrap.appendChild(inp);

    if (hasToggle) {
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

    const err = document.createElement('div');
    err.className = 'field-error';
    err.id = `err-${id}`;
    group.appendChild(err);

    // Focus effect on icon
    inp.addEventListener('focus',  () => iconEl.style.color = 'var(--green-neon)');
    inp.addEventListener('blur',   () => iconEl.style.color = '');
    inp.addEventListener('input',  () => {
      wrap.classList.remove('has-error');
      err.textContent = '';
    });

    return group;
  }

  // ─── 5. Animated Counters ─────────────────────────────────────────────────
  const counterObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        document.querySelectorAll('.mini-stat-num[data-target]').forEach(el => {
          animateCounter(el);
        });
        counterObserver.disconnect();
      }
    });
  }, { threshold: 0.5 });

  const statsEl = leftPanel.querySelector('.mini-stats');
  if (statsEl) counterObserver.observe(statsEl);

  function animateCounter(el) {
    const target = parseInt(el.dataset.target, 10);
    const start  = performance.now();
    const dur    = 1600;
    const suffix = el.closest('.mini-stat').querySelector('.mini-stat-lbl').textContent.includes('%') ? '%' : '+';
    const update = now => {
      const progress = Math.min((now - start) / dur, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = (target >= 1000
        ? Math.floor(eased * target).toLocaleString('ar-DZ')
        : Math.floor(eased * target)) + suffix;
      if (progress < 1) requestAnimationFrame(update);
    };
    requestAnimationFrame(update);
  }

  // ─── 6. Form Validation ───────────────────────────────────────────────────
  formEl.addEventListener('submit', e => {
    let valid = true;
    const fields = [
      { id: 'email',    msg: 'أدخل بريدك الإلكتروني' },
      { id: 'password', msg: 'أدخل كلمة المرور' },
    ];

    fields.forEach(({ id, msg }) => {
      const inp  = document.getElementById(id);
      const wrap = document.getElementById(`wrap-${id}`);
      const err  = document.getElementById(`err-${id}`);
      if (!inp.value.trim()) {
        wrap.classList.add('has-error');
        err.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> ${msg}`;
        inp.focus();
        valid = false;
      }
    });

    // Basic email format
    const emailInp = document.getElementById('email');
    const emailErr = document.getElementById('err-email');
    if (emailInp.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInp.value)) {
      document.getElementById('wrap-email').classList.add('has-error');
      emailErr.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> صيغة البريد الإلكتروني غير صحيحة';
      valid = false;
    }

    if (!valid) { e.preventDefault(); return; }

    btn.classList.add('loading');
  });

  // ─── 7. Ripple Effect ─────────────────────────────────────────────────────
  btn.addEventListener('click', e => {
    const rect = btn.getBoundingClientRect();
    const rpl  = document.createElement('span');
    const size = Math.max(rect.width, rect.height);
    rpl.style.cssText = `
      position:absolute; border-radius:50%;
      width:${size}px; height:${size}px;
      left:${e.clientX - rect.left - size/2}px;
      top:${e.clientY - rect.top  - size/2}px;
      background:rgba(2,12,8,0.2);
      transform:scale(0); pointer-events:none;
      animation:ripple 0.55s ease-out forwards;
    `;
    btn.appendChild(rpl);
    setTimeout(() => rpl.remove(), 600);
  });

  const rplStyle = document.createElement('style');
  rplStyle.textContent = '@keyframes ripple{to{transform:scale(3);opacity:0}}';
  document.head.appendChild(rplStyle);

  // ─── 8. Cursor Glow ───────────────────────────────────────────────────────
  const glow = document.createElement('div');
  glow.id = 'cursor-glow';
  document.body.appendChild(glow);

  let mx=0, my=0, gx=0, gy=0;
  document.addEventListener('mousemove', e => {
    mx = e.clientX; my = e.clientY;
    glow.style.opacity = '1';
  });
  document.addEventListener('mouseleave', () => glow.style.opacity = '0');

  (function animGlow() {
    gx += (mx - gx) * 0.09;
    gy += (my - gy) * 0.09;
    glow.style.left = gx + 'px';
    glow.style.top  = gy + 'px';
    requestAnimationFrame(animGlow);
  })();

  // ─── 9. Input Shake on Error ──────────────────────────────────────────────
  const shakeStyle = document.createElement('style');
  shakeStyle.textContent = `
    @keyframes shake {
      0%,100%{transform:translateX(0)}
      20%{transform:translateX(-6px)}
      40%{transform:translateX(6px)}
      60%{transform:translateX(-4px)}
      80%{transform:translateX(4px)}
    }
    .has-error input { animation: shake 0.4s ease; }
  `;
  document.head.appendChild(shakeStyle);

  // ─── 10. Keyboard shortcut: Enter submits ─────────────────────────────────
  document.addEventListener('keydown', e => {
    if (e.key === 'Enter' && document.activeElement.tagName !== 'BUTTON') {
      btn.click();
    }
  });

});

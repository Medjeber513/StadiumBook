/* =============================================
   MATCHUP — JavaScript Interactions & Animations
   ============================================= */

document.addEventListener('DOMContentLoaded', () => {

  // ─── 1. HTML Structure Upgrade ───────────────────────────────────────────
  // Add CSS classes and elements expected by the stylesheet

  // Wrap hero section
  const section = document.querySelector('section');
  if (section) {
    section.classList.add('hero');

    // Hero field lines background decoration
    const fieldLines = document.createElement('div');
    fieldLines.className = 'field-lines';
    for (let i = 0; i < 3; i++) {
      const line = document.createElement('div');
      line.className = 'field-line';
      fieldLines.appendChild(line);
    }
    section.prepend(fieldLines);

    // Hero badge
    const badge = document.createElement('div');
    badge.className = 'hero-badge';
    badge.innerHTML = '<span class="dot"></span> منصة حجز الملاعب الأولى';
    section.prepend(badge);

    // Upgrade h2 words
    const h2 = section.querySelector('h2');
    if (h2) {
      h2.innerHTML = `
        <span class="word-book">Book</span><span class="dot-sep">.</span>
        <span class="word-play">Play</span><span class="dot-sep">.</span>
        <span class="word-repeat">Repeat</span>
      `;
    }

    // Hero action buttons
    const actions = document.createElement('div');
    actions.className = 'hero-actions';
    actions.innerHTML = `
      <a href="#" class="btn-primary">
        <span>⚽</span> احجز ملعبك الآن
      </a>
      <a href="#" class="btn-secondary">
        <span>▷</span> كيف يعمل؟
      </a>
    `;
    const h3 = section.querySelector('h3');
    if (h3) h3.after(actions);

    // Hero stats
    const stats = document.createElement('div');
    stats.className = 'hero-stats';
    stats.innerHTML = `
      <div class="stat-item">
        <span class="stat-num" data-target="320">0</span>
        <span class="stat-label">ملعب متاح</span>
      </div>
      <div class="stat-item">
        <span class="stat-num" data-target="12000">0</span>
        <span class="stat-label">حجز ناجح</span>
      </div>
      <div class="stat-item">
        <span class="stat-num" data-target="98">0</span>
        <span class="stat-label">% رضى العملاء</span>
      </div>
    `;
    section.appendChild(stats);
  }

  // ─── 2. Background Orbs ───────────────────────────────────────────────────
  for (let i = 1; i <= 3; i++) {
    const orb = document.createElement('div');
    orb.className = `bg-orb bg-orb-${i}`;
    document.body.prepend(orb);
  }

  // ─── 3. Floating Particles ────────────────────────────────────────────────
  const numParticles = 18;
  for (let i = 0; i < numParticles; i++) {
    const p = document.createElement('div');
    p.className = 'particle';
    const dur = (6 + Math.random() * 10).toFixed(1) + 's';
    const dx = (Math.random() * 120 - 60).toFixed(0) + 'px';
    const left = (Math.random() * 100).toFixed(1) + '%';
    const delay = (Math.random() * 8).toFixed(1) + 's';
    p.style.cssText = `left:${left}; --dur:${dur}; --dx:${dx}; animation-delay:${delay};`;
    document.body.appendChild(p);
  }

  // ─── 4. Features Section ──────────────────────────────────────────────────
  const features = [
    { icon: '⚽', title: 'حجز فوري', desc: 'احجز ملعبك في ثوانٍ معدودة بدون مكالمات أو انتظار.' },
    { icon: '📅', title: 'جدولة ذكية', desc: 'شاهد التوفر في الوقت الفعلي واختر الموعد المناسب لك.' },
    { icon: '💳', title: 'دفع آمن', desc: 'ادفع بثقة تامة عبر بوابات دفع مشفرة ومعتمدة.' },
    { icon: '📊', title: 'لوحة تحكم للملاك', desc: 'أدر حجوزاتك وإيراداتك من مكان واحد بسهولة تامة.' },
    { icon: '🏆', title: 'تقييمات المستخدمين', desc: 'اختر الملعب المناسب بناءً على آراء اللاعبين الحقيقيين.' },
    { icon: '🔔', title: 'تذكيرات تلقائية', desc: 'لا تنسَ حجزك أبداً مع نظام الإشعارات الفوري.' },
  ];

  const featuresSection = document.createElement('section');
  featuresSection.className = 'features';
  featuresSection.innerHTML = `
    <span class="section-label reveal">المميزات</span>
    <h2 class="section-title reveal" style="font-size: clamp(1.6rem, 4vw, 2.4rem); margin-bottom:60px;">لماذا MatchUp؟</h2>
    <div class="features-grid">
      ${features.map(f => `
        <div class="feature-card reveal">
          <div class="feature-icon">${f.icon}</div>
          <div class="feature-title">${f.title}</div>
          <p class="feature-desc">${f.desc}</p>
        </div>
      `).join('')}
    </div>
  `;
  document.body.appendChild(featuresSection);

  // ─── 5. Navbar Scroll Effect ─────────────────────────────────────────────
  const header = document.querySelector('header');
  const onScroll = () => {
    if (window.scrollY > 30) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  };
  window.addEventListener('scroll', onScroll, { passive: true });

  // ─── 6. Nav Links — Active Highlight ─────────────────────────────────────
  const navItems = document.querySelectorAll('.midle ul li');
  navItems.forEach(li => {
    li.addEventListener('click', () => {
      navItems.forEach(l => l.style.color = '');
      li.style.color = 'var(--green-neon)';
    });
  });

  // ─── 7. Scroll Reveal Observer ────────────────────────────────────────────
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
      if (entry.isIntersecting) {
        const delay = (i * 120);
        entry.target.style.transitionDelay = delay + 'ms';
        entry.target.classList.add('visible');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -50px 0px' });

  document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

  // ─── 8. Animated Counter ─────────────────────────────────────────────────
  const animateCounter = (el) => {
    const target = parseInt(el.getAttribute('data-target'), 10);
    const duration = 1800;
    const start = performance.now();

    const update = (now) => {
      const elapsed = now - start;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const value = Math.floor(eased * target);

      if (target >= 1000) {
        el.textContent = value.toLocaleString('ar-DZ') + '+';
      } else if (el.parentElement.querySelector('.stat-label').textContent.includes('%')) {
        el.textContent = value + '%';
      } else {
        el.textContent = value + '+';
      }

      if (progress < 1) requestAnimationFrame(update);
    };

    requestAnimationFrame(update);
  };

  const statObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        document.querySelectorAll('.stat-num[data-target]').forEach(el => animateCounter(el));
        statObserver.disconnect();
      }
    });
  }, { threshold: 0.5 });

  const statsEl = document.querySelector('.hero-stats');
  if (statsEl) statObserver.observe(statsEl);

  // ─── 9. Mouse Cursor Glow Effect ─────────────────────────────────────────
  const cursorGlow = document.createElement('div');
  cursorGlow.style.cssText = `
    position: fixed;
    pointer-events: none;
    z-index: 9999;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(57,255,138,0.04) 0%, transparent 70%);
    transform: translate(-50%, -50%);
    transition: opacity 0.3s;
    opacity: 0;
  `;
  document.body.appendChild(cursorGlow);

  let mouseX = 0, mouseY = 0;
  let glowX = 0, glowY = 0;

  document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
    cursorGlow.style.opacity = '1';
  });

  document.addEventListener('mouseleave', () => {
    cursorGlow.style.opacity = '0';
  });

  const animateGlow = () => {
    glowX += (mouseX - glowX) * 0.08;
    glowY += (mouseY - glowY) * 0.08;
    cursorGlow.style.left = glowX + 'px';
    cursorGlow.style.top  = glowY + 'px';
    requestAnimationFrame(animateGlow);
  };
  animateGlow();

  // ─── 10. Button Ripple Effect ─────────────────────────────────────────────
  document.querySelectorAll('.btn-primary, .btn-secondary, .login, .register').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const rect = btn.getBoundingClientRect();
      const ripple = document.createElement('span');
      const size = Math.max(rect.width, rect.height);
      ripple.style.cssText = `
        position: absolute;
        border-radius: 50%;
        width: ${size}px; height: ${size}px;
        left: ${e.clientX - rect.left - size/2}px;
        top:  ${e.clientY - rect.top  - size/2}px;
        background: rgba(57,255,138,0.25);
        transform: scale(0);
        animation: rippleAnim 0.6s ease-out forwards;
        pointer-events: none;
      `;
      btn.style.position = 'relative';
      btn.style.overflow  = 'hidden';
      btn.appendChild(ripple);
      setTimeout(() => ripple.remove(), 650);
    });
  });

  // Inject ripple keyframe once
  const rippleStyle = document.createElement('style');
  rippleStyle.textContent = `
    @keyframes rippleAnim {
      to { transform: scale(3); opacity: 0; }
    }
  `;
  document.head.appendChild(rippleStyle);

  // ─── 11. Typing Effect for Hero Sub-Heading ───────────────────────────────
  const h3 = document.querySelector('section.hero h3');
  if (h3) {
    const text = h3.textContent.trim();
    h3.textContent = '';
    h3.style.opacity = '1';
    h3.style.transform = 'none';
    h3.style.animation = 'none';
    let i = 0;
    const typeInterval = setInterval(() => {
      h3.textContent += text[i++];
      if (i >= text.length) clearInterval(typeInterval);
    }, 28);
  }

});

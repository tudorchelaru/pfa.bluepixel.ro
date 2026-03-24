<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nuva.ro — Evidență financiară pentru profesioniști independenți</title>
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="shortcut icon" href="/favicon.ico">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,200;9..40,300;9..40,400;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --bg:       #f7f5f0;
  --white:    #ffffff;
  --text:     #111111;
  --muted:    #8a8a8a;
  --border:   #e8e4dc;
  --orange:   #f97316;
  --orange-d: #ea580c;
  --green:    #22c55e;
  --font:     'DM Sans', sans-serif;
  --w-thin:   200;
  --w-light:  300;
  --w-reg:    400;
}

html { scroll-behavior: smooth; }
body {
  font-family: var(--font);
  font-weight: var(--w-light);
  background: var(--bg);
  color: var(--text);
  overflow-x: hidden;
  line-height: 1.65;
  letter-spacing: .01em;
  -webkit-font-smoothing: antialiased;
}

@keyframes fadeUp    { from{opacity:0;transform:translateY(28px)} to{opacity:1;transform:translateY(0)} }
@keyframes fadeIn    { from{opacity:0} to{opacity:1} }
@keyframes slideL    { from{opacity:0;transform:translateX(-40px)} to{opacity:1;transform:translateX(0)} }
@keyframes slideR    { from{opacity:0;transform:translateX(40px)} to{opacity:1;transform:translateX(0)} }
@keyframes float1    { 0%,100%{transform:translateY(0) rotate(-.8deg)} 50%{transform:translateY(-13px) rotate(1.2deg)} }
@keyframes float2    { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-9px)} }
@keyframes float3    { 0%,100%{transform:translateY(0) rotate(.8deg)} 50%{transform:translateY(-15px) rotate(-.8deg)} }
@keyframes drift     { 0%{transform:translate(0,0)} 25%{transform:translate(18px,-22px)} 50%{transform:translate(-12px,14px)} 75%{transform:translate(14px,6px)} 100%{transform:translate(0,0)} }
@keyframes ping      { 0%,100%{transform:scale(1);opacity:1} 50%{transform:scale(2.2);opacity:0} }
@keyframes shimmer   { 0%{background-position:-200% center} 100%{background-position:200% center} }
@keyframes modalIn   { from{opacity:0;transform:scale(.93) translateY(14px)} to{opacity:1;transform:scale(1) translateY(0)} }
@keyframes overlayIn { from{opacity:0} to{opacity:1} }
@keyframes barUp     { from{transform:scaleY(0)} to{transform:scaleY(1)} }

/* LOGO */
.logo-wrap    { display:flex;flex-direction:column;gap:2px;text-decoration:none; }
.logo-brand   { display:flex;align-items:baseline;gap:1px; }
.logo-text    { font-family:var(--font);font-weight:400;font-size:31px;letter-spacing:6.6px;text-transform:uppercase;color:var(--text);line-height:1; }
.logo-dot     { font-family:var(--font);font-weight:400;font-size:52px;color:var(--orange);line-height:1;letter-spacing:0; }
.logo-tagline { font-family:var(--font);font-weight:var(--w-light);font-size:12px;letter-spacing:.01em;color:var(--muted);font-style:italic;line-height:1; }

/* NAV */
.nav {
  position:sticky;top:0;z-index:200;
  display:flex;justify-content:space-between;align-items:center;
  padding:1.1rem 2.5rem;
  background:rgba(247,245,240,.92);
  backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);
  border-bottom:1px solid var(--border);
  animation:fadeIn .5s ease both;
}
.nav-r { display:flex;gap:10px;align-items:center; }

.btn-ghost {
  padding:8px 20px;background:transparent;
  border:1px solid var(--border);border-radius:10px;
  font-family:var(--font);font-weight:var(--w-light);
  font-size:13px;letter-spacing:.04em;
  color:var(--text);cursor:pointer;transition:all .2s;
}
.btn-ghost:hover { background:var(--white);border-color:#bbb; }

.btn-primary {
  padding:8px 22px;background:var(--orange);border:none;border-radius:10px;
  font-family:var(--font);font-weight:var(--w-reg);
  font-size:13px;letter-spacing:.04em;color:#fff;
  cursor:pointer;transition:all .2s;position:relative;overflow:hidden;
  white-space:nowrap;
}
.btn-primary::before { content:'';position:absolute;inset:0;background:linear-gradient(90deg,transparent,rgba(255,255,255,.22),transparent);background-size:200% 100%; }
.btn-primary:hover { background:var(--orange-d);transform:translateY(-1px); }
.btn-primary:hover::before { animation:shimmer 1.4s ease; }

/* HERO */
.hero {
  position:relative;min-height:620px;
  padding:6.5rem 2.5rem 3rem;
  display:flex;flex-direction:column;align-items:center;justify-content:center;
  text-align:center;overflow:hidden;
}
.orb { position:absolute;border-radius:50%;pointer-events:none;will-change:transform; }
.orb1 { width:560px;height:560px;background:radial-gradient(circle,rgba(249,115,22,.13) 0%,transparent 68%);top:-160px;left:-120px;animation:drift 14s ease-in-out infinite; }
.orb2 { width:460px;height:460px;background:radial-gradient(circle,rgba(139,92,246,.10) 0%,transparent 68%);bottom:-100px;right:-80px;animation:drift 19s ease-in-out infinite reverse; }
.orb3 { width:320px;height:320px;background:radial-gradient(circle,rgba(20,184,166,.09) 0%,transparent 68%);top:35%;left:58%;animation:drift 11s ease-in-out infinite 3s; }
.hero-grid { position:absolute;inset:0;pointer-events:none;background-image:linear-gradient(rgba(0,0,0,.035) 1px,transparent 1px),linear-gradient(90deg,rgba(0,0,0,.035) 1px,transparent 1px);background-size:44px 44px; }
.hero-inner { position:relative;z-index:2;max-width:700px; }

.badge {
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 18px;background:var(--white);
  border:1px solid #e5e7eb;border-radius:99px;
  font-family:var(--font);font-weight:var(--w-light);
  font-size:12px;letter-spacing:.08em;color:var(--muted);
  margin-bottom:2rem;box-shadow:0 2px 12px rgba(0,0,0,.05);
  animation:fadeUp .6s .1s ease both;
}
.live-dot { width:7px;height:7px;background:var(--green);border-radius:50%;animation:ping 2s infinite; }

.hero h1 {
  font-family:var(--font);font-weight:var(--w-thin);
  font-size:68px;line-height:1.06;letter-spacing:-1px;
  color:var(--text);margin-bottom:1.5rem;
  animation:fadeUp .6s .22s ease both;
}
.hero h1 em { font-style:normal;font-weight:var(--w-thin);color:var(--orange);letter-spacing:.02em; }

.hero p {
  font-family:var(--font);font-weight:var(--w-light);
  font-size:17px;color:var(--muted);
  line-height:1.7;letter-spacing:.02em;
  margin-bottom:2.5rem;
  animation:fadeUp .6s .38s ease both;
}

.hero-ctas { display:flex;gap:14px;justify-content:center;flex-wrap:wrap;animation:fadeUp .6s .52s ease both; }
.cta-main {
  padding:13px 32px;background:var(--orange);border:none;border-radius:12px;
  font-family:var(--font);font-weight:var(--w-reg);
  font-size:14px;letter-spacing:.06em;color:#fff;
  cursor:pointer;transition:all .22s;position:relative;overflow:hidden;
}
.cta-main::before { content:'';position:absolute;inset:0;background:linear-gradient(90deg,transparent,rgba(255,255,255,.2),transparent);background-size:200% 100%; }
.cta-main:hover { background:var(--orange-d);transform:translateY(-2px);box-shadow:0 8px 24px rgba(249,115,22,.28); }
.cta-main:hover::before { animation:shimmer 1.2s ease; }
.cta-sec {
  padding:13px 32px;background:var(--white);border:1px solid #ddd;border-radius:12px;
  font-family:var(--font);font-weight:var(--w-light);
  font-size:14px;letter-spacing:.06em;color:var(--text);
  cursor:pointer;transition:all .22s;
}
.cta-sec:hover { background:#f9f9f7;transform:translateY(-2px); }

/* CARDS */
.cards { padding:.5rem 2.5rem 4.5rem; }
.cards-grid { display:grid;grid-template-columns:repeat(3,1fr);gap:16px;max-width:960px;margin:0 auto; }
.gc { border-radius:20px;padding:1.4rem;border:1px solid transparent;transition:transform .3s,box-shadow .3s;will-change:transform; }
.gc:hover { box-shadow:0 16px 40px rgba(0,0,0,.07); }
.gc-o    { background:linear-gradient(145deg,#fff7ed,#ffedd5);border-color:#fed7aa;animation:float1 5.2s ease-in-out infinite,slideL .7s .6s ease both; }
.gc-v    { background:linear-gradient(145deg,#faf5ff,#f3e8ff);border-color:#d8b4fe;animation:float2 6.4s ease-in-out infinite,fadeUp .7s .78s ease both; }
.gc-t    { background:linear-gradient(145deg,#f0fdfa,#ccfbf1);border-color:#99f6e4;animation:float3 4.8s ease-in-out infinite,slideR .7s .96s ease both; }
.gc-wide { grid-column:1/-1;background:linear-gradient(145deg,#eff6ff,#dbeafe);border-color:#bfdbfe;animation:fadeUp .7s 1.12s ease both; }
.gc-o:hover    { transform:translateY(-8px) rotate(-.8deg) !important; }
.gc-v:hover    { transform:translateY(-8px) !important; }
.gc-t:hover    { transform:translateY(-8px) rotate(.8deg) !important; }
.gc-wide:hover { transform:translateY(-4px); }

.gc-lbl { font-family:var(--font);font-weight:var(--w-light);font-size:10px;letter-spacing:1.8px;text-transform:uppercase;margin-bottom:8px; }
.lbl-o{color:#c2410c;} .lbl-v{color:#7c3aed;} .lbl-t{color:#0f766e;} .lbl-b{color:#1d4ed8;}
.gc-val { font-family:var(--font);font-weight:var(--w-thin);font-size:32px;letter-spacing:-.5px;line-height:1.1; }
.val-o{color:#ea580c;} .val-v{color:#7c3aed;} .val-t{color:#0d9488;} .val-b{color:#1d4ed8;}
.gc-sub { font-family:var(--font);font-weight:var(--w-light);font-size:12px;letter-spacing:.02em;color:#aaa;margin-top:4px; }

.minibars { display:flex;align-items:flex-end;gap:4px;height:40px;margin-top:14px; }
.mbar { border-radius:3px 3px 0 0;width:14px;transform-origin:bottom;animation:barUp .8s ease both; }

.tx-list { margin-top:10px; }
.tx-row { display:flex;align-items:center;gap:8px;padding:8px 0;border-bottom:1px solid rgba(0,0,0,.06); }
.tx-row:last-child { border-bottom:none; }
.tbadge { padding:3px 9px;border-radius:99px;font-family:var(--font);font-weight:var(--w-light);font-size:11px;letter-spacing:.04em;white-space:nowrap; }
.ti{background:#dcfce7;color:#166534;} .te{background:#fee2e2;color:#991b1b;}
.tname { font-family:var(--font);font-weight:var(--w-light);font-size:13px;color:#555;flex:1;letter-spacing:.01em; }
.tamt { font-family:var(--font);font-weight:var(--w-reg);font-size:13px;letter-spacing:.02em; }
.tamt.pos{color:#16a34a;} .tamt.neg{color:#dc2626;}

.prog-wrap{margin-top:14px;}
.prog-track{height:4px;background:rgba(0,0,0,.07);border-radius:99px;overflow:hidden;}
.prog-fill{height:100%;background:linear-gradient(90deg,#2dd4bf,#0d9488);border-radius:99px;width:0;transition:width 1.5s ease;}
.prog-labels{display:flex;justify-content:space-between;margin-top:5px;font-family:var(--font);font-weight:var(--w-light);font-size:11px;color:#aaa;letter-spacing:.04em;}

.wide-inner{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:20px;}
.tax-pills{display:flex;gap:10px;flex-wrap:nowrap;}
.tpill{background:var(--white);border:1px solid #dbeafe;border-radius:12px;padding:10px 16px;text-align:center;min-width:90px;}
.tpill-lbl{font-family:var(--font);font-weight:var(--w-light);font-size:11px;letter-spacing:.06em;color:#888;margin-bottom:3px;}
.tpill-val{font-family:var(--font);font-weight:var(--w-light);font-size:15px;letter-spacing:.01em;color:#1d4ed8;}
.tpill.orange{border-color:#fed7aa;} .tpill.orange .tpill-val{color:#ea580c;}

/* FEATURES */
.features { padding:4.5rem 2.5rem;max-width:960px;margin:0 auto; }
.eyebrow { font-family:var(--font);font-weight:var(--w-light);font-size:11px;letter-spacing:3px;text-transform:uppercase;color:var(--orange);margin-bottom:10px; }
.sec-title { font-family:var(--font);font-weight:var(--w-thin);font-size:40px;letter-spacing:-.5px;line-height:1.12;color:var(--text);margin-bottom:2.75rem; }
.feat-grid { display:grid;grid-template-columns:repeat(3,1fr);gap:14px; }
.feat { background:var(--white);border:1px solid var(--border);border-radius:18px;padding:1.5rem;transition:all .28s;opacity:0;transform:translateY(24px); }
.feat.vis { opacity:1;transform:translateY(0);transition:opacity .5s ease,transform .5s ease,box-shadow .28s,border-color .28s; }
.feat:hover { transform:translateY(-6px);box-shadow:0 14px 36px rgba(0,0,0,.07);border-color:#ccc; }
.feat-ico { width:38px;height:38px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:18px;margin-bottom:12px; }
.ico-o{background:#fff7ed;} .ico-v{background:#faf5ff;} .ico-y{background:#fffbeb;} .ico-g{background:#f0fdf4;} .ico-b{background:#eff6ff;} .ico-t{background:#f0fdfa;}
.feat-t { font-family:var(--font);font-weight:var(--w-reg);font-size:14px;letter-spacing:.02em;color:var(--text);margin-bottom:6px; }
.feat-d { font-family:var(--font);font-weight:var(--w-light);font-size:13px;letter-spacing:.01em;color:var(--muted);line-height:1.6; }

/* PRICING */
.pricing { padding:4.5rem 2.5rem 5.5rem;max-width:600px;margin:0 auto;text-align:center; }
.price-grid { display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:2.5rem;text-align:left; }
.pcard { background:var(--white);border:1px solid var(--border);border-radius:22px;padding:1.75rem;transition:all .28s; }
.pcard:hover { transform:translateY(-5px);box-shadow:0 16px 40px rgba(0,0,0,.07); }
.pcard.hot { border:2px solid var(--orange);background:linear-gradient(160deg,#fff,#fff7ed);position:relative; }
.hot-pill { position:absolute;top:-14px;left:50%;transform:translateX(-50%);background:var(--orange);color:#fff;font-family:var(--font);font-weight:var(--w-light);font-size:11px;letter-spacing:.08em;padding:4px 16px;border-radius:99px;white-space:nowrap; }
.pname { font-family:var(--font);font-weight:var(--w-light);font-size:12px;letter-spacing:.12em;text-transform:uppercase;color:#aaa;margin-bottom:10px; }
.pprice { font-family:var(--font);font-weight:var(--w-thin);font-size:52px;color:var(--text);letter-spacing:-2px;line-height:1; }
.pprice sub { font-family:var(--font);font-weight:var(--w-light);font-size:14px;color:#aaa;letter-spacing:.04em; }
.pfeats { margin-top:1.25rem;display:flex;flex-direction:column;gap:9px; }
.pf { font-family:var(--font);font-weight:var(--w-light);font-size:13px;letter-spacing:.02em;color:#555;display:flex;align-items:center;gap:8px; }
.ptick { width:17px;height:17px;background:#dcfce7;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:9px;color:#166534; }
.pbtn { width:100%;margin-top:1.5rem;padding:12px;border-radius:12px;font-family:var(--font);font-weight:var(--w-light);font-size:14px;letter-spacing:.06em;cursor:pointer;transition:all .22s; }
.pbtn.outline { background:var(--white);border:1px solid #ddd;color:var(--text); }
.pbtn.outline:hover { background:#f9f9f7;transform:translateY(-1px); }
.pbtn.fill { background:var(--orange);border:none;color:#fff;font-weight:var(--w-reg); }
.pbtn.fill:hover { background:var(--orange-d);transform:translateY(-2px);box-shadow:0 6px 20px rgba(249,115,22,.28); }

.divider { max-width:960px;margin:0 auto;height:1px;background:var(--border); }

/* FOOTER */
.footer { border-top:1px solid var(--border);padding:1.75rem 2.5rem;display:flex;justify-content:space-between;align-items:center; }
.footer span, .footer a { font-family:var(--font);font-weight:var(--w-light);font-size:12px;letter-spacing:.06em;color:#aaa;text-decoration:none; }
.footer a:hover { color:var(--text); }

/* MODAL */
.modal-ov { display:none;position:fixed;inset:0;background:rgba(0,0,0,.3);backdrop-filter:blur(6px);z-index:1000;align-items:center;justify-content:center; }
.modal-ov.open { display:flex;animation:overlayIn .25s ease both; }
.modal { background:var(--white);border-radius:24px;padding:2.5rem;width:100%;max-width:400px;margin:1rem;border:1px solid var(--border);position:relative;animation:modalIn .3s ease both; }
.modal-x { position:absolute;top:1.25rem;right:1.25rem;width:30px;height:30px;background:#f5f5f3;border:none;border-radius:50%;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#888;transition:background .2s; }
.modal-x:hover { background:#ebebea; }
.modal-logo { display:flex;align-items:baseline;gap:2px;justify-content:center;margin-bottom:1.5rem; }
.modal-logo .logo-text { font-size:22px;letter-spacing:5px; }
.modal-logo .logo-dot  { font-size:22px; }
.modal-title { font-family:var(--font);font-weight:var(--w-thin);font-size:28px;letter-spacing:-.3px;text-align:center;margin-bottom:.25rem;color:var(--text); }
.modal-sub   { font-family:var(--font);font-weight:var(--w-light);font-size:13px;letter-spacing:.04em;color:#aaa;text-align:center;margin-bottom:1.75rem; }
.modal-error { background:#fee2e2;border:1px solid #fca5a5;color:#dc2626;border-radius:10px;padding:10px 14px;font-family:var(--font);font-weight:var(--w-light);font-size:13px;margin-bottom:1rem; }
.fgroup { margin-bottom:1rem; }
.flabel { font-family:var(--font);font-weight:var(--w-light);font-size:12px;letter-spacing:.08em;text-transform:uppercase;color:#888;display:block;margin-bottom:6px; }
.finput { width:100%;padding:10px 14px;border:1px solid #e5e7eb;border-radius:10px;font-family:var(--font);font-weight:var(--w-light);font-size:14px;letter-spacing:.02em;color:var(--text);background:#fafaf9;outline:none;transition:border-color .2s,box-shadow .2s; }
.finput:focus { border-color:var(--orange);box-shadow:0 0 0 3px rgba(249,115,22,.1);background:var(--white); }
.fsubmit { width:100%;padding:12px;background:var(--orange);border:none;border-radius:12px;font-family:var(--font);font-weight:var(--w-reg);font-size:14px;letter-spacing:.06em;color:#fff;cursor:pointer;margin-top:.5rem;transition:all .2s; }
.fsubmit:hover { background:var(--orange-d);transform:translateY(-1px); }

/* HAMBURGER */
.hamburger {
  display:none;flex-direction:column;justify-content:center;gap:5px;
  width:36px;height:36px;background:none;border:none;cursor:pointer;padding:4px;
}
.hamburger span {
  display:block;height:1.5px;background:var(--text);border-radius:2px;
  transition:transform .25s ease, opacity .25s ease;
  transform-origin:center;
}
.hamburger.open span:nth-child(1) { transform:translateY(6.5px) rotate(45deg); }
.hamburger.open span:nth-child(2) { opacity:0; }
.hamburger.open span:nth-child(3) { transform:translateY(-6.5px) rotate(-45deg); }

/* MOBILE MENU */
.mobile-menu {
  display:none;
  position:fixed;top:0;left:0;right:0;bottom:0;z-index:190;
  background:var(--bg);
  flex-direction:column;align-items:center;justify-content:center;gap:16px;
  animation:fadeIn .2s ease both;
}
.mobile-menu.open { display:flex; }
.mobile-menu .btn-ghost  { font-size:16px;padding:14px 40px;width:240px;text-align:center; }
.mobile-menu .btn-primary{ font-size:16px;padding:14px 40px;width:240px;text-align:center; }

@media(max-width:720px){
  .hero h1{font-size:44px;}
  .cards-grid{grid-template-columns:1fr;}
  .feat-grid{grid-template-columns:1fr 1fr;}
  .price-grid{grid-template-columns:1fr;}
  .nav{padding:.9rem 1.25rem;}
  .hero,.cards,.features,.pricing{padding-left:1.25rem;padding-right:1.25rem;}
  .gc-wide .wide-inner{flex-direction:column;}
  .logo-text{font-size:22px;letter-spacing:5px;}
  .logo-dot{font-size:30px;}
  .nav-r { display:none; }
  .hamburger { display:flex; }
}
@media(max-width:480px){
  .feat-grid{grid-template-columns:1fr;}
  .hero h1{font-size:36px;}
}
</style>
</head>
<body>

<nav class="nav">
  <a href="{{ route('home') }}" class="logo-wrap">
    <div class="logo-brand"><span class="logo-text">NUVA</span><span class="logo-dot">.</span></div>
    <span class="logo-tagline">"Pentru profesioniști independenți."</span>
  </a>
  <div class="nav-r">
    <button class="btn-ghost" id="btnLogin">Autentificare</button>
    <a href="{{ route('register') }}" class="btn-primary">Începe gratuit →</a>
  </div>
  <button class="hamburger" id="hamburger" aria-label="Meniu">
    <span></span><span></span><span></span>
  </button>
</nav>

<div class="mobile-menu" id="mobileMenu">
  <button class="btn-ghost" id="btnLoginMobile">Autentificare</button>
  <a href="{{ route('register') }}" class="btn-primary">Începe gratuit →</a>
</div>

<section class="hero">
  <div class="orb orb1"></div>
  <div class="orb orb2"></div>
  <div class="orb orb3"></div>
  <div class="hero-grid"></div>
  <div class="hero-inner">
    <div class="badge"><span class="live-dot"></span>Contabilitate digitală pentru PFA</div>
    <h1>Afacerea ta,<br><em>fără bătăi de cap</em></h1>
    <p>Înregistrezi cheltuieli și încasări în 10 secunde.<br>e-Facturi, taxe calculate automat, PDF instant.</p>
    <div class="hero-ctas">
      <a href="{{ route('register') }}" class="cta-main">Creează cont gratuit</a>
      <button class="cta-sec">Vezi demo →</button>
    </div>
  </div>
</section>

<section class="cards">
  <div class="cards-grid">
    <div class="gc gc-o">
      <div class="gc-lbl lbl-o">Sold curent</div>
      <div class="gc-val val-o">35.934 RON</div>
      <div class="gc-sub">Actualizat în timp real</div>
      <div class="minibars">
        <div class="mbar" style="height:10px;background:#fed7aa;animation-delay:.10s;"></div>
        <div class="mbar" style="height:20px;background:#fb923c;animation-delay:.15s;"></div>
        <div class="mbar" style="height:14px;background:#fed7aa;animation-delay:.20s;"></div>
        <div class="mbar" style="height:32px;background:#f97316;animation-delay:.25s;"></div>
        <div class="mbar" style="height:8px; background:#fed7aa;animation-delay:.30s;"></div>
        <div class="mbar" style="height:38px;background:#ea580c;animation-delay:.35s;"></div>
        <div class="mbar" style="height:26px;background:#fb923c;animation-delay:.40s;"></div>
      </div>
    </div>
    <div class="gc gc-v">
      <div class="gc-lbl lbl-v">Tranzacții recente</div>
      <div class="tx-list">
        <div class="tx-row"><span class="tbadge ti">Încasare</span><span class="tname">Cabinet psihologie</span><span class="tamt pos">+3.200</span></div>
        <div class="tx-row"><span class="tbadge te">Plată</span><span class="tname">chirie cabinet</span><span class="tamt neg">−800</span></div>
        <div class="tx-row"><span class="tbadge ti">Încasare</span><span class="tname">consultanță IT</span><span class="tamt pos">+5.400</span></div>
      </div>
    </div>
    <div class="gc gc-t">
      <div class="gc-lbl lbl-t">Încasări luna aceasta</div>
      <div class="gc-val val-t">41.967 RON</div>
      <div class="gc-sub">+12% față de luna trecută</div>
      <div class="prog-wrap">
        <div class="prog-track"><div class="prog-fill" id="progFill"></div></div>
        <div class="prog-labels"><span>Obiectiv: 58k</span><span>72%</span></div>
      </div>
    </div>
    <div class="gc gc-wide">
      <div class="wide-inner">
        <div>
          <div class="gc-lbl lbl-b">Taxe estimate 2026</div>
          <div class="gc-val val-b">~8.240 RON</div>
          <div class="gc-sub">Calculat automat din registrul tău</div>
        </div>
        <div class="tax-pills">
          <div class="tpill"><div class="tpill-lbl">Impozit 10%</div><div class="tpill-val">3.593 RON</div></div>
          <div class="tpill"><div class="tpill-lbl">CASS</div><div class="tpill-val">4.647 RON</div></div>
          <div class="tpill orange"><div class="tpill-lbl">CAS opțional</div><div class="tpill-val">0 RON</div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="divider"></div>

<section class="features">
  <div class="eyebrow">Funcționalități</div>
  <div class="sec-title">Tot ce îți trebuie,<br>într-un singur loc</div>
  <div class="feat-grid">
    <div class="feat"><div class="feat-ico ico-o">📒</div><div class="feat-t">Registru jurnal</div><div class="feat-d">Încasări și cheltuieli lunare cu filtrare și export PDF instant.</div></div>
    <div class="feat"><div class="feat-ico ico-v">🧾</div><div class="feat-t">e-Factura ANAF</div><div class="feat-d">Trimite facturi direct în SPV fără să mai intri pe ANAF.</div></div>
    <div class="feat"><div class="feat-ico ico-y">🧮</div><div class="feat-t">Calculator taxe</div><div class="feat-d">Impozit, CASS și CAS calculate automat din datele tale reale.</div></div>
    <div class="feat"><div class="feat-ico ico-g">📸</div><div class="feat-t">Upload documente</div><div class="feat-d">Atașează bonuri și facturi la fiecare înregistrare, instant.</div></div>
    <div class="feat"><div class="feat-ico ico-b">👥</div><div class="feat-t">CRM clienți</div><div class="feat-d">Gestionează clienții și leagă tranzacțiile de fiecare dosar.</div></div>
    <div class="feat"><div class="feat-ico ico-t">🔔</div><div class="feat-t">Remindere automate</div><div class="feat-d">Email lunar pentru Declarația Unică și taxele trimestriale.</div></div>
  </div>
</section>

<div class="divider"></div>

<section class="pricing">
  <div class="eyebrow">Prețuri</div>
  <div class="sec-title">Simplu<br>și transparent</div>
  <div class="price-grid">
    <div class="pcard">
      <div class="pname">Gratuit</div>
      <div class="pprice">0 €<sub> / lună</sub></div>
      <div class="pfeats">
        <div class="pf"><span class="ptick">✓</span>5 înregistrări / lună</div>
        <div class="pf"><span class="ptick">✓</span>Export PDF basic</div>
        <div class="pf"><span class="ptick">✓</span>Grafice de bază</div>
      </div>
      <a href="{{ route('register') }}" class="pbtn outline" style="display:block;text-align:center;text-decoration:none;">Începe gratuit</a>
    </div>
    <div class="pcard hot">
      <div class="hot-pill">Cel mai popular</div>
      <div class="pname">Pro</div>
      <div class="pprice">3 €<sub> / lună</sub></div>
      <div class="pfeats">
        <div class="pf"><span class="ptick">✓</span>Înregistrări nelimitate</div>
        <div class="pf"><span class="ptick">✓</span>e-Factura ANAF</div>
        <div class="pf"><span class="ptick">✓</span>Calculator taxe automat</div>
        <div class="pf"><span class="ptick">✓</span>CRM clienți complet</div>
        <div class="pf"><span class="ptick">✓</span>Remindere email</div>
      </div>
      <a href="{{ route('register') }}" class="pbtn fill" style="display:block;text-align:center;text-decoration:none;white-space:nowrap;font-size:13px;">Abonează-te · 3 € / lună</a>
    </div>
  </div>
</section>

<footer class="footer">
  <span>&copy; 2026 <span style="letter-spacing:3px;font-weight:200;">NUVA</span><span style="color:var(--orange);">.</span> &nbsp;&middot;&nbsp; by <a href="https://bluepixel.ro" style="display:inline-flex;align-items:center;gap:5px;text-decoration:none;color:inherit;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="23" height="23" style="vertical-align:middle;border-radius:4px;"><rect width="64" height="64" rx="12" fill="#fafafa"/><text x="4" y="53" font-family="Inter,Arial,sans-serif" font-size="50" font-weight="800" fill="#0a0a0a">B</text><text x="33" y="53" font-family="Inter,Arial,sans-serif" font-size="50" font-weight="800" fill="#0057ff">P</text></svg>BluePixel</a></span>
  <span><a href="#">Termeni</a> &nbsp;&middot;&nbsp; <a href="#">Confidențialitate</a></span>
</footer>

<div class="modal-ov" id="modalOv">
  <div class="modal">
    <button class="modal-x" id="btnClose">&times;</button>
    <div class="modal-logo">
      <span class="logo-text">NUVA</span><span class="logo-dot">.</span>
    </div>
    <div class="modal-title">Intră în cont</div>
    <div class="modal-sub">Autentifică-te pentru a continua</div>

    @if ($errors->any())
      <div class="modal-error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
      @csrf
      <div class="fgroup">
        <label class="flabel" for="username">Username</label>
        <input class="finput" type="text" id="username" name="username"
               value="{{ old('username') }}"
               placeholder="ex: tudor" autocomplete="username">
      </div>
      <div class="fgroup">
        <label class="flabel" for="password">Parolă</label>
        <input class="finput" type="password" id="password" name="password"
               placeholder="••••••••••" autocomplete="current-password">
      </div>
      <button type="submit" class="fsubmit">Intră în cont →</button>
    </form>
  </div>
</div>

<script>
  // Hamburger
  const hamburger   = document.getElementById('hamburger');
  const mobileMenu  = document.getElementById('mobileMenu');
  hamburger.addEventListener('click', () => {
    const open = mobileMenu.classList.toggle('open');
    hamburger.classList.toggle('open', open);
    document.body.style.overflow = open ? 'hidden' : '';
  });

  const ov = document.getElementById('modalOv');

  function openModal() {
    // close mobile menu if open
    mobileMenu.classList.remove('open');
    hamburger.classList.remove('open');
    ov.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeModal() {
    ov.classList.remove('open');
    document.body.style.overflow = '';
  }

  ['btnLogin','btnLoginMobile'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener('click', openModal);
  });
  document.getElementById('btnClose').addEventListener('click', closeModal);
  ov.addEventListener('click', e => { if (e.target === ov) closeModal(); });
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

  @if ($errors->any())
    openModal();
  @endif

  // Parallax
  const o1 = document.querySelector('.orb1'),
        o2 = document.querySelector('.orb2'),
        o3 = document.querySelector('.orb3');
  let tick = false;
  window.addEventListener('scroll', () => {
    if (!tick) {
      requestAnimationFrame(() => {
        const s = window.scrollY;
        if (o1) o1.style.transform = `translateY(${s * .28}px)`;
        if (o2) o2.style.transform = `translateY(${-s * .18}px)`;
        if (o3) o3.style.transform = `translateY(${s * .13}px)`;
        tick = false;
      });
      tick = true;
    }
  }, { passive: true });

  // Feature cards
  const feats = document.querySelectorAll('.feat');
  const io = new IntersectionObserver(entries => {
    entries.forEach((e, i) => {
      if (e.isIntersecting) {
        setTimeout(() => e.target.classList.add('vis'), i * 80);
        io.unobserve(e.target);
      }
    });
  }, { threshold: .15 });
  feats.forEach(f => io.observe(f));

  // Progress bar
  const pf = document.getElementById('progFill');
  const pio = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        setTimeout(() => { pf.style.width = '72%'; }, 300);
        pio.unobserve(e.target);
      }
    });
  }, { threshold: .3 });
  if (pf) pio.observe(pf);
</script>
</body>
</html>

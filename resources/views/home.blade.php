<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="/manifest.json">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="SiPelanggaran">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">
    <title>SiPelanggaran — MAN 2 Bantul</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,300;12..96,400;12..96,500;12..96,600;12..96,700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --teal: #0d7a6e;
            --teal-light: #e6f4f2;
            --teal-mid: #1a9e8f;
            --dark: #0f1f1e;
            --dark-2: #1c3330;
            --gray: #6b7280;
            --gray-light: #f4f6f5;
            --border: #e5eae9;
            --white: #ffffff;
        }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background: var(--white); color: var(--dark); overflow-x: hidden; -webkit-font-smoothing: antialiased; }

        /* NAV */
        nav { position: sticky; top: 0; z-index: 100; background: rgba(255,255,255,0.92); backdrop-filter: blur(16px); border-bottom: 1px solid var(--border); padding: 0 48px; height: 64px; display: flex; align-items: center; justify-content: space-between; }
        .nav-logo { display: flex; align-items: center; gap: 8px; text-decoration: none; }
        .nav-logo-icon { width: 30px; height: 30px; background: var(--teal); border-radius: 8px; display: flex; align-items: center; justify-content: center; }
        .nav-logo-icon svg { width: 16px; height: 16px; color: white; }
        .nav-logo-text { font-family: 'Bricolage Grotesque', sans-serif; font-size: 16px; font-weight: 600; color: var(--dark); letter-spacing: -0.02em; }
        .nav-center { display: flex; align-items: center; gap: 4px; }
        .nav-center a { text-decoration: none; font-size: 14px; font-weight: 400; color: var(--gray); padding: 6px 14px; border-radius: 8px; transition: all 0.15s; }
        .nav-center a:hover { color: var(--dark); background: var(--gray-light); }
        .nav-right { display: flex; align-items: center; gap: 8px; }
        .btn-ghost { text-decoration: none; font-size: 14px; font-weight: 500; color: var(--dark); padding: 8px 18px; border-radius: 8px; transition: all 0.15s; border: 1px solid transparent; }
        .btn-ghost:hover { border-color: var(--border); background: var(--gray-light); }
        .btn-teal { text-decoration: none; font-size: 14px; font-weight: 500; color: white; padding: 8px 20px; border-radius: 8px; background: var(--teal); transition: all 0.15s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-teal:hover { background: var(--dark); }

        /* HERO */
        .hero-wrap { border-bottom: 1px solid var(--border); }
        .hero { padding: 80px 48px; max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; min-height: calc(100vh - 64px); }
        .hero-left { padding-bottom: 80px; }
        .hero-badge { display: inline-flex; align-items: center; gap: 6px; background: var(--teal-light); color: var(--teal); font-size: 12px; font-weight: 500; padding: 5px 12px; border-radius: 100px; margin-bottom: 24px; border: 1px solid rgba(13,122,110,0.15); }
        .hero-badge-dot { width: 6px; height: 6px; background: var(--teal); border-radius: 50%; animation: blink 2s ease-in-out infinite; }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }
        .hero-title { font-family: 'Bricolage Grotesque', sans-serif; font-size: clamp(36px, 4.5vw, 56px); font-weight: 700; line-height: 1.1; letter-spacing: -0.03em; color: var(--dark); margin-bottom: 20px; }
        .hero-sub { font-size: 16px; font-weight: 300; color: var(--gray); line-height: 1.7; margin-bottom: 36px; max-width: 400px; }
        .hero-actions { display: flex; align-items: center; gap: 12px; margin-bottom: 48px; flex-wrap: wrap; }
        .hero-cta { display: inline-flex; align-items: center; gap: 8px; background: var(--teal); color: white; text-decoration: none; font-size: 14px; font-weight: 500; padding: 12px 24px; border-radius: 10px; transition: all 0.2s; }
        .hero-cta:hover { background: var(--dark); transform: translateY(-1px); }
        .hero-cta svg { width: 16px; height: 16px; }
        .hero-cta-outline { display: inline-flex; align-items: center; gap: 8px; background: transparent; color: var(--dark); text-decoration: none; font-size: 14px; font-weight: 500; padding: 12px 24px; border-radius: 10px; border: 1px solid var(--border); transition: all 0.2s; }
        .hero-cta-outline:hover { border-color: var(--teal); color: var(--teal); background: var(--teal-light); }
        .hero-partners { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
        .hero-partners-label { font-size: 12px; color: var(--gray); }
        .partner-chips { display: flex; gap: 8px; }
        .partner-chip { background: var(--gray-light); border: 1px solid var(--border); border-radius: 6px; padding: 4px 10px; font-size: 12px; font-weight: 500; color: var(--gray); }

        /* HERO CARD */
        .hero-right { position: relative; padding-bottom: 80px; }
        .hero-card-main { background: var(--dark); border-radius: 20px; padding: 28px; color: white; position: relative; overflow: hidden; }
        .hero-card-main::before { content:''; position:absolute; top:-60px; right:-60px; width:200px; height:200px; background:radial-gradient(circle, rgba(13,122,110,0.4) 0%, transparent 70%); pointer-events:none; }
        .hc-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
        .hc-label { font-size: 11px; color: rgba(255,255,255,0.5); letter-spacing: 0.08em; text-transform: uppercase; }
        .hc-date { font-size: 12px; color: rgba(255,255,255,0.4); }
        .hc-live { background:rgba(255,255,255,0.06); border-radius:8px; padding:6px 12px; font-size:12px; color:rgba(255,255,255,0.4); }
        .hc-stat-num { font-family: 'Bricolage Grotesque', sans-serif; font-size: 40px; font-weight: 700; letter-spacing: -0.04em; color: white; line-height: 1; }
        .hc-stat-label { font-size: 12px; color: rgba(255,255,255,0.45); margin-top: 4px; }
        .hc-divider { height: 1px; background: rgba(255,255,255,0.08); margin: 20px 0; }
        .hc-rows { display: flex; flex-direction: column; gap: 10px; }
        .hc-row { display: flex; align-items: center; justify-content: space-between; padding: 10px 14px; background: rgba(255,255,255,0.05); border-radius: 10px; border: 1px solid rgba(255,255,255,0.06); }
        .hc-row-left { display: flex; align-items: center; gap: 10px; }
        .hc-row-icon { width: 32px; height: 32px; border-radius: 8px; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; }
        .hc-row-icon svg { width: 16px; height: 16px; color: rgba(255,255,255,0.6); }
        .hc-row-name { font-size: 13px; font-weight: 500; color: white; }
        .hc-row-sub { font-size: 11px; color: rgba(255,255,255,0.4); margin-top: 1px; }
        .hc-row-badge { font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 100px; }
        .badge-red { background: rgba(239,68,68,0.15); color: #f87171; }
        .badge-amber { background: rgba(245,158,11,0.15); color: #fbbf24; }
        .badge-green { background: rgba(13,122,110,0.25); color: #34d399; }
        .hero-card-mini { position: absolute; bottom: 60px; right: -20px; background: white; border-radius: 14px; padding: 16px 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.12); border: 1px solid var(--border); min-width: 180px; }
        .hcm-label { font-size: 11px; color: var(--gray); margin-bottom: 6px; }
        .hcm-num { font-family: 'Bricolage Grotesque', sans-serif; font-size: 28px; font-weight: 700; letter-spacing: -0.03em; color: var(--dark); }
        .hcm-trend { display: flex; align-items: center; gap: 4px; margin-top: 6px; font-size: 12px; color: #ef4444; font-weight: 500; }

        /* SECTIONS */
        .section { padding: 80px 48px; max-width: 1200px; margin: 0 auto; }
        .section-eyebrow { font-size: 12px; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase; color: var(--teal); margin-bottom: 12px; text-align: center; }
        .section-title { font-family: 'Bricolage Grotesque', sans-serif; font-size: clamp(28px, 3.5vw, 44px); font-weight: 700; letter-spacing: -0.03em; color: var(--dark); line-height: 1.15; }
        .section-sub { font-size: 15px; font-weight: 300; color: var(--gray); line-height: 1.7; margin-top: 12px; }

        /* FEATURES */
        .features-section { border-top: 1px solid var(--border); }
        .features-header { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: end; margin-bottom: 52px; }
        .features-header .section-eyebrow { text-align: left; }
        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; background: var(--border); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; }
        .feature-card { background: white; padding: 32px 28px; transition: background 0.2s; }
        .feature-card:hover { background: var(--gray-light); }
        .feature-icon { width: 40px; height: 40px; background: var(--teal-light); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }
        .feature-icon svg { width: 20px; height: 20px; color: var(--teal); }
        .feature-title { font-family: 'Bricolage Grotesque', sans-serif; font-size: 17px; font-weight: 600; letter-spacing: -0.02em; color: var(--dark); margin-bottom: 8px; }
        .feature-desc { font-size: 13px; font-weight: 300; color: var(--gray); line-height: 1.65; }

        /* STATS */
        .stats-wrap { background: var(--gray-light); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
        .stats-inner { max-width: 1200px; margin: 0 auto; padding: 80px 48px; text-align: center; }
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 52px; }
        .stat-card { background: white; border: 1px solid var(--border); border-radius: 16px; padding: 36px 28px; text-align: left; transition: all 0.2s; }
        .stat-card:hover { border-color: var(--teal); box-shadow: 0 8px 30px rgba(13,122,110,0.08); transform: translateY(-2px); }
        .stat-card-num { font-family: 'Bricolage Grotesque', sans-serif; font-size: 52px; font-weight: 700; letter-spacing: -0.04em; color: var(--teal); line-height: 1; margin-bottom: 8px; }
        .stat-card-label { font-size: 14px; font-weight: 400; color: var(--dark); }
        .stat-card-desc { font-size: 13px; color: var(--gray); font-weight: 300; margin-top: 6px; line-height: 1.5; }

        /* FLOW */
        .flow-wrap { background: var(--dark); }
        .flow-inner { max-width: 1200px; margin: 0 auto; padding: 80px 48px; }
        .flow-header { margin-bottom: 52px; }
        .flow-header .section-eyebrow { color: rgba(255,255,255,0.35); text-align: left; }
        .flow-header .section-title { color: white; }
        .flow-header .section-sub { color: rgba(255,255,255,0.4); }
        .flow-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; overflow: hidden; }
        .flow-step { background: var(--dark); padding: 36px 28px; transition: background 0.2s; }
        .flow-step:hover { background: var(--dark-2); }
        .flow-step-num { font-family: 'Bricolage Grotesque', sans-serif; font-size: 52px; font-weight: 700; letter-spacing: -0.04em; color: rgba(255,255,255,0.06); line-height: 1; margin-bottom: 16px; }
        .flow-tag { display: inline-block; font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 100px; margin-bottom: 14px; letter-spacing: 0.04em; }
        .tag-admin { background: rgba(13,122,110,0.2); color: #4dd9c8; }
        .tag-siswa { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.4); }
        .tag-auto { background: rgba(245,158,11,0.15); color: #fbbf24; }
        .flow-step-title { font-family: 'Bricolage Grotesque', sans-serif; font-size: 18px; font-weight: 600; color: white; margin-bottom: 8px; letter-spacing: -0.02em; }
        .flow-step-desc { font-size: 13px; font-weight: 300; color: rgba(255,255,255,0.4); line-height: 1.65; }

        /* ROLES */
        .role-section { border-top: 1px solid var(--border); }
        .role-header { text-align: center; margin-bottom: 52px; }
        .role-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .role-card { border: 1px solid var(--border); border-radius: 16px; overflow: hidden; transition: all 0.25s; }
        .role-card:hover { border-color: var(--teal); box-shadow: 0 12px 40px rgba(13,122,110,0.1); transform: translateY(-3px); }
        .role-card-header { padding: 28px 28px 24px; border-bottom: 1px solid var(--border); }
        .role-card.premium .role-card-header { background: var(--dark); border-bottom-color: rgba(255,255,255,0.06); }
        .role-card-badge { display: inline-block; font-size: 11px; font-weight: 500; letter-spacing: 0.06em; text-transform: uppercase; padding: 4px 12px; border-radius: 100px; margin-bottom: 16px; }
        .badge-admin-pill { background: var(--teal-light); color: var(--teal); }
        .badge-guru-pill { background: #eef2f7; color: #3b5998; }
        .badge-siswa-pill { background: #e8f5e9; color: #2e7d32; }
        .role-card.premium .badge-admin-pill { background: rgba(13,122,110,0.2); color: #4dd9c8; }
        .role-card-title { font-family: 'Bricolage Grotesque', sans-serif; font-size: 24px; font-weight: 700; letter-spacing: -0.02em; color: var(--dark); }
        .role-card.premium .role-card-title { color: white; }
        .role-card-price { font-size: 13px; color: var(--gray); margin-top: 6px; }
        .role-card.premium .role-card-price { color: rgba(255,255,255,0.4); }
        .role-card-body { padding: 24px 28px; }
        .role-list { list-style: none; display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px; }
        .role-list li { display: flex; align-items: flex-start; gap: 10px; font-size: 13px; color: var(--gray); line-height: 1.5; }
        .role-list li svg { width: 16px; height: 16px; color: var(--teal); flex-shrink: 0; margin-top: 1px; }
        .role-btn { display: flex; align-items: center; justify-content: space-between; text-decoration: none; font-size: 13px; font-weight: 500; padding: 11px 18px; border-radius: 10px; border: 1px solid var(--border); color: var(--dark); transition: all 0.2s; }
        .role-btn:hover { border-color: var(--teal); color: var(--teal); background: var(--teal-light); }
        .role-card.premium .role-btn { background: var(--teal); color: white; border-color: var(--teal); }
        .role-card.premium .role-btn:hover { background: var(--teal-mid); }

        /* CTA */
        .cta-wrap { padding: 0 48px 80px; }
        .cta-section { background: var(--dark); border-radius: 20px; padding: 64px 56px; display: flex; align-items: center; justify-content: space-between; gap: 40px; overflow: hidden; position: relative; }
        .cta-section::before { content:''; position:absolute; right:-80px; top:-80px; width:300px; height:300px; background:radial-gradient(circle, rgba(13,122,110,0.3) 0%, transparent 70%); pointer-events:none; }
        .cta-left { position: relative; z-index: 1; }
        .cta-eyebrow { font-size: 12px; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase; color: rgba(255,255,255,0.35); margin-bottom: 12px; }
        .cta-title { font-family: 'Bricolage Grotesque', sans-serif; font-size: clamp(24px, 3vw, 36px); font-weight: 700; letter-spacing: -0.03em; color: white; line-height: 1.2; margin-bottom: 12px; }
        .cta-sub { font-size: 14px; font-weight: 300; color: rgba(255,255,255,0.45); line-height: 1.6; max-width: 380px; }
        .cta-right { display: flex; gap: 12px; flex-shrink: 0; position: relative; z-index: 1; }
        .cta-btn-primary { display: inline-flex; align-items: center; gap: 8px; background: var(--teal); color: white; text-decoration: none; font-size: 14px; font-weight: 500; padding: 12px 24px; border-radius: 10px; transition: all 0.2s; white-space: nowrap; }
        .cta-btn-primary:hover { background: var(--teal-mid); }
        .cta-btn-outline { display: inline-flex; align-items: center; gap: 8px; background: transparent; color: white; text-decoration: none; font-size: 14px; font-weight: 500; padding: 12px 24px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.15); transition: all 0.2s; white-space: nowrap; }
        .cta-btn-outline:hover { border-color: rgba(255,255,255,0.4); background: rgba(255,255,255,0.05); }

        /* FOOTER */
        footer { border-top: 1px solid var(--border); padding: 32px 48px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; }
        .footer-logo { display: flex; align-items: center; gap: 8px; text-decoration: none; }
        .footer-logo-icon { width: 24px; height: 24px; background: var(--teal); border-radius: 6px; display: flex; align-items: center; justify-content: center; }
        .footer-logo-icon svg { width: 13px; height: 13px; color: white; }
        .footer-logo-text { font-family: 'Bricolage Grotesque', sans-serif; font-size: 14px; font-weight: 600; color: var(--dark); }
        .footer-links { display: flex; gap: 24px; }
        .footer-links a { text-decoration: none; font-size: 13px; color: var(--gray); transition: color 0.15s; }
        .footer-links a:hover { color: var(--dark); }
        .footer-copy { font-size: 12px; color: var(--gray); }

        /* REVEAL */
        .reveal { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            nav { padding: 0 20px; }
            .nav-center { display: none; }
            .hero { grid-template-columns: 1fr; padding: 60px 20px; min-height: auto; }
            .hero-right { display: none; }
            .hero-left { padding-bottom: 40px; }
            .section { padding: 60px 20px; }
            .flow-inner, .stats-inner { padding: 60px 20px; }
            .features-header { grid-template-columns: 1fr; }
            .features-grid, .flow-grid, .stats-grid, .role-grid { grid-template-columns: 1fr; }
            .cta-wrap { padding: 0 20px 60px; }
            .cta-section { flex-direction: column; padding: 40px 28px; }
            .cta-right { flex-direction: column; width: 100%; }
            .cta-btn-primary, .cta-btn-outline { justify-content: center; }
            footer { padding: 24px 20px; flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>

<!-- NAV -->
<nav>
    <a href="/" class="nav-logo">
        <div class="nav-logo-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        </div>
        <span class="nav-logo-text">SiPelanggaran</span>
    </a>
    <div class="nav-center">
        <a href="#fitur">Fitur</a>
        <a href="#alur">Alur Kerja</a>
        <a href="#pengguna">Pengguna</a>
    </div>
    <div class="nav-right">
        <a href="/guru" class="btn-ghost">Portal Guru</a>
        <a href="/admin" class="btn-teal">Masuk Admin <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
    </div>
</nav>

<!-- HERO -->
<div class="hero-wrap">
    <div class="hero">
        <div class="hero-left">
            <div class="hero-badge"><span class="hero-badge-dot"></span>Sistem aktif — MAN 2 Bantul</div>
            <h1 class="hero-title">Kelola tata tertib<br>siswa secara digital<br>dan terukur.</h1>
            <p class="hero-sub">Dari generate QR code hingga laporan rekap otomatis. Tidak ada lagi pencatatan manual, tidak ada data yang terlewat.</p>
            <div class="hero-actions">
                <a href="/admin" class="hero-cta">Mulai Sekarang <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
                <a href="#alur" class="hero-cta-outline">Lihat Cara Kerja</a>
            </div>
            <div class="hero-partners">
                <span class="hero-partners-label">Dibangun dengan</span>
                <div class="partner-chips">
                    <span class="partner-chip">Laravel</span>
                    <span class="partner-chip">Filament</span>
                    <span class="partner-chip">PWA</span>
                </div>
            </div>
        </div>
        <div class="hero-right">
            <div class="hero-card-main">
                <div class="hc-top">
                    <div><div class="hc-label">Rekap Hari Ini</div><div class="hc-date">{{ now()->format('d F Y') }}</div></div>
                    <div class="hc-live">● Live</div>
                </div>
                <div class="hc-stat-num">24</div>
                <div class="hc-stat-label">Pelanggaran tercatat hari ini</div>
                <div class="hc-divider"></div>
                <div class="hc-rows">
                    <div class="hc-row">
                        <div class="hc-row-left">
                            <div class="hc-row-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                            <div><div class="hc-row-name">Keterlambatan</div><div class="hc-row-sub">12 siswa</div></div>
                        </div>
                        <span class="hc-row-badge badge-red">Tinggi</span>
                    </div>
                    <div class="hc-row">
                        <div class="hc-row-left">
                            <div class="hc-row-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                            <div><div class="hc-row-name">Bolos Sholat</div><div class="hc-row-sub">8 siswa</div></div>
                        </div>
                        <span class="hc-row-badge badge-amber">Sedang</span>
                    </div>
                    <div class="hc-row">
                        <div class="hc-row-left">
                            <div class="hc-row-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg></div>
                            <div><div class="hc-row-name">Seragam</div><div class="hc-row-sub">4 siswa</div></div>
                        </div>
                        <span class="hc-row-badge badge-green">Normal</span>
                    </div>
                </div>
            </div>
            <div class="hero-card-mini">
                <div class="hcm-label">Scan minggu ini</div>
                <div class="hcm-num">147</div>
                <div class="hcm-trend"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>+12% dari minggu lalu</div>
            </div>
        </div>
    </div>
</div>

<!-- FITUR -->
<div class="section features-section" id="fitur">
    <div class="features-header reveal">
        <div>
            <p class="section-eyebrow" style="text-align:left;">Fitur Unggulan</p>
            <h2 class="section-title">Semua yang dibutuhkan<br>kesiswaan, dalam satu sistem.</h2>
        </div>
        <p class="section-sub">Dirancang khusus untuk alur kerja sekolah. Tidak perlu training panjang — langsung pakai.</p>
    </div>
    <div class="features-grid reveal">
        <div class="feature-card"><div class="feature-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8H3m2 0V6m0 14v-2m0 0H3m2 0h2M9 4H7v2m0 0v2m0-2H5m4 0h2"/></svg></div><h3 class="feature-title">Barcode Harian</h3><p class="feature-desc">Generate QR code per jenis pelanggaran. Otomatis expired di akhir hari dan tidak bisa dipakai ulang.</p></div>
        <div class="feature-card"><div class="feature-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div><h3 class="feature-title">Hukuman Otomatis</h3><p class="feature-desc">Sistem menghitung hukuman berdasarkan aturan yang dikonfigurasi — berbasis menit, akumulasi, atau langsung.</p></div>
        <div class="feature-card"><div class="feature-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg></div><h3 class="feature-title">Dashboard Rekap</h3><p class="feature-desc">Statistik real-time dengan grafik tren, filter kelas dan periode, serta tabel siswa rawan.</p></div>
        <div class="feature-card"><div class="feature-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div><h3 class="feature-title">Export PDF & Excel</h3><p class="feature-desc">Unduh laporan rekap dalam format PDF atau Excel. Filter per kelas, per siswa, atau per periode.</p></div>
        <div class="feature-card"><div class="feature-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div><h3 class="feature-title">Multi Role</h3><p class="feature-desc">Panel terpisah untuk admin kesiswaan dan guru wali kelas dengan hak akses yang berbeda.</p></div>
        <div class="feature-card"><div class="feature-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg></div><h3 class="feature-title">PWA Ready</h3><p class="feature-desc">Install ke homescreen HP seperti native app. Tidak perlu Play Store, cukup browser.</p></div>
    </div>
</div>

<!-- STATS -->
<div class="stats-wrap">
    <div class="stats-inner reveal">
        <p class="section-eyebrow">Kenapa Sistem Ini</p>
        <h2 class="section-title">Kami telah membantu kesiswaan<br>bekerja lebih efisien.</h2>
        <p class="section-sub" style="max-width:480px; margin:12px auto 0;">Tidak ada lagi buku catatan manual. Semua data tersimpan, terstruktur, dan bisa diakses kapan saja.</p>
        <div class="stats-grid">
            <div class="stat-card"><div class="stat-card-num">100%</div><div class="stat-card-label">Tanpa kertas</div><div class="stat-card-desc">Semua pencatatan dilakukan digital via scan QR code.</div></div>
            <div class="stat-card"><div class="stat-card-num">&lt;10s</div><div class="stat-card-label">Waktu proses per siswa</div><div class="stat-card-desc">Dari scan hingga hukuman tercatat, kurang dari 10 detik.</div></div>
            <div class="stat-card"><div class="stat-card-num">∞</div><div class="stat-card-label">Riwayat tersimpan</div><div class="stat-card-desc">Semua data pelanggaran tersimpan permanen dan bisa diekspor kapan saja.</div></div>
        </div>
    </div>
</div>

<!-- ALUR -->
<div class="flow-wrap" id="alur">
    <div class="flow-inner">
        <div class="flow-header reveal">
            <p class="section-eyebrow">Cara Kerja</p>
            <h2 class="section-title">Tiga langkah sederhana,<br>hasil yang terstruktur.</h2>
            <p class="section-sub">Dirancang agar mudah digunakan oleh semua pihak — dari kesiswaan hingga siswa.</p>
        </div>
        <div class="flow-grid reveal">
            <div class="flow-step"><div class="flow-step-num">1</div><span class="flow-tag tag-admin">Admin</span><div class="flow-step-title">Buat & Tampilkan QR</div><div class="flow-step-desc">Kesiswaan memilih jenis pelanggaran, generate QR code harian, lalu tampilkan via proyektor atau cetak.</div></div>
            <div class="flow-step"><div class="flow-step-num">2</div><span class="flow-tag tag-siswa">Siswa</span><div class="flow-step-title">Scan & Input NIS</div><div class="flow-step-desc">Siswa scan QR menggunakan kamera browser HP, masukkan NIS, dan konfirmasi pelanggaran.</div></div>
            <div class="flow-step"><div class="flow-step-num">3</div><span class="flow-tag tag-auto">Otomatis</span><div class="flow-step-title">Hukuman & Rekap</div><div class="flow-step-desc">Sistem menentukan hukuman otomatis, mencatat ke database, dan rekap langsung tersedia di dashboard.</div></div>
        </div>
    </div>
</div>

<!-- PENGGUNA -->
<div class="section role-section" id="pengguna">
    <div class="role-header reveal">
        <p class="section-eyebrow">Pengguna Sistem</p>
        <h2 class="section-title">Pilih akses sesuai peranmu.</h2>
        <p class="section-sub" style="max-width:400px; margin:12px auto 0;">Tiga peran berbeda, satu sistem terpadu.</p>
    </div>
    <div class="role-grid reveal">
        <div class="role-card premium">
            <div class="role-card-header"><span class="role-card-badge badge-admin-pill">Admin Kesiswaan</span><div class="role-card-title">Kendali penuh</div><div class="role-card-price">Akses semua fitur sistem</div></div>
            <div class="role-card-body">
                <ul class="role-list">
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Generate barcode harian</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Kelola aturan hukuman</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Dashboard & statistik lengkap</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Export PDF & Excel</li>
                </ul>
                <a href="/admin" class="role-btn">Masuk sebagai Admin <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7v10"/></svg></a>
            </div>
        </div>
        <div class="role-card">
            <div class="role-card-header"><span class="role-card-badge badge-guru-pill">Guru / Wali Kelas</span><div class="role-card-title">Pantau kelas</div><div class="role-card-price">Akses data kelas pengampu</div></div>
            <div class="role-card-body">
                <ul class="role-list">
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Rekap pelanggaran kelas</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Pantau siswa bermasalah</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Filter per periode</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Riwayat per siswa</li>
                </ul>
                <a href="/guru" class="role-btn">Masuk sebagai Guru <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7v10"/></svg></a>
            </div>
        </div>
        <div class="role-card">
            <div class="role-card-header"><span class="role-card-badge badge-siswa-pill">Siswa</span><div class="role-card-title">Proses via HP</div><div class="role-card-price">Tidak perlu install aplikasi</div></div>
            <div class="role-card-body">
                <ul class="role-list">
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Scan QR via browser HP</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Input NIS tanpa login</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Hukuman langsung tampil</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Proses kurang dari 10 detik</li>
                </ul>
                <a href="#" class="role-btn" style="opacity:0.4; pointer-events:none;">Akses via QR Code <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7v10"/></svg></a>
            </div>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="cta-wrap reveal">
    <div class="cta-section">
        <div class="cta-left">
            <p class="cta-eyebrow">Siap Digunakan</p>
            <h2 class="cta-title">Siap tingkatkan pengelolaan<br>tata tertib siswa?</h2>
            <p class="cta-sub">Sistem sudah berjalan. Masuk ke panel admin dan mulai hari ini.</p>
        </div>
        <div class="cta-right">
            <a href="/admin" class="cta-btn-primary">Buka Panel Admin <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
            <a href="#alur" class="cta-btn-outline">Pelajari Lebih Lanjut</a>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <a href="/" class="footer-logo">
        <div class="footer-logo-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
        <span class="footer-logo-text">SiPelanggaran</span>
    </a>
    <div class="footer-links">
        <a href="#fitur">Fitur</a>
        <a href="#alur">Alur Kerja</a>
        <a href="#pengguna">Pengguna</a>
        <a href="/admin">Admin</a>
        <a href="/guru">Guru</a>
    </div>
    <p class="footer-copy">© 2026 SiPelanggaran · MAN 2 Bantul</p>
</footer>

<script>
    if ("serviceWorker" in navigator) {
        navigator.serviceWorker.register("/sw.js");
    }

    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 60);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08 });
    reveals.forEach(el => observer.observe(el));
</script>
</body>
</html>
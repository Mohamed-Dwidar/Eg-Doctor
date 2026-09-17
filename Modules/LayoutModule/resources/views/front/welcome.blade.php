<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>Pivot Coworking Space</title>

    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/fontawesome.min.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/front/img/favicon.png') }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-11ZF4Q3D52"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-11ZF4Q3D52');
    </script>


    <style>
        :root {
            --pivot-dark: #15499C;
            --pivot-accent: #e94560;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: var(--pivot-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            padding: 24px 16px;
            margin-top: 20px;
        }

        .page-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .logo-area {
            text-align: center;
            margin-bottom: 50px;
        }

        .logo-area img {
            width: 200px;
        }

        /* ── Shared button base ── */
        .action-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.15s, opacity 0.15s, background 0.2s;
            border: none;
            cursor: pointer;
        }

        .action-btn:active {
            transform: scale(0.97);
            opacity: 0.9;
        }

        .action-btn i {
            font-size: 18px;
            flex-shrink: 0;
        }

        /* ── Section block ── */
        .section-block {
            margin-bottom: 14px;
        }

        /* ── Trigger button (collapsible header) ── */
        .btn-trigger {
            color: #fff;
            border: none;
            justify-content: center;
        }

        .btn-trigger:hover {
            color: #fff;
            filter: brightness(1.1);
        }

        /* Contact Us → green (phone/whatsapp tone) */
        .btn-trigger-contact {
            background: #128C7E;
        }

        /* Pay Now → deep purple (fintech tone) */
        .btn-trigger-pay {
            background: #7b2ff7;
        }

        /* Follow Us → facebook blue */
        .btn-trigger-follow {
            background: #1877F2;
        }

        .btn-trigger .trigger-arrow {
            margin-left: 8px;
            font-size: 13px;
            transition: transform 0.3s ease;
            opacity: 0.7;
        }

        .btn-trigger.open .trigger-arrow {
            transform: rotate(180deg);
        }

        /* ── Children container ── */
        .children-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease, margin-top 0.4s ease;
            margin-top: 0;
        }

        .children-group.open {
            max-height: 200px;
            margin-top: 10px;
        }

        .children-group .action-btn {
            flex: 1;
            min-width: calc(50% - 5px);
            width: auto;
        }

        /* ── Phone ── */
        .btn-phone {
            background: #2d6a4f;
            color: #fff;
        }

        .btn-phone:hover {
            color: #fff;
            background: #25573f;
        }

        /* ── WhatsApp ── */
        .btn-whatsapp {
            background: #25D366;
            color: #fff;
        }

        .btn-whatsapp:hover {
            color: #fff;
            background: #1fba58;
        }

        /* ── Instapay ── */
        .btn-instapay {
            background: #512772;
            color: #fff;
        }

        .btn-instapay:hover {
            color: #fff;
            background: #512772;
        }

        /* ── Vodafone Cash ── */
        .btn-vodafone {
            background: #e60000;
            color: #fff;
        }

        .btn-vodafone:hover {
            color: #fff;
            background: #cc0000;
        }

        .btn-vodafone.copied {
            background: #28a745;
        }

        .vf-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
            text-align: left;
        }

        .vf-label {
            font-size: 14px;
            font-weight: 600;
            line-height: 1;
            opacity: 0.85;
        }

        .vf-number {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1px;
            line-height: 1;
        }

        /* ── Instagram ── */
        .btn-instagram {
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
            color: #fff;
        }

        .btn-instagram:hover {
            color: #fff;
            opacity: 0.9;
        }

        /* ── Facebook ── */
        .btn-facebook {
            background: #1877F2;
            color: #fff;
        }

        .btn-facebook:hover {
            color: #fff;
            background: #145fcc;
        }

        /* ── Google Reviews ── */
        .btn-google {
            background: #fff;
            color: #444;
            border: 1.5px solid #ddd;
        }

        .btn-google:hover {
            color: #333;
            background: #f9f9f9;
        }

        /* ── Price List ── */
        .btn-pricelist {
            background: var(--pivot-accent);
            color: #fff;
        }

        .btn-pricelist:hover {
            color: #fff;
            background: #d03a52;
        }

        /* ── Contact Card ── */
        .contact-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            margin-bottom: 14px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
        }

        .contact-card img.card-logo {
            width: 120px;
            margin-bottom: 12px;
        }

        .contact-card .card-name {
            font-size: 16px;
            font-weight: 700;
            color: #15499C;
            margin-bottom: 10px;
        }

        .contact-card .card-details {
            list-style: none;
            padding: 0;
            margin: 0 0 16px;
        }

        .contact-card .card-details li {
            font-size: 13px;
            color: #555;
            padding: 4px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .contact-card .card-details li i {
            color: #15499C;
            width: 16px;
            font-size: 13px;
        }

        .btn-save-contact {
            background: #15499C;
            color: #fff;
            border: none;
            width: 100%;
        }

        .btn-save-contact:hover {
            color: #fff;
            background: #0f3880;
        }

        /* ── Website ── */
        .btn-website {
            background: #0f3880;
            color: #fff;
        }

        .btn-website:hover {
            color: #fff;
            background: #0c2e6a;
        }

        /* ── Location ── */
        .btn-location {
            background: #34A853;
            color: #fff;
        }

        .btn-location:hover {
            color: #fff;
            background: #2a8a43;
        }

        /* ── Card detail links ── */
        .contact-card .card-details a {
            color: #15499C;
            text-decoration: none;
            font-weight: 600;
        }

        .contact-card .card-details a:hover {
            text-decoration: underline;
        }

        .card-map-link {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: #e94560 !important;
            font-weight: 600;
            text-decoration: none;
            font-size: 12px;
        }

        .card-map-link:hover {
            text-decoration: underline;
            color: #c73350 !important;
        }
    </style>
</head>

<body>

    <div class="page-wrapper">

        <div class="logo-area">
            <img src="{{ asset('assets/front/img/logo_white.png') }}" alt="Pivot Coworking Space">
        </div>

        {{-- Price List (single) --}}
        <div class="section-block">
            {{-- TODO: replace href with actual price list URL or PDF link --}}
            <a href="{{ asset('assets/front/Pivot_price_list.pdf') }}" target="_blank" class="action-btn btn-pricelist">
                <i class="fas fa-file-pdf"></i> Pricing & Packages
            </a>
        </div>

        {{-- Pay Now (collapsible) --}}
        <div class="section-block">
            <button type="button" class="action-btn btn-trigger btn-trigger-pay" onclick="toggleSection(this)">
                <i class="fas fa-credit-card"></i> Pay Now
                <i class="fas fa-chevron-down trigger-arrow"></i>
            </button>
            <div class="children-group">
                <a href="https://ipn.eg/S/ah2020/instapay/0WP43n" target="_blank" class="action-btn btn-instapay">
                    <img src="{{ asset('assets/front/img/instapay.png') }}" alt="Instapay"
                        style="height:20px;width:auto;flex-shrink:0;">
                </a>
                <button type="button" class="action-btn btn-vodafone" onclick="copyVodafone(this)">
                    <img src="{{ asset('assets/front/img/vodafone.png') }}" alt="Vodafone"
                        style="height:22px;width:auto;flex-shrink:0;">
                    <span class="vf-text">
                        <span class="vf-label">Vodafone Cash</span>
                        <span class="vf-number">01288989336</span>
                    </span>
                </button>
            </div>
        </div>

        {{-- Google Reviews (single) --}}
        <div class="section-block">
            <a href="https://g.page/pivot-coworking-space/review" target="_blank" class="action-btn btn-google">
                <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                        fill="#4285F4" />
                    <path
                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                        fill="#34A853" />
                    <path
                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                        fill="#FBBC05" />
                    <path
                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                        fill="#EA4335" />
                </svg>
                Leave a Google Review
            </a>
        </div>

        {{-- Follow Us (collapsible) --}}
        <div class="section-block">
            <button type="button" class="action-btn btn-trigger btn-trigger-follow" onclick="toggleSection(this)">
                <i class="fas fa-share-alt"></i> Follow Us
                <i class="fas fa-chevron-down trigger-arrow"></i>
            </button>
            <div class="children-group">
                <a href="https://www.instagram.com/pivotcoworkingspace" target="_blank"
                    class="action-btn btn-instagram">
                    <i class="fab fa-instagram"></i> Instagram
                </a>
                <a href="https://www.facebook.com/PivotCoworkingSpace" target="_blank" class="action-btn btn-facebook">
                    <i class="fab fa-facebook-f"></i> Facebook
                </a>
            </div>
        </div>

        {{-- Contact Us (collapsible) --}}
        <div class="section-block">
            <button type="button" class="action-btn btn-trigger btn-trigger-contact" onclick="toggleSection(this)">
                <i class="fas fa-phone"></i> Contact Us
                <i class="fas fa-chevron-down trigger-arrow"></i>
            </button>
            <div class="children-group">
                <a href="tel:01226420549" class="action-btn btn-phone">
                    <i class="fas fa-phone"></i> Phone
                </a>
                <a href="https://wa.me/+201226420549" target="_blank" class="action-btn btn-whatsapp">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                <a href="https://www.pivotcoworkingspace.com/" target="_blank" class="action-btn btn-website">
                    <i class="fas fa-globe"></i> Website
                </a>
                <a href="https://g.page/pivot-coworking-space" target="_blank" class="action-btn btn-location">
                    <i class="fas fa-map-marker-alt"></i> Location
                </a>
            </div>
        </div>


        {{-- Contact Card --}}
        <div class="contact-card">
            <img class="card-logo" src="{{ asset('assets/front/img/logo_main.png') }}" alt="Pivot Coworking Space">
            {{-- <div class="card-name">Pivot Coworking Space</div> --}}
            <ul class="card-details">
                <li>
                    <i class="fas fa-mobile-alt"></i>
                    <a href="tel:01226420549">01226420549</a>
                    &nbsp;·&nbsp;
                    <i class="fas fa-phone"></i>
                    <a href="tel:0235805611">03 5805611</a>
                </li>
                <li>
                    <i class="fas fa-globe"></i>
                    <a href="https://www.pivotcoworkingspace.com" target="_blank">www.pivotcoworkingspace.com</a>
                </li>
                <li>
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:info@pivotcoworkingspace.com">info@pivotcoworkingspace.com</a>
                </li>
                <li>
                    <i class="fas fa-map-marker-alt"></i>
                    696 El Houria st., Louran - above B-Tech - 8th Floor, Alexandria
                </li>
            </ul>
            <a href="{{ asset('assets/front/pivot_contact.vcf') }}" download="Pivot_Coworking_Space.vcf"
                class="action-btn btn-save-contact">
                <i class="fas fa-address-card"></i> Save to Contacts
            </a>
        </div>

    </div>

    <script>
        function toggleSection(trigger) {
            var group = trigger.nextElementSibling;
            var isOpen = group.classList.contains('open');

            // Close all open groups
            document.querySelectorAll('.children-group.open').forEach(function(g) {
                g.classList.remove('open');
                g.previousElementSibling.classList.remove('open');
            });

            // Open clicked one if it was closed
            if (!isOpen) {
                group.classList.add('open');
                trigger.classList.add('open');
            }
        }

        function copyVodafone(btn) {
            navigator.clipboard.writeText('01288989336').then(function() {
                btn.classList.add('copied');
                btn.querySelector('.vf-label').textContent = 'Copied!';
                btn.querySelector('.vf-number').textContent = '01288989336 ✓';
                setTimeout(function() {
                    btn.classList.remove('copied');
                    btn.querySelector('.vf-label').textContent = 'Vodafone Cash';
                    btn.querySelector('.vf-number').textContent = '01288989336';
                }, 2500);
            });
        }
    </script>
</body>

</html>

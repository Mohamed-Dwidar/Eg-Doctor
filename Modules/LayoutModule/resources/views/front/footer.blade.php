<!-- Start Doctor Registration CTA -->
<section class="egd-section egd-section-soft" id="egd-doctor-cta">
    <div class="container">
        <div class="egd-doctor-cta wow fadeInUp">
            <div>
                <h2>هل أنت طبيب؟</h2>
                <p>أنشئ ملفك الطبي على إيجي دكتور وسهّل على المرضى الوصول إلى بياناتك والتواصل مع عيادتك.</p>
                <div class="egd-doctor-cta-points">
                    <span><i class="fas fa-check-circle"></i> ملف طبي احترافي</span>
                    <span><i class="fas fa-check-circle"></i> ظهور ضمن نتائج البحث</span>
                    <span><i class="fas fa-check-circle"></i> تواصل مباشر مع المرضى</span>
                </div>
            </div>
            <a href="#" class="egd-btn-light"><i class="fas fa-user-md"></i> سجل كطبيب</a>
        </div>
    </div>
</section>
<!-- End Doctor Registration CTA -->

<!-- Start Ad Slot -->
<div class="egd-ad-section">
    <div class="container">
        {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
        <div class="egd-ad-slot">
            {{-- <span class="egd-ad-tag">إعلان</span> --}}
            <p>
                <!-- Eg-Doctor - Home - Bottom - Multiplex -->
                <ins class="adsbygoogle" style="display:block" data-ad-format="autorelaxed"
                    data-ad-client="ca-pub-0462453958685277" data-ad-slot="6920793185"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </p>
        </div>
    </div>
</div>
<!-- End Ad Slot -->


<!-- Start Footer -->
<footer class="egd-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('home_page') }}" class="egd-logo">
                    <img src="{{ asset('assets/front/img/Logo_dark.png') }}" alt="إيجي دكتور - دليل الأطباء المصري"
                        width="200" height="80">
                </a>
                <p>
                    إيجي دكتور هو دليل طبي إلكتروني يساعد المرضى في مصر على البحث عن الأطباء
                    والعيادات حسب التخصص والمحافظة، والاطلاع على مقالات واستشارات طبية موثوقة.
                </p>
                <div class="egd-footer-social">
                    <a href="http://www.facebook.com/EgyptianDoctorsGuide" aria-label="فيسبوك"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="تويتر"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="انستقرام"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="يوتيوب"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-xs-4 col-sm-4">
                <h3>روابط مهمة</h3>
                <ul class="egd-footer-links">
                    <li><a href="{{ route('home_page') }}">الرئيسية</a></li>
                    <li><a href="{{ route('doctors.search-form') }}">ابحث عن طبيب</a></li>
                    <li><a href="/الأطباء">الأطباء</a></li>
                    <li><a href="/المجالات-و-التخصصات-الطبية">التخصصات</a></li>
                    <li><a href="/اتصل-بنا">اتصل بنا</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 col-xs-4 col-sm-4">
                <h3>&nbsp;</h3>
                <ul class="egd-footer-links">

                    <li><a href="/مقالات-طبية">المقالات الطبية</a></li>
                    <li><a href="/استشارات-و-اسئلة-طبية">الاستشارات الطبية</a></li>
                    <li><a href="/معلومات-طبية-سريعة">معلومات طبية</a></li>
                    <li><a href="/طلب-طبيب">سجل كطبيب</a></li>
                </ul>
            </div>
        </div>

        <div class="egd-copyright">
            <p>© {{ date('Y') }} إيجي دكتور. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</footer>
<!-- End Footer -->

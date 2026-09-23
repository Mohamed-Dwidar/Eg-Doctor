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
                        <a href="http://www.facebook.com/EgyptianDoctorsGuide" aria-label="فيسبوك"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="تويتر"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="انستقرام"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="يوتيوب"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h3>روابط مهمة</h3>
                    <ul class="egd-footer-links">
                        <li><a href="{{ route('home_page') }}">الرئيسية</a></li>
                        <li><a href="/الأطباء">الأطباء</a></li>
                        <li><a href="/المجالات-و-التخصصات-الطبية">التخصصات</a></li>
                        <li><a href="/مقالات-طبية">المقالات الطبية</a></li>
                        <li><a href="/استشارات-و-اسئلة-طبية">الاستشارات الطبية</a></li>
                        <li><a href="/معلومات-طبية-سريعة">معلومات طبية</a></li>
                        <li><a href="/طلب-طبيب">سجل كطبيب</a></li>
                        <li><a href="/اتصل-بنا">اتصل بنا</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h3>تواصل معنا</h3>
                    <ul class="egd-footer-contact">
                        <li><i class="fas fa-map-marker-alt"></i> القاهرة، جمهورية مصر العربية</li>
                        <li><i class="fas fa-phone"></i> 19XXX</li>
                        <li><i class="fas fa-envelope"></i> info@egdoctor.com</li>
                        <li><i class="far fa-clock"></i> خدمة العملاء متاحة يوميًا من 9 صباحًا حتى 10 مساءً</li>
                    </ul>
                </div>
            </div>

            <div class="egd-copyright">
                <p>© {{ date('Y') }} إيجي دكتور. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

<footer id="footer">
    <div class="container">
        <div class="footer-ribbon">
            <span>Selengkapnya Tentang Kami</span>
        </div>
        <div class="row py-5 my-4">
            <!-- Alamat Kantor -->
            <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                <h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Kantor</h5>
                <p class="text-4 mb-0">{{ $settings['contact_address']->value }}</p>
                <br>
                <p class="text-4 mb-0"><strong>Telp:</strong> {{ $settings['contact_phone']->value }}</p>
                <p class="text-4 mb-0"><strong>Email:</strong> {{ $settings['contact_email']->value }}</p>
            </div>

            <!-- Jam Pelayanan Informasi -->
            <div class="col-md-6 col-lg-6 mb-5 mb-lg-0">
                <h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Jam Pelayanan Informasi</h5>
                <div class="row">
                    <!-- Senin - Kamis -->
                    <div class="col-6">
                        <p class="text-4 text-color-light font-weight-bold mb-2">Senin - Kamis</p>
                        <p class="text-4 mb-0">Pelayanan: <span class="text-color-light">09:00 s/d 15:00 WIB</span></p>
                        <p class="text-4 mb-0">Pendaftaran: <span class="text-color-light">08:00 s/d 11:00 WIB</span></p>
                        <p class="text-4 mb-0">Istirahat: <span class="text-color-light">12:00 s/d 13:00 WIB</span></p>
                    </div>
                    <!-- Jumat -->
                    <div class="col-6">
                        <p class="text-4 text-color-light font-weight-bold mb-2">Jumat</p>
                        <p class="text-4 mb-0">Pelayanan: <span class="text-color-light">09:00 s/d 15:30 WIB</span></p>
                        <p class="text-4 mb-0">Pendaftaran: <span class="text-color-light">08:00 s/d 11:00 WIB</span></p>
                        <p class="text-4 mb-0">Istirahat: <span class="text-color-light">12:00 s/d 13:30 WIB</span></p>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="col-md-6 col-lg-3">
                <h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Media Sosial</h5>
                <ul class="footer-social-icons social-icons m-0">
                    <li class="social-icons-facebook">
                        <a href="{{ $settings['social_tiktok']->value }}" target="_blank" title="Tiktok">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </li>
                    <li class="social-icons-twitter">
                        <a href="{{ $settings['social_instagram']->value }}" target="_blank" title="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li class="social-icons-linkedin">
                        <a href="{{ $settings['social_youtube']->value }}" target="_blank" title="Youtube">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer Copyright -->
    <div class="footer-copyright">
        <div class="container py-2">
            <div class="row py-4">
                <div class="col-lg-1 d-flex align-items-center justify-content-center justify-content-lg-start mb-2 mb-lg-0">
                    <a href="#" class="logo pr-0 pr-lg-3">
                        <img alt="Logo Footer PPID POLIJE" src="{{ url($settings['footer_logo_image']->value) }}" class="opacity-5" height="33">
                    </a>
                </div>
                <div class="col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-start mb-4 mb-lg-0">
                    <p>© {{ $settings['website_title']->value }}, All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
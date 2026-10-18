<!-- Map Section -->
    <section class="map-section">
        {{-- Mapa do endereço da loja (config/services.php → loja) --}}
        <iframe id="gmap_canvas" title="Mapa da confeitaria" loading="lazy"
            src="https://maps.google.com/maps?q={{ rawurlencode($loja['mapa']) }}&t=&z=16&ie=UTF8&iwloc=&output=embed"></iframe>
    </section>
    <!-- End Map Section -->

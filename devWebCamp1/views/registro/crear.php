<main class="registro">
    <h2 class="registro__heading"><?php echo $titulo; ?></h2>
    <p class="registro__descripcion">Elige tu plan</p>

    <div class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCap</li>
            </ul>

            <p class="paquete__precio">$0</p>

            <form method="POST" action="/finalizar-registro/gratis">
                <input class="paquetes__submit" type="submit" value="Inscripcion Gratis">
            </form>
        </div>

        <div class="paquete">
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Presencial a DevWebCap</li>
                <li class="paquete__elemento">Pase por 2 dias</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
                <li class="paquete__elemento">Camisa del Evento</li>
                <li class="paquete__elemento">Comida y Bebida</li>
            </ul>

            <p class="paquete__precio">$199</p>

            <div class="paquete__pago">

                <!-- <form action="https://www.sandbox.paypal.com/ncp/payment/9V2UAZSF3PUGL" method="post" target="_blank"> -->
                <form method="POST" action="/finalizar-registro/pagar">
                    <input type="hidden" name="paquete_id" value="1">
                    <input class="paquetes__submit" type="submit" value="Pagar ahora" />
                    <img src=https://www.paypalobjects.com/images/Debit_Credit_APM.svg alt="cards" style="margin-top:2rem;" />
                    <section> Con la tecnología de <img src="https://www.paypalobjects.com/paypal-ui/logos/svg/paypal-wordmark-color.svg" alt="paypal" style="height:1.5rem;vertical-align:middle;"/></section>
                </form> 
            </div>

        </div>

        <div class="paquete">
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCap</li>
                <li class="paquete__elemento">Pase por 2 dias</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
            </ul>

            <p class="paquete__precio">$49</p>

            <!-- <form action="https://www.sandbox.paypal.com/ncp/payment/DJNK3X2WGABSN" method="POST" target="_blank" style="display:inline-grid;justify-items:center;align-content:start;gap:0.5rem;"> -->
            <form method="POST" action="/finalizar-registro/pagar">
                <input type="hidden" name="paquete_id" value="2">
                <input class="paquetes__submit" type="submit" value="Pagar ahora" />
                <img src=https://www.paypalobjects.com/images/Debit_Credit_APM.svg alt="cards" />
                <section> Con la tecnología de <img src="https://www.paypalobjects.com/paypal-ui/logos/svg/paypal-wordmark-color.svg" alt="paypal" style="height:0.875rem;vertical-align:middle;"/></section>
            </form>
        </div>
    </div>
</main>
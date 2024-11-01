<script>
/**
https://support.google.com/analytics/answer/7478520?hl=pt-BR
* Função que acompanha um clique em um link externo no Google Analytics.
* Essa função processa uma string de URL válida como um argumento e usa essa string de URL
* como o rótulo do evento. Ao definir o método de transporte como 'beacon', o hit é enviado
* usando 'navigator.sendBeacon' em um navegador compatível.
*/
var trackOutboundLink = function(url) {
  gtag('event', 'click', {
    'event_category': 'WhatsappWeb',
    'event_label': url,
    'transport_type': 'beacon';
    //'event_callback': function(){document.location = url;}
  });
}
</script>
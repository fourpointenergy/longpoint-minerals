<?php
global $lp_theme;
/**
 * Template for displaying the footer
 */?>
 <!-- END: page-content -->
   <section class="cookie-warning">
     <p>We use cookies to offer you a better browsing experience and analyze site traffic. Read how we use cookies and how you can control them in our <a href="/cookie-policy">Cookie Statement</a>. By continuing to use our site or by closing this box, you affirmatively consent to our use of cookies.</p>
     <p>If you wish to change your settings for our website or withdraw consent, please read our <a href="/cookie-policy">Cookie Statement</a> to learn more.</p>
     <button class="cookie-accept">accept</button>
   </section>
   <footer class="pb4">
     <div class="wrapper">
       <a href="/" class="my3 mb1 col-9 sm-col-4 pr1 pt1 left block">
         <img src="<?php $lp_theme->images_path(); ?>/logo-horiz-black.svg" alt="Longpoint Minerals Logo" class="footer-logo"/>
       </a>
       <div class="col-12 sm-col-7 inline-block contact-info-wrap">
         <ul class="contact-info pt2 mt3 list-reset line line-gold">
           <li class="bold text-uppercase"><?php the_field('footer_address_title', 'option'); ?></li>
           <li><?php the_field('footer_address_line_1', 'option'); ?></li>
           <li>Phone: <?php the_field('footer_phone', 'option'); ?></li>
           <?php if(get_field('footer_fax', 'option')) { ?>
           <li>Fax: <?php the_field('footer_fax', 'option'); ?> </li>
           <?php } ?>
           <!-- <li>Email: <a href="mailto:<?php the_field('footer_email', 'option'); ?>"><?php the_field('footer_email', 'option'); ?></a></li> -->
           <li><a href="/privacy-statement">Privacy Statement</a> | <a href="/terms-and-conditions">Terms &amp; Conditions</a> | <a href="/cookie-policy">Cookie Policy</a></li>
           <li><a href="https://www.linkedin.com/company/longpoint-minerals/" target="_blank" rel="noreferrer nofollow"><img src="/wp-content/themes/longpoint/assets/images/icons/linkedin.svg" style="margin-right:5px;height:20px;width:20px;vertical-align: text-bottom;" />Connect with us</a></li>
         </ul>
       </div>
     </div>
   </footer>
 </div> <!-- end animisition -->
  <?php wp_footer(); ?>
  <!--
  <div class="conference-overlay">
    <div class="shader"></div>
    <div class="inner">
      <h3 class="light-gold-text line line-gold">Attending NAPE?<br>Come See Us.</h3>
      <p><strong>Visit the LongPoint team at Booth #2829 during the upcoming NAPE Summit in Houston.</strong></p>
      <div class="header-left">
        <p><strong>WHEN:</strong></p>
        <p><strong>WHERE:</strong></p>
      </div>
      <div class="header-right">
        <p class="">Feb. 6-7, 2020</p>
        <p class="">George R. Brown Convention Center<br>Houston, Texas </p>
      </div>
      <a href="/conference" role="button" class="text-uppercase btn btn-blue-on-light mr2 text-elem">More info</a>
      <a href="#" class="close"><img src="/wp-content/themes/longpoint/assets/images/icons/icon-close-blue.svg"></a>
    </div>
  </div>
  -->
  <script type="text/javascript">
    window.addEventListener('DOMContentLoaded', function() {
      new LPApp();
    }, true);
  </script>
  <script type="text/javascript" id="">var HttpClient=function(){this.get=function(b,c){var a=new XMLHttpRequest;a.onreadystatechange=function(){4==a.readyState&&200==a.status&&c(a.responseText)};a.open("GET",b,!0);a.send(null)}},client=new HttpClient;client.get("https://extreme-ip-lookup.com/json",function(b,c){window.busLookup=JSON.parse(b)});</script>
  <!-- Hotjar Tracking Code for https://longpointminerals.com/ -->
  <script>
      (function(h,o,t,j,a,r){
          h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
          h._hjSettings={hjid:1607728,hjsv:6};
          a=o.getElementsByTagName('head')[0];
          r=o.createElement('script');r.async=1;
          r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
          a.appendChild(r);
      })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
  </script>
</body>
</html>

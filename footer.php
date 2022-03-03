</main>
	<?php if (function_exists("lc_custom_footer")) lc_custom_footer(); else {
		?>
		<?php if (is_active_sidebar( 'footerfull' )): ?>
		<div class="wrapper bg-light mt-5 py-5" id="wrapper-footer-widgets">
			
			<div class="container mb-5">
				
				<div class="row">
					<?php dynamic_sidebar( 'footerfull' ); ?>
				</div>

			</div>
		</div>
		<?php endif ?>
		
		  <!-- ======= Footer ======= -->
		  <footer>
		    <div class="container">
		      <div class="row">
		        <div class="col order-first">
		          <img src="<?php echo get_template_directory_uri() . '/assets/'; ?>img/logo-1.png" alt="" class="img-footer">
		        </div>
		        <div class="col">
		        <div class="row">
		          <div class="col-sm-9">
		            <p>Main</p>
		            <div class="row">
		              <div class="col-8 col-sm-6">
		                <ul class="list-unstyled">
		                    <li><a href="#about">About</a></li>
		                    <li><a href="#">Team</a></li>
		                    <li><a href="#">Partners</a></li>
		                    <li><a href="#contact">Contact us</a></li>
		                  </ul>
		              </div>
		              <div class="col-4 col-sm-6">
		                <ul class="list-unstyled">
		                    <li><a href="#about">Portfolio</a></li>
		                    <li><a href="#">Deliverables</a></li>
		                    <li><a href="#">Process</a></li>
		                    <li><a href="#contact">Techstack</a></li>
		                  </ul>
		              </div>
		            </div>
		          </div>
		        </div>
		    </div>
		        <div class="col order-last">
		          <ul class="list-ico">
		            <li><span class="bi bi-geo-alt"></span> 8819 Ohio St. South Gate, CA 90280</li>
		            <li><span class="bi bi-phone"></span>+1 386-688-3295</li>
		            <li><span class="bi bi-envelope"></span> contact@example.com</li>
		          </ul>
		        </div>
		      </div>
		    </div>
		  </footer>
		  <!-- End  Footer -->
  		<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
	<?php 
	} //END ELSE CASE ?>


	<?php wp_footer(); ?>
  <script src="<?php echo get_template_directory_uri() . '/assets/'; ?>vendor/jquery-3.6.0.min.js"></script>
  <script src="<?php echo get_template_directory_uri() . '/assets/'; ?>vendor/isotope.pkgd.min.js"></script>
  <script src="<?php echo get_template_directory_uri() . '/assets/'; ?>vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?php echo get_template_directory_uri() . '/assets/'; ?>vendor/typed.js/typed.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo get_template_directory_uri() . '/assets/'; ?>js/main.js"></script>
	</body>
</html>


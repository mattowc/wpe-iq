</div>
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Container Below')){?><?php } else {?>  <?php }?>
<?php include(TT_TPL_ROOT_PATH."bottom.php");?> <!-- bottom #end -->
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Above')){?>
<?php } else {?>  <?php }?>    
		<div id="footer">
            <div class="row">
                <div class="column column-3">
                    <h3>About</h3>
                    <p><img width="86" height="64" src="http://onewebcentric.wpengine.com/wp-content/uploads/2012/10/iq-logo.png" class="logo">IQ Express, by Learning Technics, is a learning program for treating and curing learning problems like ADHD, Dyslexia, Auditory Processing Disorder, Dysgraphia, and other learning disabilities. It uses a technique called Physio-Neuro therapy to help rewire the brain. Fully utilizing the brain's ability to heal itself, neuroplasticity.</p>
                </div>
                <div class="column column-3">
                    <h3>Support</h3>
                    <a href="/faqs/">FAQs</a><br />
                    <a href="/contact-us/">Contact</a><br />
                </div>
                <div class="column column-3">
                    <h3>Contact</h3>
                    <ul>
                        <li>Phone: 800-893-9315</li>s
                        <li>Email: support@iq-express.com</li>
                        <li>Hours: M-F 10-6pm MST</li>
                    </ul>
                </div>
            </div>
        	<div class="footer_inner"> 
                <p class="fl">Copyright &copy; 2011 - <a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></a>. 126 W. 12300 South, Suite A,
Draper, Utah 84020</p>
                <p class="fr"> 
                    <span class="copyright"><a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></a> website design by </span> 
                    <span class="templatic">   <a href="http://onewebcentric.com" title="onewebcentric.com">onewebcentric.com</a>  </span>  
                </p>
           </div>       
     	</div>
    </div>

<!-- Page generated: <?php timer_stop(1); ?> s, <?php echo get_num_queries(); ?> queries -->
<?php wp_footer(); ?>

<?php echo (get_option('ga')) ? get_option('ga') : '' ?>

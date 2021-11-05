<?php 
    require_once 'header.php';
?>
        <!-- .page-content start -->
        <div class="page-content dark custom-img-background page-title-4 page-title mb-0">
            <div class="container">
                <!-- .row start -->
                <div class="row">
                    <!-- .col-md-12 start -->
                    <div class="col-md-12 triggerAnimation animated" data-animate='fadeInUp'>
                        <!-- .simple-heading start -->
                        <div class="simple-heading mb-30">
                            <h2>Contact Information</h2>
                        </div><!-- .simple-heading end -->
                        <ul class="breadcrumb">
                            <li><a href="<?php echo base_url();?>">Home</a></li>
                            <li><a href="#">Pages</a></li>
                            <li><span class="active">Contact</span></li>
                        </ul><!-- .breadcrumb end -->
                    </div><!-- .col-md-12 end -->
                </div><!-- .row end -->
            </div><!-- .container end -->
        </div><!-- .page-content end -->

        <!-- .page-content start -->
        <div class="page-content">
            <div class="container-fluid">
                <!-- .row start -->
                <div class="row mb-0">
                    <div class="col-md-6 clearfix custom-col-padding left-col pt-80 pb-0 mb-0">
                        <!-- .simple-heading start -->
                        <section class="simple-heading">
                            <h2>Get in touch</h2>
                        </section><!-- .simple-heading end -->
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                            euismod tincidunt laoreet. Claritas est etiam processus dynamicus, qui sequitur
                            mutationem consuetudium lectorum. Eodem modo typi, qui nunc nobis videntur parum
                            clari, fiant sollemnes in futurum. </p>
                        <p>Nam liber tempor cum soluta nobis eleifend option.</p>

                        <div class="row mb-0 pt-40">
                            <div class="world-map-container">
                                <img src="<?php echo base_url(logo);?>" alt=""/>
                            </div>
                          <!--   <div class="col-md-6">
                                <div class="custom-heading">
                                    <h4>BookMarks Melbourne</h4>
                                </div>
                                <ul class="contact-info-list">
                                    <li>
                                        <address><i class="fa fa-map-marker"></i>
                                            795 South Park Avenue, Door 6 Wonderland, CA 94107, Australia</address>
                                    </li>

                                    <li>
                                        <i class="fa fa-mobile"></i>
                                        +440 875369208 - Office
                                        <br>+440 353363114 - Fax
                                    </li>

                                    <li>
                                        <i class="fa fa-paper-plane"></i>
                                        <a href="mailto:support@sitename.com"><span>support@sitename.com</span></a>
                                        <a href="mailto:info@sitename.com"><span>info@sitename.com</span></a>
                                    </li>
                                </ul>
                            </div> -->
                            <div class="col-md-6">
                                <div class="custom-heading">
                                    <h4>Save Bookmark</h4>
                                </div>
                                <br>
                                <ul class="contact-info-list">
                                    <li>
                                        <i class="fa fa-map-marker"></i>
                                        <?php echo address; ?>
                                    </li>

                                    <li>
                                        <i class="fa fa-mobile"></i>
                                        +91 <?php echo phone; ?> | Office (10AM to 10PM)
                                    </li>

                                     <li>
                                        <i class="fa fa-paper-plane"></i>
                                        <a href="mailto:<?php echo email; ?>"><span><?php echo email; ?></span></a>
                                    </li> 
                                </ul>
                            </div>
                        </div>

                    </div><!-- .col-md-6 end -->
                    <div class="col-md-6 bkg-grey custom-col-padding right-col pt-80 pb-80 mb-0">
                        <div class="simple-heading">
                            <h2>FeedBack</h2>
                        </div><!-- .simple-heading-left end -->
                        <h3 class="mb-40">Lorem ipsum dolor sit amet, consectetuer adipiscing <span>tincidunt ut laoreet</span> dolore.</h3>

                        <!-- form start -->
                        <form class="wpcf7">
                            <fieldset>
                                <span class="wpcf7-form-control-wrap your-name">
                                    <input type="text" class="wpcf7-text" id="contact-name" placeholder="Your name *">
                                </span>
                            </fieldset>

                            <fieldset>
                                <span class="wpcf7-form-control-wrap your-email">
                                    <input type="email" name="email" class="wpcf7-text" id="contact-email" placeholder="Email Address *">
                                </span>
                            </fieldset>

                            <fieldset>
                                <span class="wpcf7-form-control-wrap subject">
                                    <input type="text" class="wpcf7-text" id="contact-subject" placeholder="Subject">
                                </span>
                            </fieldset>

                            <fieldset>
                                <span class="wpcf7-form-control-wrap your-message">
                                    <textarea rows="8" class="wpcf7-textarea" id="contact-message" placeholder="Message"></textarea>
                                </span>
                            </fieldset>
                            <input type="submit" class="wpcf7-submit btn btn-big float-left" value="Submit">
                        </form><!-- .wpcf7 end -->
                    </div><!-- .col-md-6 end -->
                </div><!-- .row end -->
            </div><!-- .container end -->

            <!-- .container start -->
            <!-- <div class="container-fluid">
                <div class="row map mb-0">
                    <div id="map"></div>
                </div>          
            </div> --><!-- .container-fluid end -->
        </div><!-- .page-content end -->

<?php 
    require_once 'footer.php';
?>
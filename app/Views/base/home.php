<div class="rev_slider_wrapper">
	<div class="rev_slider fullscreenbanner" id="rev_slider">
		<ul>
			<?php
			$query = $this->db->table('slider')->get();
			foreach ($query->getResult() as $row) {
			?>
				<li data-delay="5000" data-fsmasterspeed="1000" data-masterspeed="2000" data-slotamount="7" data-transition="zoomout">
					<img alt="" class="rev-slidebg" data-bgfit="cover" data-bgposition="center right" data-bgrepeat="no-repeat" src="<?= site_url() ?>assets/images/slider/<?= $row->picture ?>">
					<div class="slide-title tp-caption tp-resizeme text-center" data-color="#fff" data-elementdelay="0.05" data-fontsize="['70','60', '60', '125']" data-fontweight="600" data-frames='[{"delay":0,"split":"chars","splitdelay":0.05,"speed":2000,"frame":"0","from":"y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]' data-height="none" data-hoffset="['0','0','0','0']" data-lineheight="['80','70', '70', '135']" data-mask_in="x:50px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-responsive_offset="on" data-splitin="chars" data-splitout="none" data-start="500" data-transform_idle="o:1;" data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power2.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-voffset="['-40','-40', '-150', '-350']" data-whitespace="normal" data-width="['850','800','650']" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']">
						<?= $row->title ?>
					</div>
					<div class="slide-subtitle tp-caption tp-resizeme text-center" data-color="#fff" data-fontsize="['18', '18', '18', '18']" data-fontweight="300" data-hoffset="['0','0','0','0']" data-lineheight="['30']" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-splitin="none" data-splitout="none" data-start="1500" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1200;e:Power1.easeInOut;" data-transform_out="opacity:0;s:1000;s:1000;" data-voffset="['70','70', '15', '15']" data-whitespace="normal" data-width="['1000','1000','550']" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']">
						<?= $row->description ?>
					</div>
					<div class="tp-caption rev-btn tp-resizeme slider-btn button-primary" data-actions='[{"event":"click","action":"scrollbelow","offset":"-70px","delay":"","speed":"2500","ease":"Power1.easeInOut"}]' data-fontsize="['15','15','15','15']" data-fontweight="600" data-frames='[{"delay":1500,"speed":1000,"frame":"0","from":"y:50px;opacity:0;fb:10px;fbr:100;","to":"o:1;fb:0;fbr:100;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;fbr:100;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"200","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;fb:0;fbr:110%;","style":"c:rgba(255,255,255,1);bs:solid;bw:0 0 0 0;"}]' data-height="none" data-hoffset="['0','0','0','0']" data-lineheight="['50','50','50','50']" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingtop="[0,0,0,0]" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="2500" data-textalign="['center','center','center','center']" data-type="button" data-voffset="['150','150','150','30']" data-whitespace="normal" data-width="['200','200','200','200']" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']" id="slide-1081-layer-130" style="">
						Learn More
					</div>
				</li>
				<!-- 				
				<li data-delay="5000" data-fsmasterspeed="1000" data-masterspeed="1000" data-slotamount="7" data-transition="slotzoom-horizontal">
					<img alt="" class="rev-slidebg" data-bgfit="cover" data-bgposition="center right" data-bgrepeat="no-repeat" src="<?= site_url() ?>assets/images/slider/<?= $row->picture ?>">
					<div class="slide-title tp-caption tp-resizeme white-color text-center" data-elementdelay="0.05" data-fontsize="['70','60', '60', '125']" data-fontweight="600" data-height="none" data-hoffset="['0','0','0','0']" data-lineheight="['80','70', '70', '135']" data-mask_in="x:50px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-responsive_offset="on" data-splitin="chars" data-splitout="none" data-start="500" data-transform_idle="o:1;" data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power2.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-voffset="['-90','-90', '-150', '-350']" data-whitespace="normal" data-width="['800','700','650']" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']">
						<?= $row->title ?>
					</div>
					<div class="slide-subtitle tp-caption tp-resizeme white-color text-center" data-fontsize="['18', '18', '18', '18']" data-fontweight="300" data-hoffset="['0','0','0','0']" data-lineheight="['30']" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-splitin="none" data-splitout="none" data-start="1500" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1200;e:Power1.easeInOut;" data-transform_out="opacity:0;s:1000;s:1000;" data-voffset="['45','25', '15', '15']" data-whitespace="normal" data-width="['1000','1000','550']" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']">
						<?= $row->description ?>
					</div>
					<div class="tp-caption rev-btn tp-resizeme slider-btn button-primary" data-actions='[{"event":"click","action":"scrollbelow","offset":"-70px","delay":"","speed":"2500","ease":"Power1.easeInOut"}]' data-fontsize="['15','15','15','15']" data-fontweight="600" data-frames='[{"delay":900,"speed":1000,"frame":"0","from":"y:50px;opacity:0;fb:10px;fbr:100;","to":"o:1;fb:0;fbr:100;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;fbr:100;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"200","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;fb:0;fbr:110%;","style":"c:rgba(255,255,255,1);bs:solid;bw:0 0 0 0;"}]' data-height="none" data-hoffset="['0','0','0','0']" data-lineheight="['50','50','50','50']" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingtop="[0,0,0,0]" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="1500" data-textalign="['center','center','center','center']" data-type="button" data-voffset="['100','100','100','30']" data-whitespace="intial" data-width="['200','200','200','200']" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']" id="slide-1081-layer-13">
						Learn More
					</div>
				</li> -->
			<?php } ?>
		</ul>
	</div>
</div>
<div class="section-block">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-12">
				<div class="dots-bg mt-40">
					<div class="section-heading text-left wow fadeInDown" data-wow-delay="0.3s">
						<!-- <small class=" primary-color">We have best experts in the field</small> -->
						<h3 class="semi-bold">Profile.</h3>
						<div class="section-heading-line line-thin"></div>
						<p style="text-align:justify"><b>Mentari Indonesia</b> is a civic and non-profit social organization. At Mentari Indonesia, we act within the spirit of empowerment for the sustainable development in Indonesia. We support and promotes empowerment activities based
							on renewable energy and local resource utilization in Indonesia. In November 2019, Mentari Indonesia was selected by Australia Awards Indonesia to conduct workshop and training program on rooftop solar panel installation
							for vocational students in North Maluku and organize a national seminar regarding solar energy utilization at the Governor’s Office, North Maluku. In 2020, during the Covid-19 pandemic, Mentari Indonesia provides a virtual
							education program regarding energy efficiency and renewable energy to schools, as well as webinar series to promote renewable energy utilization, especially solar PV in Indonesia.

						</p>
						<p style="text-align:justify">Mentari Indonesia presents a team of Indonesian millennial experts who have experience and proven expertise in energy efficiency and conservation, green building, and renewable energy, as well as conducting community development,
							workshop, and training programs at the local and national levels.</p>

						<div class="mt-30">
							<a class="button-simple" href="#">Become a client <i class="fa fa-arrow-right primary-color"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-12">
				<!-- <div class="pl-45-md">  -->
				<div class="row">
					<div class="section-heading text-left mt-40 wow fadeInDown" data-wow-delay="0.3s">
						<h3 class="semi-bold pt-1 ">What We Do.</h3>
						<div class="section-heading-line line-thin"></div>
					</div>
					<div class="col-md-6 col-sm-6 col-12 wow fadeInRight" data-wow-delay="0.8s">

						<div class="features-box-3 text-left">
							<div class="features-box-3-icon">
								<i class="icon-development"></i>
							</div>
							<h4>Research and Development on Renewable Energy Technology</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-12 wow fadeInRight" data-wow-delay="0.8s">
						<div class=" features-box-3 text-left">
							<div class="features-box-3-icon">
								<i class="icon-marketing"></i>
							</div>
							<h4>Community development program</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-12 wow fadeInRight" data-wow-delay="0.8s">
						<div class=" features-box-3 text-left">
							<div class="features-box-3-icon">
								<i class="icon-chess"></i>
							</div>
							<h4>Education program on energy efficiency and conservation, and renewable energy</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-12 wow fadeInRight" data-wow-delay="0.8s">
						<div class=" features-box-3 text-left">
							<div class="features-box-3-icon">
								<i class="icon-start"></i>
							</div>
							<h4>Solar PV installation training and workshop</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
						</div>
					</div>
				</div>
			</div>
			<!-- </div> -->
		</div>
	</div>
</div>

<!-- portofolio section  -->
<div class="section-block grey-bg background-center background-no-repeat background-contain" style="background-image: url(<?= site_url() ?>assets/base/img/content/bgs/bg2.png);">

	<div class="container">
		<div class="section-heading text-center">
			<small class="primary-color">Our Activities</small>
			<h4 class="semi-bold font-size-35">Portofolio
			</h4>
			<div class="section-heading-line line-thin"></div>
		</div>
		<div class="row mt-20">
			<div class="col-md-3 col-sm-3 col-12 wow fadeInUp" data-wow-delay="0.5s">
				<div class="service-box-3">
					<div class="inner">
						<div class="service-box-3-icon">
							<i class="icon-locked-combination-padlock-stroke"></i>
						</div>
						<h4>Training and Workshop</h4>
						<p>Rooftop solar PV installation training and workshop at SMKN 2 Kota Ternate (5 Nov 2019).</p><a class="btn btn-light" href="#">Learn More <i class="fa fa-arrow-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-12 wow fadeInUp" data-wow-delay="0.5s">
				<div class="service-box-3">
					<div class="inner">
						<div class="service-box-3-icon">
							<i class="icon-worldwide"></i>
						</div>
						<h4>National Seminar</h4>
						<p>A national seminar on solar PV implementation in North Maluku at Kantor Gubernur Maluku Utara (7 Nov 2019).</p><a class="service-box-3-btn" href="#">Learn More <i class="fa fa-arrow-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-12 wow fadeInUp" data-wow-delay="0.5s">
				<div class="service-box-3">
					<div class="inner">
						<img alt="img" src="<?= site_url() ?>assets/base/img/content/bgs/bg11.jpg">
						<h4>Rooftop PV Project</h4>
						<p>the 1st rooftop PV implementation for residential house in Ternate which has been installed by SMKN 2 Kota Ternate students (7 Des 2019).</p><a class="service-box-3-btn" href="#">Learn More <i class="fa fa-arrow-right"></i></a>
					</div>
				</div>
			</div>
			<!-- <div class="col-md-3 col-sm-3 col-12 wow fadeInUp" data-wow-delay="0.5s">
				<div class="service-box-3">
					<div class="inner">
						<div class="service-box-3-icon">
							<i class="icon-development"></i>
						</div>
						<h4>Education Program</h4>
						<p>Renewable Energy Class for Youth at Erudio Indonesia (2 Sept 2020).</p><a class="service-box-3-btn" href="#">Learn More <i class="fa fa-arrow-right"></i></a>
					</div>
				</div>
			</div> -->


			<div class="col-md-3 col-sm-3 col-12 wow fadeInUp" data-wow-delay="0.5s">
				<div class="service-block-2">
					<img alt="img" src="<?= site_url() ?>assets/base/img/content/bgs/bg11.jpg">
					<div class="service-block-2-content">
						<h4><a href="#">Insurance Consulting</a></h4><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</strong><a class="service-block-2-btn" href="#">Learn more <i class="fa fa-arrow-right primary-color"></i></a>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="container-fluid pl-0 pr-0">
	<div class="row no-gutters">
		<div class="col-md-6 col-sm-12 col-12 wow fadeInLeft" data-wow-delay="0.5s">
			<div class="full-background background-right min-350 shadow-primary" style="background-image: url(<?= site_url() ?>assets/base/img/content/home-images/dream.jpg);"></div>

			<!-- <div class="col-md-6 col-sm-6 col-12 wow fadeInLeft" data-wow-delay="0.5s"><img alt="img" class="shadow-primary rounded-border" src="<?= site_url() ?>assets/base/img/content/home-images/dream.jpg"></div> -->

		</div>
		<div class="col-md-6 col-sm-12 col-12 fadeInDown" data-wow-delay="0.8s">
			<div class="padding-10-perc grey-bg background-80 background-no-repeat background-center">
				<div class="section-heading text-left">
					<small class="grey-color font-size-20 font-weight-normal">Brand promises delivered</small>
					<h4 class="semi-bold font-size-35">Helping clients win and keep customers - profitably!</h4>
				</div>
				<div class="text-content mt-20">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequa</p>
				</div>
				<ul class="primary-list mt-20">
					<li><i class="fas fa-check-circle"></i>Solving problems, building brands.</li>
					<li><i class="fas fa-check-circle"></i>Building brands with purpose and passion.</li>
					<li><i class="fas fa-check-circle"></i>Connecting customers to your brand.</li>
				</ul>
				<div class="mt-40">
					<a class="button-primary button-sm" href="#">Learn More</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="section-block">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-12 ">
				<div class="section-heading text-left wow fadeInDown" data-wow-delay="0.5s">
					<h3 class="semi-bold"><span class="primary-color">Helping you</span> achieve profitable growth</h3>
					<div class="section-heading-line line-thin"></div>
				</div>
				<div class="text-content mt-15 wow fadeInDown" data-wow-delay="0.5s">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.cillum dolore eu fugiat nulla pariatur.</p>
				</div><a class="button-md button-primary mt-15" href="#">Become a Client</a>
			</div>
			<div class="col-md-6 col-sm-6 col-12 wow fadeInRight" data-wow-delay="0.7s">
				<div class="pl-45-md">
					<canvas class="chartjs mt-30-xs" height="270px" id="chart-1"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="section-block section-sm border-top">
	<div class="container">
		<div class="owl-carousel owl-theme clients clients-carousel">
			<?php
			$query = $this->db->table('client')->get();
			foreach ($query->getResult() as $row) {
			?>
				<a href="<?= $row->link ?>" target="_blank">
					<div class="item"><img alt="partner-image" src="<?= site_url() ?>assets/images/client/<?= $row->picture ?>" title="<?= $row->description ?>"></div>
				</a>
			<?php } ?>
		</div>
	</div>
</div>
<div class="section-block-parallax jarallax" data-jarallax="" data-speed="0.6" style="background-image: url('<?= site_url() ?>assets/base/img/content/bgs/bg10.jpg');">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-12">
				<div class="section-heading text-left">
					<h3 class="semi-bold">What people say about us</h3>
					<div class="section-heading-line line-thin"></div>
				</div>
				<div class="owl-carousel owl-theme testmonials-carousel-3">
					<div class="testmonial-box text-left">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat.</p>
						<div class="testmonial-rating">
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
						</div>
						<h4>John Doe <strong>/ CEO Founder</strong></h4>
					</div>
					<div class="testmonial-box text-left">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat.</p>
						<div class="testmonial-rating">
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
						</div>
						<h4>Angela White <strong>/ HR Manager</strong></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="section-block">
	<div class="container">
		<div class="section-heading text-center">
			<h3 class="semi-bold">Recent News</h3>
			<div class="section-heading-line line-thin dark-bg"></div>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt<br>
				ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
		</div>
		<div class="row mt-50 wow fadeInDown" data-wow-delay="0.5s">
			<?php
			$query = $this->db->table('post')->where('active', 'Y')->orderBy('created', 'desc')->limit(3)->get();
			foreach ($query->getResult() as $row) {
			?>
				<div class="col-md-4 col-sm-4 col-12 shadow p-3 mb-5 bg-white rounded">
					<div class="blog-grid">
						<a href="blog/post/<?= $row->url ?>"><img alt="blog" src="<?= site_url() ?>/assets/thumbs/<?= $row->picture ?>" onerror="this.onerror=null;this.src='<?= site_url() ?>assets/images/blank.png'"></a>
						<div class="blog-team-box">
							<h6><?= date("d M Y H:i", strtotime($row->created)) ?></h6>
						</div>
						<h4><a href="blog/post/<?= $row->url ?>"><?= character_limiter(strip_tags($row->title), 60) ?></a></h4>
						<p><?= character_limiter(strip_tags($row->content), 100) ?>.</p><a class="button-simple-primary mt-20" href="blog/post/<?= $row->url ?>">Read More <i class="fas fa-arrow-right"></i></a>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
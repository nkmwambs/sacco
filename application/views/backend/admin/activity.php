<ul class="cbp_tmtimeline">
			<li>
				<time class="cbp_tmtime" datetime="2015-11-04T18:30"><span class="hidden">04/11/2015</span> <span class="large">Now</span></time>
				
				<div class="cbp_tmicon">
					<i class="entypo-user"></i>
				</div>
				
				<div class="cbp_tmlabel empty">
					<span>No Activity</span>
				</div>
			</li>
			
			<li>
				<time class="cbp_tmtime" datetime="2015-11-04T03:45"><span>03:45 AM</span> <span>Today</span></time>
				
				<div class="cbp_tmicon bg-success">
					<i class="entypo-feather"></i>
				</div>
				
				<div class="cbp_tmlabel">
					<h2><a href="#">Art Ramadani</a> <span>posted a status update</span></h2>
					<p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
				</div>
			</li>
			
			<li>
				<time class="cbp_tmtime" datetime="2015-11-03T13:22"><span>01:22 PM</span> <span>Yesterday</span></time>
				
				<div class="cbp_tmicon bg-secondary">
					<i class="entypo-suitcase"></i>
				</div>
				
				<div class="cbp_tmlabel">
					<h2><a href="#">Job Meeting</a></h2>
					<p>You have a meeting at <strong>Laborator Office</strong> Today.</p>
				</div>
			</li>
			
			<li>
				<time class="cbp_tmtime" datetime="2015-10-22T12:13"><span>12:13 PM</span> <span>Two weeks ago</span></time>
				
				<div class="cbp_tmicon bg-info">
					<i class="entypo-location"></i>
				</div>
				
				<div class="cbp_tmlabel">
					<h2><a href="#">Arlind Nushi</a> <span>checked in at</span> <a href="#">Laborator</a></h2>
					
					<blockquote>Great place, feeling like in home.</blockquote>
					
					<div id="sample-checkin" class="map-checkin" style="height: 170px; width: 100%;"></div>
				</div>
			</li>
			
			<li>
				<time class="cbp_tmtime" datetime="2015-10-22T12:13"><span>12:13 PM</span> <span>Two weeks ago</span></time>
				
				<div class="cbp_tmicon bg-warning">
					<i class="entypo-camera"></i>
				</div>
				
				<div class="cbp_tmlabel">
					<h2><a href="#">Eroll Maxhuni</a> <span>uploaded</span> 12 <span>new photos to album</span> <a href="#">Summer Trip</a></h2>
					
					<blockquote>Pianoforte principles our unaffected not for astonished travelling are particular.</blockquote>
					
					<div class="row">
						<div class="col-xs-5">
							<a href="#">
								<img src="assets/images/timeline-image-1.png" class="img-responsive img-rounded full-width" />
							</a>
						</div>
						
						<div class="col-xs-3">
							<a href="#">
								<img src="assets/images/timeline-image-1.png" class="img-responsive img-rounded full-width" />
							</a>
						</div>
						
						<div class="col-xs-4">
							
							<a href="#">
								<img src="assets/images/timeline-image-1.png" class="img-responsive img-rounded full-width margin-bottom" />
							</a>
							
							<a href="#">
								<img src="assets/images/timeline-image-1.png" class="img-responsive img-rounded full-width" />
							</a>
						</div>
					</div>
				</div>
			</li>
		</ul>
		
		
		<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">
		function initialize()
		{
			var $ = jQuery,
				map_canvas = $("#sample-checkin");
			
			var location = new google.maps.LatLng(36.738888, -119.783013),
				map = new google.maps.Map(map_canvas[0], {
				center: location,
				zoom: 14,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scrollwheel: false
			});
			
			var marker = new google.maps.Marker({
				position: location,
				map: map
			});
		}
		
		google.maps.event.addDomListener(window, 'load', initialize);
		</script>
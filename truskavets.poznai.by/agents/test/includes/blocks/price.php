<?php
$price_json = json_decode(file_get_contents($src_url.'JSON/price.json'));
$title = strip_tags($price_json->section_title);
$sub_title = strip_tags($price_json->section_sub_title);
$dolar = (int)strip_tags($price_json->dolar);
$price = $price_json->price;
$str_stop_date = strtotime('13.12.2019');
$stop_date = date('d.m.Y',strtotime('next sunday',$str_stop_date));
$start_date = date('d.m.Y',strtotime('next friday'));

// =============================================================================
// CREATE PRICE ARRAY //
// =============================================================================
for($i = 0; $i < count($price); $i++){
	foreach($price[$i] as $key => $value){
		if($key === 'date'){
			$all_dates = create_dates($value);
			$price[$i]->date = $all_dates;
		}
	}
}
?>

<section class="price-section" id="priceSection">
	<h2 class="section-title mrb-2 aos-wrap">
		<span class="block aos-el" data-aos="fade-down"><?php echo $title; ?></span>
		<span class="divider-xs aos-el" data-aos="flip-left"></span>
	</h2>
	<h5 class="section-sub-title mrb-3 aos-wrap">
		<span class="aos-el" data-aos="fade-up"><?php echo $sub_title; ?></span>
	</h5>

	<div class="price-container container-fluid">
		<div class="row">
			<div class="col-md-12 menu-days-price" id="dolarContainer" data-dolar="<?php echo $dolar; ?>">

				<table class="table table-hover rooms-price-table">
					<thead>
						<tr>
							<th scope="col"><p class="room-table-head">Номера</p></th>
							<th scope="col">
								<div class="dropdown text-center">
									<p class="table-title">Стоимость тура<br> на 10 дней</p>
									<span>Дата выезда: </span>
									<button id="dayBtn9" class="btn dropdown-toggle day-btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										На 9 дней
									</button>
									<div class="dropdown-menu scroll-menu" id="dropDown9">
										<?php
										$_price = &$price;
										$all_weeks = get_all_weeks($start_date,$stop_date,$_price);
										for($i = 0; $i < count($all_weeks); $i++){
											if(is_object($all_weeks[$i][1])){
												if($all_weeks[$i][1]->{'offer'} !== ''){
													$offer_class = ' offer-class';
												} else {
													$offer_class = '';
												}
												if(
													strip_tags($all_weeks[$i][1]->{'1room'}) !== '' &&
													strip_tags($all_weeks[$i][1]->{'2lux'}) !== '' &&
													strip_tags($all_weeks[$i][1]->{'2room'}) !== '' &&
													strip_tags($all_weeks[$i][1]->{'3econom'}) !== '' &&
													strip_tags($all_weeks[$i][1]->{'4family'}) !== '' &&
													strip_tags($all_weeks[$i][1]->{'23econom'}) !== ''
												) {
													echo '<button class="dropdown-item'.$offer_class.'" type="button"
													data-1room="'.strip_tags($all_weeks[$i][1]->{'1room'}).'"
													data-2lux="'.strip_tags($all_weeks[$i][1]->{'2lux'}).'"
													data-2room="'.strip_tags($all_weeks[$i][1]->{'2room'}).'"
													data-3econom="'.strip_tags($all_weeks[$i][1]->{'3econom'}).'"
													data-4family="'.strip_tags($all_weeks[$i][1]->{'4family'}).'"
													data-23econom="'.strip_tags($all_weeks[$i][1]->{'23econom'}).'"
													data-offer="'.strip_tags($all_weeks[$i][1]->{'offer'}).'"
													>'.$all_weeks[$i][0].'</button>';
												}
											}
										}
										?>
									</div>
								</div>
							</th>
							<th scope="col">
								<div class="dropdown text-center">
									<p class="table-title">Стоимость тура<br> на 9 дней</p>
									<span>Дата выезда: </span>
									<button id="dayBtn8" class="btn dropdown-toggle day-btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										На 8 дней
									</button>
									<div class="dropdown-menu scroll-menu" id="dropDown8">
										<?php
										$_price = &$price;
										$all_weeks = get_all_weeks($start_date,$stop_date,$_price);
										for($i = 0; $i < count($all_weeks); $i++){
											if(is_object($all_weeks[$i][1])){
												$curr_item = &$all_weeks[$i];
												if($all_weeks[$i][1]->{'offer'} !== ''){
													$offer_class = ' offer-class';
												} else {
													$offer_class = '';
												}
												if(
													strip_tags($curr_item[1]->{'1room'}) !== '' &&
													strip_tags($curr_item[1]->{'2lux'}) !== '' &&
													strip_tags($curr_item[1]->{'2room'}) !== '' &&
													strip_tags($curr_item[1]->{'3econom'}) !== '' &&
													strip_tags($curr_item[1]->{'4family'}) !== '' &&
													strip_tags($curr_item[1]->{'23econom'}) !== ''
												) {
													echo '<button class="dropdown-item'.$offer_class.'" type="button"
													data-1room="'.strip_tags($curr_item[1]->{'1room'}).'"
													data-2lux="'.strip_tags($curr_item[1]->{'2lux'}).'"
													data-2room="'.strip_tags($curr_item[1]->{'2room'}).'"
													data-3econom="'.strip_tags($curr_item[1]->{'3econom'}).'"
													data-4family="'.strip_tags($curr_item[1]->{'4family'}).'"
													data-23econom="'.strip_tags($curr_item[1]->{'23econom'}).'"
													data-offer="'.strip_tags($all_weeks[$i][1]->{'offer'}).'"
													>'.date('d.m.Y',strtotime($curr_item[0] . '+1 day')).'</button>';
												}
											}
										}
										?>
									</div>
								</div>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><p class="room-name-table">4-х местный семейный</p></td>
							<td><div class="room-table room9day family4"></div></td>
							<td><div class="room-table room8day family4"></div></td>
						</tr>
						<tr>
							<td><p class="room-name-table">3-х местный эконом</p></td>
							<td><div class="room-table room9day econom3"></div></td>
							<td><div class="room-table room8day econom3"></div></td>
						</tr>
						<tr>
							<td><p class="room-name-table">2-х местный эконом или 3-х местный</p></td>
							<td><div class="room-table room9day econom23"></div></td>
							<td><div class="room-table room8day econom23"></div></td>
						</tr>
						<tr>
							<td><p class="room-name-table">2-х местный</p></td>
							<td><div class="room-table room9day room2"></div></td>
							<td><div class="room-table room8day room2"></div></td>
						</tr>
						<tr>
							<td><p class="room-name-table">2-х местный полулюкс</p></td>
							<td><div class="room-table room9day lux2"></div></td>
							<td><div class="room-table room8day lux2"></div></td>
						</tr>
						<tr>
							<td><p class="room-name-table">1-но местный</p></td>
							<td><div class="room-table room9day room1"></div></td>
							<td><div class="room-table room8day room1"></div></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</section>

<?php
$rooms = new Price($src_url);
?>

<section class="price-section" id="priceSection">
	<h2 class="section-title mrb-2 aos-wrap">
		<span class="block aos-el" data-aos="fade-down"><?= $rooms->title; ?></span>
		<span class="divider-xs aos-el" data-aos="flip-left"></span>
	</h2>
	<h5 class="section-sub-title mrb-3 aos-wrap">
		<span class="aos-el" data-aos="fade-up"><?= $rooms->sub_title; ?></span>
	</h5>

	<div class="price-container container-fluid">
		<div class="row">
			<div class="col-md-12 menu-days-price" id="dolarContainer" data-dolar="<?= $rooms->dolar; ?>">

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
										for($i = 0; $i < count($rooms->weeks); $i++) {
											$curr_price = $rooms->find_room($rooms->weeks[$i]);
											$date = $rooms->calc_week($rooms->weeks[$i],10);
											$offer_class = $curr_price->offer !== '' ? ' offer-class' : '';
											echo '
											<button class="dropdown-item'.$offer_class.'" type="button"
											data-1room="'.($curr_price->{'1room'}+20).'"
											data-2lux="'.($curr_price->{'2lux'}+20).'"
											data-2room="'.($curr_price->{'2room'}+20).'"
											data-3econom="'.($curr_price->{'3econom'}+20).'"
											data-4family="'.($curr_price->{'4family'}+20).'"
											data-23econom="'.($curr_price->{'23econom'}+20).'"
											data-offer="'.$curr_price->{'offer'}.'"
											>'.$date[0].'</button>
											';
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
										for($i = 0; $i < count($rooms->weeks); $i++) {
											$curr_price = $rooms->find_room($rooms->weeks[$i]);
											$date = $rooms->calc_week($rooms->weeks[$i],10);
											$cur_date = date($rooms->format,strtotime('+1 day',strtotime($date[0])));
											$offer_class = $curr_price->offer !== '' ? ' offer-class' : '';
											echo '
											<button class="dropdown-item'.$offer_class.'" type="button"
											data-1room="'.($curr_price->{'1room'}).'"
											data-2lux="'.($curr_price->{'2lux'}).'"
											data-2room="'.($curr_price->{'2room'}).'"
											data-3econom="'.($curr_price->{'3econom'}).'"
											data-4family="'.($curr_price->{'4family'}).'"
											data-23econom="'.($curr_price->{'23econom'}).'"
											data-offer="'.$curr_price->{'offer'}.'"
											>'.$cur_date.'</button>
											';
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

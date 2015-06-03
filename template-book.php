<?php 
/**
 * template-book.php
 *
 * Template Name: Book Online
 */
?>

<?php get_header(); ?>
    
    <!-- Booking Form -->
    <div class="row dark">
        <div class="container content bookTaxi">
            <h1>Book a Taxi</h1>
            <p>You can book your taxi in three easy steps secure your taxi
from wherever you are!</p>
        <?php 
        $find_service=get_page_by_title('find-service');
        $find_service=get_permalink($find_service->ID);
         ?>
        <form class="bookingForm" action="<?php echo $find_service ?>" method="post">
            <div class="first_step">
                <div class="col-md-6">
                    <select id="arrival" name="arrival">
                        <option selected>Malta International Airport</option>
                        <?php get_locations(); ?>
                    </select>
                    <span class="arrow"></span>
                </div>
                <div class="col-md-6">
                    <select id="departure" name="departure">
                        <option selected>To</option>
                        <?php get_locations(); ?>
                    </select>
                    <span class="arrow"></span>
                </div>
                <div class="col-md-6">
                    <input type="text" id="arrival-date" name="arrival-date" readonly class="date datepicker">
                </div>
                <div class="col-md-6">
                    <input type="text" id="departure-date" name="departure-date" readonly class="date datepicker">
                </div>
                <div class="col-md-6">
                    <select name="extra_stop" id="extra_stop">
                        <option selected>Extra Stop</option>
                        <?php get_locations(); ?>
                    </select>
                    <span class="arrow"></span>
                </div>
                <div class="col-md-6">
                    <select name="num_persons" id="num_persons">
                        <option selected disabled required>Number of Persons</option>
                        <?php for ($i=1;$i<=20;$i++): ?>
                            <option value="<?php echo $i ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                    <span class="arrow"></span>
                </div>
                <div class="col-md-6">
                    <select name="service" id="service">
                        <option disabled selected>Select Service</option>
                        <option value="Private">Private</option>
                        <option value="Executive">Executive</option>
                        <option value="Shared">Shared</option>
                        <option value="Ambi lift van (Wheelchair Case)">Ambi lift van (Wheelchair Case)</option>
                    </select>
                    <span class="arrow"></span>
                </div>
                <div class="col-md-6">
                    <select name="extra_service" id="extra_service">
                        <option disabled selected>Extra Service</option>
                        <option value="Baby Seat (+ 4 euro)">Baby Seat (+ 4 euro)</option>
                        <option value="Booster Seat (+ 4 euro)">Booster Seat (+ 4 euro)</option>
                    </select>
                    <span class="arrow"></span>
                </div>
                <div class="col-md-12">
                        <input type="submit" class="sub_button" value="Book Now">
                </div>
                <div class="clearfix"></div>
            </div><!-- close of first step -->
            <div class="clearfix"></div>
        </form>
        </div>
    </div>

<?php get_footer(); ?>
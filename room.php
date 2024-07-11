<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
  rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
   crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="Rooms_styles.css">
  <script src="https://kit.fontawesome.com/7516121dff.js" crossorigin="anonymous"></script>
</head>
<body>
  <?php
  include './nav.php ';
  ?>

    <div class="Room">
    <img src="hotel2.jpg" alt="Room shop">
    <div class="Room-text">
      <h1>Welcome to our Radiant hotel Ruiru!</h1>
      <p>Whether you're traveling for business or leisure, our diverse selection of rooms is designed to cater to all your needs. From elegant Deluxe Rooms and luxurious Suites to convenient Twin Rooms and spacious Family Rooms, we have the perfect accommodation for you. Enjoy your stay and feel free to reach out for any assistance. Your comfort is our priority!</p>
    </div>
  </div>

  <section class="Rooms_container"> 
    <h1>Rooms</h1>

    <div class="Rooms_cards">

      <div class="Rooms-item">
        <div class="Rooms_image">
          <img src="room_single.jpg" alt="single">
        </div>
        <div class="text">
          <h2>Single room</h2>
          <p> Cozy and modern, this spacious single room features a comfortable queen-sized bed, a work desk, and a private bathroom. Enjoy complimentary high-speed Wi-Fi and a flat-screen TV with streaming services. Located in the heart of downtown, it’s perfect for business travelers and tourists alike
          </p>
          <div class="price">ksh5,000.00</div>
          <div class="btn">
            <button onclick="window.location.href='bookings.html'">Book</button>
          </div>
        </div>
       </div>

      <div class="Rooms-item">
        <div class="text">
            
          <h2>Deluxe room</h2>
          <p>Elegant and spacious, the Deluxe Room boasts a luxurious king-sized bed, a stylish seating area, and a well-appointed en-suite bathroom. Relax with complimentary high-speed Wi-Fi, a minibar, and a large flat-screen TV. Perfect for those seeking comfort and sophistication during their stay.
          </p>
          <div class="price">ksh8,000.00</div>
          <div class="btn">
            <button onclick="window.location.href='bookings.html'">Book</button>
          </div>
        </div>
        <div class="Rooms_image">
            <img src="room_deluxe.jpg" alt="deluxe">
        </div>
        </div>
      <div class="Rooms-item">
        <div class="Rooms_image"> 
          <img src="room_twin.jpg" alt="twin">
        </div>
        <div class="text">
          <h2>Twin room</h2>
          <p>Our Twin Room offers two comfortable single beds, a work desk, and a modern en-suite bathroom, making it perfect for friends or colleagues traveling together. Enjoy amenities like complimentary high-speed Wi-Fi, a flat-screen TV, and a coffee maker. Conveniently located near major attractions and business centers.
          </p>
          <div class="price">ksh10,000.00</div>
          <div class="btn">
            <button onclick="window.location.href='bookings.html'">Book</button>
          </div>
        </div>
      </div>
        <div class="Rooms-item">
          <div class="text">
          <h2> Suite room</h2>
          <p>Experience ultimate luxury in our Suite, featuring a separate living room, a plush king-sized bed, and a lavish bathroom with a soaking tub. Enjoy exclusive amenities including complimentary high-speed Wi-Fi, a fully stocked minibar, and two flat-screen TVs. Ideal for guests desiring extra space and top-tier comfort.</p>
            <div class="price">ksh20,000.00</div>
          <div class="btn">
            <button onclick="window.location.href='bookings.html'">Book</button>
          </div>
        </div>
        <div class="Rooms_image">
            <img src="room_suite.jpg" alt="suite">
          </div>
        </div>
        <div class="Rooms-item">
          <div class="Rooms_image">
            <img src="room_family.jpg" alt="familiy">
          </div>
          <div class="text">
          <h2>familiy room</h2>
          <p>Designed for families, this spacious room includes a king-sized bed, two single beds, and a cozy seating area. The room features a private bathroom, complimentary high-speed Wi-Fi, and a large flat-screen TV with kid-friendly channels. Enjoy the perfect blend of comfort and convenience for your family getaway.
          </p>
          <div class="price">ksh18,000.00</div>
          <div class="btn">
            <button onclick="window.location.href='bookings.html'">Book</button>
          </div>
        </div>
        </div>
        
        </div>

    </div>
  </section>
   <!-- <section id="about">
        <h2>About Us</h2>
        <p>Welcome to our hotel! We are delighted to have you with us. To help you choose the perfect room for your stay, consider the Deluxe Room for a touch of elegance, the Suite for ultimate luxury and space, the Twin Room for convenient travel with friends or colleagues, and the Family Room for a comfortable family getaway. Enjoy your stay and feel free to reach out to us for any assistance! </p>
    </section> -->
   <div style="text-align: center;">
    &copy; 2024 High Quality Rooms. All rights reserved. 
   </div>
   
   </section>
    </div>
    
  
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
  rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
   crossorigin="anonymous">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" type="text/css" href="styles.css">
 
   
    <title>Room reservation system</title>
</head>
<body>
   <?php
    include './nav.php ';
    ?>

    <div class="hotel">
        <img src="hotel4.jpeg" alt="hotel">
        <div class="hotel-text">
          <h1>Welcome to our TYC Hotel!</h1>
          <p>We are thrilled to welcome you to our room reservation platform</p>
        </div>
      </div>

      <h1 class="room">Our Rooms...</h1>
<div class="container">
   
    <div class="slide">
        <div class="item" style="background-image: url('./room_single.jpg');">
            <div class="content">
                <div class="name">Single Room</div>
                <div class="des">Cozy and modern, this spacious single room features a comfortable queen-sized bed, a work desk, and a private bathroom. Enjoy complimentary high-speed Wi-Fi and a flat-screen TV with streaming services. Located in the heart of downtown, it’s perfect for business travelers and tourists alike</div>
                </div>
        </div>
        <div class="item" style="background-image: url('./room_twin.jpg');">
            <div class="content">
                <div class="name">Twin Room</div>
                <div class="des">Our Twin Room offers two comfortable single beds, a work desk, and a modern en-suite bathroom, making it perfect for friends or colleagues traveling together. Enjoy amenities like complimentary high-speed Wi-Fi, a flat-screen TV, and a coffee maker. Conveniently located near major attractions and business centers.</div>
                </div>
        </div>
        <div class="item" style="background-image: url('./room_deluxe.jpg');">
            <div class="content">
                <div class="name">Deluxe Room</div>
                <div class="des">Elegant and spacious, the Deluxe Room boasts a luxurious king-sized bed, a stylish seating area, and a well-appointed en-suite bathroom. Relax with complimentary high-speed Wi-Fi, a minibar, and a large flat-screen TV. Perfect for those seeking comfort and sophistication during their stay.</div>
                </div>
        </div>
        <div class="item" style="background-image: url('./room_family.jpg');">
            <div class="content">
                <div class="name">Family Room</div>
                <div class="des">Designed for families, this spacious room includes a king-sized bed, two single beds, and a cozy seating area. The room features a private bathroom, complimentary high-speed Wi-Fi, and a large flat-screen TV with kid-friendly channels. Enjoy the perfect blend of comfort and convenience for your family getaway.</div>
                </div>
        </div>
        <div class="item" style="background-image: url('./room_suite.jpg');">
            <div class="content">
                <div class="name">Suite</div>
                <div class="des">Experience ultimate luxury in our Suite, featuring a separate living room, a plush king-sized bed, and a lavish bathroom with a soaking tub. Enjoy exclusive amenities including complimentary high-speed Wi-Fi, a fully stocked minibar, and two flat-screen TVs. Ideal for guests desiring extra space and top-tier comfort.</div>
            </div>
        </div>
    </div>

    <div class="button">
        <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
        <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
    </div>
</div>

<script>
    let next = document.querySelector('.next');
    let prev = document.querySelector('.prev');

    next.addEventListener('click', function(){
        let items = document.querySelectorAll('.item');
        document.querySelector('.slide').appendChild(items[0]);
    });

    prev.addEventListener('click', function(){
        let items = document.querySelectorAll('.item');
        document.querySelector('.slide').prepend(items[items.length - 1]);
    });
</script>
<script src="https://kit.fontawesome.com/7516121dff.js" crossorigin="anonymous"></script>
</body>
</html>
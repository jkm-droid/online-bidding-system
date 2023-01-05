<h1>Online Bidding System</h1>
<h3>Scope</h3>
<ul>
<li>Its an online system that will allow buyers to bid for items being auction. </li>
<li>In the case where the same item with different features is being auction it will 
need to compare and display the two different features for the buyer to be able 
to make an easy and fast decision on which item to bid on</li>
<li>The system should fully signal the products available for auctioning</li>
<li>It should store and generate report on completed bids</li>
<li>Each bid should last for certain duration of time</li>
</ul>

<h3>Players</h3>
<h4>Sellers and buyers.</h4>
<li>The sellers should also have some ratings depending on the successful sells made to increase customer trust</li>
<li>Only the registered users can place their bids</li>
<li>And obviously the highest bidder owns the property in the case where he placed his bid before the stipulated time elapsed</li>

<h3>Functions</h3>
<li>In the case where bidders are not bidding or they are bidding at relatively low amount, the system can place 
a fake bid to motivate the to bid higher.(idk if this can be possible?)</li>
<li>The admin should upload a clear image/images of the item, its specification and set the lowest amount the item can be purchased.</li>
<li>In the case where the set amount is not reached or no one bidded the bidding is considered as unsuccessful</li>

<h3>Admin Role</h3>
<li>On the admin side kukuwe na a list of sellers with-name, contact, location, rating(which can be updated by the admin after a successful sell)</li>
<li>During item entry and description the admin  will be prompted to enter the sellers details from the list.</li>

<h3>Registered users(buyers)</h3>
<li>When a registered user is bidding  he/she can view both the item details  and seller details including rating to increase buyer to seller trust</li>

<h3>Similar bids</h3>
<li>In the case where two or more items are available for bidding(lets say 2 hp laptops)</li>
<li>A comparison of their specs is displayed to aid the bidder to aid the bidder in  making a decision  on what item to bid on and what to leave.
i.e
Comparison of price, Ram and ssd/harddisk storage, colour, screen size etc</li>

    Database Design
    Tables
    Admin - username,email,phone_number, password
    Buyers/Users - full_name,email/phone_number,password
    Products - name, price, specs, availability
    Bids - product_id, buyer_id, bid_price
    Sellers - full_name,email/phone_number,location,rating
    
    Relationships
    Products - Sellers - one-to-many
    Products - Bids - one-to-many
    Buyers - Bids - one-to-many

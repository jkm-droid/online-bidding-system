Scope
Its a online system that will allow buyers to bid for items being auction. 
In the case where the same item with different features is being auction it will 
need to compare and display the two different features for the buyer to be able 
to make a easy and fast decision on which item to bid on
The system should fully signal the products available for auctioning
It should store and generate report on completed bids
Each bid should last for certain duration of time

Players
Sellers and buyers.
The sellers should also have some ratings depending on the successful sells made to increase customer trust
Only the registered users can place their bids
And obviously the highest bidder owns the property in the case where he placed his bid before the stipulated time elapsed

Functions
In the case where bidders are not bidding or they are bidding at relatively low amount, the system can place 
a fake bid to motivate the to bid higher.(idk if this can be possible?)
The admin should upload a clear image/images of the item, its specification and set the lowest amount the item can be purchased.
In the case where the set amount is not reached or no one bidded the bidding is considered as unsuccessful

Admin Role
On the admin side kukuwe na a list of sellers with-name, contact, location, rating(which can be updated by the admin after a successful sell)
During item entry and description the admin  will be prompted to enter the sellers details from the list.

Registered users(buyers)
When a registered user is bidding  he/she can view both the item details  and seller details including rating to increase buyer to seller trust

Similar bids
In the case where two or more items are available for bidding(lets say 2 hp laptops)
A comparison of their specs is displayed to aid the bidder to aid the bidder in  making a decision  on what item to bid on and what to leave.
i.e
Comparison of price, Ram and ssd/harddisk storage, colour, screen size etc

Database Design
    Tables
    Admin - username,email,phone_number, password
    Buyers/Users - full_name,email/phone_number,password
    Products - price, specs, availability
    Bids - product_id, seller_id, bid_price
    Sellers - full_name,email/phone_number,password,location,rating
    
    Relationships
    Products - Sellers - one-to-many
    Products - Bids - one-to-many
    Buyers - Bids - one-to-many
# online-bidding-system

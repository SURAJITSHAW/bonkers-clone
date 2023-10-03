# bonkers-clone-frontend
This is clone project, where trying to replicate https://www.bonkerscorner.com/


## Things to wrok on:
- modify add-cart button with AJAX
- display:none for wishlist button while not logged in, and if logged in store the p_id associated to user_id
- if the cart is empty view cart (cart details page) design got dystorted, same with proceed page
- proceed.php: at the side show the no of addresses user have stored, add a radio button option to which one to choose. And also give option to create a new address
- About address DB table: create a separate table for the address which will in a way ralted to users somehow.
- Had to modify 'orders' table: there's 2 way possible I can store p_id of the order products:
            1. create a separate table for storing product details associated with the order_id
            2. else put p_id with comma separated in the same order table itself
- 
 
